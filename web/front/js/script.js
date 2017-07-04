// "use strict"; 

  $(window).scroll(function(){
      if( $(window).scrollTop() == 0 ) {
          $('.scroll_top').stop(false,true).fadeOut(600);
      }else{
          $('.scroll_top').stop(false,true).fadeIn(600);
      }
  });

  /* scroll top */ 
  $(document).on('click','.scroll_top',function(){
      $('body,html').animate({scrollTop:0},400);
      return false;
  })

// OWL Carousel
$(document).ready(function() {
     
    $("#owl-example").owlCarousel({
     
    autoPlay: 3000, //Set AutoPlay to 3 seconds
     
    items : 2,
	navigation: false,
    pagination: false,
    itemsDesktop : [1000,2], //5 items between 1000px and 901px
	itemsDesktopSmall : [900,2], // betweem 900px and 601px
	itemsTablet: [600,1], //2 items between 600 and 0
	stopOnHover: true
     
    });

    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });
     
    });


	
	
// Tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// MENU
$(document).ready(function($){
					$('#accordion-1').dcAccordion({
						eventType: 'click',
						autoClose: false,
						saveState: true,
						disableLink: true,
						speed: 'slow',
						showCount: true,
						autoExpand: true,
						cookie	: 'dcjq-accordion-1',
						classExpand	 : 'dcjq-current-parent'
					});
});


// ISOTOPE
$( function() {
  // init Isotope
  var $container = $('.isotope').isotope({
    itemSelector: '.intro'
  });

  // selected element control on initial load
  var selector = $('.classtobefilteredoutonload');
    $container.isotope({ filter: '.grid-view-big.recent' });
  
  // store filter for each group
  var filters = {};

  $('.three-column').on( 'click', '.button', function() {
    var $this = $(this);
    // get group key
    var $buttonGroup = $this.parents('.button-group');
    var filterGroup = $buttonGroup.attr('data-filter-group');
    // set filter for group
    filters[ filterGroup ] = $this.attr('data-filter');
    // combine filters
    var filterValue = '';
    for ( var prop in filters ) {
      filterValue += filters[ prop ];
    }
    // set filter for Isotope
    $container.isotope({ filter: filterValue });
  });

  // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });
  
});
	