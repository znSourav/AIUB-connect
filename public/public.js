$(document).ready(function(){

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
//alert(CSRF_TOKEN);
  $.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url:"/search/recentSearch",
    type:"POST",
    success:function(res){
      //alert(res);
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

      var search = res.split("**");
      //alert(search);
      $('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'search',
        source: substringMatcher(search)
      });

    }
  });
});