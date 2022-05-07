$(function(){
  $('.card-text').click(function() {
    /* Act on the event */
    var arquivo = $(this).attr('arquivo');
    $('.'+arquivo).fadeToggle(1000);
  });

  $('.titulo').click(function(event) {
    /* Act on the event */
    $('.tituloHidden').fadeToggle(1000);
  });

  $('.editar').hover(function() {
    /* Stuff to do when the mouse enters the element */
    $(this).children("i").addClass('fa fa-pencil');
  }, function() {
    /* Stuff to do when the mouse leaves the element */
    $(this).children("i").removeClass('fa fa-pencil');
  });

  $(".titulo").hover(function() {
    /* Stuff to do when the mouse enters the element */
    $(this).children("i").addClass('fa fa-pencil');
  }, function() {
    /* Stuff to do when the mouse leaves the element */
    $(this).children("i").removeClass('fa fa-pencil');
  });
})
