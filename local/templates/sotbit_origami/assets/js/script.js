
// --------svg4evrybody------------------
$(document).ready(function(){
    svg4everybody();
});
// --------end svg4evrybody--------------


window.onresize = function(event) {

    // if ( $(window).width() < 576 ) {
    //     ChangeCouponMobile();
    //     titleChangeMobile();
    // }
    // else {
    //     ChangeCouponAllDevice();
    // }
    // if ( $(window).width() < 992 ) {
    //     ChangePriceMobile();
    // }
    // else {
    //     ChangePriceDevice();
    // }
    if ($(window).width() < 768) {
        galleryMoreItems(4);
        // ChangePhoneMobileDetail();
        // ChangeRegions(true);
        // previewProductMobileNot();
    }
    else {
        galleryMoreItems(15);
        // ChangePhoneDeviceDetail();
        // ChangeRegions(false);
    }

};

$(document).ready(function() {


    mobileShowAllPhone();
    dropdownShow();
    $(".hover").mouseleave(
        function () {
            $(this).removeClass("hover");
        }
    );
    if ( $(window).width() < 768 ) {
        ChangeBrandMobile();
        galleryMoreItems(4);
        ChangePhoneMobileDetail();

        if(document.querySelector('.header_info_block')) {
            ChangeRegions(true);
        }
    }
    else {
        ChangeBrandAllDevice();
        galleryMoreItems(15);
        ChangePhoneDeviceDetail();
        ChangeRegions(false);
    }

    if ( $(window).width() < 576 ) {
        // ChangeNewsMobile();
        ChangeCouponMobile();
        titleChangeMobile();
    }
    else {
        titleChangeDevice();
        // ChangeNewsAllDevice();
        ChangeCouponAllDevice();
    }

    if ( $(window).width() < 992 ) {
        ChangePriceMobile();
    }
    else {
        ChangePriceDevice();
    }

    //scroll
    MainScrollDetailCard();

	// slider
	// CaruselPhone();
	// CaruselBrand();
	CaruselProductVariant();
	CaruselProduct();
	CaruselCanvas();
	CaruselCanvasAllWidth();
	CaruselProductAdvice();
    // CaruselRecommendedProducts(); temp disabled slider
	// CaruselProductGift();
	CaruselPhotoBlogDetail();
	CaruselPhotoSection();
	// end slider
	// MobileBasket();

	TransitionDetail();

	orderOpenProperty();

	//celect
    MainSelect();

    /*if(document.querySelector('.header-two')) {
        MobileBasketTwo();
    }
    if(document.querySelector('.header_info_block')) {
        MobileBasket();
    }*/

    if ( $(window).width() < 1024 ) {
        ChangeRegionsTwo(true);
    }
    else {
        ChangeRegionsTwo(false);
    }

});


function previewProductMobileNot() {
	if($("div").is(".main_info_preview_product")) {
		$(".main_info_preview_product").closest(".wrap-popup-window").hide();
	}
}

/// top menu



/// top menu end

// if ($(window).width <= 768) {

// }

// ----- catalog galery ----- ///
function galleryMoreItemsResize () {
    if ( $(window).width() < 768 ) {
        galleryMoreItems(4);
    }
    else {
        galleryMoreItems(15);
    }
}

function galleryMoreItems(count_2){

	var size_li_2 = $(".catalog_content__category_block .catalog_content__category_item").length;
	$('.catalog_content__category_block .catalog_content__category_item').css("display","none");
	$('.catalog_content__category_block .catalog_content__category_item:lt('+count_2+')').show();
	$('#loadMore').click(function () {
		count_2 = (count_2+count_2 <= size_li_2) ? count_2+count_2 : size_li_2;
		$('.catalog_content__category_block .catalog_content__category_item:lt('+count_2+')').show();
		if(size_li_2===count_2){
			$("#loadMore").remove();
		};
	});
	if($("div").is('#loadMore2')){
		if(size_li_2<=15){
			$("#loadMore").remove();
		};
    };
	return;
};
/// ----- end catalog galery ----- ///

/// menu
function mobileShowAllPhone() {
	$('.container_menu_mobile__phone_block').click(function(){
		if ($(this).children(".many_tels_wrapper").hasClass("active")) {
            $(this).children(".many_tels_wrapper").slideUp(300, function () {
                $(this).removeClass("active");
            });
		} else {
            $(this).children(".many_tels_wrapper").slideDown(300, function () {
                $(this).addClass("active");
            });
		}
	});
}
/// end menu

// -------show Contact Link --------
function dropdownShow() {
    $('.dropdown_list').click(function(){
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).parent().removeClass("active");
            $(this).children(".many_wrapper").slideUp(300);
        } else {
            $(this).addClass("active");
            $(this).parent().addClass("active");
            $(this).children(".many_wrapper").slideDown(300);
        }
    });
}
// -------end ContactLink



// order Mobile open property
function orderOpenProperty() {
	$(".main_order_block__item .main_order_block__item_slide_open" ).click(function() {
		$(this).parent().find(".main_order_block__item_slide").toggleClass("active");
		$(this).toggleClass("active");
	});
}
// end order Mobile open property

// ----- owl-carousel phone----- //
function CaruselPhone() {
	$('.carousel-phone').owlCarousel({
		stopOnHover: true,
		loop:true,
		items:1,
		nav:true,
		navText : ["",""],
		autoplay:false,
		smartSpeed:500,
	});
}
// -----end owl-carousel phone----- //





// ----- owl-carousel slider-canvas-all-width ----- //
function CaruselCanvasAllWidth() {
	$('.slider-canvas-all-width').owlCarousel({
		stopOnHover: true,
		loop:true,
		items:1,
		nav:true,
		navText : ["",""],
		autoplay:true,
    autoplaySpeed:6000,
		smartSpeed:500
	});
}

// ----- owl-carousel product ----- //
function CaruselProductVariant() {
	$('.slider-product_variant').owlCarousel({
		stopOnHover: true,
		loop:true,
		nav:true,
		navText : ["",""],
		smartSpeed:500,
		autoplayTimeout:2000,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:4
			}
		}
	});
}

function CaruselPhotoBlogDetail()
{
	$('.blog-detail__gallery-items').owlCarousel({
		stopOnHover: true,
		loop:true,
		nav:true,
		navText : ["",""],
		smartSpeed:500,
		autoplayTimeout:2000,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:3
			}
		}
	});
}

function CaruselPhotoSection()
{
	$('.slider-product-section').owlCarousel({
		stopOnHover: true,
		loop:true,
		nav:true,
		navText : ["",""],
		smartSpeed:500,
		autoplayTimeout:2000,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:4
			}
		}
	});
}


function CaruselProductAdvice() {
	$('.detail-product-advice').owlCarousel({
		stopOnHover: true,
		loop:true,
		nav:true,
		navText : ["",""],
		smartSpeed:500,
		autoplayTimeout:2000,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:5
			}
		}
	});
}



// ----- end owl-carousel product ----- //

// ----- owl-carousel main canvas ----- //
function CaruselCanvas() {
	$('.slider-canvas').owlCarousel({
		stopOnHover: true,
		loop:true,
		items:1,
		nav:true,
		navText : ["",""],
		autoplay:true,
		autoplayTimeout:6000,
		    autoplaySpeed:500,
		smartSpeed:500
	});
}
// ----- owl-carousel end main canvas ----- //

function ChangeBrandMobile() {
	// $(".brand_block").addClass("brand_block_variant owl-carousel");
	// $(".brand_block_variant_two").addClass("brand_block_variant owl-carousel");
	// $(".brand_block_variant_two").removeClass("row");
}
function ChangeBrandAllDevice() {
	// $(".brand_block").removeClass("brand_block_variant owl-carousel");
	// $(".brand_block_variant_two").removeClass("brand_block_variant owl-carousel");
	// $(".brand_block_variant_two").addClass("row");
}

// function ChangeNewsMobile() {
// 	$(".news_block").addClass("carousel-phone owl-carousel");
// 	$(".news_block_three").addClass("carousel-phone owl-carousel");

// }
// function ChangeNewsAllDevice() {
// 	$(".news_block").removeClass("carousel-phone owl-carousel");
// 	$(".news_block_three").removeClass("carousel-phone owl-carousel");

// }

// ChangeCoupon
function ChangeCouponMobile() {
	$( ".main_order_coupon" ).prependTo( ".main_order" );
}
function ChangeCouponAllDevice() {
	$( ".main_order_coupon" ).appendTo( ".main_order" );
}
// end ChangeCoupon

// ChangePrice
function ChangePriceMobile() {
	$( ".main_order_all_price" ).prependTo( ".main_order" );
}
function ChangePriceDevice() {
	$( ".main_order_coupon" ).appendTo( ".main_order" );
}
// end ChangePrice




// ChangePhoneMobile
function ChangePhoneMobileDetail() {
	// $( ".product-detail-info-block-comment" ).prependTo( ".product-detail-photo-block" );
	// $( ".product-detail-info-block-title" ).prependTo( ".product-detail-photo-block" );
	// $(".product-detail-info-block-brand").prependTo( ".article-mobile-block" );
	// $(".product-detail-share-block").appendTo(".product-detail-info-block-one-click-basket");
	//$(".slider-ditail-card").addClass("slider-product_variant owl-carousel");
}

function ChangePhoneDeviceDetail() {
	// $( ".product-detail-info-block-comment" ).prependTo( ".detail-title-block" );
	// $( ".product-detail-info-block-title" ).prependTo( ".detail-title-block" );
	// $(".product-detail-info-block-brand").prependTo( "#right_detail_card" );
	// $(".product-detail-share-block").prependTo( ".product-detail-share" );
	//$(".slider-ditail-card").removeClass("slider-product_variant owl-carousel");
}



function TransitionDetail() {
	$("#all_property").on("click",".block-basic-property-link", function (event) {
		event.preventDefault();
		var id  = $(this).attr('href'),
            top = $(id).offset().top;

        let panelBX = document.querySelector('#bx-panel');
        if(panelBX) {
            let heightPanelBx = panelBX.offsetHeight;
            top -=  heightPanelBx + 90;
        } else {
            top -= 90;
        }

        $('#TAB_PROPERTIES').click();
        $('body,html').animate({scrollTop: top}, 1000);
    });

    $("#product_detail_info__delivery").on("click",".product_detail_info__delivery-link--btn", function (event) {
		event.preventDefault();
		var id  = $(this).attr('href'),
            top = $(id).offset().top;

        let panelBX = document.querySelector('#bx-panel');
        if(panelBX) {
            let heightPanelBx = panelBX.offsetHeight;
            top -=  heightPanelBx + 90;
        } else {
            top -= 90;
        }

        $('#TAB_DELIVERY').click();
        $('body,html').animate({scrollTop: top}, 1000);

    });

    $("#all_property").on("touchstart",".block-basic-property-link", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;

        let panelBX = document.querySelector('#bx-panel');
        if(panelBX) {
            let heightPanelBx = panelBX.offsetHeight;
            top -=  heightPanelBx + 90;
        } else {
            top -= 90;
        }

        $('#TAB_PROPERTIES').click();
        $('body,html').animate({scrollTop: top}, 1000);
    });

    $("#product_detail_info__delivery").on("touchstart",".product_detail_info__delivery-link--btn", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;

        let panelBX = document.querySelector('#bx-panel');
        if(panelBX) {
            let heightPanelBx = panelBX.offsetHeight;
            top -=  heightPanelBx + 90;
        } else {
            top -= 90;
        }

        $('#TAB_DELIVERY').click();
        $('body,html').animate({scrollTop: top}, 1000);

    });
}

function copyUrl()
{
	var dummy = document.createElement('input'),
		text = window.location.href;

	document.body.appendChild(dummy);
	dummy.value = text;
	dummy.select();
	document.execCommand('copy');
	document.body.removeChild(dummy);
}

function showShares()
{
	$('#sharing-buttons').toggleClass('active');
}

function showModal(html)
{
	let block =
        '<div class="wrap-popup-window">' +
		    '<div class="modal-popup-bg" onclick="closeModal();">&nbsp;</div>' +
            '<div class="popup-window">' +
                '<div class="popup-close" onclick="closeModal();"></div>'+
                '<div class="popup-content">' +
                    html +
                '</div>' +
            '</div>' +
        '</div>';

	$("body").append(block);
}

function closeModal()
{
	BX.onCustomEvent('OnBasketChange');
	$('.wrap-popup-window').last().remove();
}

function closeModal2()
{
	BX.onCustomEvent('OnBasketChange');
	$('.wrap-popup-window').hide();
}

function closeModal3()
{
	
	$('.wrap-popup-window').hide();
}
function titleChangeMobile() {
	$( "div.personal_title_block" ).appendTo( ".sidebar" );
}

function titleChangeDevice() {
	$( "div.personal_title_block" ).appendTo( ".personal_block_component" );
}

//personal_title_block

function sendForm(sid, color) {
	$('.error_custom').remove();
        
        if ($("form[name='" + sid + "'] input[name='personal']").is(':checked')) {
            $("form[name='" + sid + "'] input[type='submit']").trigger('click');
             
        } else {
        	
        	 $("<p class='error_custom'>"+$('#text_error_form').text()+ "</p>").appendTo($('form[name="' + sid + '"] .feedback_block__compliance'));
            $('.feedback_block__compliance svg path').css({'stroke': color, 'stroke-dashoffset': 0});
        }
    }

    function sendFormEmail(sid, color) {
        $('.error_custom').remove();
        if ($("form[name='" + sid + "'] input[name='personal']").is(':checked')) {
            $("form[name='" + sid + "'] input[type='submit']").trigger('click');
       
        } else {
        	
        	$("<p class='error_custom'>"+$('#text_error_form').text()+ "</p>").appendTo($('form[name="' + sid + '"] .feedback_block__compliance'));
            $('.feedback_block__compliance svg path').css({'stroke': color, 'stroke-dashoffset': 0});
           
        }
    }

function callbackPhone(siteDir, lid, item)
{

	$('.mail_phone').show();
	/*createBtnLoader(item);
	$.ajax({
		url: siteDir+'include/ajax/callbackphone.php',
		type: 'POST',
		data:{'lid':lid},
		success: function(html)
		{
			removeBtnLoader(item);
			showModal(html);
		}
	});*/
}

function callbackMail(siteDir, lid, item)
{
	/*createBtnLoader(item);
	$.ajax({
		url: siteDir+'include/ajax/callbackmail.php',
		type: 'POST',
		data:{'lid':lid},
		success: function(html)
		{
			removeBtnLoader(item);
			showModal(html);
		}
	});*/

	$('.mail_feedback').show();
}




function foundCheaper(siteDir, lid, name, item)
{

    createBtnLoader(item);
    $.ajax({
        url: siteDir + 'include/ajax/foundcheaper.php',
        type: 'POST',
        data: {
            'lid': lid,
            'name': name
		},
        success: function(html)
        {
            removeBtnLoader(item);
            showModal(html);
        }
    });
}

function wantGift(siteDir, lid, url, img, item)
{
	let length = document.querySelectorAll('.js-product-name').length;
	let name = document.querySelectorAll('.js-product-name')[length - 1].innerText;
	let price = $('.js-product-price').html();
	let oldPrice = $('.js-product-old-price').html();

    createBtnLoader(item);
    $.ajax({
        url: siteDir + 'include/ajax/wantgift.php',
        type: 'POST',
        data: {
            'lid': lid,
            'name': name,
            'url': url,
            'img': img,
            'price': price,
            'oldPrice': oldPrice
		},
        success: function(html)
        {
            removeBtnLoader(item);
            showModal(html);
        }
    });
}

function checkStock(siteDir, lid, name, item)
{
    createBtnLoader(item);
    $.ajax({
        url: siteDir + 'include/ajax/checkstock.php',
        type: 'POST',
        data: {
            'lid': lid,
            'name': name
		},
        success: function(html)
        {
            showModal(html);
            removeBtnLoader(item);
        }
    });
}

function MobileBasket() {
	let cntBasket = $('.basket-block.header_info_block__item .basket-block__link_main_basket .basket-block__link_basket_cal').html();
	let cntCompare = $('.basket-block.header_info_block__item .basket-block__link:eq(1) .basket-block__link_basket_cal').html();
	let cntFavorite = $('.basket-block.header_info_block__item .basket-block__link:eq(2) .basket-block__link_basket_cal').html();

	$('.container_menu_mobile__item_link:eq(1) .container_menu_mobile__item_link_col').html(cntCompare);
	$('.container_menu_mobile__item_link:eq(2) .container_menu_mobile__item_link_col').html(cntFavorite);
	$('.container_menu_mobile__item_link:eq(3) .container_menu_mobile__item_link_col').html(cntBasket);
	$('.header_mmenu__content_phone_and_basket .basket-block__link_basket_cal').html(cntBasket);
}

function MobileBasketTwo() {
    let cntBasket = $('.header-two__basket-buy span').html();
    let cntCompare = $('.header-two__basket-compare span').html();
    let cntFavorite = $('.header-two__basket-favorites span').html();


	$('.container_menu_mobile__item_link:eq(1) .container_menu_mobile__item_link_col').html(cntCompare);
	$('.container_menu_mobile__item_link:eq(2) .container_menu_mobile__item_link_col').html(cntFavorite);
	$('.container_menu_mobile__item_link:eq(3) .container_menu_mobile__item_link_col').html(cntBasket);
	$('.header_mmenu__content_phone_and_basket .basket-block__link_basket_cal').html(cntBasket);
}


function quickView(url)
{
	BX.showWait();
	let add = '?preview=Y';
	let location = window.location.href;
	if(location.indexOf('clear_cache=Y') !== false)
	{
		add+='&clear_cache=Y';
	}
	url += add;

    createLoaderQuickView($('body'));
	$.ajax({
		url: url,
		type: 'POST',
		data:{'sessid': BX.bitrix_sessid()},
		success: function(html)
		{
            removeQuickViewLoader();
            showModal(html);
            setTimeout(name, 1000);
		}
	});
	BX.closeWait();
}

function ChangeRegions(isMobile) {
	if(isMobile)
	{
		var Regions = $('.header_info_block .header_info_block__block_region').html();
		if(Regions.length > 0)
		{
			$('#mobileRegion').html(Regions);
		}
	}
	else
	{
		if($('#mobileRegion').length)
		{
			var Regions = $('#mobileRegion').html();
			if (Regions.length > 0)
			{
				$('.header_info_block .header_info_block__block_region').html(Regions);
			}
		}
	}
}

function ChangeRegionsTwo(isMobile) {
    if(isMobile)
    {
        var Regions = $('.header-two__city').html();

        if(Regions.length > 0)
        {
            $('#mobileRegion').html(Regions);
            $('.header-two__city').html('');
        }
    }
    else
    {
        var Regions = $('#mobileRegion').html();
        if(Regions.length > 0)
        {
            $('.header-two__city').html(Regions);
            $('#mobileRegion').html('');
        }
    }
}


var myFuncCalls = 0;
 function MainSelect() {
	 $(".custom-select-block").each(function ()
	 {
		 if (!$(this).parent('.custom-select-wrapper').find('div.custom-select-block').length)
		 {
			 var classes = $(this).attr("class"),
				 id = $(this).attr("id"),
				 name = $(this).attr("name");

			 var name = $(this).find('option:selected').html();
			 var nameItems = $(this).find('option:selected').attr("value");

			 $(this).attr('placeholder', name);
			 let placeholder = $(this).data('placeholder');
			 if (placeholder === undefined)
			 {
				 placeholder = $(this).attr("placeholder");
			 }
			 let option = $(this).find("option:selected");
			 if (option !== undefined)
			 {
				 placeholder = option.html();
			 }
			 var template = '<div class="' + classes + '">';
             template += '<span class="custom-select-trigger">' +
             '<div class="mobile_sorting_svg_icons">' +
             '</div>' +
             '<div class="custom-select-trigger_sorting_text">' + placeholder + '</div></span>';
			 template += '<div class="custom-options">';
			 $(this).find("option").each(function ()
			 {
				 if (nameItems == $(this).attr("value"))
				 {
					 var selectItems = "selected";
				 }

				 template += '<span class="custom-option ' + selectItems + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
			 });
			 template += '</div></div>';

			 $(this).wrap('<div class="custom-select-wrapper"></div>');
			 $(this).hide();
			 $(this).after(template);
		 }
	 });
	 $(".custom-option:first-of-type").hover(function ()
	 {
		 $(this).parents(".custom-options").addClass("option-hover");
	 }, function ()
	 {
		 $(this).parents(".custom-options").removeClass("option-hover");
	 });
	 $(".custom-select-trigger").on("click", function (event)
	 {
		 $('html').one('click', function ()
		 {
			 $(".custom-select-block").removeClass("opened");
		 });
		 $(this).parents(".custom-select-block").toggleClass("opened");
		 event.stopPropagation();
	 });
	 $(".custom-option").on("click", function ()
	 {
	 	var obj = $(this).parents(".custom-options").find(".custom-option");
	 	var curVal = $(this).html();
	 	var order = $(this).closest('.select_block').find('.sort-orders').find('.sort-order');
	 	var numSel = 0;
		 $(this).parents(".custom-options").find(".custom-option").removeClass("selection");

		 $(obj).each(function (index, value) {
			 if($(value).html() == curVal){
			 	numSel = index;
			 	return true;
			 }
		 });
		 $(order).attr('selected', false);
		 $(order[numSel]).attr('selected', true);
		 $(this).addClass("selection");
		 $(this).parents(".custom-select-block").removeClass("opened");

         let windowWidth = window.innerWidth || document.documentElement.clientWidth;

         if (windowWidth > 575) {
		     $(this).parents(".custom-select-block").find(".custom-select-trigger").text($(this).text());
         }

         $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
		 $(this).parents(".custom-select-wrapper").find("select").trigger("change");
	 });
 }

function MainScrollDetailCard() {
    $('.origami_main_scroll').each(function(){new PerfectScrollbar(this);})
}

function CaruselProduct() {
	$('.slider-product').owlCarousel({
		stopOnHover: true,
		loop:true,
		items:4,
		nav:true,
		navText : ["",""],
		smartSpeed:500,
		autoplayTimeout:2000,

		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:3
            },
            1240:{
				items:4
			}
		}
	});
}




///////!!!!! MANY KOSTYLEY BE CAREFULL!!!!!/////// -----DO_NOT_TOUCH-----



var initrecommended = false;
function CaruselRecommendedProducts() {
	$('.recommended-products__slider').owlCarousel({

		// stopOnHover: true,
		loop:true,
		items:5,
		nav:true,
		navText : ["",""],
		autoplay:false,
		smartSpeed:500,
		stagePadding: 10,

		responsive:{
			0:{
				items:1
			},
			460:{
				items:2
			},
			810:{
				items:3
			},
			1080:{
				items:4
			},
			1350:{
				items:5
			}
		},
		onInitialized: opacityAdd,
		onResized: opacityAdd,
		onTranslate: opacityReset,
		onTranslated: opacityAdd,
		onDrag: opacityReset
    });


	function opacityAdd () {
		$('.recommended-poducts').find('.owl-item').css('opacity', '1');
		var activeSlides = $('.recommended-poducts').find('.owl-item.active');
		activeSlides.eq(0).prev().css('opacity', '0');
		activeSlides.eq(activeSlides.length - 1).next().css('opacity', '0');

		if(!initrecommended){
			$('.recommended-poducts .owl-item').each(function(i){
				if($(this).find('.params-item-recommend').length)
				{
					let str = $(this).find('.params-item-recommend').html().trim();
					let json = JSON.parse(str);
					if ($(this).hasClass('cloned'))
					{
						for (let k in json.VISUAL)
						{
							if(k == 'SUBSCRIBE_ID'){
								let param = $(this).find('#' + json.VISUAL[k] + '_hidden');
								param.attr('id', json.VISUAL[k] + 1 + '_hidden');
							}
							let param = $(this).find('#' + json.VISUAL[k]);
							param.attr('id', param.attr('id') + 1);
							json.VISUAL[k] = json.VISUAL[k] + '1';
						}
					}
					var el = [];
					el[i] = new JCCatalogItemRecommend(json);
					let compared = $(this).find('.comparedinfo').data('compared');
					if(compared == ''){
						compared = false;
					}
					else{
						compared = true;
					}
					el[i].setCompared(compared);

					let comparedIds = $(this).find('.comparedIdsinfo').data('compared');
					if(comparedIds !== undefined){
						el[i].setCompareInfo(comparedIds);
					}

					let wishes = $(this).find('.wishesinfo').data('wish');
					el[i].setWishInfo(wishes);

					if(el[i].wishes !== undefined && el[i].wishes.length > 0)
					{
						var check = false;
						if(el[i].offers !== undefined && el[i].offers.length > 0)
						{
							let k, index;
							for (k = 0; k < el[i].offers.length; k++)
							{
								boolOneSearch = true;
								for (j in el[i].selectedValues)
								{
									if (el[i].selectedValues[j] !== el[i].offers[k].TREE[j])
									{
										boolOneSearch = false;
										break;
									}
								}
								if (boolOneSearch)
								{
									index = k;
									break;
								}
							}
							for (var key in el[i].wishes)
							{
								if (el[i].wishes[key] == el[i].offers[index]['ID'])
								{
									check = true;
								}
							}
						}
					else{
						for (var key in el[i].wishes)
						{
							if (el[i].wishes[key] == el[i].id)
							{
								check = true;
							}
						}
					}
						el[i].setWished(check);
					}
				}
			});
			initrecommended = true;
		}
	}
	function opacityReset () {
        $('.recommended-poducts').find('.owl-item').css('opacity', '1');
    }

    //////////////////////////
}




//-------------resize slick slider ----------------
window.triggerSlider = function (item, size, settings, callback) {
    if ($(window).width() <= size) {
        $(item).slick(settings);
        isSlider = true;
    }

    function resizeSlider () {
        if (timerId) {
            clearTimeout(timerId);
            var timerId = setTimeout(function () {
                if ($(window).width() <= size) {
                    if (!$(item).hasClass('slick-slider')) {
                        $(item).slick(settings);
                    }
                } else {
                    if ($(item).hasClass('slick-slider')) {
                        $(item).slick('unslick');
                        if(callback) {
                            callback();
                        }
                    }
                }
            }, 700);
        }
        var timerId = setTimeout(function () {
            if ($(window).width() <= size) {
                if (!$(item).hasClass('slick-slider')) {
                    $(item).slick(settings);
                }
            } else {
                if ($(item).hasClass('slick-slider')) {
                    $(item).slick('unslick');
                    if(callback) {
                        callback();
                    }
                }
            }
        }, 700);



        // callback();
        // console.log(callback);
    }

    $(window).on('resize', resizeSlider);
};

function inicialSlider (item, settings) {
    $(item).slick(settings);
}


// --setting---
var settingSlider = {
    mainSettings: {
        slidesToShow: 1,
        variableWidth: true,
        mobileFirst: true,
        arrows: false
    },

    brandSetting: {
        variableWidth: true,
        mobileFirst: true,
        arrows: false,
        prevArrow: '<button type="button" class="btn-slick-custom btn-slick-custom--prev">Prev</button>',
        nextArrow: '<button type="button" class="btn-slick-custom btn-slick-custom--next">Prev</button>',
        responsive: [
            {
                breakpoint: 565,
                settings: {
                  variableWidth: false,
                  arrows: true,
                  slidesToShow: 3
                }
            },
            {
              breakpoint: 768,
              settings: {
                variableWidth: false,
                arrows: true,
                slidesToShow: 5
              }
            }
        ]
    },

    itemSetting: {
        variableWidth: true,
        // mobileFirst: true,
        arrows: true,
        infinite: false,
        touchThreshold: 10,
        slidesToShow: 5,
        touchThreshold: 50,
        variableWidth: true,
        prevArrow: '<button type="button" class="btn-slick-custom btn-slick-custom--prev">Prev</button>',
        nextArrow: '<button type="button" class="btn-slick-custom btn-slick-custom--next">Prev</button>',
        responsive: [
            {
                breakpoint: 565,
                settings: {
                  variableWidth: true,
                  arrows: true,
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
            },
            {
                breakpoint: 830,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
            },
            {
              breakpoint: 1023,
              settings: {
                variableWidth: true,
                arrows: true,
                slidesToShow: 4,
                touchThreshold: 50,
              }
            }
        ]
    }
}


// --inicial----

$(document).ready(function(){
    window.triggerSlider('.tabs_block__product_card', 768, settingSlider.mainSettings);
    window.triggerSlider('.news_block', 768, settingSlider.mainSettings);

    window.triggerSlider('.promotion_block_three', 768, settingSlider.mainSettings);
    window.triggerSlider('.promotion_block_two', 768, settingSlider.mainSettings);
    window.triggerSlider('.promotion_block', 768, settingSlider.mainSettings);
    window.triggerSlider('.news_block_three', 768, settingSlider.mainSettings);
    window.triggerSlider('.news_block_one_wrapper', 768, settingSlider.mainSettings);
    window.triggerSlider('.news_block_two__wrapper', 768, settingSlider.mainSettings);
    window.triggerSlider('.social_block_YT__wrapper', 768, settingSlider.mainSettings);
    window.triggerSlider('.social_block_inst__wrapper', 768, settingSlider.mainSettings);
    window.triggerSlider('.blog_block-simple__wrapper', 768, settingSlider.mainSettings);
    window.triggerSlider('.blog_block-square__wrapper', 768, settingSlider.mainSettings);


    window.triggerSlider('.brand_block', 768, settingSlider.mainSettings);
    // window.triggerSlider('.brand_block_variant_two__wrapper', 768, settingSlider.mainSettings);

    // inicialSlider('.recommended-products__slider', settingSlider.itemSetting);
    // inicialSlider('.brand_block_variant', settingSlider.brandSetting);
    // triggerSlider('.product_card__block_item_inner', 768, settingSlider.mainSettings);
  });

// --------------end slick slider--------------



// ------header-two-------------

function scrollSearch () {
    var search = document.querySelector('.header-two__search-matches-list');
    if (search) {
        new PerfectScrollbar(search,{
        wheelSpeed: 0.5,
        wheelPropagation: true,
        minScrollbarLength: 20
        });
    }
}


// function scrollSity(params) {
//     if (document.querySelector(".select-city__modal-wrap")) {
//         if (document.querySelector(".select-city__list_wrapper_favorites")) {
//             let favoritesSity = document.querySelectorAll(".select-city__list_wrapper_favorites");
//             let arr = [];
//             for(let i = 0; i < favoritesSity.length; i++) {
//                 favoritesSity[i].style.position = 'relative';
//                 favoritesSity[i].style.marginRight = '8px';

//                    let currentScroll = new PerfectScrollbar(favoritesSity[i],{
//                     wheelSpeed: 0.5,
//                     wheelPropagation: true,
//                     minScrollbarLength: 20
//                 });
//                 arr.push(currentScroll);
//             }

//             if (document.querySelector('.select-city__tabs')) {
//                 document.querySelector('.select-city__tabs').addEventListener('click', function () {
//                     for (let i = 0; i < arr.length; i++) {
//                         arr[i].update();
//                     }
//                 });
//             }
//         }

//         if (document.querySelector(".select-city__list_wrapper_cities")) {
//             let listSity = document.querySelectorAll(".select-city__list_wrapper_cities");
//             let arr = [];
//             for(let i = 0; i < listSity.length; i++) {
//                 listSity[i].style.position = 'relative';
//                 let currentScroll = new PerfectScrollbar(listSity[i],{
//                     wheelSpeed: 0.5,
//                     wheelPropagation: true,
//                     minScrollbarLength: 20
//                 });
//                 arr.push(currentScroll);
//             }

//             if (document.querySelector('.select-city__tabs')) {
//                 document.querySelector('.select-city__tabs').addEventListener('click', function () {
//                     for (let i = 0; i < arr.length; i++) {
//                         arr[i].update();
//                     }
//                 });
//             }
//         }
//     }
// }

// $(document).ready(function () {


    // ---scroll-----
    // var cont = document.querySelector('.header-two__menu-catalog');
    // if(cont) {
    //     new PerfectScrollbar(cont,{
    //         wheelSpeed: 0.5,
    //         wheelPropagation: true,
    //         minScrollbarLength: 20
    //     });
    // }


    // let navSubmenu = document.querySelectorAll('.header-two__nav-submenu');
    // if(navSubmenu) {
    //     for (let i = 0; navSubmenu.length > i; i++) {
    //         new PerfectScrollbar(navSubmenu[i],{
    //             wheelSpeed: 0.5,
    //             wheelPropagation: true,
    //             minScrollbarLength: 20,
    //             typeContainer: 'li'
    //         });
    //     }
    // }


    // ---end scroll-----

    // ---hide nav items------
    // var sizeChange = [];
    // function arrow (quantity) {
    //     var navigation = document.querySelectorAll('.header-two__main-navigation .header-two__main-nav-item');

    //     for(var n = 0; navigation.length > n; n++) {
    //         if( navigation[n].querySelector('.header-two__nav-submenu')) {
    //             navigation[n].querySelector('.header-two__nav-submenu').classList.remove('header-two__nav-submenu--right');
    //             navigation[n].querySelector('.header-two__nav-submenu').classList.add('header-two__nav-submenu--left');
    //         }
    //     }

    //     for (var i = quantity; i > 0; i--) {
    //         var item = navigation[navigation.length - i];

    //         if (item.querySelector('.header-two__nav-submenu')) {
    //             item.querySelector('.header-two__nav-submenu').classList.remove('header-two__nav-submenu--left');
    //             item.querySelector('.header-two__nav-submenu').classList.add('header-two__nav-submenu--right');
    //         }
    //     }
    // }
    // arrow(3);

    // function delItem () {
    //     var widthScreen = document.documentElement.clientWidth;
    //     var nav = document.querySelectorAll('.header-two__main-navigation > div');
    //     var widthNav = document.querySelector('.header-two__main-nav-catalog').clientWidth;
    //     for (var i = 0; nav.length > i; i++) {
    //         widthNav += nav[i].offsetWidth;
    //     }

    //     if (widthScreen < widthNav) {

    //         if (!document.querySelector('.header-two__main-nav-item-more')) {
    //             var itemMore = document.createElement('div');
    //             itemMore.classList.add('header-two__main-nav-item-more');
    //             var submenuItemMore = document.createElement('div');
    //             submenuItemMore.classList.add('header-two__nav-submenu');
    //             submenuItemMore.classList.add('header-two__nav-submenu--right');
    //             itemMore.innerHTML =
    //                 '<svg class="site-navigation__item-icon-more" width="24" height="18">' +
    //                     '<use xlink:href="/local/templates/sotbit_origami/assets/img/sprite.svg#icon_more"></use>' +
    //                 '</svg>';
    //             itemMore.appendChild(submenuItemMore);
    //             document.querySelector('.header-two__main-navigation').appendChild(itemMore);
    //         }

    //         var itemsNav = document.querySelectorAll('.header-two__main-navigation > .header-two__main-nav-item');
    //         var lastItem = itemsNav[itemsNav.length - 1].parentNode.removeChild(itemsNav[itemsNav.length - 1]);
    //         sizeChange.push(widthNav);

    //         document.querySelector('.header-two__main-nav-item-more .header-two__nav-submenu').insertBefore(lastItem, document.querySelector('.header-two__main-nav-item-more .header-two__nav-submenu .header-two__main-nav-item'));
    //         delItem ();

    //     }
    // }
    // delItem ();


    // function addItem() {
    //     sizeChange.pop();
    //     var item = document.querySelector('.header-two__main-nav-item-more .header-two__main-nav-item').parentNode.removeChild(document.querySelector('.header-two__main-nav-item-more .header-two__main-nav-item'));
    //     document.querySelector('.header-two__main-navigation').insertBefore(item, document.querySelector('.header-two__main-nav-item-more'));
    // }


    // window.addEventListener('resize', function(evt) {

    //     var widthScreen = document.documentElement.clientWidth;
    //     var nav = document.querySelectorAll('.header-two__main-navigation > div');
    //     var widthNav = document.querySelector('.header-two__main-nav-catalog').clientWidth;
    //     for (var i = 0; nav.length > i; i++) {
    //         widthNav += nav[i].offsetWidth;
    //     }

    //     if (widthScreen < widthNav) {
    //         delItem();
    //     }

    //     var size = sizeChange[sizeChange.length - 1];
    //     if ((widthScreen > size) && size) {
    //         addItem();
    //     }

    //     if (document.querySelector('.header-two__main-nav-item-more')) {
    //         if(!document.querySelector('.header-two__main-nav-item-more .header-two__nav-submenu').childNodes[0]) {
    //             document.querySelector('.header-two__main-nav-item-more').parentNode.removeChild(document.querySelector('.header-two__main-nav-item-more'));
    //         }
    //     }

    //     arrow(3);
    // });

    // ---end hide nav items------
// });




// ------end header-two-------------



function reloadCaptcha(e,siteDir){
	let img = $(e).closest('.feedback_block__captcha').find('img');
	let sid = $(e).closest('.feedback_block__captcha').find('[name="captcha_sid"]');
	if(img !== undefined){
		$.getJSON(siteDir+'include/ajax/reload_captcha.php', function(data) {
			img.attr('src','/bitrix/tools/captcha.php?captcha_sid='+data);
			sid.val(data);
		});
	}
}

function clearBasket(siteId, siteDir){
	BX.showWait();
	$.ajax({
		url: siteDir+'include/ajax/basket_clear.php',
		type: 'POST',
		data:{'sessid': BX.bitrix_sessid(),'siteId':siteId},
		success: function()
		{
			location.reload();
		}
	});
	BX.closeWait();
}
// --------main-loaders------------
function createMainLoader (item) {
    // item.css("position","relative");
    item.append(
        '<div class="loader">' +
            '<div class="inner">' +
                '<div class="cssload-loader">' +
                    '<div class="cssload-inner cssload-one"></div>' +
                    '<div class="cssload-inner cssload-two"></div>' +
                    '<div class="cssload-inner cssload-three"></div>' +
                '</div>' +
            '</div>' +
        '</div>'
    );
}

function removeMainLoader () {
    $("div").remove(".loader");
}

function createLoaderQuickView (item) {
    // item.css("position","relative");
    item.append(
    '<div class="loaderQuickView">' +
    '<div class="inner">' +
    '<div class="cssload-loader">' +
    '<div class="cssload-inner cssload-one"></div>' +
    '<div class="cssload-inner cssload-two"></div>' +
    '<div class="cssload-inner cssload-three"></div>' +
    '</div>' +
    '</div>' +
    '</div>'
    );
}

function removeQuickViewLoader () {
    $("div").remove(".loaderQuickView");
}



function createMainLoaderInner (item) {
    item.css("position","relative");
    item.append(
        '<div class="loader loader--inner">' +
            '<div class="inner">' +
                '<div class="cssload-loader">' +
                    '<div class="cssload-inner cssload-one"></div>' +
                    '<div class="cssload-inner cssload-two"></div>' +
                    '<div class="cssload-inner cssload-three"></div>' +
                '</div>' +
            '</div>' +
        '</div>'
    );
}

function removeMainLoaderInner (item) {
    item.css("position","");
    $("div").remove(".loader");
}


// --------end-main-loaders--------
function createCartLoader (item) {
    // item.css("position","relative");
    item.append(
        '<div class="loader">' +
            '<div class="inner">' +
				'<svg width="30" height="30" viewBox="0 0 93 93" fill="none" xmlns="http://www.w3.org/2000/svg">' +
				'<path class="circle" fill-rule="evenodd" clip-rule="evenodd" d="M46.5 91.5C71.3528 91.5 91.5 71.3528 91.5 46.5C91.5 21.6472 71.3528 1.5 46.5 1.5C21.6472 1.5 1.5 21.6472 1.5 46.5C1.5 71.3528 21.6472 91.5 46.5 91.5ZM46.5 93C72.1812 93 93 72.1812 93 46.5C93 20.8188 72.1812 0 46.5 0C20.8188 0 0 20.8188 0 46.5C0 72.1812 20.8188 93 46.5 93Z"/>' +
				'<path fill-rule="evenodd" clip-rule="evenodd" d="M42.6286 29.2913C43.02 29.6809 43.0214 30.3141 42.6318 30.7055L35.868 37.5H58.132L51.3682 30.7055C50.9786 30.3141 50.98 29.6809 51.3714 29.2913C51.7628 28.9017 52.396 28.9031 52.7856 29.2945L60.954 37.5H69C69.5523 37.5 70 37.9477 70 38.5V45.3C70 45.8523 69.5523 46.3 69 46.3H66.4506L63.2148 64.1781C63.1287 64.654 62.7144 65 62.2308 65H31.7692C31.2856 65 30.8713 64.654 30.7852 64.1781L27.5494 46.3H25C24.4477 46.3 24 45.8523 24 45.3V38.5C24 37.9477 24.4477 37.5 25 37.5H33.046L41.2144 29.2945C41.604 28.9031 42.2372 28.9017 42.6286 29.2913ZM29.5819 46.3L32.6045 63H61.3955L64.4181 46.3H29.5819ZM26 39.5V44.3H68V39.5H26ZM38.5385 49.4C39.0907 49.4 39.5385 49.8477 39.5385 50.4V58.9C39.5385 59.4523 39.0907 59.9 38.5385 59.9C37.9862 59.9 37.5385 59.4523 37.5385 58.9V50.4C37.5385 49.8477 37.9862 49.4 38.5385 49.4ZM47 49.4C47.5523 49.4 48 49.8477 48 50.4V58.9C48 59.4523 47.5523 59.9 47 59.9C46.4477 59.9 46 59.4523 46 58.9V50.4C46 49.8477 46.4477 49.4 47 49.4ZM55.4615 49.4C56.0138 49.4 56.4615 49.8477 56.4615 50.4V58.9C56.4615 59.4523 56.0138 59.9 55.4615 59.9C54.9093 59.9 54.4615 59.4523 54.4615 58.9V50.4C54.4615 49.8477 54.9093 49.4 55.4615 49.4Z"/>' +
				'</svg>' +
            '</div>' +
        '</div>'
    );
}

function removeCartLoader () {
    $("div").remove(".loader");
}
// ----cart loader-----

// ----end cart loader-----





function createBtnLoader (item) {
	if(item != undefined){


    // item.innerHTML = '';
    item.parentNode.style.position = "relative";
    item.classList.add('btnLoaderCustom');
    item.style.color = "transparent";
    // item.style.height = "0px";
    var svg = document.createElement("div");
    svg.classList.add('loader-btn');
    svg.innerHTML =
        '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"' +
        'width="18px" height="20px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">'+
        '<rect x="0" y="13" width="4" height="5">'+
        '<animate attributeName="height" attributeType="XML"'+
            'values="5;21;5"'+
            'begin="0s" dur="0.6s" repeatCount="indefinite" />'+
        '<animate attributeName="y" attributeType="XML"'+
            'values="13; 5; 13"'+
            'begin="0s" dur="0.6s" repeatCount="indefinite" />'+
        '</rect>'+
        '<rect x="10" y="13" width="4" height="5">'+
        '<animate attributeName="height" attributeType="XML"'+
            'values="5;21;5"'+
            'begin="0.15s" dur="0.6s" repeatCount="indefinite" />'+
        '<animate attributeName="y" attributeType="XML"'+
            'values="13; 5; 13"'+
            'begin="0.15s" dur="0.6s" repeatCount="indefinite" />'+
        '</rect>'+
        '<rect x="20" y="13" width="4" height="5">'+
        '<animate attributeName="height" attributeType="XML"'+
            'values="5;21;5"'+
            'begin="0.3s" dur="0.6s" repeatCount="indefinite" />'+
        '<animate attributeName="y" attributeType="XML"'+
            'values="13; 5; 13"'+
            'begin="0.3s" dur="0.6s" repeatCount="indefinite" />'+
        '</rect>'+
    '</svg>'

    item.appendChild(svg);
    }
}

function removeBtnLoader (item) {
    // item.style.position = "";
    item.classList.remove('btnLoaderCustom');
    item.parentNode.style.position = "";
    item.style.color = "";
    // item.style.height = "";
    item.removeChild(item.querySelector('.loader-btn'));
    // item.removeChild();
}

// ---------------custom bitrix loader--------------------

var lastWait = [];
	/* non-xhr loadings */
	BX.showWait = function (node, msg)
	{
		node = BX(node) || document.body || document.documentElement;
		msg = msg || BX.message('JS_CORE_LOADING');

		var container_id = node.id || Math.random();

		var obMsg = node.bxmsg = document.body.appendChild(BX.create('DIV', {
			props: {
				id: 'wait_' + container_id,
				className: 'bx-core-waitwindow'
			},
			text: msg
		}));

		setTimeout(BX.delegate(_adjustWait, node), 10);

		createMainLoader($('body'));

		lastWait[lastWait.length] = obMsg;
		return obMsg;
	};

	BX.closeWait = function (node, obMsg)
	{
		removeMainLoader($('body'));
		if (node && !obMsg)
			obMsg = node.bxmsg;
		if (node && !obMsg && BX.hasClass(node, 'bx-core-waitwindow'))
			obMsg = node;
		if (node && !obMsg)
			obMsg = BX('wait_' + node.id);
		if (!obMsg)
			obMsg = lastWait.pop();

		if (obMsg && obMsg.parentNode)
		{
			for (var i = 0, len = lastWait.length; i < len; i++)
			{
				if (obMsg == lastWait[i])
				{
					lastWait = BX.util.deleteFromArray(lastWait, i);
					break;
				}
			}

			obMsg.parentNode.removeChild(obMsg);
			if (node)
				node.bxmsg = null;
			BX.cleanNode(obMsg, true);
		}
	};

	function _adjustWait()
	{
		if (!this.bxmsg)
			return;

		var arContainerPos = BX.pos(this),
			div_top = arContainerPos.top;

		if (div_top < BX.GetDocElement().scrollTop)
			div_top = BX.GetDocElement().scrollTop + 5;

		this.bxmsg.style.top = (div_top + 5) + 'px';

		if (this == BX.GetDocElement())
		{
			this.bxmsg.style.right = '5px';
		}
		else
		{
			this.bxmsg.style.left = (arContainerPos.right - this.bxmsg.offsetWidth - 5) + 'px';
		}
	}

    // ---------------end custom bitrix loader--------------------


    function createLoadersMore (item) {
        item.css("position","relative");
        item.addClass('btnLoaderMore');
        item.append(
            '<div class="loader loader--inner">'+
                '<div class="inner">'+
                    '<div class="sk-wave" style="display: block">'+
                        '<div class="sk-rect sk-rect-1"></div>'+
                        '<div class="sk-rect sk-rect-2"></div>'+
                        '<div class="sk-rect sk-rect-3"></div>'+
                        '<div class="sk-rect sk-rect-4"></div>'+
                        '<div class="sk-rect sk-rect-5"></div>'+
                    '</div>'+
                '</div>'+
            '</div>'
        );
    }

    function removeLoadersMore (item) {
        item.css("position","");
        item.removeClass("btnLoaderMore");
        $("div").remove(".loader");
    }


    // ----------------------------------------------------------------------------------------------------------------------------------

// -------------btn go top --------------------
    function btnTop(viewHeight){
        let btn = document.getElementById('btn_go-top');
        const HEIGHT_SCROLL = viewHeight || 400;
        let scroll;

        window.onscroll = function() {
            if (window.pageYOffset > HEIGHT_SCROLL) {
                btn.classList.add('visible');
            } else {
                btn.classList.remove('visible');
            }
        }

        window.addEventListener('wheel', handlerCleanTimer);

        window.addEventListener('touchmove', handlerCleanTimer);

        function handlerCleanTimer() {
            btn.dataset.scroll = '';
            $('body,html').stop(true);
        }

        function handlerClickScroll () {
            if (btn.dataset.scroll  === 'true') {
                return;
            }
            scroll = window.pageYOffset;
            $('body,html').animate({scrollTop: 0}, 1000);
            btn.dataset.scroll = 'true';
        }

        btn.addEventListener('click', handlerClickScroll);

        btn.addEventListener('touchend', handlerClickScroll);
    };
    // -------------end btn go top --------------------


// ----------------lazyLoad------------------------
/**
    @attr class="lazy"                                      ==> tag img for lazyLoad
    @attr src="/upload/sotbit.origami/no_photo_medium.svg"  ==> img default(const)
    @attr data-src="image-to-lazy-load-1x.jpg"              ==> img load
    @attr data-srcset="image-to-lazy-load-2x.jpg 2x         ==> alternative image

    example ==>
    <img class="lazy" src="placeholder-image.jpg" data-src="image-to-lazy-load-1x.jpg" data-srcset="image-to-lazy-load-2x.jpg 2x, image-to-lazy-load-1x.jpg 1x" alt="I'm an image!"></img>
*/
window.lazyLoadOn = function () {
    document.addEventListener("DOMContentLoaded", function() {

        let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
        let active = false;

        const lazyLoad = function() {
            if (active === false) {
            active = true;

            setTimeout(function() {
                lazyImages.forEach(function(lazyImage) {
                if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
                    lazyImage.src = lazyImage.dataset.src;
                    if (lazyImage.dataset.srcset) {
                        lazyImage.srcset = lazyImage.dataset.srcset;
                    }
                    lazyImage.classList.remove("lazy");
                    if(lazyImage.nextElementSibling && lazyImage.nextElementSibling.classList.contains('loader-lazy')) {
                        lazyImage.nextElementSibling.parentElement.removeChild(lazyImage.nextElementSibling);
                        }
                    lazyImages = lazyImages.filter(function(image) {
                    return image !== lazyImage;
                    });

                    if (lazyImages.length === 0) {
                    document.removeEventListener("scroll", lazyLoad);
                    window.removeEventListener("resize", lazyLoad);
                    window.removeEventListener("orientationchange", lazyLoad);
                    }
                }
                });

                active = false;
            }, 200);
            }
        };

        document.addEventListener("scroll", lazyLoad);
        window.addEventListener("resize", lazyLoad);
        window.addEventListener("orientationchange", lazyLoad);
        lazyLoad();


        let body = document.querySelector('body');
        let observer = new MutationObserver (function () {
            lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
            document.addEventListener("scroll", lazyLoad);
            window.addEventListener("resize", lazyLoad);
            window.addEventListener("orientationchange", lazyLoad);
            lazyLoad();
        });

        observer.observe(body, {
            childList: true,
            subtree: true
        });
    });
};

// ----------------end lazyLoad---------------------=---


// ------createSquareItem------------
/**
    @attr container    ==> selector container (string)
*/

function SquareItems(container) {
    this.container = document.querySelector(container);
    this.items = Array.prototype.slice.call(this.container.children);
    this.setHeight = function (item) {
        let elemWidth = Math.round(item.offsetWidth);
        item.style.height = elemWidth + 'px';
    }
    const _this = this;
    _this.items.forEach(function (elem) {
        _this.setHeight(elem);
    });
    let observer = new MutationObserver(function () {
        _this.items.forEach(function (elem) {
            _this.setHeight(elem);
        });
    });
    observer.observe(_this.container, {
        childList: true
    });

    window.addEventListener('resize', function () {
        _this.items.forEach(function (elem) {
            _this.setHeight(elem);
        });
    });
}
// ------end CreateSquareItem---------

// ------createHeightImg------------
/**
    @attr container    ==> selector:string 'selector container'
    @example: new HeightImg('selector', 'selector2',....);
*/

function HeightImg(containers) {
    try {
        this.block = [];
        this.timerResize = null;
        this.body = document.querySelector('body');
        const _this = this;
        const _arguments = arguments;
        function calcHeight (item) {
            let img = item.querySelector('img');
            img.style.height = '';
            let height = item.offsetHeight;
            img.style.height = height + 'px';
        }

        for(let i = 0; arguments.length > i; i ++) {
            let containers = Array.prototype.slice.call(document.querySelectorAll(arguments[i]));
            this.block = this.block.concat(containers);
        }

        this.block.forEach(calcHeight);

        window.addEventListener('resize', function () {
            if(_this.timerResize) {
                clearTimeout(_this.timerResize);
                _this.timerResize = setTimeout(function() {
                    _this.block.forEach(calcHeight);

                },100)
            } else {
                _this.timerResize = setTimeout(function() {
                    _this.block.forEach(calcHeight);
                },100)
            }
        });

        let observer = new MutationObserver(function () {
            for(let i = 0; arguments.length > i; i ++) {
                let containers = Array.prototype.slice.call(document.querySelectorAll(_arguments[i]));
                _this.block = _this.block.concat(containers);
            }
            _this.block.forEach(calcHeight);
        });
        observer.observe(this.body, {
            childList: true,
            subtree: true
        });
    } catch(e) {
        console.log(e);
    }
}
// ------end createHeightImg---------


// ------ regions switch to mobile ---------//

window.addEventListener("resize", function () {
    let windowWidth = window.innerWidth || document.documentElement.clientWidth;

    if (windowWidth < 768) {
        if(document.querySelector('.header_info_block')) {
            ChangeRegions(true);
        }
    } else {
        ChangeRegions(false);
    }

    if (windowWidth < 1024 ) {
        ChangeRegionsTwo(true);
    } else {
        ChangeRegionsTwo(false);
    }
});

// ------ // regions switch to mobile ---------//


//-------------CONTACTS PAGE ----------------/

function callbackManager(siteDir, lid, item) {
    createBtnLoader(item);

    $.ajax({
        url: siteDir + 'include/ajax/contacts_callback_manager.php',
        type: 'POST',
        data: {'lid': lid},
        success: function (html) {
            removeBtnLoader(item);
            showModal(html);
        }
    });
}

//-------------/CONTACTS PAGE ----------------/
