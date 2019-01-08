$(document).ready(function(){

	/* if($("#searchitem").val().length<1){
	 $('#showSearchItem').removeClass('show');
     $('#showSearchItemDown').removeClass('show');

 		}*/

 		/*$("#searchitem").focusout(function(){
        $('#showSearchItem').removeClass('show');
     $('#showSearchItemDown').removeClass('show');
    });*/
    alert("Click");
    


    var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};

var state = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

var item = ['mara', 'khao', 'bhalo'
];


$('.typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(state)
});

/*$("#searchItem").click(function(event){

    event.stopPropagation();
    $('#result').html('<h5>Recent searches</h5>');
    $('#result').append('<li class="list-group-item link-class"><img src="'+value.image+'" height="40" width="40" class="img-thumbnail" /> '+value.name+' | <span class="text-muted">'+value.location+'</span></li>');
 



});
$(document).click( function(){

                //$('#list').hide();
                $('#result').html('');

            });
$("#searchItem").keyup( function(){

                //$('#list').hide();
                $('#result').html('');

            });
if ($("#searchItem").val().length>=1 ){

 $('#result').html('');
 }
*/
/*$("#searchitem").keyup(function () {
        value = $(this).val();
        $('#showSearchItem').addClass('show');
        $('#showSearchItemDown').addClass('show');
        

        if (value.length >= 0 ) {
             $.ajax({
                url: "/user-home/search",
                method:"post",
                data: {
                    'sval' : value
                },
                success: function(msg){
                    var name="";
                    for(i=0;i<msg.length;i++)
                    {
                    	name=name+"<a href=/user-home/profile/view/"+msg[i].userId+">"+msg[i].userName+"</a><br>";
                	}
                	$("#searchresult").html(name);
                }
            });
        }
    });*/
});


