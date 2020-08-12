<?php

namespace App\Http\Controllers;

use App\cancelledExps;
use App\Expences;
use App\ApprovedExps;
use App\RequestedExps;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class ExpencesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application expences.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('finance.expences');
    }

    //creating new expences
    public function create(Request $request)
    {
        $this->validate($request, [
            "desc" => "required",
            "amount" => "required|numeric",
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $inputs = $request->all();
        
        //if expense is for Executive, we call executive expenses creator
        if (Auth::user()->userType !== "worker") {
            $content = new Request();
            $content = $request;
            return $this->executiveExpenses($content);
        }
        try {
            $user->expences()->save(
                new Expences([
                    "desc" => $inputs["desc"],
                    "amount" => $inputs["amount"],
                    "status" => "pending",
                    "viewed" => 0
                ])
            );
            return response()->json([
                'msg' => "Expence Saved Successfull",
                'expences' => $user->expences()->orderBy("created_at", "desc")->get()
            ]);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //Executive expenses being created function
    public function executiveExpenses(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        $inputs = $request->all();
        $recommendStatus = 1;
        $newExpenseStatus = "recommended";
        if(Auth::user()->userType === "admin") {
            $recommendStatus = "accepted";
            $newExpenseStatus = "accepted";
        }
        try {
            $expenseId = $user->expences()->save(
                new Expences([
                    "desc" => $inputs["desc"],
                    "amount" => $inputs["amount"],
                    "status" => $newExpenseStatus,
                    "viewed" => 0
                ])
            )->id;
            $expense = Expences::findOrFail($expenseId);
            $expense->requestedExps()->save(
                new RequestedExps([
                    "viewed" => Auth::user()->id,
                    "recommended" => $recommendStatus
                ])
            );
            return response()->json([
                'msg' => "Expence Saved Successfull",
                'expences' => $user->expences()->orderBy("created_at", "desc")->get()
            ]);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //fetching expences
    public function fetch()
    {
        $user = User::findOrFail(Auth::user()->id);
        return response()->json($user->expences()->orderBy("created_at", "desc")->get());
    }

    //fetching cancelled expences
    public function cancelled()
    {
        try {
            $expencesCanclled = DB::table('expences')
                ->join("cancelled_exps", "expences.id", "=", "cancelled_exps.expences_id")
                ->select(
                    "expences.id", 
                    "expences.desc", 
                    "expences.amount", 
                    "cancelled_exps.created_at", 
                    "cancelled_exps.viewed",
                    "cancelled_exps.reason"
                    )
                ->where('user_id', "=", Auth::user()->id)->orderBy("created_at", "desc")->get();
            return response()->json($expencesCanclled);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //fetching Pending expences
    public function pending()
    {
        try {
            $pending =
            DB::table('expences')
            ->join("users", "expences.user_id", "=", "users.id")
            ->select("expences.id", "expences.desc", "expences.created_at", "expences.user_id", "expences.amount", "users.name")
            ->where('status', "=", "pending")->orderBy("created_at", "desc")->get();
            return response()->json($pending);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //Recommending Expense
    public function recommend(Request $request)
    {
        $inputs = $request->all();
        $saveExpense = new RequestedExps([
            "viewed" => Auth::user()->id,
            "recommended" => 1
            ]);
        try {
            $expense = Expences::findOrFail($inputs["id"]);
            $expense->requestedExps()->save($saveExpense);
            Expences::where("id", "=", $inputs["id"])->update([
                "status" => "recommended"
            ]);
            //returning pending Expenses
            return $this->pending();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //Declining Expense
    public function decline(Request $request)
    {
        $inputs = $request->all();
        $saveExpense = new cancelledExps([
            "viewed" => 0,
            "reason" => $inputs["others"]
        ]);
        try {
            $expense = Expences::findOrFail($inputs["id"]);
            $expense->cancelledExps()->save($saveExpense);
            Expences::where("id", "=", $inputs["id"])->update([
                "status" => "cancelled"
            ]);
            //returning pending Expences
            return $this->pending();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //Updating Expense
    // public function update(Request $request, $id)
    // {
    //     $inputs = $request->all();
    //     $this->validate($request, [
    //         "amount" => "required",
    //         "desc" => "required"
    //     ]);
    //     try {
    //         $user = User::findOrFail(Auth::user()->id);
    //         $user->expences()->where("id", "=", $id)->update([
    //             "amount" => $inputs["amount"],
    //             "desc" => $inputs["desc"],
    //             "viewed" => 0
    //         ]);
    //         return response()->json([
    //             'msg' => "Expence Saved Successfull",
    //             'expences' => $user->expences()->orderBy("created_at", "desc")
    //         ]);
    //     } catch (QueryException $th) {
    //         throw $th;
    //     }
    // }

    //Deleting Expense
    public function delete($id){
        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->expences()->where("id", "=", $id)->delete();
            return response()->json([
                'msg' => "Expence Widrawn Successfully",
                'expences' => $user->expences()->orderBy("created_at", "desc")
            ]);
        } catch (QueryException $th) {
            throw $th;
        }
        
    }

    //hr Recommendations
    public function hrRecommendation(){
        $expencesRecommended = DB::table('requested_exps')
            ->join("expences", "requested_exps.expences_id", "=", "expences.id")
            ->join("users", "expences.user_id", "=", "users.id")
            ->select(
                "expences.id",
                "expences.desc",
                "expences.amount",
                "users.name",
                "requested_exps.created_at",
                "requested_exps.viewed"
            )->where("recommended", "=", 1)->orderBy("created_at", "desc")->get();
            return response()->json($expencesRecommended);
    }

    //Fetching accepted expenses for admin
    public function getAccepted()
    {
        $expencesAccepted = DB::table('requested_exps')
        ->join("expences", "requested_exps.expences_id", "=", "expences.id")
        ->join("users", "expences.user_id", "=", "users.id")
        ->select(
            "expences.id",
            "expences.desc",
            "expences.amount",
            "users.name",
            "requested_exps.created_at",
            "requested_exps.viewed"
        )->where("recommended", "=", "accepted")->orderBy("created_at", "desc")->get();
        return response()->json($expencesAccepted);
    }

    //Hr Cash Outs
    public function cashOut(Request $request){
        $inputs = $request->all();
        $saveExpense = new ApprovedExps([
            "viewed" => 0
        ]);
        try {
            $expense = Expences::findOrFail($inputs["id"]);
            $expense->approvedExps()->save($saveExpense);
            Expences::where("id", "=", $inputs["id"])->update([
                "status" => "accepted"
            ]);
            RequestedExps::where("expences_id", "=", $inputs["id"])->update([
                "recommended" => 0
            ]);
            //getting recommended expenses
            return $this->getAccepted();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //Admin Acceptance
    public function accept(Request $request)
    {
        $inputs = $request->all();
        try {
            RequestedExps::where("expences_id", "=", $inputs["id"])->update([
                "recommended" => "accepted"
            ]);

            //getting recommended expenses
            return $this->hrRecommendation();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //Admin Declining
    public function adminDecline(Request $request){
        $inputs = $request->all();
        $saveExpense = new cancelledExps([
            "viewed" => 0
        ]);
        try {
            $expense = Expences::findOrFail($inputs["id"]);
            $expense->cancelledExps()->save($saveExpense);
            Expences::where("id", "=", $inputs["id"])->update([
                "status" => "cancelled"
            ]);
            RequestedExps::where("expences_id", "=", $inputs["id"])->update([
                "recommended" => 0
            ]);
            // hr recommended Expences
            return $this->hrRecommendation();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    // function to retrieve all approved expences
    public function allApproved($month){
        $approvedExpences = DB::table('approved_exps')
        ->where("approved_exps.created_at", "LIKE", "%{$month}%")
        ->join("expences", "approved_exps.expences_id", "=", "expences.id")
        ->join("users", "expences.user_id", "=", "users.id")
        ->select(
            "expences.id",
            "expences.desc",
            "expences.amount",
            "users.name",
            "approved_exps.created_at",
            "approved_exps.viewed"
        )->orderBy("created_at", "desc")->get();
        return response()->json($approvedExpences);
    }

    //Approved Expences for both hr and admin
    public function approved(Request $request){
        $inputs = $request->all();
        $month = $inputs['month'];
        return $this->allApproved($month);
    }

    //User approved Expences
    public function userApproved(Request $request){
        $inputs = $request->all();
        $month = $inputs['month'];
        //registering view
        if ($inputs["id"] > 0) {
            try {
                $expense = Expences::findOrFail($inputs["id"]);
                $expense->approvedExps()->update([
                    "viewed" => 1
                ]);
            } catch (QueryException $th) {
                throw $th;
            }
        }

        //retrieving Approved expences
        try {
            $approvedExpences = DB::table('approved_exps')
            ->where("approved_exps.created_at", "LIKE", "%{$month}%")
            ->join("expences", "approved_exps.expences_id", "=", "expences.id")
            ->where('expences.user_id', "=", Auth::user()->id)
            ->join("users", "expences.user_id", "=", "users.id")
            ->select(
                "expences.id",
                "expences.desc",
                "expences.amount",
                "users.name",
                "approved_exps.created_at",
                "approved_exps.viewed"
                )->orderBy("created_at", "desc")->get();
            return response()->json($approvedExpences);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    // appling viewed of cancelled expenses
    public function cancelledViewed(Request $request) {
        try {
            $expense = Expences::findOrFail($request[0]);
            $expense->cancelledExps()->update([
                "viewed" => 1
            ]);
            //returning cancelled Expences
            return $this->cancelled();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    // printing the pdf
    public function printPDF($month){
        try {
            $show = DB::table('approved_exps')
            ->where("approved_exps.created_at", "LIKE", "%{$month}%")
            ->join("expences", "approved_exps.expences_id", "=", "expences.id")
            ->join("users", "expences.user_id", "=", "users.id")
            ->select(
                "expences.id",
                "expences.desc",
                "expences.amount",
                "users.name",
                "approved_exps.created_at",
                "approved_exps.viewed"
            )->orderBy("created_at", "desc")->get();
            // return view('finance.pdf_view', ["show" => $show, "month" => $month]);
            $pdf = PDF::loadView('finance.pdf_view', ["show" => $show, "month" => $month]);
            return $pdf->download('meduim.pdf');
        } catch (QueryException $th) {
            throw $th;
        }
        
    }
}
