$(document).ready(function() {
    let skewCollageCover = $('#skew-collage-cover'),
        navBarHeight = $('#skew-nav-bar').height(),
        mainCollageContainer = $('#skew-collage'),
        cellsHeight = mainCollageContainer.find('.cell').height(),
        mainCollageCell1 = mainCollageContainer.find('.cell1'),
        mainCollageCell2 = mainCollageContainer.find('.cell2'),
        mainCollageCell3 = mainCollageContainer.find('.cell3'),
        mainCollageCell4 = mainCollageContainer.find('.cell4'),
        skewLogo = mainCollageContainer.find('.logo'),
        coof = 0.366;

    skewCollageCover.css('height',cellsHeight + navBarHeight);

    mainCollageCell1.css({
        'left': $(window).width(),
        'display': 'block'
    });

    mainCollageCell2.css({
        'left': $(window).width(),
        'display': 'block'
    });

    mainCollageCell3.css({
        'right': -1 * mainCollageCell3.width(),
        'display': 'block'
    });

    mainCollageCell4.css({
        'right': -1 * mainCollageCell4.width(),
        'display': 'block'
    });

    mainCollageCell1.animate({'left':0},'slow',function () {
        $(this).css({
            'left': 0,
            'right': 'auto'
        });
        mainCollageCell2.animate({'left':mainCollageCell1.width() - (mainCollageCell1.width() * coof)},'slow', function () {
            $(this).css('right','auto');
            mainCollageCell3.animate({'right':mainCollageCell4.width() - (mainCollageCell4.width() * coof)},'slow', function () {
                $(this).css('left','auto');
                mainCollageCell4.animate({'right':0},'slow',function () {
                    $(this).css('left','auto');

                    resizeLogo(skewLogo, skewCollageCover);
                    skewLogo.animate({'opacity':1},'slow',function () {
                        $('.section.skew').css('border-bottom','1px solid #1f1e19');
                    });
                    // $(window).resize(function () {
                    //     resizeskewCollage(
                    //         navBarHeight,
                    //         skewCollageCover,
                    //         mainCollageContainer,
                    //         mainCollageCell1,
                    //         mainCollageCell2,
                    //         mainCollageCell3,
                    //         mainCollageCell4,
                    //         skewLogo,
                    //         coof
                    //     );
                    // });
                });
            });
        });
    });

    $(window).resize(function () {
        resizeskewCollage(
            navBarHeight,
            skewCollageCover,
            mainCollageContainer,
            mainCollageCell1,
            mainCollageCell2,
            mainCollageCell3,
            mainCollageCell4,
            skewLogo,
            coof
        );
    });
});

function resizeskewCollage(navBarHeight, skewCollageCover, mainContainer, cell1, cell2, cell3, cell4, skewLogo, coof)
{
    mainContainer.css('height',mainContainer.width()/($(window).width() > 575 ? 3.1740 : 1.45));
    skewCollageCover.css('height',mainContainer.height() + navBarHeight);

    resizeLogo(skewLogo, skewCollageCover);
    cell2.css('left',cell1.width() - (cell1.width() * coof));
    cell3.css({
        'left': 'auto',
        'right': cell4.width() - (cell4.width() * coof)
    });
    cell4.css({
        'left': 'auto',
        'right': 0
    });
}

function resizeLogo(skewLogo, skewCollageCover)
{
    skewLogo.css({
        'width': skewCollageCover.width()/($(window).width() > 575 ? 3 : 2),
        'top': skewCollageCover.height()/2
    });
}
