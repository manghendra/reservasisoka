$(function(){
    $(".box .h_title").not(this).next("ul").show("normal");
   	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
    $(".box").children(".h_title2").click( function() { $(this).next("ul").slideToggle(); });
});