jQuery(document).ready(function(){
			     // binds form submission and fields to the validation engine
			     jQuery("#formID").validationEngine();
            });
            
jQuery(document).ready(function(){
			     // binds form submission and fields to the validation engine
			     jQuery("#formID2").validationEngine();
            });

function formatDate (input)
{
	  var datePart = input.match(/\d+/g),
	  year = datePart[0],
	  month = datePart[1], 
	  day = datePart[2];
	  var m = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
	  return day+' '+m[month-1]+' '+year;
} 