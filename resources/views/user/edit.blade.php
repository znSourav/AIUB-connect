<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Edit | Connect</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
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


<div class="post-project">
  <h3>Edit Post</h3>
  <div class="post-project-fields">
    <form id="formPost" role="form" method="POST" enctype="multipart/form-data">
      {{@csrf_field()}}
      <input type="hidden" name="url" id ="url" value="{{ url()->previous() }}">
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
          <textarea name="status" placeholder="Description" id="status">{{$postInfo->status}}</textarea>
        </div>
        
        @php
          if($postInfo->img!=null)
          {
            $picu=str_replace('\\xampp\\htdocs\\','http://localhost/',$postInfo->img); 
            $picu=str_replace('\\','/',$picu);
          }
          else
          {
            $picu="";
          } 
        @endphp
        <textarea id="checkpic" name="checkpic" style="display:none;">{{$picu}}</textarea>

        <div class="col-md-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div id="preview" class="input-group image-preview">
            <input name="statusPic" id="checkpic" class="form-control image-preview-filename" disabled="disabled" value="{{$picu}}"> <!-- don't give a name === doesn't send on POST/GET -->
            <span class="input-group-btn">

              <!-- image-preview-clear button -->
              @if($postInfo->img!=null)
                <button id="img-clr" type="button" class="btn btn-default image-preview-clear"  style>
                  Clear
                </button>
              @elseif($postInfo->img==null)
                <button id="img-clr" type="button" class="btn btn-default image-preview-clear"  style="display: none;">
                  Clear
                </button>
              @endif

              <!-- image-preview-input -->
                <div class="btn btn-default image-preview-input">
                  <i class="fa fa-folder-open"></i>
                  <span class="image-preview-input-title2">Browse</span>
                  <input type="file" accept="image/png, image/jpeg, image/gif" name="image"/>
                </div>
             </span>
          </div>
        </div>
        <br>
        <div class="col-lg-12">
          <ul>
            <li><button class="active" type="submit" value="post">Update</button></li>
            <li><a id="cancelEdit" href="#" title="">Cancel</a></li>
          </ul>
        </div>
      </div>
    </form>
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
<script type="text/javascript" src="/vendor/js/script.js"></script>   


</body>
<script>
'undefined'=== typeof _trfq || (window._trfq = []);
'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'}),_trfd.push({'ap':'cpsh'},{'server':'a2plcpnl0235'}) 
</script>

<script type="text/javascript">
  $(function(){
    $('#formPost').submit(function(e) {
    var status = $('#status').val();
    var statusPic = $('#dynamic').length;
    var chpic = $('#checkpic').val().length;
    
    if (status.length < 1 && (statusPic < 1 && chpic<1)) 
    {
      $('.error').empty();
      e.preventDefault();
      $('#status').after('<span class="error">Status can not be empty</span>');
    }
  });

  $('#img-clr').click(function(obj){
    $('#checkpic').val("");
  }); 
});
</script>
</html>