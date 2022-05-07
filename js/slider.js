$(function(){
  
  var curSlide = 0;
  var maxSlide  = $(".img-banner").length - 1;

  changeSlide();
  initSlide();

  function initSlide(){
    $('.img-banner').hide();
    $('.img-banner').eq(0).show();
  }

  function changeSlide(){
    setInterval(function(){
      $('.img-banner').eq(curSlide).fadeOut(2000);
      curSlide++;
      if (curSlide > maxSlide){
        curSlide = 0;
      }
      $('.img-banner').eq(curSlide).fadeIn(2000);
    },3000);
  }

})
