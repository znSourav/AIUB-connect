<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostInfo;
use App\User;

class postController extends Controller
{
  public function insert(Request $request,$id)
  {
    $request->session()->put('url.intended',url()->previous());
    $time="";

    if($request->has('image'))
    {
      date_default_timezone_set('Asia/Dhaka'); 
      $time = date("Y-m-d H:i:s");
      $time = str_replace(':','-',$time);

      $image=$request->file('image');
      $input['imagename']= $time.'.'.$image->getClientOriginalExtension();
      $destination = '/xampp/htdocs/connectapi/'.$id.'/uploads/';
      $filename= '\xampp\htdocs\connectapi\\'.$id.'\\uploads\\'.$input['imagename'];
      $image->move($destination,$input['imagename']);
    }
    if($time=="")
    {
      date_default_timezone_set('Asia/Dhaka'); 
      $time = date("Y-m-d H:i:s");
      $time = str_replace(':','-',$time);
      $filename = null;
    }

    $type=$request->type;
    if($request->status !="")
    {
      $status=$request->status;
    }
    else
    {
     $status=""; 
    }

    $post=new PostInfo();
    $post->post_id=$time;
    $post->user_id=$id;
    $post->status=$status;
    $post->img=$filename;
    $post->post_type=$type;
    $post->save();

    return redirect($request->session()->get('url.intended'));
  }

  public function edit(Request $request,$id)
  {
    $post=PostInfo::find($id);
    return view('user.edit')->with('postInfo',$post);
  }
  
  public function update(Request $request,$id)
  {
    $time="";

    if($request->has('image'))
    {
      date_default_timezone_set('Asia/Dhaka'); 
      $time = date("Y-m-d H:i:s");
      $time = str_replace(':','-',$time);

      $image=$request->file('image');
      $input['imagename']= $time.'.'.$image->getClientOriginalExtension();
      $destination = '/xampp/htdocs/connectapi/'.$id.'uploads/';
      $filename= '\xampp\htdocs\connectapi\\'.$id.'uploads\\'.$input['imagename'];
      $image->move($destination,$input['imagename']);

      $post=PostInfo::find($id);
      $post->status=$request->status;
      $post->img=$filename;
      $post->post_type=$request->type;
      $post->save();


      $url=$request->input('url');

      if (strpos($url, 'profile') !== false)
      {
        return redirect()->route('user.profile',['id'=>$request->session()->get('user')]);
      }
      else if(strpos($url, 'home') !== false)
      {
        return redirect()->route('user.home',['id'=>$request->session()->get('user')]); 
      }
    }

    if($time=="")
    {
      if($request->input('checkpic')=="")
      {
        $post=PostInfo::find($id);
        $post->status=$request->status;
        $post->img=null;
        $post->post_type=$request->type;
        $post->save();

        $url=$request->input('url');

        if (strpos($url, 'profile') !== false)
        {
          return redirect()->route('user.profile',['id'=>$request->session()->get('user')]);
        }
        else if(strpos($url, 'home') !== false)
        {
          return redirect()->route('user.home',['id'=>$request->session()->get('user')]); 
        }
      }
      else if($request->input('checkpic')!="")
      {
        $post=PostInfo::find($id);
        $post->status=$request->status;
        $post->post_type=$request->type;
        $post->save();

        $url=$request->input('url');

        if (strpos($url, 'profile') !== false)
        {
          return redirect()->route('user.profile',['id'=>$request->session()->get('user')]);
        }
        else if(strpos($url, 'home') !== false)
        {
          return redirect()->route('user.home',['id'=>$request->session()->get('user')]); 
        }
      }
    }
  }

  

  public function delete(Request $request,$postid)
  {
    $request->session()->put('url.intended',url()->previous());
    PostInfo::destroy($postid);
    return redirect($request->session()->get('url.intended'));
  }

  public function getUser(Request $request)
  {

    $search=User::where('userId',$request->id)->get();
    return response()->json($search);
  }
}
