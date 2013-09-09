jQuery(document).ready(function(){

    //Init Functions at page 8.0_is.functions.js
    DeviceDetector();
    WindowSizeFunctions();
    validator();
    BtnMenuMobile();
    PortfolioItemSize();

	//Plugins
    jQuery('.fancy').fancybox();
    jQuery('input[type="tel"]').mask('(99) 9999-9999');

});

jQuery(window).load(function(){

    jQuery("#RJRScroller").mCustomScrollbar({
        autoHideScrollbar:false,
        theme:"light-thin"
    });
});

jQuery(window).resize(function(){
    WindowSizeFunctions();
    PortfolioItemSize();
});

jQuery('#PagePortfolio figure').click(function(){

	var slug;

	slug  = jQuery(this).data('client');

	jQuery.get('http://www.interative.cc/?portfolio='+slug+'&ajax', function(html) {
		  console.log(html);
	});
});