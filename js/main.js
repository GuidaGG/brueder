///////////////// SETUP ISOTOPE /////////////////

jQuery(function ($) {



 var $container = $('#isotope'); //The ID for the list with all the blog posts
 $container.isotope({ //Isotope options, 'item' matches the class in the PHP
 itemSelector : 'li', 
   layoutMode : 'masonry'
 });
 
 $container.imagesLoaded().progress( function() {
  $container.isotope('layout');
 });

 var $gallery = $('#isotope-product-page'); //The ID for the list with all the blog posts
 $gallery.isotope({ //Isotope options, 'item' matches the class in the PHP
 itemSelector : 'div', 
   layoutMode : 'masonry'
 });
 
 $gallery.imagesLoaded().progress( function() {
  $gallery.isotope('layout');
 }); 
 
 //Add the class selected to the item that is clicked, and remove from the others
 var $optionSets = $('#filters'),
 $optionLinks = $optionSets.find('a');
 
 $optionLinks.click(function(){
 var $this = $(this);
 // don't proceed if already selected
 if ( $this.hasClass('selected') ) {
   return false;
 }
 var $optionSet = $this.parents('#filters');
 $optionSets.find('.selected').removeClass('selected');
 $this.addClass('selected');
 
 //When an item is clicked, sort the items.
 var selector = $(this).attr('data-filter');
 $container.isotope({ filter: selector });
 
 return false;
 });
 
});

///////////////// FUNCTIONS /////////////////

(function($) {

$(document).ready(shapeTable());

$(window).resize(function() {
  shapeTable();
});

function shapeTable() {
  if ($(window).width() < 768) {
    $('.product-name').attr('colspan',2);
  };
};

var mailcheckout = $( "#order-email" ).val();
$( "#mce-EMAIL" ).val(mailcheckout);

var target = $('.up_mobile').offset().top;

$('body html window').on('touchstart', function(e) { 
  alert('hallo')
    var cookieheight = $(".cookie-notice-container").height();
    $('.cookie-notice-container').animate({ marginTop: - cookieheight*2}, 300);
    $('body').animate({ marginTop: '0'}, 500);
});


$(window).on('scroll', function() { 
    var cookieheight = $(".cookie-notice-container").height();
    $('.cookie-notice-container').animate({ marginTop: - cookieheight*2}, 300);
    $('body').animate({ marginTop: '0'}, 500);

    if ($(window).scrollTop() > target) {
        $('.up_mobile').addClass('sticky');
        $('.up_mobile').addClass('rotate180');
    } else {
        $('.up_mobile').removeClass('sticky'); 
        $('.up_mobile').removeClass('rotate180');
    }
});

$('.up_mobile').click(function(){
  if ( $('.up_mobile').hasClass('sticky') ){
    setTimeout( function() {
      $("html, body").scrollTo($("header"), 300, 'swing');
    }, 200 );
  } else {
    setTimeout( function() {
     $("html, body").scrollTo($('#content'), 300, 'swing');
    }, 200 );
  }
});
  
//lazyload
function imgSrc(){

   var $container = $('#isotope');
   $('img').each(function(){
       if($(this).offset().top < $(window).height() + 400) {
            $(this).attr('src',$(this).data('src'))
       }  
   });
}

$(document).ready(function(){
    (![]+[])[+!+[]]+(![]+[])[!+[]+!+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]+(!![]+[])[+[]]+(![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[!+[]+!+[]+[+[]]]+(+(+!+[]+[+[]]+[+!+[]]))[(!![]+[])[+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+(+![]+([]+[])[([][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+([][[]]+[])[+!+[]]+(![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[+!+[]]+([][[]]+[])[+[]]+([][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+(!![]+[])[+[]]+(!![]+[])[+!+[]]+([![]]+[][[]])[+!+[]+[+[]]]+([][[]]+[])[+!+[]]+(+![]+[![]]+([]+[])[([][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+([][[]]+[])[+!+[]]+(![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[+!+[]]+([][[]]+[])[+[]]+([][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+(!![]+[])[+!+[]]])[!+[]+!+[]+[+[]]]](!+[]+!+[]+[+!+[]])[+!+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(+[![]]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+!+[]]]+(![]+[])[!+[]+!+[]]+([][[]]+[])[+[]]+(+(!+[]+!+[]+[+[]]))[(!![]+[])[+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+(+![]+([]+[])[([][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+([][[]]+[])[+!+[]]+(![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[+!+[]]+([][[]]+[])[+[]]+([][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+(!![]+[])[+[]]+(!![]+[])[+!+[]]+([![]]+[][[]])[+!+[]+[+[]]]+([][[]]+[])[+!+[]]+(+![]+[![]]+([]+[])[([][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+([][[]]+[])[+!+[]]+(![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[+!+[]]+([][[]]+[])[+[]]+([][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[+!+[]+[+[]]]+(!![]+[])[+!+[]]])[!+[]+!+[]+[+[]]]](!+[]+!+[]+[+!+[]])+(![]+[])[+!+[]]+(![]+[])[!+[]+!+[]+!+[]]+(!![]+[][(![]+[])[+[]]+([![]]+[][[]])[+!+[]+[+[]]]+(![]+[])[!+[]+!+[]]+(!![]+[])[+[]]+(!![]+[])[!+[]+!+[]+!+[]]+(!![]+[])[+!+[]]])[!+[]+!+[]+[+[]]]
 // Isotope
    if( $(".cookie-notice-container").css('display') == 'block') {
        var cookieheight = $(".cookie-notice-container").height()
        $('body').css('marginTop', cookieheight*1.15)
    }

    $('#cn-accept-cookie').click(function(){
        $('.cookie-notice-container').animate({ marginTop: - cookieheight*1.15, opacity: 0}, 300);
        $('body').animate({ marginTop: '0'}, 500);
    });


    $('#up > a').click(function(){
        $("html, body").scrollTo($('header'), 300, 'swing');
    });

    //lazy load
    var $win = $(window),
    $con = $('#isotope'),
    $imgs = $("img");

    $con.isotope({
        onLayout: function() {
            $win.trigger("scroll");
        }
    });
    
    $imgs.Lazy();


    imgSrc()
   /* OK ZOOM */
   $('.product-custom-thumbnail > img, .lg-span-1 img, .lg-span-2 img, .lg-span-3 img, .about-thumbnail-wrapper img, .image_gallery_preview > .woocommerce-product-gallery__image > a > img, .woocommerce-product-gallery__image  > a > img').okzoom({
      width: 250,
      height: 250,
      round: true,
      background: "#fff",
      backgroundRepeat: "no-repeat",
      shadow: "0 0 0px #000",
      border: "0px solid black",
      pointerEvents: "none",
      scaleWidth: 1600,
   });
    
    /* NEWSLETTER */
    $('#newslettercta').on('click', function(){
        $('#newsletter').toggleClass('height')
    });
    
    $('.search-field').on('mouseenter', function(){
        $( this ).css( "opacity", "1" );
        $('.page-title').css( "opacity", "0" );
    });
    
    $('.search-field').on('mouseleave', function(){
        $( this ).css( "opacity", "0" );
        $('.page-title').css( "opacity", "1" );
    });

    $('#newslettercta1').on('click', function(){
        $('#newsletter1').toggleClass('height')
    });
    
    /* FILTER */
    $('.filter_arrow, .filter-title').on('click', function(){
        $('.filter').toggleClass( "height", 200, "swing" );
        $('.filter_arrow').toggleClass('rotate180');
    });
    
    /* CART AMOUNT */
    $('.quantity-sintle-product-minus').click( function() {
        
        var amount = $(this).siblings('.product-amount-costum').html();
        if((amount >= 2)){
            var counter = $(this).siblings().children('.input-text.qty.text').val();
            counter-- ;
            $(this).siblings().children('.input-text.qty.text').val(counter);
            $(this).siblings('.product-amount-costum').html(function(i, val) { return val*1-1 });
            if($("input").is("[disabled]")){
                $("input").removeAttr('disabled');
            }
        }
    });
    
    $('.quantity-sintle-product-plus').click( function() {
  
            var counter = $(this).siblings().children('.input-text.qty.text').val();
            counter++ ;
            $(this).siblings().children('.input-text.qty.text').val(counter);
            $(this).siblings('.product-amount-costum').html(function(i, val) { return val*1+1 });
            if($("input").is("[disabled]")){
                $("input").removeAttr('disabled');
            }
    });

    $('.post-tags-date-author').parent().children('p').hide();
    
    $('.woocommerce-product-gallery__image').find('a').removeAttr('href');
    
    /* guida doing stuff because she too dumb to make it in php */
    $( document.body ).on( 'updated_cart_totals', function(){
          /* CART AMOUNT */
        $('.quantity-sintle-product-minus').click( function() {
            
            var amount = $(this).siblings('.product-amount-costum').html();
            if((amount >= 2)){
                var counter = $(this).siblings().children('.input-text.qty.text').val();
                counter-- ;
                $(this).siblings().children('.input-text.qty.text').val(counter);
                $(this).siblings('.product-amount-costum').html(function(i, val) { return val*1-1 });
                if($("input").is("[disabled]")){
                    $("input").removeAttr('disabled');
                }
            }
        });
        
        $('.quantity-sintle-product-plus').click( function() {
      
                var counter = $(this).siblings().children('.input-text.qty.text').val();
                counter++ ;
                $(this).siblings().children('.input-text.qty.text').val(counter);
                $(this).siblings('.product-amount-costum').html(function(i, val) { return val*1+1 });
                if($("input").is("[disabled]")){
                    $("input").removeAttr('disabled');
                }
        });
    });
});


})( jQuery );

