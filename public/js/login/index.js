// Toggle Function
$('.toggle').click(function(){
  // Switches the Icon
  $(this).children('i').toggleClass('fa-pencil');
  $(this).children('div.tooltips').toggle();
  // Switches the forms  
  $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
  }, "slow");
});
//var index=0;
//$("[type='checkbox']").on('change',function(){
//
//    if (this.checked) {
//        $("select").css('display','block');
//    }
//    else{
//        $("select").css('display','none');
//    }
//});
