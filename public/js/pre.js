window.onload = function() {
    $(".tot").attr("style", "display: flex !important");
    $(".preloader").hide();
    $("button").not(".filelogo").click(function(){
        $(".tot").attr("style", "display: none !important");
        $(".preloader").show();
    });
    $("a").not(".filelogo").click(function(){
        $(".tot").attr("style", "display: none !important");
        $(".preloader").show();
    });
}
