<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Profile | Connect</title>
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


<body >
<!-- Process IMAGE -->
  @php 
    if($otherInfo->pic_flag==0)
    {
      $picOther=$otherInfo->pic;
      $picOther="http://localhost/connectapi/".$picOther;
    }
    else if($otherInfo->pic_flag==1)    
    {
      $picOther=$otherInfo->modified_pic;
      $picOther=str_replace('\\xampp\\htdocs\\','http://localhost/',$picOther); 
      $picOther=str_replace('\\','/',$picOther);
    }       
  @endphp
<!-- Image Process Done -->
  <div class="wrapper">
   <header id="header" class="sticky-top">
      <div class="container">
        <div class="header-data">
          <div class="logo">
            <a href="#" title=""><img  style="height: 40px;width: 40px;margin: 0 auto;" src="/vendor/images/aiub-logo.png" alt=""></a>
          </div><!--logo end-->

          <div class="menu-btn">
            <a href="#" title=""><i class="fa fa-bars"></i></a>
          </div><!--menu-btn end-->
          <div class="user-account">
            
            
          </div>
        </div><!--header-data end-->
      </div>
    </header><!--header end-->  

    @php
    if($otherInfo->cover_pic==null)
    {
      $coverpic="";
    }
    else
    {
      $coverpic=$otherInfo->cover_pic;
      $coverpic=str_replace('\\xampp\\htdocs\\','http://localhost/',$coverpic);
      $coverpic=str_replace('\\','/',$coverpic);
    }
    @endphp

    <section class="cover-sec">
      <img src= '{{$coverpic}}'  alt="" style="max-height:300px;">
    </section>


    <main>
      <div class="main-section">
        <div class="container">
          <div class="main-section-data">
            <div class="row">
              <div class="col-lg-3">
                <div class="main-left-sidebar">
                  <div class="user_profile">
                    <div class="user-pro-img">
                      <img src="{{$picOther}}" alt="" style="width: 180px; height: 180px;">
                      
                    </div><!--user-pro-img end-->
                    <div class="user_pro_status">
                      <!-- <ul class="flw-status">
                        <li>
                          <a href=""><span>Connected With</span></a>
                          <b>155</b>
                        </li>
                      </ul> -->
                    </div><!--user_pro_status end-->
                    
                  </div><!--user_profile end-->
                </div><!--main-left-sidebar end-->
              </div>
              <div class="col-lg-6">
                <div class="main-ws-sec">
                  <div class="user-tab-sec">
                    <h3><{{$otherInfo->userName}}></h3>
                    <div class="star-descp">
                      <span>{{$otherInfo->program}}</span>
                    </div><!--star-descp end-->
                    <div class="tab-feed st2">
                      <ul>
                        <li data-tab="feed-dd" class="active">
                          <a href="#" title="">
                            <img src="/vendor/images/ic1.png" alt="">
                            <span>Feed</span>
                          </a>
                        </li>
                        
                      </ul>
                    </div><!-- tab-feed end-->
                  </div><!--user-tab-sec end-->
                  <div class="product-feed-tab current" id="feed-dd">
                    <div class="main-ws-sec">
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
            <img src={{$picOther}} alt="" style="width: 50px; height: 50px;">          
                   
            <div class="usy-name">
              <h3>
                <a href="{{route('user.view',['id'=>$otherInfo->userId])}}">{{$otherInfo->userName}}</a>
              </h3>
              <span><img src="/vendor/images/clock.png" alt="">{{$time}}</span>
              <br/>
              <span>{{$postInfo[$i]->post_type}}</span>
          </div>
        </div>
          </div>
          <div class="job_descp">
          <div class="viewmore">
              @if($postInfo[$i]->status!=null)
                <p>{{$postInfo[$i]->status}}</p>
              @endif
              @if($postInfo[$i]->img!=null)
                @php
                  $picu=str_replace('\\xampp\\htdocs\\','http://localhost/',$postInfo[$i]->img);
                @endphp
              <img id="myImg" src='{{$picu}}' style="max-width:40%; height:auto;margin-left:40% ;">
              @endif
          </div>
          </div>

            <div class="job-status-bar">
            <ul class="like-com">
              <!-- <li>
                 <a href="#" title="" class="com"><i class="la la-heart"></i> Like 15</a>
               </li> 
               <li><a id="comment" title="" class="com"><img src="/vendor/images/com.png" alt=""> Comment 15</a></li>
               <li> 
               <a href="#" title="" class="com"><i class="fa fa-share"></i>Share</a></li> --> 
            </ul>
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

                  </div><!--posts-section end-->
                </div><!--main-ws-sec end-->
                  </div><!--product-feed-tab end-->
                  
                  <div class="product-feed-tab" id="saved-jobs">
                    <div class="user-profile-ov">
                      <h3><a href="#" title="" class="overview-open">Recent Activities</a> <a href="#" title="" class="overview-open"></a></h3>
                      <div class="notifications-list">
                        <div class="notfication-details">
                          <div class="noty-user-img">
                            <img src="/vendor/images/resources/ny-img1.png" alt="">
                          </div>
                          <div class="notification-info">
                            <h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
                            <span>2 min ago</span>
                          </div><!--notification-info -->
                        </div><!--notfication-details end-->
                        <div class="notfication-details">
                          <div class="noty-user-img">
                            <img src="/vendor/images/resources/ny-img2.png" alt="">
                          </div>
                          <div class="notification-info">
                            <h3><a href="#" title="">Poonam Verma</a> Bid on your Latest project.</h3>
                            <span>2 min ago</span>
                          </div><!--notification-info -->
                        </div><!--notfication-details end-->
                        <div class="notfication-details">
                          <div class="noty-user-img">
                            <img src="/vendor/images/resources/ny-img3.png" alt="">
                          </div>
                          <div class="notification-info">
                            <h3><a href="#" title="">Tonney Dhman</a> Comment on your project.</h3>
                            <span>2 min ago</span>
                          </div><!--notification-info -->
                        </div><!--notfication-details end-->
                        <div class="notfication-details">
                          <div class="noty-user-img">
                            <img src="/vendor/images/resources/ny-img1.png" alt="">
                          </div>
                          <div class="notification-info">
                            <h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
                            <span>2 min ago</span>
                          </div><!--notification-info -->
                        </div><!--notfication-details end-->
                        <div class="notfication-details">
                          <div class="noty-user-img">
                            <img src="/vendor/images/resources/ny-img1.png" alt="">
                          </div>
                          <div class="notification-info">
                            <h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
                            <span>2 min ago</span>
                          </div><!--notification-info -->
                        </div><!--notfication-details end-->
                        <div class="notfication-details">
                          <div class="noty-user-img">
                            <img src="/vendor/images/resources/ny-img2.png" alt="">
                          </div>
                          <div class="notification-info">
                            <h3><a href="#" title="">Poonam Verma </a> Bid on your Latest project.</h3>
                            <span>2 min ago</span>
                          </div><!--notification-info -->
                        </div><!--notfication-details end-->
                        <div class="notfication-details">
                          <div class="noty-user-img">
                            <img src="/vendor/images/resources/ny-img3.png" alt="">
                          </div>
                          <div class="notification-info">
                            <h3><a href="#" title="">Tonney Dhman</a> Comment on your project</h3>
                            <span>2 min ago</span>
                          </div><!--notification-info -->
                        </div><!--notfication-details end-->
                        <div class="notfication-details">
                          <div class="noty-user-img">
                            <img src="/vendor/images/resources/ny-img1.png" alt="">
                          </div>
                          <div class="notification-info">
                            <h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
                            <span>2 min ago</span>
                          </div><!--notification-info -->
                        </div><!--notfication-details end-->
                      </div><!--notifications-list end-->

                    </div><!--user-profile-ov end-->
                    
                  </div>
                  
                </div><!--main-ws-sec end-->
              </div>
              <div class="col-lg-3">
                <div class="right-sidebar">
                </div><!--right-sidebar end-->
              </div>
            </div>
          </div><!-- main-section-data end-->
        </div> 
      </div>
      
    </main>

    <footer>
      <div class="footy-sec mn no-margin">
        <div class="container">
          <ul>
            <li><a href="#" title="">Help Center</a></li>
            <li><a href="#" title="">Privacy Policy</a></li>
            <li><a href="#" title="">Community Guidelines</a></li>
            <li><a href="#" title="">Cookies Policy</a></li>
            <li><a href="#" title="">Career</a></li>
            <li><a href="#" title="">Forum</a></li>
            <li><a href="#" title="">Language</a></li>
            <li><a href="#" title="">Copyright Policy</a></li>
          </ul>
          <p><img src="/vendor/images/copy-icon2.png" alt="">Copyright 2018</p>
          <img class="fl-rgt" style="width: 100px;height: 40px;" src="/vendor/images/aiub-logo.png" alt="">
        </div>
      </div>
    </footer><!--footer end-->

    <div class="overview-box" id="overview-box">
      <div class="overview-edit">
        <h3>Overview</h3>
        <span>5000 character left</span>
        <form>
          <textarea></textarea>
          <button type="submit" class="save">Save</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->


    <div class="overview-box" id="experience-box">
      <div class="overview-edit">
        <h3>Experience</h3>
        <form>
          <input type="text" name="subject" placeholder="Subject">
          <textarea></textarea>
          <button type="submit" class="save">Save</button>
          <button type="submit" class="save-add">Save & Add More</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

    <div class="overview-box" id="education-box">
      <div class="overview-edit">
        <h3>Education</h3>
        <form>
          <input type="text" name="school" placeholder="School / University">
          <div class="datepicky">
            <div class="row">
              <div class="col-lg-6 no-left-pd">
                <div class="datefm">
                  <input type="text" name="from" placeholder="From" class="datepicker"> 
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
              <div class="col-lg-6 no-righ-pd">
                <div class="datefm">
                  <input type="text" name="to" placeholder="To" class="datepicker">
                  <i class="fa fa-calendar"></i>
                </div>
              </div>
            </div>
          </div>
          <input type="text" name="degree" placeholder="Degree">
          <textarea placeholder="Description"></textarea>
          <button type="submit" class="save">Save</button>
          <button type="submit" class="save-add">Save & Add More</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

    <div class="overview-box" id="location-box">
      <div class="overview-edit">
        <h3>Location</h3>
        <form>
          <div class="datefm">
            <select>
              <option>Country</option>
              <option value="pakistan">Pakistan</option>
              <option value="england">England</option>
              <option value="india">India</option>
              <option value="usa">United Sates</option>
            </select>
            <i class="fa fa-globe"></i>
          </div>
          <div class="datefm">
            <select>
              <option>City</option>
              <option value="london">London</option>
              <option value="new-york">New York</option>
              <option value="sydney">Sydney</option>
              <option value="chicago">Chicago</option>
            </select>
            <i class="fa fa-map-marker"></i>
          </div>
          <button type="submit" class="save">Save</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

    <div class="overview-box" id="skills-box">
      <div class="overview-edit">
        <h3>Skills</h3>
        <ul>
          <li><a href="#" title="" class="skl-name">HTML</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
          <li><a href="#" title="" class="skl-name">php</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
          <li><a href="#" title="" class="skl-name">css</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
        </ul>
        <form>
          <input type="text" name="skills" placeholder="Skills">
          <button type="submit" class="save">Save</button>
          <button type="submit" class="save-add">Save & Add More</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->

    <div class="overview-box" id="create-portfolio">
      <div class="overview-edit">
        <h3>Create Portfolio</h3>
        <form>
          <input type="text" name="pf-name" placeholder="Portfolio Name">
          <div class="file-submit">
            <input type="file" name="file">
          </div>
          <div class="pf-img">
            <img src="/vendor/images/resources/np.png" alt="">
          </div>
          <input type="text" name="website-url" placeholder="htp://www.example.com">
          <button type="submit" class="save">Save</button>
          <button type="submit" class="cancel">Cancel</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
      </div><!--overview-edit end-->
    </div><!--overview-box end-->



    <!-- post smth -->
    <div class="post-popup job_post">
      <div class="post-project">
        <h3>Post something</h3>
        <div class="post-project-fields">
          <form id="formPost" action="{{route('post.insert',['id'=>session('user')])}}"  method="post" enctype="multipart/form-data">
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
                <div id="preview1" class="input-group image-preview2">
                <input id="statusPic" type="text" class="form-control image-preview-filename2" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                    <span class="input-group-btn">
                      <!-- image-preview-clear button -->
                      <button type="button" class="btn btn-default image-preview-clear2" style="display:none;">
                        <i class="fa fa-remove"></i> Clear
                      </button>
                      <!-- image-preview-input -->
                      <div class="btn btn-default image-preview-input2">
                        <i class="fa fa-folder-open"></i>
                        <span class="image-preview-input-title2">Browse</span>
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
        <a  href="#" title=""><i class="la la-times-circle-o"></i></a>
      </div><!--post-project end-->
    </div><!--post-project-popup end-->



      <!-- edit picture -->
    <div class="post-popup pic_post">
      <div class="post-project">
        <h3>Edit picture</h3>
        <div class="post-project-fields">




          <form id="formPic" method="post" action="{{route('user.changePic',['id'=>session('user')])}}" enctype="multipart/form-data">
            {{@csrf_field()}}
            <div class="row">
                <div class="col-md-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                  <div  id="preview1" class="input-group image-preview">
                    <input id="textPic" type="text" class="form-control  image-preview-filename"  disabled="disabled" />
                    <!-- don't give a name === doesn't send on POST/GET -->
                    <span  class="input-group-btn">
                        <!-- image-preview-clear button -->
                      <button type="button" id="clear" class="btn btn-default image-preview-clear" style="display:none;">
                        <i class="fa fa-remove"></i> Clear
                      </button>         
                      <!-- image-preview-input -->
                      <div class="btn btn-default image-preview-input">
                        <i class="fa fa-folder-open"></i>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif " name="imageProPic"/>
                        <!-- rename it -->
                      </div>
                    </span>
                  </div>
                </div>
                <br>
                <div class="col-lg-12">
                <ul>
                  <li><button class="active" id="submitPic" type="submit" name="reset" value="reset" class="btn btn-primary btn-post" > Reset Pic</button> </li>
                  <li> <button class="active" type="submit" id="submitPic" name="change" value="change" class="btn btn-primary btn-post " >Submit</button> </li>
                  <li><a href="#" title="">Cancel</a></li>
                </ul>
              </div> 
          </div>
        </form>



        </div><!--post-project-fields end-->
        <a href="#" title=""><i class="la la-times-circle-o"></i></a>
      </div><!--post-project end-->
    </div><!--post-project-popup end-->
    

      <!-- edit cover -->

    <div class="post-popup pst-pj">
      <div class="post-project">
        <h3>Change Cover</h3>
        <div class="post-project-fields">

          <form id="formCover" action="{{route('user.changeCover',['id'=>session('user')])}}" method="post" enctype="multipart/form-data">
            {{@csrf_field()}}
            <div class="row">
              <div class="col-md-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div id="preview1" class="input-group image-preview3">
                <input id="textCover" type="text" class="form-control image-preview-filename3" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                    <span class="input-group-btn">
                      <!-- image-preview-clear button -->
                      <button type="button" id="clearCover" class="btn btn-default image-preview-clear3" style="display:none;">
                        <i class="fa fa-remove"></i> Clear
                      </button>
                      <!-- image-preview-input -->
                      <div class="btn btn-default image-preview-input3">
                        <i class="fa fa-folder-open"></i>
                        <span class="image-preview-input-title3">Browse</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif,video/*" name="imageCoverPic"/>
                         <!-- rename it -->
                      </div>
                   </span>
                </div>
              </div>
              <br>
              <div class="col-lg-12">
                <ul>
                  <li><button class="active" type="submit" name="change" value="change">Change</button></li>
                  <li><a id="cancelEdit"  href="#" title="">Cancel</a></li>
                </ul>
              </div>
            </div>
          </form>

        </div>post-project-fields end
        <a href="#" title=""><i class="la la-times-circle-o"></i></a>
      </div>post-project end
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


</body>

<script type="text/javascript">
      
    

      
    $(window).on('popstate', function() {
      location.reload(true);
    });

      var which;

      $("#submitPic").click(function (e) 
      {
        which = $(this).attr("name");
      });

      $('#formPic').submit(function(e) 
      {

        if(which=="reset")
        {
          $('.error').empty();
        }
        else
        {
          if(!$('#clear').is(':visible'))
      {
        $('.error').empty();
        e.preventDefault();
              $('#textPic').after('<span class="error">No Picture Selected</span>');
      }
        }
        
      });
      $('#formCover').submit(function(e) 
      {
        if(!$('#clearCover').is(':visible'))
      {
        $('.error').empty();
        e.preventDefault();
              $('#textCover').after('<span class="error">No Picture Selected</span>');
      }       
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

    });
    </script>
<script>'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'}),_trfd.push({'ap':'cpsh'},{'server':'a2plcpnl0235'}) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.</script><!-- <script src='../../../img1.wsimg.com/tcc/tcc_l.combined.1.0.6.min.js'></script> -->
<!-- Mirrored from gambolthemes.net/html/workwise/my-profile-feed.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Nov 2018 07:57:22 GMT -->
</html>