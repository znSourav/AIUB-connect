<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\RecentSearch;
use App\Course;

class searchController extends Controller
{
  public function index(Request $request,$id)
  {
    if($request->input('searchvalue')!="")
    {
      $search=RecentSearch::find($id);

      if($search=="")
      {
        $search = new RecentSearch();
        $search->userId=$id;
        $search->content=$request->searchvalue;
        $search->save();

        //Search By ID::::
        if($request->category == "By ID")
        {
          if(strlen($request->searchvalue)==10)
          {
            $searchUsers=User::where('userId',$request->searchvalue)->get();
            $user=User::find($id);

            return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
          }
          else if(strlen($request->searchvalue)<10)
          {
            $searchUsers=User::where('userId','LIKE','%'.$request->searchvalue.'%')->get();
            $user=User::find($id);
            error_log($searchUsers);

            return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
          }
        }
        //Search By Name::::
        if($request->category == "By Name")
        {
          $searchUsers=User::where('userName','LIKE','%'.$request->searchvalue.'%')->get();
          $user=User::find($id);
          error_log($searchUsers);
          return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
        }

        //Search By Course::::
        if($request->category == "By Course")
        {
          $searchUsers=DB::table('users')
            ->join('courses','users.userId','=','courses.student_id')
            ->where('courses.c_name','LIKE','%'.$request->searchvalue.'%')
            ->select('users.*')
            ->get();

          $user=User::find($id);  
          error_log($searchUsers);
          return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
        }

        //Search By Year
        if($request->category == "By Year")
        {
          $searchUsers=User::where('userId','LIKE',$request->searchvalue.'%')->get();
          $user=User::find($id);
          return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
        }
        //Search By Semester
        if($request->category == "By Semester")
        {
          $value=explode("-",$request->searchvalue);
          $searchUsers=User::where('userId','LIKE',$value[0].'%'.$value[1])->get();
          $user=User::find($id);
          return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
        }

      }
      else
      {
        $value=explode("**",$search->content);
        $value = array_map('strtolower', $value);
        if(!in_array(strtolower($request->searchvalue), $value))
        {
          $search=RecentSearch::find($id);
          $search->content=$search->content."**".$request->searchvalue;
          $search->save();
        }

        //Search By ID::::
        if($request->category == "By ID")
        {
          if(strlen($request->searchvalue)==10)
          {
            $searchUsers=User::where('userId',$request->searchvalue)->get();
            $user=User::find($id);

            return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
          }
          else if(strlen($request->searchvalue)<10)
          {
            $searchUsers=User::where('userId','LIKE','%'.$request->searchvalue.'%')->get();
            $user=User::find($id);
            error_log($searchUsers);

            return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
          }
        }

        //Search By Name::::
        if($request->category == "By Name")
        {
          $searchUsers=User::where('userName','LIKE','%'.$request->searchvalue.'%')->get();
          $user=User::find($id);
          error_log($searchUsers);
          return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
        }

        //Search By Course::::
        if($request->category == "By Course")
        {
          $searchUsers=DB::table('users')
            ->join('courses','users.userId','=','courses.student_id')
            ->where('courses.c_name','LIKE','%'.$request->searchvalue.'%')
            ->select('users.*')
            ->get();

          $user=User::find($id);  
          error_log($searchUsers);
          return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
        }

        //Search By Year
        if($request->category == "By Year")
        {
          $searchUsers=User::where('userId','LIKE',$request->searchvalue.'%')->get();
          $user=User::find($id);
          return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
        }
        //Search By Semester
        if($request->category == "By Semester")
        {
          $value=explode("-",$request->searchvalue);
          $searchUsers=User::where('userId','LIKE',$value[0].'%'.$value[1])->get();
          $user=User::find($id);
          return view('user.search')->with('userInfo',$user)->with('searchInfo',$searchUsers);
        }

      }
    }
    else
    {
      return redirect()->back();
    }
  }

  public function recentSearch(Request $request)
  {
    $search=RecentSearch::find($request->session()->get('user'));
    $course=Course::select('c_name')->get();

    $result=$search->content;

    for($i=0;$i<sizeof($course);$i++)
    {
      if($result=="")
      {
        $result=$course[$i]->c_name;
      }
      else
      {
        if (!strpos($result, strtolower($course[$i]->c_name)) !== false)
        {
          $result=$result."**".$course[$i]->c_name;
        }
      }
    }
    return response()->json($result);
  }
}
