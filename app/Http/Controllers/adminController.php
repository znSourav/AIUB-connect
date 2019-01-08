<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\PostInfo;

class adminController extends Controller
{
  public function index(Request $request)
  {
    $users = User::all();
    $posts = PostInfo::all();

    $search=DB::table('users')
            ->join('postinfo','users.userId','=','postinfo.user_id')
            ->select('users.department')
            ->get();

    return view('admin.admin',['user'=>$users,'post'=>$posts,'search'=>$search]);
  }

  public function view(Request $request,$id)
  {
    $other=User::find($id);
    $posts=PostInfo::where('user_id',$id)
          ->where('post_type','Public')
          ->orderBy('post_id', 'DESC')
          ->get();

    return view('admin.view')->with('otherInfo',$other)->with('postInfo',$posts);
  }
}
