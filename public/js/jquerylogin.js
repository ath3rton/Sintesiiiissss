window.onload = function() {
    $("#breg").click(function(){
        $(".login-page").css('z-index', -1);
        $(".reg-page").css('z-index', 100);
        $(".reg-page").show(1000);
    });
    $("#lbtn").click(function(){
        $(".reg-page").hide(1000);
    }); 
    $("#lshowpas").on( 'change', function() {
        if( $(this).is(':checked') ) {
            $("#user_password").get(0).type =  'text';
        }else{
            $("#user_password").get(0).type =  'password';
        }
    });
}