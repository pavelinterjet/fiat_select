// $(window).load(function(e) {
//     (function(s) {
//         if(!window.history.pushState) return;
//         s = (!!window.location.hash.length) ? s + window.location.hash : s;
//         var regex = /(^#\w+[0-9A-Za-z])?((&\?)jet_redirected(=[^&]*)?|^jet_redirected(=[^&]*)?&?|\?jet_redirected(=[^&]*)?&?|#(\w*[0-9a-zA-Z]#))/;
//         if(s.indexOf('jet_redirected') > -1) history.replaceState({}, '', '../' + ((!!s.replace(regex, '').length) ? '?' + s.replace(regex, '') : s.replace(regex, '')));
//     })(window.location.search);
// });

jQuery(document).ready(function($){
    
    // $('#form').jetform({
    //     url: 'https://hoverlead.com/lead/save',
    //     token: '4546f2cec1bf697336371c926e683fd2aa',
    //     errorSelector: false,
    //     successSelector: true,
    //     spinner: false,
    //     template: {
    //         response: {
    //             sending: 'שולח...'
    //         }
    //     },
    //     onSuccess: function() {
    //         $('#form .form_to_hide ').fadeOut(function (params) {
    //             $('.thankyou').fadeIn();
    //         })
    //     }
    // });


    

    var inPage = function (moduleName, callback) {
      const $node = (typeof moduleName === "string") ? $('.' + moduleName) : moduleName;
    
      if ($node.length > 0 && typeof callback == "function") {
          callback($node);
      }
    };


    
const galleryBev = function ($list) {
  $list.each(function(){
      const $comp = $(this);

      $carousel = $comp; 
      // const $carousel = $comp.find('.big_slider');
      const $wrapper = $comp.find('.big_slider');
      let canScroll = true;
      let firstSlide = true;

      
      $carousel.slick({
          infinite: false,
          swipe: true,
          rtl: false,
          dots: true,
          arrows: false,
          variableWidth: true,
          slidesToScroll: 1,
          slidesToShow: 1,
          speed: 500,
          responsive: [
              {
                  breakpoint: 1199,
                  settings: {
                      swipe: true
                  }
              },
              {
                breakpoint: 960,
                settings: {
                    swipe: true,
                    variableWidth: false,
                }
            }
          ]
      });

      const $dots = $carousel.find(".slick-dots li");
      $dots.find("button").click(function(e) {
          e.stopImmediatePropagation();
          canScroll = false;

          const $this = $(this);
          const index = $dots.index($this.parent());

          if (index > $carousel.slick('slickCurrentSlide')) {
              setTimeout(function(){
                  $comp.find('.slick-slide').removeClass('slick-active');
                  $comp.find('.slick-slide').eq(index).addClass("slick-active");
              }, 100);

              setTimeout(function(){
                  $carousel.slick('goTo', index);
              }, 520);
          } else {
              $carousel.slick('goTo', index);
          }

          setTimeout(function() {
              canScroll = true;
          }, 1000);
      });

      const $slides = $carousel.find(".slick-slide");
      $slides.click(function(e) {
          const $this = $(this);

          if (!$(this).hasClass("slick-active")) {
              e.stopImmediatePropagation();
              canScroll = false;

              const index = $slides.index($this);

              if (index > $carousel.slick('slickCurrentSlide')) {
                  setTimeout(function () {
                      $comp.find('.slick-slide').removeClass('slick-active');
                      $comp.find('.slick-slide').eq(index).addClass("slick-active");
                  }, 100);

                  setTimeout(function () {
                      $carousel.slick('goTo', index);
                  }, 520);
              } else {
                  $carousel.slick('goTo', index);
              }

              setTimeout(function () {
                  canScroll = true;
              }, 1000);
          }
      });

      /* start Scroll Animation*/
      let scroll_position = 0;
      var scroll_direction;
      var activeSliderNumber = 1;


      $(window).on('keydown', function(e){
          let scroll = false;
          const code = typeof e.keyCode === "undefined" ? e.key : e.keyCode;
          switch (code) {
              case 39: case 40:
                  scroll = "down";
                  break;
              case 37: case 38:
                  scroll = "up";
                  break;
          }
          // if (scroll) {
          //     scrollGallery(scroll);
          // }
      });

      

      function resetGallery() {
          firstSlide = true;
          activeSliderNumber = 1;
          $carousel.slick("goTo", 0);
      }
  });
};


$(function () {
  const moduleName = 'big_slider';
  inPage(moduleName, galleryBev);
});




var filtered_car_par = {
        rtl: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        cssEase: 'linear',
        infinite: true,
        speed: 500,
        cssEase: 'ease-in-out',
        touchThreshold: 100,
        draggable: true };


$('.filtered_carousel').slick(filtered_car_par);




$(this).parent().find('.car_m').removeClass('active');
$(this).addClass('active');
var cmodels = $('.car_models .car_m.active').attr('data-filter');
var submodels    = $('.car_submodels .car_m.active').attr('data-filter');
var car_colors = $('.colors .car_m.active').attr('data-filter');
var data = {
    car_models: cmodels,
    submodels: submodels,
    car_colors: car_colors
};
$.ajax({
    url: '',
    type: 'POST',
    data,
    // dataType: "json",
    success: function(data){

        if( data.length > 0 ) {

            $('.car_filter .left').html( data);

            let bt = $('.blue_title').clone();
            let cf = $('.car_features').clone();
            let sl = $('.secret_link a').clone()

            $('.mobile_filter_content').html('');
            $('.mobile_filter_content').append( bt[0] );
            $('.mobile_filter_content').append( cf[0] );
            $('.big_button').html( sl[0] );

            $('.filtered_carousel').slick(filtered_car_par);

        }
    }
})



$('.filter_lvl .car_m').click(function(){


    $(this).parent().find('.car_m').removeClass('active');
    $(this).addClass('active');
    var cmodels = $('.car_models .car_m.active').attr('data-filter');
    var submodels    = $('.car_submodels .car_m.active').attr('data-filter');
    var car_colors = $('.colors .car_m.active').attr('data-filter');
    var data = {
        car_models: cmodels,
        submodels: submodels,
        car_colors: car_colors
    };
    $.ajax({
        url: '',
        type: 'POST',
        data,
        // dataType: "json",
        success: function(data){

            if( data.length > 0 ) {
                $('.car_filter .left').html( data );

                let bt = $('.blue_title').clone();
                let cf = $('.car_features').clone();
                let sl = $('.secret_link a').clone()

                $('.mobile_filter_content').html('');
                $('.mobile_filter_content').append( bt[0] );
                $('.mobile_filter_content').append( cf[0] );
                $('.big_button').html( sl[0] );

                $('.filtered_carousel').slick(filtered_car_par);
            }
        }
    })


})

    



    
if( $(window).width() < 960 ) {
    $('.filter_lvl>div').slick({
        infinite: false,
        slidesToScroll: 1,
        slidesToShow: 3,
        speed: 500,
        arrows: false,
        rtl: true,
        responsive: [
            {
                breakpoint: 500,
                settings: {
                    swipe: true,
                    slidesToShow: 2,
                }
            },
            
        ]
    });
}

    
$("a").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();
          // Store hash
          var hash = this.hash;
          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
    });

})