<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Course;
use App\PostInfo;
use App\Connect;
use App\ConnectRequest;

class connectController extends Controller
{
  public function getConnected(Request $request)
  {
    $connected = Connect::find($request->session()->get('user'));
    if($connected->connected_with == "")
    {
      return response()->json("neg");
    }
    else
    {
      $value=explode("**",$connected->connected_with);
      if(!in_array($request->reqId, $value))
      {
        return response()->json("neg");
      }
      else
      {
        return response()->json("pos"); 
      }
    }
  }

  public function getUsers(Request $request)
  {
    $user = User::where('userId','=',$request->reqId)->get();
    return response()->json($user);
  }

  public function getConnectRequest(Request $request)
  {
    $user = ConnectRequest::where('request_from','=',$request->session()->get('user'))
                          ->where('request_to','=',$request->reqId)
                          ->get();
    if(sizeof((array)$user)>0)
    {
      return response()->json("yes");   
    }
    else
    {
      $user = ConnectRequest::where('request_to','=',$request->session()->get('user'))
                          ->where('request_from','=',$request->reqId)
                          ->get();
      if(sizeof((array)$user)>0)
      {
        return response()->json("yesno");   
      }
      else
      {
        return response()->json("no"); 
      } 
    }
  }

  public function noRequest(Request $request,$id)
  {
    $request->session()->put('url.intended',url()->previous());
    $user = ConnectRequest::where('request_to',$request->session()->get('user'))
                      ->where('request_from',$id)
                      ->delete();
    return redirect($request->session()->get('url.intended'));
  }

  public function yesRequest(Request $request,$id)
  {
    $request->session()->put('url.intended',url()->previous());

    $user = Connect::find($request->session()->get('user'));
    if($user->connected_with=="")
    {
      $user->connected_with = $id;
      $user->save();
    }
    else
    {
      $user->connected_with = $user->connected_with."**".$id;
      $user->save();
    }

    $user = Connect::find($id);
    if($user->connected_with=="")
    {
      $user->connected_with = $request->session()->get('user');
      $user->save();
    }
    else
    {
      $user->connected_with = $user->connected_with."**".$request->session()->get('user');
      $user->save();
    }

    $user = ConnectRequest::where('request_to',$request->session()->get('user'))
                      ->where('request_from',$id)
                      ->delete();

    return redirect($request->session()->get('url.intended'));
  }

  public function connectRequest(Request $request,$id)
  {
    $request->session()->put('url.intended',url()->previous());
    $user = new ConnectRequest();
    $user->request_to = $id;
    $user->request_from = $request->session()->get('user');
    $user->save();

    return redirect($request->session()->get('url.intended'));
  }

  public function cancelRequest(Request $request,$id)
  {
    $request->session()->put('url.intended',url()->previous());
    $user = ConnectRequest::where('request_from',$request->session()->get('user'))
                      ->where('request_to',$id)
                      ->delete();
    return redirect($request->session()->get('url.intended'));
  }

  public function disconnect(Request $request,$id)
  {
    $request->session()->put('url.intended',url()->previous());

    $user = Connect::find($request->session()->get('user'));
    $people = $user->connected_with;


    if(strpos($people,"**".$id) !== false)
    {
      $people = str_replace("**".$id,"",$people);
    }
    else
    {
      $people = str_replace($id,"",$people); 
    }

    $user->connected_with = $people;
    $user->save();

    $user = Connect::find($id);
    $people = $user->connected_with;

    if(strpos($people,"**".$request->session()->get('user')) !== false)
    {
      $people = str_replace("**".$request->session()->get('user'),"",$people);
    }
    else
    {
      $people = str_replace($request->session()->get('user'),"",$people); 
    }

    $user->connected_with = $people;
    $user->save();

    return redirect($request->session()->get('url.intended'));
  }

  public function request(Request $request,$id)
  {
    $other=DB::table('users')
        ->join('connect_request','users.userId','=','connect_request.request_from')
        ->where('request_to',$id)
        ->select('users.*')
        ->get();

    $user=User::find($id);
    return view('user.request')->with('userInfo',$user)->with('searchInfo',$other);
  }

  public function connected(Request $request,$id)
  {
    $other = Connect::find($request->session()->get('user'));

    if(sizeof((array)$other)>0)
    {
      $other = explode("**",$other->connected_with);
    }
    else
    {
      $other = [];
    }

    $user=User::find($id);

    return view('user.connected')->with('userInfo',$user)->with('searchInfo',$other);
  }

  public function getConnectedNumber(Request $request)
  {
    $user = Connect::find($request->session()->get('user'));
    if(sizeof((array)$user)>0)
    {
      $user = explode("**",$user->connected_with);
    }
    else
    {
      $user = [];
    }
    return response()->json(sizeof((array)$user));
  }

   public function getRequests(Request $request)
  {
    $user = ConnectRequest::where('request_to',$request->session()->get('user'))->get();
    return response()->json($user);
  }

  public function getRequestNumber(Request $request)
  {
    $user = ConnectRequest::where('request_to',$request->session()->get('user'))
                        ->where('flag',0)
                        ->get();
    return response()->json(sizeof((array)$user));
  }

  public function clearNotification(Request $request)
  {
    $user = ConnectRequest::where('request_to',$request->session()->get('user'))
                        ->where('flag',0)
                        ->get();
    if(sizeof((array)$user)>0)
    {
      $people = ConnectRequest::where('request_to',$request->session()->get('user'))
              ->update(['flag' => 1 ]);
      return response()->json("clear");
    }
    else
    {
      return response()->json("notclear"); 
    }
  }

}
