<!doctype html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="/jquery-3.3.1.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/vendor/css/animate.css">
  <link rel="stylesheet" type="text/css" href="/vendor/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/vendor/css/line-awesome.css">
  <link rel="stylesheet" type="text/css" href="/vendor/css/line-awesome-font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/vendor/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/vendor/css/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" type="text/css" href="/vendor/lib/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="/vendor/lib/slick/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="/vendor/css/style.css">
  <link rel="stylesheet" type="text/css" href="/vendor/css/responsive.css">
  <link rel="stylesheet" type="text/css" href="/vendor/css/type.css">
  <link rel="stylesheet" href="/schedule/css/reset.css"> <!-- CSS reset -->
  <link rel="stylesheet" href="/schedule/css/style.css"> <!-- Resource style -->
    
  <title>Schedule</title>
</head>
<body>
<!-- Process IMAGE -->
  @php 
    if($userInfo->pic_flag==0)
    {
      $pic=$userInfo->pic;
      $pic="http://localhost/connectapi/".$pic;
    }
    else if($userInfo->pic_flag==1)    
    {
      $pic=$userInfo->modified_pic;
      $pic=str_replace('\\xampp\\htdocs\\','http://localhost/',$pic); 
      $pic=str_replace('\\','/',$pic);
    }       
  @endphp
<!-- Image Process Done -->
  <input type="hidden" name="{{$userInfo->userName}}" id ="myname">
  <input type="hidden" name="{{$userInfo->userId}}" id ="myId">
  <input type="hidden" name="{{$pic}}" id  ="mypic">


  <div class="wrapper">
    <header id="header" class="sticky-top">
      <div class="container">
        <div class="header-data">
          <div class="logo">
            <a href="#" title=""><img  style="height: 40px;width: 40px;margin: 0 auto;" src="/vendor/images/aiub-logo.png" alt=""></a>
          </div><!--logo end-->
           <div class="search-bar">
            <form id="searchForm" autocomplete="off" method="get" action="{{route('search.index',['id'=>session('user')])}}">

              <input autocomplete="off" id="searchItem" class="typeahead" type="text"  name="searchvalue" placeholder="Search...">

              <button  type="submit" style="margin-right: 40px;z-index:0;"><i class="la la-search"></i></button>

              <a  class="option-box-open"><button id="option"  type="button"><i class="fa fa-cog"></i></button></a>
              <div class="option-box" style="width: 280px;">
                  <select class="form-control" name="category" id="sel1" style="z-index: -33333;">
                    <option selected="selected">By ID</option>
                    <option>By Name</option>
                    <option>By Course</option>
                    <option>By Year</option>
                    <option>By Semester</option>
                  </select>
              </div>
            </form>

          </div><!--search-bar end-->
          <nav>
            <ul>
              <li>
                <a href="{{route('user.home',['id'=>session('user')])}}" title="">
                  <span><img src="/vendor/images/icon1.png" alt=""></span>
                  Home
                </a>
              </li>
              <li>
                <a href="{{route('user.profile',['id'=>session('user')])}}" title="">
                  <span><i class="fa fa-user fa-lg"></i></span>
                   My Profile
                </a>
              </li>
              <li>
                <a href="{{route('user.schedule',['id'=>session('user')])}}" title="Schedule | Connect">
                  <span><i class="fa fa-calendar"></i></span>
                  Schedule
                </a>
              </li>
              <li>
                <a href="{{route('user.message',['id'=>session('user')])}}" title=""role="button"  >
                  <span><img src="/vendor/images/icon6.png" alt=""></span>
                  Messages
                </a>
              </li>
              <li id="check">
                <a href="#" title="" class="dropdown-toggle" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span><img src="/vendor/images/icon7.png" alt="">
                  <sup id="badgeNotification">
                  </sup>
                </span>

                <script>
                  $(document).ready(function(){
                  $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"/connect/getRequestNumber",
                    type:"POST",
                    success:function(res){
                      if(res!=0)
                      {
                        $('#badgeNotification').html('<span class="badge badge-danger">'+res+'</span>');  
                      }
                    }
                  });
                });
                </script>
                  


                @php $ddcount=0; @endphp
                <div id="clickNotification">Notification</div>
                </a>
                <div  class="dropdown-menu dropdown-menu abc msg" aria-labelledby="notificationsDropdown">
                  <div class="nott-list" style="overflow: auto;max-height: 250px;max-width: 300px;">

                    <div class="msg-wrapper" id="dd" >
                    </div>
                      <script>
                          $(document).ready(function(){
                          $.ajax({
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url:"/connect/getRequests",
                            type:"POST",
                            async:false,
                            success:function(res){
                              if(res.length!=0)
                              {
                                for(var w=0;w<res.length;w++)
                                {
                                  $.ajax({
                                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                  url:"/connect/getUsers",
                                  type:"POST",
                                  data: {reqId:res[w].request_from},
                                  async:false,
                                  success:function(resx){
                                    if (resx[0].pic_flag == 0) {
                                      var picSr = resx[0].pic;
                                      picSr = "http://localhost/connectapi/" + picSr;
                                    } else if (resx[0].pic_flag == 1) {
                                      var picSr = resx[0].modified_pic;
                                      picSr = picSr.replace('\\xampp\\htdocs\\', 'http://localhost/');
                                      picSr = picSr.replace(/\\/g, '/');
                                    }
                                    $('#dd').append('<div class="msg-wrapper" id="dd{{$ddcount}}"><a class="dropdown-item drop-item" href="/user/view/' + resx[0].userId + '"><div class="pull-left"><img src="' + picSr + '" alt="Card image cap"></div><h4>Request From ' + resx[0].userName +'</h4></a><div class="dropdown-divider"></div></div>');
                                  }
                                });
                                }
                              }
                            }
                          });
                        });
                      </script>
                        
                </div><!--notification-box end-->
              </li>
            </ul>
          </nav><!--nav end-->
          <div class="menu-btn">
            <a href="#" title=""><i class="fa fa-bars"></i></a>
          </div><!--menu-btn end-->
          <div class="user-account">
            <div class="user-info">
              <img src="{{$pic}}" alt="" style="width: 30px; height: 30px;">

              <i class="la la-sort-down"></i>
            </div>
            <div class="user-account-settingss">
              
              
              <h3 class="tc"><a href="{{route('user.logout')}}" title="">Logout</a></h3>
            </div><!--user-account-settingss end-->
          </div>
        </div><!--header-data end-->
      </div>
    </header><!--header end-->  
      <br><br><br>

      <div class="schedule"> 
        <div class="cd-schedule loading">
          <div class="timeline">
            <ul>
              <li><span>08:00</span></li>
              <li><span>08:30</span></li>
              <li><span>09:00</span></li>
              <li><span>09:30</span></li>
              <li><span>10:00</span></li>
              <li><span>10:30</span></li>
              <li><span>11:00</span></li>
              <li><span>11:30</span></li>
              <li><span>12:00</span></li>
              <li><span>12:30</span></li>
              <li><span>1:00</span></li>
              <li><span>1:30</span></li>
              <li><span>2:00</span></li>
              <li><span>2:30</span></li>
              <li><span>3:00</span></li>
              <li><span>3:30</span></li>
              <li><span>4:00</span></li>
              <li><span>4:30</span></li>
              <li><span>5:00</span></li>
              <li><span>5:30</span></li>
              <li><span>6:00</span></li>
              <li><span>6:30</span></li>
              <li><span>7:00</span></li>
              <li><span>7:30</span></li>
              <li><span>8:00</span></li>
              <li><span>8:30</span></li>
              <li><span>9:00</span></li>
              <li><span>9:30</span></li>
            </ul>
          </div> <!-- .timeline -->
          
          <div class='events'>
            <ul>
              <li class='events-group'>
                <div class='top-info'><span>Saturday</span></div>
              </li>
              <li class="events-group">
                <div class="top-info"><span>Sunday</span></div>
                <ul>

                @for($i=0;$i<sizeof($schedule);$i++)
                  @php
                  $courseName = $schedule[$i]->c_name;
                  $faculty = $schedule[$i]->c_faculty;
                  $facultyPic = $schedule[$i]->faculty_pic;
                  $cd1 = $schedule[$i]->c_day1;
                  $cd1type = $schedule[$i]->c_day1_type;
                  $cd1room = $schedule[$i]->c_day1_room;
                  $cd2 = $schedule[$i]->c_day2;
                  $cd2type = $schedule[$i]->c_day2_type;
                  $cd2room = $schedule[$i]->c_day2_room;
                  @endphp

                  @if(substr($cd1,0,3)=="Sun")
                  @php
                    $start1 = substr($cd1,(strpos($cd1," ")),(strpos($cd1,"-")-4));
                    $end1 = substr($cd1,(strpos($cd1,"-")+6),strlen($cd1));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-1">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif

                  @if(substr($cd2,0,3)=="Sun")
                  @php
                    $start1 = substr($cd2,(strpos($cd2," ")),(strpos($cd2,"-")-4));
                    $end1 = substr($cd2,(strpos($cd2,"-")+6),strlen($cd2));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-1">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif
                @endfor 
                </ul>
              </li>

              <li class="events-group">
                <div class="top-info"><span>Monday</span></div>
                <ul>

                @for($i=0;$i<sizeof($schedule);$i++)
                  @php
                  $courseName = $schedule[$i]->c_name;
                  $faculty = $schedule[$i]->c_faculty;
                  $facultyPic = $schedule[$i]->faculty_pic;
                  $cd1 = $schedule[$i]->c_day1;
                  $cd1type = $schedule[$i]->c_day1_type;
                  $cd1room = $schedule[$i]->c_day1_room;
                  $cd2 = $schedule[$i]->c_day2;
                  $cd2type = $schedule[$i]->c_day2_type;
                  $cd2room = $schedule[$i]->c_day2_room;
                  @endphp

                  @if(substr($cd1,0,3)=="Mon")
                  @php
                    $start1 = substr($cd1,(strpos($cd1," ")),(strpos($cd1,"-")-4));
                    $end1 = substr($cd1,(strpos($cd1,"-")+6),strlen($cd1));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-2">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif

                  @if(substr($cd2,0,3)=="Mon")
                  @php
                    $start1 = substr($cd2,(strpos($cd2," ")),(strpos($cd2,"-")-4));
                    $end1 = substr($cd2,(strpos($cd2,"-")+6),strlen($cd2));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-2">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif
                @endfor 
                </ul>
              </li>
              <li class="events-group">
                <div class="top-info"><span>Tuesday</span></div>
                <ul>

                @for($i=0;$i<sizeof($schedule);$i++)
                  @php
                  $courseName = $schedule[$i]->c_name;
                  $faculty = $schedule[$i]->c_faculty;
                  $facultyPic = $schedule[$i]->faculty_pic;
                  $cd1 = $schedule[$i]->c_day1;
                  $cd1type = $schedule[$i]->c_day1_type;
                  $cd1room = $schedule[$i]->c_day1_room;
                  $cd2 = $schedule[$i]->c_day2;
                  $cd2type = $schedule[$i]->c_day2_type;
                  $cd2room = $schedule[$i]->c_day2_room;
                  @endphp

                  @if(substr($cd1,0,3)=="Tue")
                  @php
                    $start1 = substr($cd1,(strpos($cd1," ")),(strpos($cd1,"-")-4));
                    $end1 = substr($cd1,(strpos($cd1,"-")+6),strlen($cd1));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-1">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif

                  @if(substr($cd2,0,3)=="Tue")
                  @php
                    $start1 = substr($cd2,(strpos($cd2," ")),(strpos($cd2,"-")-4));
                    $end1 = substr($cd2,(strpos($cd2,"-")+6),strlen($cd2));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-1">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif
                @endfor 
                </ul>
              </li>
              <li class="events-group">
                <div class="top-info"><span>Wednesday</span></div>
                <ul>

                @for($i=0;$i<sizeof($schedule);$i++)
                  @php
                  $courseName = $schedule[$i]->c_name;
                  $faculty = $schedule[$i]->c_faculty;
                  $facultyPic = $schedule[$i]->faculty_pic;
                  $cd1 = $schedule[$i]->c_day1;
                  $cd1type = $schedule[$i]->c_day1_type;
                  $cd1room = $schedule[$i]->c_day1_room;
                  $cd2 = $schedule[$i]->c_day2;
                  $cd2type = $schedule[$i]->c_day2_type;
                  $cd2room = $schedule[$i]->c_day2_room;
                  @endphp

                  @if(substr($cd1,0,3)=="Wed")
                  @php
                    $start1 = substr($cd1,(strpos($cd1," ")),(strpos($cd1,"-")-4));
                    $end1 = substr($cd1,(strpos($cd1,"-")+6),strlen($cd1));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-2">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif

                  @if(substr($cd2,0,3)=="Wed")
                  @php
                    $start1 = substr($cd2,(strpos($cd2," ")),(strpos($cd2,"-")-4));
                    $end1 = substr($cd2,(strpos($cd2,"-")+6),strlen($cd2));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-2">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif
                @endfor 
                </ul>
              </li>
              <li class="events-group">
                <div class="top-info"><span>Thursday</span></div>
                <ul>

                @for($i=0;$i<sizeof($schedule);$i++)
                  @php
                  $courseName = $schedule[$i]->c_name;
                  $faculty = $schedule[$i]->c_faculty;
                  $facultyPic = $schedule[$i]->faculty_pic;
                  $cd1 = $schedule[$i]->c_day1;
                  $cd1type = $schedule[$i]->c_day1_type;
                  $cd1room = $schedule[$i]->c_day1_room;
                  $cd2 = $schedule[$i]->c_day2;
                  $cd2type = $schedule[$i]->c_day2_type;
                  $cd2room = $schedule[$i]->c_day2_room;
                  @endphp

                  @if(substr($cd1,0,3)=="Thr")
                  @php
                    $start1 = substr($cd1,(strpos($cd1," ")),(strpos($cd1,"-")-4));
                    $end1 = substr($cd1,(strpos($cd1,"-")+6),strlen($cd1));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-1">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif

                  @if(substr($cd2,0,3)=="Thr")
                  @php
                    $start1 = substr($cd2,(strpos($cd2," ")),(strpos($cd2,"-")-4));
                    $end1 = substr($cd2,(strpos($cd2,"-")+6),strlen($cd2));
                  @endphp


                    @if(substr($start1,strlen($start1)-3,strlen($start1))==" PM")
                      @php $start1=substr($start1,0,strlen($start1)-3); @endphp
                    @endif
                    @if(substr($end1,strlen($end1)-3,strlen($end1))==" PM")
                      @php $end1=substr($end1,0,strlen($end1)-3); @endphp
                    @endif
                  <li class="single-event" data-start="{{$start1}}" data-end="{{$end1}}" data-content="event-abs-circuit" data-event="event-1">
                    <a href="#0">
                      <em class="event-name">{{$courseName}}</em>
                      <p class="pc" style="display:none;">{{$facultyPic}}</p>
                      <p class="faculty" style="display:none;">{{$faculty}}</p>
                      <p class="room" style="display:none;">{{$cd1room}}</p>
                      <p class="type" style="display:none;">{{$cd1type}}</p>
                    </a>
                  </li>
                  @endif
                @endfor 
                </ul>
              </li>

              <!-- END OF LOOP -->  
            </ul>
          </div>                  
          <div class="event-modal">
            <header class="header">
              <div class="content">
                <span class="event-date"></span>
                <h3 class="event-name"></h3>
                <img id="faculty-pic" src="" style="width: 150px;height: 150px;border: 1px solid white;margin:10px 0px 10px 40px;">
                <p class="course-faculty" style="font-size: 25px;text-align: center;text-justify:inter-word;"></p><br>
              </div>

              <div class="header-bg"></div>
            </header>

            <div class="body">
              <div class="event-info"><br>
                <em class="course-name" style="font-size: 25px;margin:100px 50px;text-align: justify;text-justify:inter-word;"></em><br>
                <em class="course-time" style="font-size: 25px;margin:100px 50px;"></em><br>
                <em class="course-room" style="font-size: 25px;margin:100px 50px;"></em><br>
                <em class="course-type" style="font-size: 25px;margin:100px 50px;"></em><br>

                
              </div>
              <div class="body-bg"></div>
            </div>

            <a href="#0" class="close">Close</a>
          </div>

          <div class="cover-layer"></div>
        </div> <!-- .cd-schedule -->
      </div>
      <div id="cc-app"></div>
  </div>


<script type="text/javascript" src="/vendor/js/jquery.min.js"></script>
<script type="text/javascript" src="/vendor/js/popper.js"></script>
<script type="text/javascript" src="/vendor/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/vendor/js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="/vendor/lib/slick/slick.min.js"></script>
<script type="text/javascript" src="/vendor/js/scrollbar.js"></script>
<script type="text/javascript" src="/vendor/js/jquery.sticky.js"></script>
<script type="text/javascript" src="/vendor/js/jquery.showmore.min.js"></script>
<script type="text/javascript" src="/vendor/js/typeahead.js/typeahead.bundle.js"></script>
<script type="text/javascript" src="/vendor/js/typeahead.js/typeahead.jquery.js"></script>
<script type="text/javascript" src="/public.js"></script> 
<script type="text/javascript" src="/vendor/js/script.js"></script>  
<script src="/vendor/js/ChatCamp.min.js"></script>
<script src="https://cdn.chatcamp.io/js/chatcamp-ui.min.js"></script>


<script src="/schedule/js/modernizr.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>



<script src="/schedule/js/main.js"></script> <!-- Resource jQuery -->


<script type="text/javascript">
  window.ChatCampUi.init({
        appId: "6472534674328514560", 
        user: {
          id: $('#myId').attr('name'),
          displayName: $('#myname').attr('name'),// optional
          avatarUrl: $('#mypic').attr('name')// optional
          // accessToken: USER_ACCESS_TOKEN // optional
        }, 
        ui: {
          theme: {
            primaryBackground: "#3f45ad",
            primaryText: "#ffffff",
            secondaryBackground: "#ffffff",
            secondaryText: "#000000",
            tertiaryBackground: "#f4f7f9",
            tertiaryText: "#263238"
          },
          roster: {
            tabs: ['recent', 'rooms', 'users'], 
            render: true, 
            defaultMode: 'open', // other possible values are minimize, hidden
            showUserAvatarUpload: true
          },
          channel: {
            showAttachFile: true,
            showVideoCall: true,
            showVoiceRecording: true
          }
        }
      })
</script>
<script>
  if( !window.jQuery ) document.write('<script src="/schedule/js/jquery-3.0.0.min.js"><\/script>');
  $.noConflict();
</script>
</body>

</html>