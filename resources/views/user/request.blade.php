<!DOCTYPE html>
<html>

<!-- Mirrored from gambolthemes.net/html/workwise/profiles.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Nov 2018 07:57:06 GMT -->
<head>
<meta charset="UTF-8">
<title>Request | Connect </title>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />

<script src="/jquery-3.3.1.js"></script>


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
</head>


<body >
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
 

      <section class="companies-info">
        <div class="container">
          <div class="company-title">
            <h3>All Requests</h3>
          </div><!--company-title end-->
          <div class="companies-list">

            <div class="row"  id=""> 
              @php
            $count=0;
            $countConnect=0;
            @endphp
            @if(sizeof($searchInfo)==0)
            <div class="company_profile_info">
              <div class="company-up-info">
                <h3>No Result Found</h3>
              </div>
            </div><!--company_profile_info end-->
            @else
              @for($i=0;$i<sizeof($searchInfo);$i++)
                <div id="connect{{$countConnect}}" class="col-lg-3 col-md-4 col-sm-6 col-12">                
                    <script>
                    $(document).ready(function(){
                      $.ajax({
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "/connect/getUsers",
                        type: "POST",
                        data: { reqId: "{{$searchInfo[$i]->userId}}" },
                        success:function(res2){
                        if(res2[0].pic_flag==0)
                        {
                          var picSr=res2[0].pic;
                          picSr="http://localhost/connectapi/"+picSr;
                        }
                        else if(res2[0].pic_flag==1)    
                        {
                          var picSr=res2[0].modified_pic;
                          picSr=picSr.replace('\\xampp\\htdocs\\','http://localhost/');
                          picSr=picSr.replace(/\\/g, '/');
                        }
                          $('#connect{{$countConnect}}').html('<div class="company_profile_info badge-fsit"><div class="company-up-info"><img  src="' + picSr + '" alt="Card image cap"><h3><a class="card-title"><a href="/profile/connectedView/' + res2[0].userId + '">' + res2[0].userName + '</a></h3><p>' + res2[0].userId + '<br>' + res2[0].program + '</p><a class="btn btn-primary  btn-block" href="/connect/yes-request/'+res2[0].userId+'">Confirm</a><a class="btn btn-primary  btn-block" href="/connect/no-request/'+res2[0].userId+'">Delete</a>');
                        }     
                      }); 
                    })    
                  </script>
                    </div>
                    @php $countConnect++ @endphp 
                    @endfor 
              @endif
            </div>
          </div>
        </div>
      </section>
      <div id="cc-app"></div>

        <!-- /.container-fluid -->    
  </div><!--theme-layout end-->


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
</body>
<script>'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'}),_trfd.push({'ap':'cpsh'},{'server':'a2plcpnl0235'}) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.
</script><!-- <script src='../../../img1.wsimg.com/tcc/tcc_l.combined.1.0.6.min.js'></script>
 --><!-- Mirrored from gambolthemes.net/html/workwise/profiles.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Nov 2018 07:57:14 GMT -->
</html>