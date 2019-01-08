
$(function(){
	alert("SDSD");
  $.ajax({
    url:"/search/getUserByPost",
    method:"post",
    data : { userid:postInfo[i].user_id },
    success:function(res){
    	alert(res);
    }
  });    
});
                        	
                    	