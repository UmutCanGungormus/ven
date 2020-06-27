/*  ---------------------------------------------------
    Template Name: Fashi
    Description: Fashi eCommerce HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com/
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';


(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Hero Slider
    --------------------*/
    $(".hero-items").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        Product Slider
    --------------------*/
    $(".product-slider").owlCarousel({
        loop: true,
        margin: 25,
        nav: true,
        items: 4,
        dots: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    /*------------------
       logo Carousel
    --------------------*/
    $(".logo-carousel").owlCarousel({
        loop: false,
        margin: 30,
        nav: false,
        items: 5,
        dots: false,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        mouseDrag: false,
        autoplay: true,
        responsive: {
            0: {
                items: 3,
            },
            768: {
                items: 5,
            }
        }
    });

    /*-----------------------
       Product Single Slider
    -------------------------*/
    $(".ps-slider").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        items: 3,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if (mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end




    // Use this for real timer date
    /* var timerdate = "2020/01/01"; */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"));
    });


    /*----------------------------------------------------
     Language Flag js 
    ----------------------------------------------------*/
    $(document).ready(function (e) {
        //no use
        try {
            var pages = $("#pages").msDropdown({
                on: {
                    change: function (data, ui) {
                        var val = data.value;
                        if (val != "")
                            window.location = val;
                    }
                }
            }).data("dd");

            var pagename = document.location.pathname.toString();
            pagename = pagename.split("/");
            pages.setIndexByValue(pagename[pagename.length - 1]);
            $("#ver").html(msBeautify.version.msDropdown);
        } catch (e) {
            // console.log(e);
        }
        $("#ver").html(msBeautify.version.msDropdown);

        //convert
        $(".language_drop").msDropdown({ roundedBorder: false });
        $("#tech").data("dd");
    });
    /*-------------------
		Range Slider
	--------------------- */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('₺' + ui.values[0]);
            maxamount.val('₺' + ui.values[1]);
        }
    });
    minamount.val('₺' + rangeSlider.slider("values", 0));
    maxamount.val('₺' + rangeSlider.slider("values", 1));

    /*-------------------
		Radio Btn
	--------------------- */
    $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").on('click', function () {
        $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
		Nice Select
    --------------------- */
    $('.sorting, .p-show').niceSelect();

    /*------------------
		Single Product
	--------------------*/
    $('.product-thumbs-track .pt').on('click', function () {
        $('.product-thumbs-track .pt').removeClass('active');
        $(this).addClass('active');
        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product-big-img').attr('src');
        if (imgurl != bigImg) {
            $('.product-big-img').attr({ src: imgurl });
            $('.zoomImg').attr({ src: imgurl });
        }
    });

    $('.product-pic-zoom').zoom();

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

})(jQuery);
$(document).ready(function () {
    let count = 1;
    let name;
    let id;
    let ml;
    let pricem;
    let i = 0;
    $(".sm-size").each(function () {
        if (i === 0) {
            ml = $(this).parent().find("input[type='radio']").val();
            pricem = (parseFloat($(".unit-price").text()));
            id = $(this).parent().find("input[type='radio']").data("id");
        }
        i++;
    });

    $(document).on("click", ".sm-size", function () {
        ml = $(this).parent().find("input[type='radio']").val();
        pricem = (parseFloat($(".unit-price").data("price")));
        $(".unit-price").text(pricem * ml + " ₺")

    });
    $(document).on("click", ".update-qty>.qtybtn", function () {
        let qty = $(this).parent().find("input[type='text']").val();
        let id = $(this).parent().find("input[type='text']").data("id");
        let datam = {
            "rowid": id,
            "qty": qty
        }
        $.ajax({
            url: window.location.origin + "/ven/sepet_guncelle",
            type: "post",
            data: datam

        }).done(function () {
            location.reload();
        });

    })
    $(document).on("click", ".basket-destroy", function () {
        $.ajax({
            url: window.location.origin + "/ven/sepeti_sil",
            type: "post"

        }).done(function () {
            location.reload();
        });
    })

    $('#examplem').DataTable({
        "Previous": "Önceki"
    });


    $(document).on("click", ".pd-cart", function () {
        count = $(".quantity>.pro-qty>input[type='text']").val();
        name = $(".unit-title").text();
        let datam = {
            'id': id,
            'qty': count,
            'price': pricem,
            'name': name,
            "options": { "ml": ml }
        };
        $.ajax({
            url: window.location.origin + "/ven/sepete_ekle",
            type: "post",
            data: datam

        }).done(function () {
            location.reload();
        });
    });
    $(document).on("click", ".fa-times", function () {
        let id = $(this).data("id");
        $.ajax({
            url: window.location.origin + "/ven/sepet_cikar",
            type: "post",
            data: { "id": id }

        }).done(function () {
            location.reload();
        });
    })
   
    $(document).on("click",".showPass",function(){
        let pass=$(".userPass");
        $(".showPass").hide();
        $(".hidePass").css("display", "block");;
        pass.attr('type', 'text');
        
    });
    $(document).on("click",".hidePass",function(){
        let pass=$(".userPass");
        $(".hidePass").hide();
        $(".showPass").css("display", "block");
        pass.attr('type', 'password');
        
    });

    $(document).on("click",".searching",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        let category = $("select[name='category']").val();
        let search = $("input[name = 'search']").val();
        if(category === null || category === "" || !category){
            if(search === null || search === "" || !search){
                iziToast.error({title:"Hata!",message:"Boş Alan Bırakmayınız!",position:"topCenter"});
            }else{
                window.location.href = window.location.origin+"/ven/ara/"+encodeURIComponent(search)+"/";
            }
                
        }else{
            window.location.href = window.location.origin+"/ven/ara/"+encodeURIComponent(search)+"/"+encodeURIComponent(category);
        }
        
    });

});

function createModal(modalClass = null,modalTitle=null,modalSubTitle = null, headerColor = "#88A0B9",width = 600,onOpening = function(){}, onOpened = function(){}, onClosing = function(){}, onClosed = function(){}, afterRender = function(){}, onFullScreen = function(){}, onResize = function(){},fullscreen = true,openFullscreen = false,closeOnEscape= true,closeButton = true,overlayClose = false,autoOpen= 0,zindex = 999)
{
    if(modalClass !== "" || modalClass !== null){
        $(modalClass).iziModal({
            title: modalTitle,
            subtitle: modalSubTitle,
            headerColor: headerColor,
            width: width,
            zindex: zindex,
            fullscreen: fullscreen,
            openFullscreen: openFullscreen,
            closeOnEscape: closeOnEscape,
            closeButton: closeButton,
            overlayClose: overlayClose,
            autoOpen: autoOpen,
            onFullScreen: onFullScreen,
            onResize: onResize,
            onOpening: onOpening,
            onOpened: onOpened,
            onClosing: onClosing,
            onClosed: onClosed,
            afterRender: afterRender
        });
    }
}

function openModal(modalClass = null,event = function () {}){
    $(modalClass).iziModal('open',event);
}

function closeModal(modalClass = null,event = function () {}){
    $(modalClass).iziModal('close',event);
}