$(document).ready(function(){

  $('.slide-track').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: $("#prevBT"),
    nextArrow: $("#nextBT"),
    responsive:[
      {
        breakpoint: 520,
        settings:{
          slidesToShow: 1
        }
      },
      {
        breakpoint: 970,
        settings:{
          slidesToShow: 2
        }
      },
      {
        breakpoint: 1340,
        settings:{
          slidesToShow: 3
        }
      }]
    });

  });
