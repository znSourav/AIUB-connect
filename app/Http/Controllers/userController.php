<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Connect;
use App\PostInfo;

class userController extends Controller
{
  public function index(Request $request,$id)
  {
    $connected = Connect::find($request->session()->get('user'));
    if($connected->connected_with == "")
    {
      $cons=$request->session()->get('user');
    }
    else
    {
      $cons=$connected->connected_with."**".$request->session()->get('user');
      $val=explode("**",$cons);
    }
    $post = array();

    error_log(sizeof($val));

    for($i=0;$i<sizeof($val);$i++)
    {


      $posts=PostInfo::where('user_id',$val[$i])
            ->where(function($q) {
              $q->where('post_type','Public')
              ->orwhere('post_type','Followers');
              })
            ->orderBy('post_id', 'DESC')
            ->get();

      for($j=0;$j<sizeof($posts);$j++)
      {
        error_log($posts[$j]);
        array_push($post,$posts[$j]);  
      }
    }

    $user=User::find($id);
    error_log($id);
    return view('user.home')->with('userInfo',$user)->with('postInfo',$post);
  }

  public function changePic(Request $request,$id)
  {
    if($request->get('change'))
    {
      if($request->has('imageProPic'))
      {
        $image=$request->file('imageProPic');
        $input['imagename']= $id.'propic'.'.'.$image->getClientOriginalExtension();
        $destination = '/xampp/htdocs/connectapi/'.$id;
        $filename= '\xampp\htdocs\connectapi\\'.$id.'\\'.$input['imagename'];
        $image->move($destination,$input['imagename']);
      }
      $user=User::find($id);
      $user->pic_flag=1;
      $user->modified_pic=$filename;
      $user->save();
    }
    else if($request->get('reset'))
    {
      $user=User::find($id);
      $user->pic_flag=0;
      $user->save();
    }
    return redirect()->route('user.profile',['id'=>$id]);
  }
  public function changeCover(Request $request,$id)
  {
    if($request->get('change'))
    {
      if($request->has('imageCoverPic'))
      {
        $image=$request->file('imageCoverPic');
        $input['imagename']= $id.'coverpic'.'.'.$image->getClientOriginalExtension();
        $destination = '/xampp/htdocs/connectapi/'.$id;
        $filename= '\xampp\htdocs\connectapi\\'.$id.'\\'.$input['imagename'];
        $image->move($destination,$input['imagename']);
      }
      $user=User::find($id);
      $user->cover_pic=$filename;
      $user->save();
    }
    return redirect()->route('user.profile',['id'=>$id]);
  }

  public function profile(Request $request,$id)
  {
    $user=User::find($id);
    $posts=PostInfo::where('user_id',$id)
            ->orderBy('post_id', 'DESC')
            ->get();

    return view('user.profile')->with('postInfo',$posts)->with('userInfo',$user);
  }

  public function schedule(Request $request,$id)
  {
    $user=User::find($id);
    $courses=Course::where('student_id',$id)
            ->get();
    
    return view('user.schedule')->with('schedule',$courses)->with('userInfo',$user);
  }


   public function message(Request $request,$id)
  {
    $user=User::find($id);
    $courses=Course::where('student_id',$id)
            ->get();
    
    return view('user.message')->with('userInfo',$user);
  }

  
  public function view(Request $request,$id)
  {
    $user=User::find($request->session()->get('user'));
    $other=User::find($id);
    $posts=PostInfo::where('user_id',$id)
          ->where('post_type','Public')
          ->orderBy('post_id', 'DESC')
          ->get();

    error_log($posts);


    return view('user.view')->with('otherInfo',$other)->with('userInfo',$user)->with('postInfo',$posts);
  }

  public function viewConnected(Request $request,$id)
  {

    $user=User::find($request->session()->get('user'));
    $other=User::find($id);
    $posts=PostInfo::where('user_id',$id)
          ->where('post_type','Public')
          ->orwhere('post_type','Followers')
          ->orderBy('post_id', 'DESC')
          ->get();

    error_log($posts);
    return view('user.viewConnected')->with('otherInfo',$other)->with('userInfo',$user)->with('postInfo',$posts);

  }
}
