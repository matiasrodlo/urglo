$(document).on("ready", function()
{	
	$(".barmenu").on("click", function()
    {
        if($(".navigation-left").css("display") == "none")
        {
          $(".navigation-left").css("display", "block");
          $(".navigation-right").css("display", "block");
          $(".navigation-right").css("margin-left", "260px");
          $(".barmenu").css("margin-left", "260px");
          $("body").css("background", "");
        }
        else
        {
           $(".navigation-left").css("display", "none");
           $(".navigation-right").css("float", "none");
           $(".navigation-right").css("margin-left", "0");           
           $(".barmenu").css("margin-left", "0px");
           $("body").css("background", "#fff");
        }
    });
    
  jQuery('.navigation-left .dropdown > a').click(function(){
    if(!jQuery(this).next().is(':visible'))
      jQuery(this).next().slideDown('fast');
    else
      jQuery(this).next().slideUp('fast');  
    return false;
  });
})