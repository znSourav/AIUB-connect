<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use App\Connect;
use App\Admin;

class loginController extends Controller
{
  public function index(Request $request)
  {
    return view('login.login');
  }
  public function verify(loginRequest $request)
  {
    $userid=$request->userid;
    $password=$request->password;

    //Checking Admin
    $admin = Admin::where('userName',$userid)
              ->where('password',$password)
              ->get();
    if(sizeof($admin)>0)
    {
      $request->session()->put('user',$userid);
      return redirect()->route('admin.home');
    }
    else
    {
      //VALIDATION:::::::::::::::
      $flag="true";
      for($i=0;$i<strlen($userid);$i++)
      {
        if(($userid[$i]>="0" && $userid[$i]<="9") || ($userid[$i]=="-"))
        {
          $flag="true";
        }
        else
        {
          $flag="false";
          break;
        }
      }
      if($flag=="true")
      {
        $count=0;
        for($i=0;$i<strlen($userid);$i++)
        {
          if($userid[$i]=="-")
          {
            $count++;
          }
        }
        if($count!=2)
        {
          //INVALID:::::::::::
          $request->session()->flash('errormessage','Invalid UserId or Password');
          return redirect()->route('login.index');
        }
        else
        {
          $id=$userid;
          $onepos=strpos($id,"-");
          $one=substr($id,0,$onepos);
          if(strlen($one)!=2)
          {
            //INVALID::::::::::::::::::::::
            $request->session()->flash('errormessage','Invalid UserId or Password');
            return redirect()->route('login.index');
          }
          else if(strlen($one)==2)
          {
            $twopos=strpos($id,"-",$onepos+1);
            $two=substr($id,$onepos+1,$twopos-3);
            if(strlen($two)==5)
            {
              $three=substr($id,$twopos+1,strlen($id));
              if(strlen($three)==1)
              {
                //SUCCESSFUL:::::

                $url = 'http://localhost/connectapi/login.php';
                $data = array('userid' => $userid, 'password' => $password);
                $options = array(
                        'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data),
                    )
                );

                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);

                if($result=="failed")
                {
                  $request->session()->flash('errormessage','INCORRECT UserId or Password');
                  return redirect()->route('login.index');
                }
                else if($result=="success")
                {
                  $connect=Connect::find($userid);

                  if(empty((array) $connect))
                  {
                    $connect = new Connect();
                    $connect->userId = $userid;
                    $connect->connected_with = "";
                    $connect->save();
                  }
                  $request->session()->put('user',$userid);
                  return redirect()->route('user.home',['id'=>$userid]);
                }
              }
              else
              {
                //INVALID:::::::::::::
                $request->session()->flash('errormessage','Invalid UserId or Password');
                return redirect()->route('login.index');
              }
            }
            else
            {
              //INVALID::::::::::::::::
              $request->session()->flash('errormessage','Invalid UserId or Password');
              return redirect()->route('login.index');
            }
          }
        }
      }
      else 
      {
        //INVALID:::::::::::::::
        $request->session()->flash('errormessage','Invalid UserId or Password');
        return redirect()->route('login.index');
      }  
      /*if($user!=null)
      {
        $request->session()->put('userInfo',$user);
        return redirect()->route('user.home',['id'=>$user->id]);
      }
      else
      {
        $request->session()->flash('errormessage','Invalid username or password');
        return redirect()->route('login.index');
      }*/
    }
  }
}
