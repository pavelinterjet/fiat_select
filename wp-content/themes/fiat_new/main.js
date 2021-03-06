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
          rtl: true,
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
        rtl: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        cssEase: 'linear',
        infinite: true,
        arrows: true,
        prevArrow: '<div class="prev"></div>',
        nextArrow: '<div class="next"></div>',
        speed: 500,
        cssEase: 'ease-in-out',
        touchThreshold: 100,
        draggable: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false
                }
            },
        ]
    };
$('.filtered_carousel').slick(filtered_car_par);

if( $(window).width() < 960 ) {
    $('.car_submodels>div').slick({
        infinite: false,
        slidesToScroll: 1,
        slidesToShow: 3,
        speed: 500,
        arrows: false,
        rtl: false,
        responsive: [
            {
                breakpoint: 500,
                settings: {
                    swipe: true,
                    slidesToShow: 3,
                }
            },
            
        ]
    });
    $('.car_colors>div').slick({
        infinite: false,
        slidesToScroll: 1,
        slidesToShow: 4,
        speed: 500,
        arrows: false,
        rtl: false,
        centerMode: false,
        infinite: false,
        responsive: [
            {
                breakpoint: 500,
                settings: {
                    swipe: true,
                    slidesToShow: 4,
                }
            },
            
        ]
    });
    setTimeout(function() {
        var $slide = $(".car_submodels .slick-slider .active");
        var slideIndex = $slide.attr("data-slick-index");
        $(".car_submodels .slick-slider").slick("slickGoTo", slideIndex   );

        var $slide_colors = $(".car_colors .slick-slider .active");
        var slideIndex_colors = $slide_colors.attr("data-slick-index");
        $(".car_colors .slick-slider").slick("slickGoTo", slideIndex_colors   );
    }, 3000);
}









$('.filter_lvl .car_m').click(function() {
    
    $(this).parent().find('.car_m').removeClass('active');
    $(this).addClass('active');

    var that = $(this);

    var filter_type = $(this).attr('data-filter_type');
    var current_filter = $(this).attr('data-filter');

    var cmodels = $('.car_models .car_m.active').attr('data-filter');
    var submodels    = $('.car_submodels .car_m.active').attr('data-filter');
    var car_colors = $('.car_colors .car_m.active').attr('data-filter');


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
        success: function (data) {
            
            var av = data['available'];

            console.log(data);


            $('.car_m[data-filter_type="colors"]').removeClass('active');
            $('.car_m[data-filter_type="submodel"]').removeClass('active');

            $('.car_m[data-filter_type="colors"]').removeClass('bright');
            $('.car_m[data-filter_type="submodel"]').removeClass('bright');


            

                if( typeof av['colors'] != 'undefined' ) {
                    for (let i = 0; i < av['colors'].length; i++) {
                        $('.car_m[data-filter_type="colors"][data-filter="filter_'+av['colors'][i]+'"]').addClass('bright');
                        
                        if( filter_type != 'colors' ) {
                            $('.car_m[data-filter_type="colors"][data-filter="filter_'+av['colors'][0]+'"]').addClass('active');
                        } 

                        


                    }
                }
                
                if( typeof av['sub_models'] != 'undefined') {
                    for (let i = 0; i < av['sub_models'].length; i++) {

                        if( filter_type != 'submodel' && filter_type != 'color') {
                            $('.car_m[data-filter_type="submodel"][data-filter="filter_'+av['sub_models'][0]+'"]').addClass('active');
                        }
                         

                        if ( filter_type == 'color' ) {
                            $('.car_m[data-filter_type="submodel"][data-filter="'+current_filter+'"]').addClass('active');
                        }
                        

                        $('.car_m[data-filter_type="submodel"][data-filter="filter_'+av['sub_models'][i]+'"]').addClass('bright');

                    }
                }



                $(that).addClass('active');


                $('.car_filter .left').html( data.content );

                let bt = $('.blue_title').clone();
                let cf = $('.car_features').clone();
                let sl = $('.secret_link a').clone()

                $('.mobile_filter_content').html( bt + cf );
                $('.filtered_carousel').slick(filtered_car_par);

                $('.mobile_filter_content').html('');
                $('.mobile_filter_content').append( bt[0] );
                $('.mobile_filter_content').append( cf[0] );
                $('.big_button').html( sl[0] );
                // $('.filtered_carousel').slick(filtered_car_par);
                $('.big_slider').html('');
                $('.big_slider').slick('unslick');
                $('.big_slider').html( data.bottom_gal );

                // setTimeout(function(){
                //     $('.car_m').removeClass('active');
                //     $('.car_models .car_m.bright').eq(0).addClass('active');
                //     $('.car_submodels .car_m.bright').eq(0).addClass('active');
                //     $('.car_colors .car_m.bright').eq(0).addClass('active');
                // },500)

                inPage('big_slider', galleryBev);



        }
    })





})




















// $('.car_models .car_m.bright').eq(0).addClass('active');
// $('.car_submodels .car_m.bright').eq(0).addClass('active');
// $('.car_colors .car_m.bright').eq(0).addClass('active');





// $('.filter_lvl .car_m').click(function(){

//     $(this).parent().find('.car_m').removeClass('active');
//     $(this).addClass('active');
//     var that = $(this);

//     var cmodels = $('.car_models .car_m.active').attr('data-filter');
//     var submodels    = $('.car_submodels .car_m.active').attr('data-filter');
//     var car_colors = $('.car_colors .car_m.active').attr('data-filter');

//     var filter_type = $(this).attr('data-filter_type');
//     var current_filter = $(this).attr('data-filter');

//     var data = {
//         car_models: cmodels,
//         submodels: submodels,
//         car_colors: car_colors,
//         filter_type: filter_type,
//         current_filter: current_filter
//     };

//     $.ajax({
//         url: '',
//         type: 'POST',
//         data,
//         dataType: "json",
//         success: function(data){

//             var av = data['available'];



//             $('.car_m[data-filter_type="colors"]').removeClass('active');
//             $('.car_m[data-filter_type="submodel"]').removeClass('active');

//             $('.car_m[data-filter_type="colors"]').removeClass('bright');
//             $('.car_m[data-filter_type="submodel"]').removeClass('bright');


//                 if( typeof av['colors'] != 'undefined' ) {
//                     for (let i = 0; i < av['colors'].length; i++) {
//                         $('.car_m[data-filter_type="colors"][data-filter="filter_'+av['colors'][i]+'"]').addClass('bright');
                        
//                         if( filter_type != 'colors' ) {
//                             $('.car_m[data-filter_type="colors"][data-filter="filter_'+av['colors'][0]+'"]').addClass('active');
//                         } 
//                     }
//                 }
                

//                 if( typeof av['submodels'] != 'undefined') {
//                     for (let i = 0; i < av['submodels'].length; i++) {

//                         if( filter_type != 'submodel' ) {
//                             $('.car_m[data-filter_type="submodel"][data-filter="filter_'+av['submodels'][0]+'"]').addClass('active');
//                         }
//                         $('.car_m[data-filter_type="submodel"][data-filter="filter_'+av['submodels'][i]+'"]').addClass('bright');
//                     }
//                 }

            
//             $(that).addClass('active');

//             // if( data.content > 0 ) {

//                 $('.car_filter .left').html( data.content );

//                 let bt = $('.blue_title').clone();
//                 let cf = $('.car_features').clone();
//                 let sl = $('.secret_link a').clone()

//                 $('.mobile_filter_content').html( bt + cf );
//                 $('.filtered_carousel').slick(filtered_car_par);

//                 $('.mobile_filter_content').html('');
//                 $('.mobile_filter_content').append( bt[0] );
//                 $('.mobile_filter_content').append( cf[0] );
//                 $('.big_button').html( sl[0] );
//                 // $('.filtered_carousel').slick(filtered_car_par);
//                 $('.big_slider').html('');
//                 $('.big_slider').slick('unslick');
//                 $('.big_slider').html( data.bottom_gal );

//                 // setTimeout(function(){
//                 //     $('.car_m').removeClass('active');
//                 //     $('.car_models .car_m.bright').eq(0).addClass('active');
//                 //     $('.car_submodels .car_m.bright').eq(0).addClass('active');
//                 //     $('.car_colors .car_m.bright').eq(0).addClass('active');
//                 // },500)

//                 inPage('big_slider', galleryBev);


//             // }
//         }
//     })

// })






// $('.filter_lvl .car_m').click(function(){

//     $(this).parent().find('.car_m').removeClass('active');
//     // $('.filter_lvl .car_m').removeClass('active');

//     $(this).addClass('active bright');

//     var that = $(this);
 
//     var filter_type = $(this).attr('data-filter_type');
//     var current_filter = $(this).attr('data-filter');

//     var cmodels = $('.car_models').attr('data-filter');
//     var submodels    = $('.car_submodels').attr('data-filter');
//     var car_colors = $('.car_colors').attr('data-filter');

//     var data = {
//         // car_models: cmodels,
//         // submodels: submodels,
//         // car_colors: car_colors,
//         filter_type: filter_type,
//         current_filter: current_filter
//     };
//     $.ajax({
//         url: '',
//         type: 'POST',
//         data,
//         dataType: "json",
//         beforeSend: function() {
//             $('.preloader').fadeIn();
//             $('.left,.big_slider').addClass('loading');
//         },
//         success: function(data, textStatus, jqXHR){
//             $('.preloader').fadeOut();
//             $('.left,.big_slider').removeClass('loading');
//             $('.car_m').removeClass('bright');
//                 $(that).addClass('bright');
//                 var av = data['available'];
//                 if( typeof av['model'] != 'undefined' ) {
//                     for (let i = 0; i < av['model'].length; i++) {
//                         $('.car_m[data-filter_type="model"][data-filter="filter_'+av['model'][i][0]+'"]').addClass('bright');
//                     }
//                 }
//                 if( typeof av['colors'] != 'undefined' ) {
//                     for (let i = 0; i < av['colors'].length; i++) {
//                         $('.car_m[data-filter_type="colors"][data-filter="filter_'+av['colors'][i][0]+'"]').addClass('bright');
//                     }
//                 }
//                 if( typeof av['submodel'] != 'undefined') {
//                     for (let i = 0; i < av['submodel'].length; i++) {
//                         $('.car_m[data-filter_type="submodel"][data-filter="filter_'+av['submodel'][i][0]+'"]').addClass('bright');
//                     }
//                 }

//             if( data['content'].length > 0 ) {
//                 $('.car_filter .left').html( data['content'] );
//                 let bt = $('.blue_title').clone();
//                 let cf = $('.car_features').clone();
//                 let sl = $('.secret_link a').clone()
//                         $('.mobile_filter_content').html('');
//                         $('.mobile_filter_content').append( bt[0] );
//                         $('.mobile_filter_content').append( cf[0] );
//                         $('.big_button').html( sl[0] );
//                         $('.filtered_carousel').slick(filtered_car_par);
//                         $('.big_slider').html('');
//                         $('.big_slider').slick('unslick');
//                         $('.big_slider').html( data['bottom_gal'] );
//                 setTimeout(function(){
//                     $('.car_m').removeClass('active');
//                     $('.car_models .car_m.bright').eq(0).addClass('active');
//                     $('.car_submodels .car_m.bright').eq(0).addClass('active');
//                     $('.car_colors .car_m.bright').eq(0).addClass('active');
//                 },500)
//                 inPage('big_slider', galleryBev);
//             }

//             setTimeout(function() {
//                 var $slide = $(".car_submodels .slick-slider .bright.active");
//                 var slideIndex = $slide.index();
//                 $(".car_submodels .slick-slider").slick("slickGoTo", slideIndex-2  );
//                 var $slide_colors = $(".car_colors .slick-slider .active");
//                 var slideIndex_colors = $slide_colors.index();
//                 $(".car_colors .slick-slider").slick("slickGoTo", slideIndex_colors  );
//             }, 2000 );
//         }
//     })
// })


setTimeout(() => {
    // $('.car_m').removeClass('active');
    $('.car_models .car_m').eq(0).trigger('click');
    // $('.car_submodels .car_m.bright').eq(0).trigger('click');
    // $('.car_colors .car_m.bright').eq(0).trigger('click');
}, 1000);


    
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