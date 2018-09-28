jQuery(document).ready(function($){
  $('.slider-panel').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    infinite: false,
    prevArrow: '<i class="fas fa-angle-left"></i>',
    nextArrow: '<i class="fas fa-angle-right"></i>',
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true
        }
      }
    ]
  });

  //$('#library').on('shown.bs.collapse', function(){
  //  $('.slider-panel').get(0).slick.setPosition();
  //});
});