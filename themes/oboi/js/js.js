function load_post(elm, json) {
    var result = JSON.parse(json);
    // console.log(result);
    result.offset = $('[data-list]').find('[data-item]').length;
    var data = new FormData();
    data.append('type', 'load_post');
    $.each(result, function (i, v) {
        data.append(i, v);
    });
    $.ajax({
        url: '/wp-ajax/index.php',
        type: 'POST',
        tmp_dir: 'tmp',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "html",
        data: data,
        success: function(data){
            $('[data-list]').append(data);
            $('[data-item]').fadeIn(400);
            if($('[data-list]').find('[data-item]').length == $(elm).attr('data-count')){
                $(elm).remove()
            }
        }
    })
}

function goodsFilter(elm) {
    var data = new FormData();
    data.append('type', 'filter_session');
    var array = [];
    var i = 0;
    $.each($(elm).find('[data-checkbox]'), function (i, v) {
        var elem = [];
        var ic = 0;
        var name = $(v).attr('data-checkbox');
        $.each($(elm).find('input[name='+name+']'), function (i, v) {
            if($(v).prop("checked")){
                elem[ic++] = $(v).val();
            }
        });
        if(elem.length != 0 && elem[0].length != ''){
            data.append(name, elem[0]);
        }
    });

    $.ajax({
        url: '/wp-ajax/index.php',
        type: 'POST',
        tmp_dir: 'tmp',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "html",
        data: data,
        success: function(data){
            $('[data-cotalog]').fadeOut(400, function () {
                $(this).html(data);
                $(".img-category").imgLiquid();
                $(this).fadeIn(400);
            });
        }
    });
}
function goodsFilterDelete(elm) {
    // location.replace("/goods");
    var data = new FormData();
    var link = $(elm).attr('href');
    data.append('type', 'filter_session_delete');
    $.ajax({
        url: '/wp-ajax/index.php',
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "html",
        data: data,
        success: function(data){
            location.replace(link);
        }
    });
}

function LoadPage(elm) {
    var count = $('[data-item-goods]').length;
    var count_max = $(elm).attr('data-max');
    var count_goods_max = $(elm).attr('data-goods-max');
    var data = new FormData();
    data.append('type', 'LoadPage');
    data.append('count', count);
    $.ajax({
        url: '/wp-ajax/index.php',
        type: 'POST',
        tmp_dir: 'tmp',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "html",
        data: data,
        success: function(data){
            $('[data-cotalog]').fadeOut(400, function () {
                $(this).html(data);
                $(".img-category").imgLiquid();
                $(this).fadeIn(400);
            });
        }
    });
}

function LoadPageFull(elm) {
    var count = $('[data-item-goods]').length;
    var count_max = $(elm).attr('data-max');
    var count_goods_max = $(elm).attr('data-goods-max');
    var data = new FormData();
    data.append('type', 'LoadPageFull');
    data.append('count_goods_max', count_goods_max);
    data.append('status', 'full');
    $.ajax({
        url: '/wp-ajax/index.php',
        type: 'POST',
        tmp_dir: 'tmp',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "html",
        data: data,
        success: function(data){
            $('[data-cotalog]').fadeOut(400, function () {
                $(this).html(data);
                $(".img-category").imgLiquid();
                $(this).fadeIn(400);
            });
        }
    });
}

function LoadCatLink(elm) {
    var id = $(elm).attr('data-cat');
    var data = new FormData();
    data.append('type', 'LoadCatLink');
    data.append('category', id);
    $.ajax({
        url: '/wp-ajax/index.php',
        type: 'POST',
        tmp_dir: 'tmp',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "html",
        data: data
    });
}

function FormContact(elm) {
    var result = $(elm).find('[name]');
    var i = 0;
    var error = [];
    var mail = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
    $('.error-item').animate({'right': -210}, 300);
    $('.error-item').html('');
    $('[name]').css('border-color', '#DDDDDD');
    $.each(result, function (i, v) {
        switch ($(v).attr('name')){
            case 'email':
                if($(v).val().length == 0){
                    error[i++] = JSON.parse($(v).attr('data-error'))[0];
                    $(v).css('border-color', 'rgb(255, 195, 195)');
                    $('.error-item').append('<div>'+JSON.parse($(v).attr('data-error'))[0]+'</div>');
                } else if(!mail.test($(v).val())){
                    error[i++] = JSON.parse($(v).attr('data-error'))[1];
                    $(v).css('border-color', 'rgb(255, 195, 195)');
                    $('.error-item').append('<div>'+JSON.parse($(v).attr('data-error'))[1]+'</div>');
                }
                break;
            case 'phone':
                if($(v).val().length == 0){
                    error[i++] = JSON.parse($(v).attr('data-error'))[0];
                    $(v).css('border-color', 'rgb(255, 195, 195)');
                    $('.error-item').append('<div>'+JSON.parse($(v).attr('data-error'))[0]+'</div>');
                }
                break;
            default:
                if($(v).val().length == 0){
                    error[i++] = JSON.parse($(v).attr('data-error'))[0];
                    $(v).css('border-color', 'rgb(255, 195, 195)');
                    $('.error-item').append('<div>'+JSON.parse($(v).attr('data-error'))[0]+'</div>');
                }
                break;
        }
    });
    $('.error-item').animate({'right': 0}, 300);
    if(error.length == 0){
        var data = new FormData();
        data.append('type', 'FormContact');
        $.each(result, function (i, v) {
            data.append($(v).attr('name'), $(v).val());
        });
        $.ajax({
            url: '/wp-ajax/index.php',
            type: 'POST',
            tmp_dir: 'tmp',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "html",
            data: data,
            success: function(data){
                var json = JSON.parse(data);
                switch (json.method){
                    case 'contact':
                        $(elm).html('<div class="ok-contact-load">'+json.text+'</div>');
                        break;
                    case 'goods':
                        $(elm).html('<div class="ok-goods-load">'+json.text+'</div>');
                        break;
                    case 'basket_goods':
                        $(elm).html('<div class="ok-goods-load">'+json.text+'</div>');
                        break;
                }
            }
        });
    }
}

function SlideNext(){
    var e = $('[data-list]').find('.active');
    var img, link;
    if(e.next().length != 0){
        img = e.next().attr('style').split(': ');
        link = e.next().attr('data-link');
        $('[data-banner]').css(img[0], img[1]);
        $('[data-banner-link]').attr('href', link);
        e.next().addClass('active');
        e.removeClass('active');
    } else {
        img = $('[data-id=0]').attr('style').split(': ');
        link = $('[data-id=0]').attr('data-link');
        $('[data-banner]').css(img[0], img[1]);
        $('[data-banner-link]').attr('href', link);
        $('[data-id=0]').addClass('active');
        e.removeClass('active');
    }
}
function SlidePrev(){
    var e = $('[data-list]').find('.active');
    var img, link;
    if(e.prev().length != 0){
        img = e.prev().attr('style').split(': ');
        link = e.prev().attr('data-link');
        $('[data-banner]').css(img[0], img[1]);
        $('[data-banner-link]').attr('href', link);
        e.prev().addClass('active');
        e.removeClass('active');
    } else {
        var count = $('[data-id]').length - 1;
        img = $('[data-id='+count+']').attr('style').split(': ');
        link = $('[data-id='+count+']').attr('data-link');
        $('[data-banner]').css(img[0], img[1]);
        $('[data-banner-link]').attr('href', link);
        $('[data-id='+count+']').addClass('active');
        e.removeClass('active');
    }
}

function catalogItemCounter(field){

    var fieldCount = function(el) {

        var
        // Мин. значение
            min = el.data('min') || false,

        // Макс. значение
            max = el.data('max') || false,

        // Кнопка уменьшения кол-ва
            dec = el.prev('.dec'),

        // Кнопка увеличения кол-ва
            inc = el.next('.inc');

        function init(el) {
            if(!el.attr('disabled')){
                dec.on('click', decrement);
                inc.on('click', increment);
            }

            // Уменьшим значение
            function decrement() {
                var value = parseInt(el[0].value);
                value--;

                if(!min || value >= min) {
                    el[0].value = value;
                }
            };

            // Увеличим значение
            function increment() {
                var value = parseInt(el[0].value);

                value++;

                if(!max || value <= max) {
                    el[0].value = value++;
                }
            };

        }

        el.each(function() {
            init($(this));
        });
    };

    $(field).each(function(){
        fieldCount($(this));
    });
}

function basket_goods_che(elm) {
    var data = new FormData();
    data.append('type', 'basket_goods_che');
    $.each($(elm).find('[name]'), function (i, v) {
        data.append($(v).attr('name'), $(v).val());
    });
    $.ajax({
        url: '/wp-ajax/index.php',
        type: 'POST',
        tmp_dir: 'tmp',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "html",
        data: data,
        success: function(data){
            $(elm).find('.fieldCount').val(1);
            $('[data-changes="basket__top"]').html(data);
        }
    });
}

function basket_goods_che_counter(elm, n) {
    var parents = $(elm).parents('[data-id]');
    var s = $(elm).parent().find('input').val();
    var data = new FormData();
    data.append('type', 'basket_goods_che_counter');
    data.append('id', parents.attr('data-id'));
    data.append('n', n);
    var d = 0;
    if(n == 1){
        d = Number(s)-1;
        if(d >= 1){
            $.ajax({
                url: '/wp-ajax/index.php',
                type: 'POST',
                tmp_dir: 'tmp',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "html",
                data: data,
                success: function(data){
                    var a1 = $($(data)[0]).html();
                    var a2 = $($(data)[2]).html();
                    var a3 = $($(data)[4]).html();
                    parents.find('[data-changes=basket-page__price]').html(a1);
                    $('[data-changes="basket__top"]').html(a2);
                    $('[data-changes="basket"]').html(a3);
                    $('.basket__order').magnificPopup({
                        type:'inline',
                        midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
                    });
                }
            });
        }

    }
    if(n == 2){
        d = Number(s)+1;
        if(d <= 999){
            $.ajax({
                url: '/wp-ajax/index.php',
                type: 'POST',
                tmp_dir: 'tmp',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "html",
                data: data,
                success: function(data){
                    var a1 = $($(data)[0]).html();
                    var a2 = $($(data)[2]).html();
                    var a3 = $($(data)[4]).html();
                    parents.find('[data-changes=basket-page__price]').html(a1);
                    $('[data-changes="basket__top"]').html(a2);
                    $('[data-changes="basket"]').html(a3);
                    $('.basket__order').magnificPopup({
                        type:'inline',
                        midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
                    });
                }
            });
        }
    }
}

function delete_goods_basket(elm) {
    var parents = $(elm).parents('[data-id]');
    var data = new FormData();
    data.append('type', 'delete_goods_basket');
    data.append('id', parents.attr('data-id'));
    $.ajax({
        url: '/wp-ajax/index.php',
        type: 'POST',
        tmp_dir: 'tmp',
        processData: false,
        contentType: false,
        cache: false,
        dataType: "html",
        data: data,
        success: function(data){
            parents.slideUp(300, function () {
                $(this).remove();
            });
            var a1 = $($(data)[0]).html();
            var a2 = $($(data)[2]).html();
            var a3 = $($(data)[4]).html();
            $('[data-changes="h1"]').html(a1);
            $('[data-changes="basket__top"]').html(a2);
            $('[data-changes="basket"]').html(a3);
            $('.basket__order').magnificPopup({
                type:'inline',
                midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
            });
        }
    });
}

$(document).ready(function () {
    $('[name=phone]').mask('+7(000)000-00-00');
    $(".megamenu").megamenu();
    $('.scroll-pane').jScrollPane();
    $(".img-category").imgLiquid();
    $(".img-rel").imgLiquid();
    $('[data-checkbox]').each(function (i,v) {
        $(v).find('input[type=checkbox]').on('click', function () {
            if($(this).is(':checked')){
                $(v).find('input[type=checkbox]').prop('checked', false);
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    });

    catalogItemCounter('.fieldCount');

    if($('.new_header').length != 0){
        $('.menu_list_header > li').hover(function () {
            $(this).find('span').parent().addClass('focus');
        }, function () {
            $(this).find('span').parent().removeClass('focus');
        });
        $('.search_header > span').on('click', function () {
            var parent = $(this).parent();
            if(!parent.hasClass('active')){
                parent.addClass('active');
                $(this).find('i').removeClass('fa-search').addClass('fa-times');
            } else {
                $(this).find('i').removeClass('fa-times').addClass('fa-search');
                parent.removeClass('active');
            }
        });
        if($('.menu_list_header_mobile').length != 0){
            $('.menu_list_header_mobile > li > span').hover(function () {
                $(this).parent().addClass('focus');
            }, function () {
                $(this).parent().removeClass('focus');
            })
        }
    }


    $('.open-popup-link').magnificPopup({
        type:'inline',
        midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });

    $('.basket__order').magnificPopup({
        type:'inline',
        midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });


    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });

    if($('.home').length != 0){
        setInterval(function() {
            SlideNext();
        }, 10000);
    }

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        // touchMove: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        touchMove: false,
        // centerMode: false,
        focusOnSelect: false
    });

}); 
