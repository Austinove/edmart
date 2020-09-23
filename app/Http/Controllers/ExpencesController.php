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
                    "status" => "Not Viewed",
                    "viewed" => 0,
                    "reason" => "No Reason"
                ])
            );
            return response()->json([
                'msg' => "Expence Saved Successfull",
                'expences' => $user->expences()->whereIn("status", ["Not Viewed", "Viewed", "Under Review", "recommended"])
                                ->orderBy("created_at", "desc")->get()
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
                    "viewed" => 0,
                    "reason" => "No Reason"
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
                'expences' => $user->expences()->whereIn("status", ["Not Viewed", "Viewed", "Under Review", "recommended"])
                            ->orderBy("created_at", "desc")->get()
            ]);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //fetching expences
    public function fetch()
    {
        $user = User::findOrFail(Auth::user()->id);
        return response()->json($user->expences()
                        ->whereIn("status", ["Not Viewed", "Viewed", "Under Review", "recommended", "waiting", "ViewedClarify"])
                        ->orderBy("created_at", "desc")->get());
    }

    //fetching cancelled expenses
    public function cancelled(Request $request)
    {
        $inputs = $request->all();
        $month = $inputs['month'];
        try {
            $expencesCanclled = DB::table('expences')
                ->join("cancelled_exps", "expences.id", "=", "cancelled_exps.expences_id")
                ->where("cancelled_exps.created_at", "LIKE", "%{$month}%")
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

    //fetching Pending expenses for hr
    public function pending()
    {
        try {
            $pending =
            DB::table('expences')
            ->join("users", "expences.user_id", "=", "users.id")
            ->select(
                "expences.id",
                "expences.desc",
                "expences.created_at",
                "expences.user_id",
                "expences.amount",
                "users.name",
                "expences.status",
                "expences.reason"
                )
            ->where("expences.status", "=", "Not Viewed")
            ->orwhere("expences.status", "=", "Viewed")
            ->orderBy("created_at", "desc")->get();
            return response()->json($pending);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //fetching declined expenses from Admin
    public function clarify()
    {
        try {
            $clarify =
                DB::table('expences')
                ->join("users", "expences.user_id", "=", "users.id")
                ->select(
                    "expences.id",
                    "expences.desc",
                    "expences.created_at",
                    "expences.user_id",
                    "expences.amount",
                    "users.name",
                    "expences.status",
                    "expences.reason"
                )
                ->where("expences.status", "=", "waiting")
                ->orwhere("expences.status", "=", "ViewedClarify")
                ->orderBy("created_at", "desc")->get();
            return response()->json($clarify);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    // hr marking viewed
    public function viewed(Request $request) {
        $expWait = "Viewed";
        $inputs = $request->all();
        if($inputs['clarify'] === "clarify"){
            $expWait = "ViewedClarify";
        }
        try {
            Expences::where("id", "=", $inputs["id"])->update([
                "status" => $expWait
            ]);
            //returning pending Expenses
            return $this->pending();
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

    //Fetch Revised Expenses to Admin
    public function getRevised() {
        $revisedExpenses = DB::table('requested_exps')
        ->join("expences", "requested_exps.expences_id", "=", "expences.id")
        ->join("users", "expences.user_id", "=", "users.id")
        ->select(
            "expences.id",
            "expences.desc",
            "expences.amount",
            "users.name",
            "requested_exps.created_at",
            "requested_exps.viewed",
            "expences.reason"
        )->where("recommended", "=", 2)->orderBy("created_at", "desc")->get();
        return response()->json($revisedExpenses);
    }

    //Hr revised action Expense to Admin
    public function revised(Request $request){
        $inputs = $request->all();
        try {
            RequestedExps::where("expences_id", "=", $inputs["id"])->update([
                "viewed" => Auth::user()->id,
                "recommended" => 2
            ]);
            Expences::where("id", "=", $inputs["id"])->update([
                "status" => "recommended",
                "reason" => $inputs["others"]
            ]);
            //returning expenses for revising
            return $this->clarify();
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
            //returning pending Expenses
            return $this->pending();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //Deleting Expense
    public function delete($id){
        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->expences()->where("id", "=", $id)->delete();
            return response()->json([
                'msg' => "Expense Widrawn Successfully"
            ]);
        } catch (QueryException $th) {
            throw $th;
        }
        
    }

    //Fetch hr Recommendations for admin
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
                "requested_exps.viewed",
                "expences.reason"
            )->where("recommended", "=", 1)->orderBy("created_at", "desc")->get();
            return response()->json($expencesRecommended);
    }

    //Fetching accepted expenses for hr
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
        try {
            Expences::where("id", "=", $inputs["id"])->update([
                "status" => "waiting",
                "reason" => $inputs["others"]
            ]);
            RequestedExps::where("expences_id", "=", $inputs["id"])->update([
                "recommended" => 0
            ]);
            // get revised expenses
            return $this->getRevised();
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
        $inputs = $request->all();
        try {
            $expense = Expences::findOrFail($inputs[0]);
            $expense->cancelledExps()->update([
                "viewed" => 1
            ]);
            //return something
            return response()->json(["msg"=>"viewed"]);
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
                "users.position",
                "approved_exps.created_at",
                "approved_exps.viewed"
            )->orderBy("created_at", "desc")->get();
            // return view('finance.pdf_view', ["show" => $show, "month" => $month]);
            $pdf = PDF::loadView('finance.pdf_view', ["show" => $show, "month" => $month]);
            return $pdf->download('edmart_expenses.pdf');
        } catch (QueryException $th) {
            throw $th;
        }
        
    }
}
