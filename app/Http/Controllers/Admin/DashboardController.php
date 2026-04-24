<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminUsers;
use Redirect;
use DB;
use Auth;
use App\Models\Comment;


class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('login','logout');
    }

   public function dashboard(){
        $user = Auth::guard('admins')->user();

        $title = "Dashboard";
        $orders = DB::table('imagefootage_orders')->count();
        $users = DB::table('imagefootage_users')->count();
        $products = DB::table('imagefootage_products')->count();
        $subs = DB::table('imagefootage_user_package') ->groupBy('user_id')->count();
        if ($subs) {
            $subspercentage = ($subs*100)/$users;
        }

         // Fetch open and in-progress comments
    $pendingComments = Comment::with('admin', 'agent')
        ->whereIn('status', ['Open', 'In Progress'])
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
    
        // Add user data to each comment
        foreach($pendingComments as $comment) {
            $comment->user = DB::table('imagefootage_users')->find($comment->user_id);
        }
    
    $data['pending_comments'] = $pendingComments;
    $data['pending_comments_count'] = $pendingComments->count();
    

        $data['orders'] = $orders;
        $data['products'] = $products;
        $data['users'] = $users;
        $data['subspercentage'] = $subspercentage ?? 0;
        return view('admin.dashboard.dashboard', compact('title'), ['data' => $data]);
	}

}
