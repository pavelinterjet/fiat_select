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








$('.filter_lvl .car_m').click(function(){

    console.log('test');

    $(this).parent().find('.car_m').removeClass('active');
    $(this).addClass('active bright');

    var that = $(this);
 
    var filter_type = $(this).attr('data-filter_type');
    var current_filter = $(this).attr('data-filter');

    var cmodels = $('.car_models .car_m.active').attr('data-filter');
    var submodels    = $('.car_submodels .car_m.active').attr('data-filter');
    var car_colors = $('.colors .car_m.active').attr('data-filter');


    var data = {
        car_models: cmodels,
        submodels: submodels,
        car_colors: car_colors,
        filter_type: filter_type,
        current_filter: current_filter
    };

    $.ajax({
        url: '',
        type: 'POST',
        data,
        dataType: "json",
        beforeSend: function() {
            $('.preloader').fadeIn();
            $('.left,.big_slider').addClass('loading');
        },
        success: function(data, textStatus, jqXHR){

            $('.preloader').fadeOut();
            $('.left,.big_slider').removeClass('loading');

            $('.car_m').removeClass('bright');
            $(that).addClass('bright');
                var av = data['available'];
                if( typeof av['model'] != 'undefined' ) {
                    for (let i = 0; i < av['model'].length; i++) {
                        $('.car_m[data-filter_type="model"][data-filter="filter_'+av['model'][i][0]+'"]').addClass('bright');
                    }
                }
                if( typeof av['colors'] != 'undefined' ) {
                    for (let i = 0; i < av['colors'].length; i++) {
                        $('.car_m[data-filter_type="colors"][data-filter="filter_'+av['colors'][i][0]+'"]').addClass('bright');
                    }
                }
                if( typeof av['submodel'] != 'undefined') {
                    for (let i = 0; i < av['submodel'].length; i++) {
                        $('.car_m[data-filter_type="submodel"][data-filter="filter_'+av['submodel'][i][0]+'"]').addClass('bright');
                    }
                }
                
            if( data['content'].length > 0 ) {
                $('.car_filter .left').html( data['content'] );

                let bt = $('.blue_title').clone();
                let cf = $('.car_features').clone();
                let sl = $('.secret_link a').clone()

                $('.mobile_filter_content').html('');
                $('.mobile_filter_content').append( bt[0] );
                $('.mobile_filter_content').append( cf[0] );
                $('.big_button').html( sl[0] );

                $('.filtered_carousel').slick(filtered_car_par);
                $('.big_slider').html('');
                $('.big_slider').slick('unslick');
                $('.big_slider').html( data['bottom_gal'] );


                setTimeout(function(){

                    console.log('jopa');

                    
                    $('.car_models .car_m').each(function(i){

                        $('.car_models .car_m').removeClass('active');
                        $(this).find('.bright').addClass('active');
                        
                    })
                    $('.car_submodels .car_m').each(function(i){
                        $('.car_submodels .car_m').removeClass('active');
                        $(this).find('.bright').addClass('active');
                    })
                    $('.colors .car_m').each(function(i){
                        $('.colors .car_m').removeClass('active');
                        $(this).find('.bright').addClass('active');

                        console.log('jopa');
                    })
                },1000)

                inPage('big_slider', galleryBev);

            }
        }
    })

})


// $('.car_models .car_m[data-count="1"]').trigger('click');
// $('.car_submodels .car_m[data-count="1"]').trigger('click');
// $('.colors .car_m[data-count="1"]').trigger('click');

    
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