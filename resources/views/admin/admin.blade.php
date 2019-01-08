<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Dashboard | Connect</title>
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
  


  
  <div class="wrapper">
    


     <header id="header" class="sticky-top">
      <div class="container">
        <div class="header-data">
          <div class="logo">
            <a href="#" title=""><img  style="height: 40px;width: 40px;margin: 0 auto;" src="/vendor/images/aiub-logo.png" alt=""></a>
          </div><!--logo end-->
          <div class="search-bar">

            

          </div><!--search-bar end-->
          <nav>
           
          </nav><!--nav end-->
          <div class="menu-btn">
            <a href="#" title=""><i class="fa fa-bars"></i></a>
          </div><!--menu-btn end-->
          <div class="user-account">
              <h3 class="tc" style="color: white;padding-top: 10px;"><a style="color: white;" href="{{route('user.logout')}}" title="">Logout</a></h3>
            </div>
            <!-- <div class="user-account-settingss">
              
              
              <h3 class="tc"><a href="{{route('user.logout')}}" title="">Logout</a></h3>
            </div>user-account-settingss end -->
          </div>
        </div><!--header-data end-->
      </div>
    </header><!--header end-->    


    <section class="profile-account-setting">
      <div class="container">
        <div class="account-tabs-setting">
          <div class="row">
            <div class="col-lg-3">
              <div class="acc-leftbar">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-status" aria-selected="false"><i class="fa fa-line-chart"></i>Statictics</a>
                   
                    <a class="nav-item nav-link" id="nav-requests-tab" data-toggle="tab" href="#nav-requests" role="tab" aria-controls="nav-requests" aria-selected="false"><i class="fa fa-group"></i>All users</a>
                  </div>
              </div><!--acc-leftbar end-->
            </div>
            <div class="col-lg-9">
              <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
                    <div class="acc-setting">
                      <h3>Statictics</h3>
                      <div class="profile-bx-details">
                        
                        <div class="row">
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Total Users</span>
                                <span class="info-box-number">{{sizeof($user)}}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->

                          <!-- fix for small devices only -->
                          <div class="clearfix visible-sm-block"></div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-green"><i class="fa fa-sticky-note"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">Posts</span>
                                <span class="info-box-number">{{sizeof($post)}}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                          
                        </div>
                        <!-- /.row -->
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div style="width: 300px;height: 300px;"><canvas id="myChart1" ></canvas></div>
                          </div>
                          <!-- /.col -->
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div style="width: 300px;height: 300px;"><canvas id="myChart2" ></canvas></div>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div style="width: 300px;height: 300px;"><canvas id="myChart1" ></canvas></div>
                          </div>
                          <!-- /.col -->
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div style="width: 300px;height: 300px;"><canvas id="myChart2" ></canvas></div>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div><!--profile-bx-details end-->
                      <div class="pro-work-status">
                        <!-- <h4>Work Status  -  Last Months Working Status</h4> -->
                      </div><!--pro-work-status end-->
                    </div><!--acc-setting end-->
                  </div>

                  @php $postfsit=0; $postfe=0; $postfass=0; $postfba=0; @endphp

                  @for($m=0;$m<sizeof($search);$m++)
                    @if($search[$m]->department=="FACULTY OF SCIENCE & INFORMATION TECHNOLOGY")
                      @php $postfsit++; @endphp
                    @elseif($search[$m]->department=="FACULTY OF ARTS & SOCIAL SCIENCE")
                      @php $postfass++; @endphp
                    @elseif($search[$m]->department=="FACULTY OF ENGINEERING")
                      @php $postfe++; @endphp
                    @elseif($search[$m]->department=="FACULTY OF BUSINESS ADMINISTRATION")
                      @php $postfba++; @endphp
                    @endif
                  @endfor

                 
                  <div class="tab-pane fade" id="nav-requests" role="tabpanel" aria-labelledby="nav-requests-tab">
                    <div class="acc-setting">
                      <h3>Users</h3>
                      <div class="requests-list">
                      @if(sizeof($user)>0)
                        @php $fsit=0;$fba=0;$fass=0;$fe=0; @endphp
                        @for($i=0;$i<sizeof($user);$i++)
                        
                        @php 
                          if($user[$i]->pic_flag==0)
                          {
                            $pic=$user[$i]->pic;
                            $pic="http://localhost/connectapi/".$pic;
                          }
                          else if($user[$i]->pic_flag==1)    
                          {
                            $pic=$user[$i]->modified_pic;
                            $pic=str_replace('\\xampp\\htdocs\\','http://localhost/',$pic); 
                            $pic=str_replace('\\','/',$pic);
                          }   
                        @endphp

                          <div class="request-details" >
                            <div class="noty-user-img">
                              <img src="{{$pic}}" alt="">
                            </div>
                            <div class="request-info">
                              <h3>{{$user[$i]->userName}}</h3>
                              <span>{{$user[$i]->program}}</span>
                            </div>
                            <div class="accept-feat">
                              @if($user[$i]->department=="FACULTY OF SCIENCE & INFORMATION TECHNOLOGY")
                              <ul>
                                @php $fsit++; @endphp
                                <li><a href="/admin/view/{{$user[$i]->userId}}"><button type="submit" class="accept-req fsit-bc">View profile</button></a></li>
                              </ul>
                              @elseif($user[$i]->department=="FACULTY OF ARTS & SOCIAL SCIENCE")
                              <ul>
                                @php $fass++; @endphp
                                <li><a href="/admin/view/{{$user[$i]->userId}}"><button type="submit" class="accept-req fass-bc">View profile</button></a></li>
                              </ul>
                              @elseif($user[$i]->department=="FACULTY OF ENGINEERING")
                              <ul>
                                @php $fe++; @endphp
                                <li><a href=""><button type="submit" class="accept-req fe-bc">View profile</button></a></li>
                              </ul>
                              @elseif($user[$i]->department=="FACULTY OF BUSINESS ADMINISTRATION")
                              <ul>
                                @php $fba++; @endphp
                                <li><a href=""><button type="submit" class="accept-req fba-bc">View profile</button></a></li>
                              </ul>
                              @endif
                            </div><!--accept-feat end-->
                          </div><!--request-detailse end-->
                      @endfor
                    @else
                      <div class="request-details">
                        <div class="request-info">
                          <h3>NO Users Available</h3>
                        </div>
                      </div><!--request-detailse end-->
                    @endif


                      </div><!--requests-list end-->
                    </div><!--acc-setting end-->
                  </div>
              </div>
            </div>
          </div>
        </div><!--account-tabs-setting end-->
      </div>
    </section>



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
          <p><img src="images/copy-icon2.png" alt="">Copyright 2018</p>
          <img class="fl-rgt" src="images/logo2.png" alt="">
        </div>
      </div>
    </footer>

  </div><!--theme-layout end-->



  


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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
    var chartUsers = document.getElementById('myChart1').getContext('2d');
    var chartActiveUsers = document.getElementById('myChart2').getContext('2d');

    var chart1 = new Chart(chartUsers, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ["FSIT", "FE", "FBA", "FASS"],
        datasets: [{
            label: "Number of users",
           
            backgroundColor: ["#0072bc","#f7941e","#c5281c",'#008c44'],
            data: [{{$fsit}},{{$fe}},{{$fba}},{{$fass}}],
        }]
    },

    // Configuration options go here
      options: {
      title: {
        display: true,
        text: 'Number of users in different dept'
      }
    }
    });

    var chart2 = new Chart(chartActiveUsers, {
    // The type of chart we want to create
    type: 'doughnut',

    // The data for our dataset
    data: {
        labels: ["FSIT", "FE", "FBA", "FASS"],
        datasets: [{
            label: "Number of active users",
           
            backgroundColor: ["#0072bc","#f7941e","#c5281c",'#008c44'],
            data: [{{$postfsit}},{{$postfe}},{{$postfba}},{{$postfass}}],
        }]
    },

    // Configuration options go here
      options: {
      title: {
        display: true,
        text: 'Number of active users'
      },
      legend: {
            display: true,
            labels: {
                fontColor: 'rgb(255, 99, 132)'
            }
        }
       
    }
    });
  </script>


</body>



</html>