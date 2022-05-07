$(function(){
  var princ1 = $(".princ1");
  var princ2 = $(".princ2");
  var princ3 = $(".princ3");
  var princ4 = $(".princ4");
  var princ5 = $(".princ5");
  var princ6 = $(".princ6");
  var princ9 = $(".princ9");

  var black1 = $(".black1"); 
  var black2 = $(".black2");
  var black3 = $(".black3");
  var black4 = $(".black4");
  var black5 = $(".black5");
  var black6 = $(".black6");
  var black9 = $(".black9");


  princ1.hover(function(){
    black1.fadeIn();
  },function(){
    black1.fadeOut();
  })

  princ2.hover(function(){
    black2.fadeIn();
  },function(){
    black2.fadeOut();
  })

  princ3.hover(function(){
    black3.fadeIn();
  },function(){
    black3.fadeOut();
  })

  princ4.hover(function(){
    black4.fadeIn();
  },function(){
    black4.fadeOut();
  })

  princ5.hover(function(){
    black5.fadeIn();
  },function(){
    black5.fadeOut();
  })

  princ6.hover(function(){
    black6.fadeIn();
  },function(){
    black6.fadeOut();
  })

});

$(window).on('load',function(){
  if ($('target').length > 0){
    // O elemento existe
    var elemento = '#'+$('target').attr('target');
    var divScroll = $(elemento).offset().top;
    $('html,body').animate({'scrollTop':divScroll},5000);
  }

})



