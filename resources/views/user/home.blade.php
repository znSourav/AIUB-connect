<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Home | Connect</title>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />

<script src="/jquery-3.3.1.js"></script>


<link rel="stylesheet" type="text/css" href="/vendor/css/animate.css">
<link rel="stylesheet" type="text/css" href="/vendor/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/vendor/css/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="/vendor/css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="/vendor/css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/vendor/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/vendor/lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="/vendor/lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="/vendor/css/style.css">
<link rel="stylesheet" type="text/css" href="/vendor/css/responsive.css">
<link rel="stylesheet" type="text/css" href="/vendor/css/type.css">
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

    <main>
      <div class="main-section">
        <div class="container">
          <div class="main-section-data">
            <div class="row">
              <div class="col-lg-3 col-md-4 pd-left-none no-pd">
                <div class="main-left-sidebar no-margin">
                  <div class="user-data full-width">
                    <div class="user-profile">
                      <div class="username-dt">
                        <div class="usr-pic">
                          <img src="{{$pic}}" alt="">
                        </div>
                      </div><!--username-dt end-->
                      <div class="user-specs">
                        <span>@ {{$userInfo->userId}}</span>
                        <h5>{{$userInfo->userName}}</h5>
                        <span>{{$userInfo->program}}</span>
                      </div>
                    </div><!--user-profile end-->
                    <ul class="user-fw-status" >
                      <li >
                        <a href="{{route('connect.connected',['id'=>session('user')])}}"><h4>Connected With</h4></a>
                        <span id="spanx"></span>
                        <script>
                          $(document).ready(function(){
                            $.ajax({
                              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                              url:"/connect/getConnectedNumber",
                              type:"POST",
                              success:function(res){
                                $('#spanx').html(res);
                              }
                            });
                          });
                        </script>
                      </li>
                      <li>
                        <a href="{{route('user.profile',['id'=>session('user')])}}" title="">View Profile</a>
                      </li>
                      <li >
                        <a href="{{route('connect.request',['id'=>session('user')])}}"<h4>Request </h4></a>
                        <span id="spanx2"></span>
                        <script>
                          $(document).ready(function(){
                            $.ajax({
                              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                              url:"/connect/getRequests",
                              type:"POST",
                              success:function(res){
                                $('#spanx2').html(res.length);
                              }
                            });
                          });
                        </script>
                      </li>
                    </ul>
                  </div><!--user-data end-->
                  
                  <div class="tags-sec full-width">
                    <ul>
                      <li><a href="#" title="">Help Center</a></li>
                      <li><a href="#" title="">About</a></li>
                      <li><a href="#" title="">Privacy Policy</a></li>
                      <li><a href="#" title="">Community Guidelines</a></li>
                      <li><a href="#" title="">Cookies Policy</a></li>
                      <li><a href="#" title="">Career</a></li>
                      <li><a href="#" title="">Language</a></li>
                      <li><a href="#" title="">Copyright Policy</a></li>
                    </ul>
                    <div class="cp-sec">
                      <img src="/vendor/images/aiub-logo.png" style="width: 25px;height: 25px;" alt=""><p style="text-align: center; margin:0 auto;">AIUB connect</p>
                      <p><img src="/vendor/images/cp.png" alt="">Copyright 2018</p>
                    </div>
                  </div><!--tags-sec end-->
                </div><!--main-left-sidebar end-->
              </div>



              <div class="col-lg-6 col-md-8 no-pd">
                <div class="main-ws-sec">
                  <div class="post-topbar">
                    <div class="user-picy">
                      <img src="{{$pic}}" alt="pro-pic" >
                    </div>
                    <div class="post-st">
                      <ul>
                        <!-- <li><a class="post_project" href="#" title="">Post a Project</a></li> -->
                        <li><a class="post-jb active" href="#" title="">Post</a></li>
                      </ul>
                    </div><!--post-st end-->
                  </div><!--post-topbar end-->
          
                  <div class="posts-section">
                    @if(sizeof($postInfo)==0)  
                      <div class="post-bar">
                        <div class="job_descp">
                          <div class="viewmore">
                            <p>NO POST TO DISPLAY</p>
                          </div>
                        </div>
                      </div>                      
                    @elseif(sizeof($postInfo)>0)
                      @php 
                        $count=0;
                        $countX=0; 
                      @endphp 
                        @for($i=0;$i<sizeof($postInfo);$i++)
                        @php
                        $YMDpost = substr($postInfo[$i]->post_id,0,(strpos($postInfo[$i]->post_id," ")));
                        $timepost = substr($postInfo[$i]->post_id,(strpos($postInfo[$i]->post_id," ")+1),strlen($postInfo[$i]->post_id));


                        date_default_timezone_set('Asia/Dhaka'); 
                        $timezone = date("Y-m-d H:i:s");
                        $timezone=str_replace(':','-',$timezone);

                        $YMDnow = substr($timezone,0,(strpos($timezone," ")));
                        $timenow = substr($timezone,(strpos($timezone," "))+1,strlen($timezone));
                        @endphp
           
                        @if(substr($timepost,0,2)>=12)
                          @php
                          $hr=substr($timepost,0,2)-12;
                          $hr=$hr.":".substr($timepost,3,2)." PM";
                          @endphp
                        @else
                          @php
                          $hr=substr($timepost,0,2);
                          $hr=$hr.":".substr($timepost,3,2)." AM";
                          @endphp 
                        @endif
                        
                        @if(substr($YMDnow,0,4)==substr($YMDpost,0,4))
                          @if(substr($YMDnow,5,2)==substr($YMDpost,5,2))
                            @if(substr($YMDnow,8,2)==substr($YMDpost,8,2))
                              @if(substr($timenow,0,2)==substr($timepost,0,2))
                                @php $time=(int)substr($timenow,3,2)-(int)substr($timepost,3,2); @endphp
                                @if($time < 1)
                                  @php $time="0"." Minute ago" ; @endphp
                                @else
                                  @php $time=$time." Minutes ago" ; @endphp
                                @endif
                              @else
                                @php $time=(int)substr($timenow,0,2)-(int)substr($timepost,0,2); @endphp
                                @if($time < 1)
                                  @php $time="0"." Hour ago" ; @endphp
                                @else
                                  @php $time=$time." Hours ago" ; @endphp
                                @endif
                              @endif
                            @else
                              @php $time=(int)substr($YMDnow,8,2)-(int)substr($YMDpost,8,2); @endphp
                              @if($time < 1)
                                @php $time="0"." Day ago at ".str_replace('-',':',$hr); @endphp
                              @else
                                @php $time=$time." Days ago at ".str_replace('-',':',$hr); @endphp
                              @endif
                            @endif
                          @else

                            @php $time=(int)substr($YMDnow,5,2)-(int)substr($YMDpost,5,2); @endphp
                            @if($time < 1)
                              @php $time="0"." Month ago at ".str_replace('-',':',$hr); @endphp
                            @else
                              @php $time=$time." Months ago at ".str_replace('-',':',$hr); @endphp
                            @endif
                          @endif
                        @else
                          @php $time=(int)substr($YMDnow,0,4)-(int)substr($YMDpost,0,4); @endphp
                          @if($time==1)
                            @php $time=$time." Year ago at ".str_replace('-',':',$hr); @endphp
                          @else
                            @php $time=$time." Years ago at ".str_replace('-',':',$hr); @endphp
                          @endif
                        @endif
                            
                    <div class="post-bar">
                      <div class="post_topbar">
                        <div class="usy-dt">          
                          <div id="targetpTop{{$count}}"></div> 
                          <script>
                            $(document).ready(function(){
                              $.ajax({
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url:"/post/getUser",
                                type:"POST",
                                data: {id:'{{$postInfo[$i]->user_id}}'},
                                success:function(res){
                                  if(res[0].pic_flag==0)
                                  {
                                    var picPostUser="http://localhost/connectapi/"+res[0].pic;
                                  }
                                  else if(res[0].pic_flag==1)
                                  {
                                  var picPostUser=res[0].modified_pic;
                                      picPostUser=picPostUser.replace('\\xampp\\htdocs\\','http://localhost/');
                                      picPostUser=picPostUser.replace(/\\/g, '/');
                                  }
                                  $('#targetpTop{{$count}}').html(
                                    '<img src='+picPostUser+' alt="" style="width: 50px; height: 50px;"><div class="usy-name"><h3><a href="/user/viewConnected/{{$postInfo[$i]->user_id}}">'+res[0].userName+'</a></h3><span><img src="vendor/images/clock.png" alt="">{{$time}}</span><br/><span>{{$postInfo[$i]->post_type}}</span></div>');
                                }
                              });
                            });
                          </script>
                            @php $count++; @endphp
                    </div>
                    <div class="ed-opts">
                      <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                      <ul class="ed-options ">
                        @if($postInfo[$i]->user_id==$userInfo->userId)
                          <li><a href="{{route('post.edit',['postid'=>$postInfo[$i]->post_id])}}">Edit</a></li>
                          <li><a href="{{route('post.delete',['postid'=>$postInfo[$i]->post_id])}}">Delete</a></li>
                        @endif
                      </ul>
                    </div>
                    </div>
                    <div class="job_descp">
                    <div class="viewmore">
                        @if($postInfo[$i]->status!=null)
                          <p>{{$postInfo[$i]->status}}</p>
                        @endif  
                        @if($postInfo[$i]->img!=null)
                          @php  $picu=str_replace('\\xampp\\htdocs\\','http://localhost/',$postInfo[$i]->img); @endphp
                        <img id="myImg" src='{{$picu}}' style="max-width:40%; height:auto;margin-left:40% ;">
                        @endif
                    </div>
                    </div>
  
                  </div><!--posts-section end-->

                  
                  @endfor
                  <div class="process-comm">
                    <div class="spinner">
                      <div class="bounce1"></div>
                      <div class="bounce2"></div>
                      <div class="bounce3"></div>
                    </div>
                  </div><!--process-comm end-->

                  @endif
                </div>
                </div>
              </div>

      </div>
    </div><!-- main-section-data end-->
  </div> 
  </div>
    <div id="cc-app"></div>
  </main>



  <div class="post-popup job_post">
    <div class="post-project">
      <h3>Post something</h3>
      <div class="post-project-fields">
        <form id="formPost" action="{{route('post.insert',['id'=>session('user')])}}" method="post" enctype="multipart/form-data">
          {{@csrf_field()}}
          <div class="row">
            <div class="col-lg-4">
              <div class="inp-field">
                <select name="type">
                  <option value="Public" ><i class="fa fa-globe"></i> Public</option>
                  <option value="Followers"><i class="fa fa-users"></i> Followers</option>
                  <option value="Private"><i class="fa fa-user"></i> Just Me</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <textarea name="status" placeholder="Description" id="status"></textarea>
            </div>
              
            <div class="col-md-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
              <div id="preview1" class="input-group image-preview">
              <input id="statusPic" type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                  <!-- image-preview-clear button -->
                  <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                    <i class="fa fa-remove"></i> Clear
                  </button>
                  <!-- image-preview-input -->
                  <div class="btn btn-default image-preview-input">
                    <i class="fa fa-folder-open"></i>
                    <span class="image-preview-input-title">Browse</span>
                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image"/>
                    <!-- rename it -->
                  </div>
               </span>
              </div>
            </div>

              <br>
              <div class="col-lg-12">
                <ul>
                  <li><button class="active" type="submit" value="post">Post</button></li>
                  <li><a id="cancelPost" href="#" title="">Cancel</a></li>
                </ul>
              </div>
            </div>
          </form>

        </div><!--post-project-fields end-->
        <a href="#" title=""><i class="la la-times-circle-o"></i></a>
      </div><!--post-project end-->
    </div><!--post-project-popup end-->
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




</body>


<script type="text/javascript">
  $(function(){

    
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
    });

    $(window).on('popstate', function() {
        location.reload(true);
    });

    $('#formPost').submit(function(e) {
    var status = $('#status').val();
    var statusPic = $('#statusPic').val();
  
    if (status.length < 1 && statusPic.length < 1) {
      $('.error').empty();
        e.preventDefault();
        $('#status').after('<span class="error">Status can not be empty</span>');
      }
    });

    $('body').click(function(e){
      if($( "#check" ).hasClass( "show" ))
      {
        $.ajax({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url:"/connect/clearNotification",
          type:"POST",
          success:function(res){
            if(res=="clear")
            {
              location.reload();
            }
          }
        });
      }
    });

    $('#clickNotification').click(function(e){
      if($( "#check" ).hasClass( "show" ))
      {
        $.ajax({
          url:"/connect/clearNotification",
          method:"post",
          data: {userId:'<%=userInfo[0].userId%>'},
          success:function(res){
            if(res=="clear")
          {
            location.reload();
          }
        }
      });
    }
  })       
});
</script>
</html>