window.onload = function() {
    $(".tot").attr("style", "display: flex !important");
    $(".preloader").hide();
    
}
$(function() { 
    $("button").click(function(){
        $(".tot").attr("style", "display: none !important");
        $(".preloader").show();
    });
    $("a").click(function(){
        $(".tot").attr("style", "display: none !important");
        $(".preloader").show();
    });
});