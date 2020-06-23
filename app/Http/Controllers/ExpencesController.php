<?php

namespace App\Http\Controllers;

use App\cancelledExps;
use App\Expences;
use App\ApprovedExps;
use App\RequestedExps;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            $user->expences()->save(
                new Expences([
                    "desc" => $inputs["desc"],
                    "amount" => $inputs["amount"],
                    "status" => "pending"
                ])
            );
            return response()->json([
                'msg' => "Expence Saved Successfull",
                'expences' => $user->expences
            ]);
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //fetching expences
    public function fetch()
    {
        $user = User::findOrFail(Auth::user()->id);
        return response()->json($user->expences);
    }

    //fetching cancelled expences
    public function cancelled()
    {
        try {
            $expencesCanclled = DB::table('expences')
                ->join("cancelled_exps", "expences.id", "=", "cancelled_exps.expences_id")
                ->select("expences.id", "expences.desc", "expences.amount", "cancelled_exps.created_at", "cancelled_exps.viewed")
                ->where('user_id', "=", Auth::user()->id)->get();
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
            ->where('status', "=", "pending")->get();
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
            "recommended" => 1,
            "aproved" => 0
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
            "viewed" => Auth::user()->id
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
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $this->validate($request, [
            "amount" => "required",
            "desc" => "required"
        ]);
        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->expences()->where("id", "=", $id)->update([
                "amount" => $inputs["amount"],
                "desc" => $inputs["desc"]
            ]);
            return response()->json([
                'msg' => "Expence Saved Successfull",
                'expences' => $user->expences
            ]);
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
                'msg' => "Expence Widrawn Successfully",
                'expences' => $user->expences
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
            )->where("recommended", "=", 1)->get();
            return response()->json($expencesRecommended);
    }

    //Admin Acceptance
    public function accept(Request $request){
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
                "recommended" => 0,
                "aproved" => 1
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
            "viewed" => Auth::user()->id
        ]);
        try {
            $expense = Expences::findOrFail($inputs["id"]);
            $expense->cancelledExps()->save($saveExpense);
            Expences::where("id", "=", $inputs["id"])->update([
                "status" => "cancelled"
            ]);
            RequestedExps::where("expences_id", "=", $inputs["id"])->update([
                "recommended" => 0,
                "aproved" => 0
            ]);
            // hr recommended Expences
            return $this->hrRecommendation();
        } catch (QueryException $th) {
            throw $th;
        }
    }

    //Approved Expences
    public function approved(Request $request){
        $inputs = $request->all();
        $month = $inputs['month'];
        $approvedExpences = DB::table('approved_exps')
            ->where("created_at", "LIKE", "%{$month}%")
            // ->join("expences", "approved_exps.expences_id", "=", "expences.id")
            // ->join("users", "expences.user_id", "=", "users.id")
            // ->select(
            //     "expences.id",
            //     "expences.desc",
            //     "expences.amount",
            //     "users.name",
            //     "approved_exps.created_at",
            //     "approved_exps.viewed"
            //     )
                ->get();
        return response()->json($approvedExpences);
    }
}
