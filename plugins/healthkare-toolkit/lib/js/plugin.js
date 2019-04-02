(function($) {

	"use strict";
	
	/* - Google Map */
	function initialize(obj) {

		var lat = $('#'+obj).attr("data-lat");
		var lng = $('#'+obj).attr("data-lng");
		var contentString = $('#'+obj).attr("data-string");
		var myLatlng = new google.maps.LatLng(lat,lng);
		var map, marker, infowindow;
		var image = $('#'+obj).attr("data-marker");
		var zoomLevel = parseInt($("#"+obj).attr("data-zoom") ,10);
		var styles = [{"featureType":"landscape","stylers":[{"saturation":" "},{"lightness":" "},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":" "},{"lightness":" "},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":" "},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":" "},{"lightness":" "},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":" "},{"lightness":" "},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":" "},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":" "},{"saturation":" "}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":" "},{"saturation":" "}]}]
		var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});	
		var mapOptions = {
			zoom: zoomLevel,
			disableDefaultUI: true,
			center: myLatlng,
            scrollwheel: false,
			mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, "map_style"]
			}
		}
		map = new google.maps.Map(document.getElementById(obj), mapOptions);	
		map.mapTypes.set('map_style', styledMap);
		map.setMapTypeId('map_style');
		infowindow = new google.maps.InfoWindow({
			content: contentString,
			maxWidth: 300
		});		
		marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			icon: image
		});
		if(contentString != '') {
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			});	
		}
	}
	
	/* Image Height */
	function image_height() {
		var width = $(window).width();
		var cnt_height = $(".rev_slider").height();
		$(".image-section").css("height", cnt_height);
	}
	
	/* - Selling Section */
	function selling_img() {
		var width = $(window).width();
		var selling_section_height = $(".woocommerce-selling1").height();
		var selling_content_height = $(".selling-detail").height();
		if ( width >= 992 ) {
			$( ".selling-img" ).removeAttr("style");
			$( ".selling-img img" ).remove();
			var selling_img = $(".selling-img").attr("data-image");
			$( ".selling-img" ).css({"background-image":"url('" + selling_img + "')","height": selling_section_height });
		} else {
			$( ".selling-img" ).removeAttr("style");
			$( ".selling-img img" ).remove();
			var selling_img = $(".selling-img").attr("data-image");
			$( ".selling-img" ).append("<img src='"+ selling_img +"' />")
		}
	}
	
	/* - Latest Blog: 1: Video iframe Height Setting */
	function post_video_height1() {
		var width = $(window).width();
		var cnt_height = $(".latest-blog .entry-cover img").height();
		$(".latest-blog .entry-cover iframe").css("height", cnt_height);	
	}
	
	/* - Latest Blog: 2: Video iframe Height Setting */
	function post_video_height2() {
		var width = $(window).width();
		var cnt_height = $(".latest-blog1-section .entry-cover img").height();
		$(".latest-blog1-section .entry-cover iframe").css("height", cnt_height);	
	}
	
	/* Event - Document Ready */
	$(document).on("ready",function() {

		/* - Contact Map* */
		if($("#map-canvas-contact").length==1){
			initialize("map-canvas-contact");
		}
		
		/* - Best Selling Layou One */
		if($(".woocommerce-selling").length){
			var url;
			$(".selling-box .icon-list").magnificPopup({
				delegate: "a.zoom-in",
				type: "image",
				tLoading: "Loading image #%curr%...",
				mainClass: "mfp-img-mobile",
				gallery: {
					enabled: true,
					navigateByImgClick: false,
					preload: [0,1]
				},
				image: {
					tError: "<a href="%url%">The image #%curr%</a> could not be loaded.",
				}
			});
		}
		
		/* - Product Section */
		if($(".product-section .wishlist-box").length){
			var url;
			$(".products .wishlist-box").magnificPopup({
				delegate: "a.zoom-in",
				type: "image",
				tLoading: "Loading image #%curr%...",
				mainClass: "mfp-img-mobile",
				gallery: {
					enabled: true,
					navigateByImgClick: false,
					preload: [0,1]
				},
				image: {
					tError: "<a href="%url%">The image #%curr%</a> could not be loaded.",
				}
			});
		}
		
		/* - Client Carousel */
		if( $(".clients-carousel").length ) {
			$(".clients-carousel").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: true,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					500:{
						items: 2
					},
					600:{
						items: 3
					},
					1000:{
						items: 5
					}
				}
			});
		}
		
		/* - Category Carousel */
		if( $(".category-carousel").length ) {
			$(".category-carousel").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					480:{
						items: 2
					},
					768:{
						items: 2
					},
					1000:{
						items: 3
					},
					1366:{
						items: 4
					}
				}
			});
		}
		
		/* - Collection Carousel */
		if( $(".collection-carousel").length ) {
			$(".collection-carousel").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					600:{
						items: 2
					},
					768:{
						items: 2
					},
					1000:{
						items: 3
					}
				}
			});
		}
		
		/* - Category Carousel */
		if( $(".team-carousel").length ) {
			$(".team-carousel").owlCarousel({
				loop: true,
				margin: 30,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					480:{
						items: 2
					},
					768:{
						items: 3
					},
					992:{
						items: 4
					}
				}
			});
		}

		/* - Collection Carousel */
		if( $(".category-carousel1").length ) {
			$(".category-carousel1").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					500:{
						items: 1
					},
					768:{
						items: 2
					},
					1000:{
						items: 2
					}
				}
			});
		}

		/* - Collection Carousel */
		if( $(".collection-carousel-2").length ) {
			$(".collection-carousel-2").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: false,
				autoplay: false,
				responsive:{
					0:{
						items: 1
					},
					992:{
						items: 2
					}
				}
			});
		}
		
		/* - Shop Single */
		$(".carousel-item").owlCarousel({
			loop: true,
			autoplay: false,
			items: 1,
			nav: true,
			dots: false,
			autoplayHoverPause: true,
			animateOut: "slideOutUp",
			animateIn: "slideInUp"
		});
		
		/* - Latest Blog: Layout One Wrap Div's */
		var $div = $(".latest-blog1-section > div");
		for (var i = 0; i < $div.length; i += 2) {		
			var $new = $("<div/>", {				
				class: 'row'
			});
			$div.slice(i, i + 2).wrapAll($new);
		}
		
		/* - Selling Section */
		selling_img();
		
		/* - Post Video Height 1 */
		post_video_height1();
		
		/* - Post Video Height 2 */
		post_video_height2();
		
		/* Image Height */
		image_height();
		
	});	/* Event - Document Ready */
	
	var resizeId;
	$( window ).on("resize",function() {
		
		clearTimeout(resizeId);
		resizeId = setTimeout(doneResizing, 500);
		
		var width	=	$(window).width();
		var height	=	$(window).height();

		/* - Selling Section */
		selling_img();
		
		/* - Post Video Height 1 */
		post_video_height1();
		
		/* - Post Video Height 2 */
		post_video_height2();
	
	});
	
	function doneResizing(){
		/* Image Height */
		image_height();
	}
	
	$(window).on("load",function() {
		/* Image Height */
		setTimeout(function(){ 
			image_height(); 
		}, 1000);
		
		/* - Selling Section */
		selling_img();
		
		/* - Post Video Height 1 */
		post_video_height1();
		
		/* - Post Video Height 2 */
		post_video_height2();
		
		/* - Product Section */	
		if( $(".product-section").length ) {
			var $container = $(".products");
			$container.isotope({
			  itemSelector: ".products > li",
			  gutter: 0,
			  transitionDuration: "0.5s"
			});

			$("#filters a").on("click",function(){
				$("#filters a").removeClass("active");
				$(this).addClass("active");
				var selector = $(this).attr("data-filter");
				$container.isotope({ filter: selector });
				return false;
			});
		}	
		
	});
	
})(jQuery);