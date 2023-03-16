$(document).ready(function() {
    $('a.img-preview').fancybox({
        padding: 3
    });

    $('input[name=phone]').mask("+7(999)999-99-99");

    let wow = new WOW({
        boxClass:     'wow',
        animateClass: 'animated',
        offset:       0,
        mobile:       true,
        live:         true
    });
    wow.init();

    $('.select').select2({
        minimumResultsForSearch: Infinity
    });

    $('#slider-voltage').ionRangeSlider({
        grid: true,
        min: 5,
        max: 12,
        from: 9,
        step: 1,
        prettify_enabled: false
    });

    $('#slider-resistance').ionRangeSlider({
        grid: true,
        min: 1,
        max: 6,
        from: 3,
        step: 1,
        prettify_enabled: false
    });

    // $('.owl-carousel.news').owlCarousel({
    //     margin: 10,
    //     loop: true,
    //     nav: true,
    //     autoplay: true,
    //     autoplayTimeout:5000,
    //     dots: false,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //         768: {
    //             items: 2
    //         },
    //         1000: {
    //             items: 3
    //         },
    //         1200: {
    //             items: 4
    //         },
    //     },
    //     // navText:[navButtonBlack1,navButtonBlack2]
    // });
    //
    // $('.owl-carousel.portfolio').owlCarousel({
    //     margin: 10,
    //     loop: true,
    //     nav: false,
    //     autoplay: true,
    //     autoplayTimeout:10000,
    //     dots: true,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //     },
    //     // navText:[navButtonBlack1,navButtonBlack2]
    // });
    //
    // $('.owl-carousel .owl-nav > button').focus(function () {
    //     $(this).blur();
    // });

    // Scroll menu
    // let uriParams = getQueryParams(window.location.search);
    // if (uriParams.scroll) gotoScroll(uriParams.scroll);

    window.menuScrollFlag = false;
    $('a[data-scroll], div[data-scroll]').click(function (e) {
        e.preventDefault();
        let self = $(this);
        if (!window.menuScrollFlag) {
            gotoScroll(self.attr('data-scroll'));
        }
    });

    // Scroll controls
    fixingMainMenu($(window).scrollTop());
    setTimeout(function () {
        windowScroll();
        resizeContactsLines();

        let skewCollageCover = $('#skew-collage-cover'),
            mainCollageContainer = $('#skew-collage'),
            mainCollageCell1 = mainCollageContainer.find('.cell1'),
            mainCollageCell2 = mainCollageContainer.find('.cell2'),
            mainCollageCell3 = mainCollageContainer.find('.cell3'),
            mainCollageCell4 = mainCollageContainer.find('.cell4'),
            skewLogo = mainCollageContainer.find('.logo');

        resizeskewCollage(
            skewCollageCover,
            mainCollageContainer,
            mainCollageCell1,
            mainCollageCell2,
            mainCollageCell3,
            mainCollageCell4,
            skewLogo
        );

        mainCollageContainer.find('.cell').each(function () {
            $(this).css({
                'left': 'auto',
                'right':-1 * $(this).width(),
                'display': 'block'
            });
        });

        mainCollageCell1.animate({'left':0},'fast',function () {
            $(this).css({
                'left': 0,
                'right': 'auto'
            });
            mainCollageCell2.animate({'left':mainCollageCell1.width() - (mainCollageCell1.width() * 0.366)},'fast', function () {
                $(this).css('right','auto');
                mainCollageCell3.animate({'right':mainCollageCell4.width() - (mainCollageCell4.width() * 0.366)},'fast', function () {
                    mainCollageCell4.animate({'right':0},'fast',function () {
                        skewLogo.animate({'opacity':1},'slow',function () {
                            $('.section.skew').css('border-bottom','1px solid #1f1e19');
                        });
                        $(window).resize(function () {
                            resizeskewCollage(
                                skewCollageCover,
                                mainCollageContainer,
                                mainCollageCell1,
                                mainCollageCell2,
                                mainCollageCell3,
                                mainCollageCell4,
                                skewLogo
                            );
                        });
                    });
                });
            });
        });
    }, 1000);

    $(window).resize(function () {
        resizeContactsLines();
    });

    // Click image portfolio
    $('.portfolio-item .images > img').click(function () {
        let smallImage = $(this),
            newSrc = smallImage.attr('src'),
            mainImageContainer = smallImage.parents('.portfolio-item').find('.image'),
            mainImageFancyBox = mainImageContainer.find('a'),
            mainImage = mainImageContainer.find('img');

        if (newSrc != mainImage.attr('src')) {
            mainImageContainer.css({
                'width':mainImageContainer.width(),
                'height':mainImageContainer.height(),
            });
            mainImage.fadeOut(function () {
                mainImage.attr('src',newSrc);
                mainImageFancyBox.attr('href',smallImage.attr('fancyBoxFull'));
                mainImage.fadeIn();
            });
        }
    });
});

function windowScroll() {
    let onTopButton = $('#on-top-button');

    $(window).scroll(function() {
        let windowScroll = $(window).scrollTop(),
            win = $(this);

        fixingMainMenu(windowScroll);

        window.menuScrollFlag = true;
        $('.section').each(function () {
            let scrollData = $(this).attr('data-scroll-destination');
            if (!win.scrollTop()) {
                resetColorHrefsMenu();
                window.menuScrollFlag = false;
            } else if ($(this).offset().top <= win.scrollTop()+200 && scrollData) {
                window.menuScrollFlag = false;
                resetColorHrefsMenu();
                $('a[data-scroll=' + scrollData + ']').parents('li.nav-item').addClass('active');
            }
        });

        if (windowScroll > $(window).height()) {
            onTopButton.fadeIn();
        } else onTopButton.fadeOut();
    });
}

function resetColorHrefsMenu() {
    $('li.nav-item').removeClass('active').blur();
}

function gotoScroll(scroll) {
    $('html,body').animate({
        scrollTop: $('div[data-scroll-destination="' + scroll + '"]').offset().top - 51
    }, 1500, 'easeInOutQuint');
}

function fixingMainMenu(windowScroll, firstCall) {
    let mainMenu = $('#main-nav');

    if (windowScroll > 55 && !parseInt(mainMenu.css('top'))) {
        mainMenu.addClass('top-fix').animate({'top':0}, 'slow');
    } else mainMenu.removeClass('top-fix');
}

function resizeContactsLines()
{
    let contactsTable = $('.section.contacts table'),
        lineCounter = 1;

    contactsTable.find('.contact').each(function () {
        let contactName = $(this).find('.contact-name');
        $(this).find('.line').css('width',$(this).width() - contactName.width() - 17 * (lineCounter + 6.5));
        lineCounter++;
    });
}

function resizeskewCollage(skewCollageCover, mainContainer,cell1,cell2,cell3,cell4,skewLogo)
{
    mainContainer.css('height',mainContainer.width()/($(window).width() > 575 ? 3.1740 : 1.45));
    skewCollageCover.css('height',mainContainer.height() + 50);
    skewLogo.css('width',mainContainer.width()/($(window).width() > 575 ? 3 : 2));

    cell2.css('left',cell1.width() - (cell1.width() * 0.366));
    cell3.css('right',cell4.width() - (cell4.width() * 0.366));
}

// function getQueryParams(qs) {
//     qs = qs.split('+').join(' ');
//     let params = {},
//         tokens,
//         re = /[?&]?([^=]+)=([^&]*)/g;
//     while (tokens = re.exec(qs)) {
//         params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
//     }
//     return params;
// }
