jQuery(function( $ ){

    $(document).ready(function() {
        // language selector
        // if ($('.select-item').length > 0) {
        //     $('.select-item').click( function() {
        //         if ($(this).hasClass('active')) {
        //                 $(this).next().fadeOut();
        //                 $(this).removeClass('active');
        //         } else {
        //                 $(this).next().fadeIn();
        //                 $(this).addClass('active');
        //         }
        //     });
        //
        // }

        $('.sln-service__header').next().hide();


        // PAGELOADER
        $('body > .site-container').animate({ opacity: 1 }, 2000, function() {});


        // CATEGORY FOR SELECTION OF VALUE IN SELECT FIELD
        var categoryGetParameter = getUrlParameter('cat');

        if(categoryGetParameter > 0) {
            if($('.filterbar').length > 0) {
                $('.filterbar select option[data-category-id='+categoryGetParameter+']').attr('selected','selected');
            }
        }

        if($('#category-filter').length > 0) {
            styleTheSelectField();
        }

        // SHOW MOBILE MENU ON SCROLL UP
        var didScroll;
        var lastScrollTop = 0;
        var navbarID = '#masthead'
        var navbarHeight = $(navbarID).outerHeight();
        var delta = 150;

        $(window).scroll(function(event){
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        function hasScrolled() {
            var st = $(this).scrollTop();

            if(Math.abs(lastScrollTop - st) <= delta)
                return;

            if (st > lastScrollTop && st > navbarHeight){ $(navbarID).removeClass('nav-down').addClass('nav-up');
            } else {
                if(st + $(window).height() < $(document).height()) { $(navbarID).removeClass('nav-up').addClass('nav-down');
                }
            }

            if ((st == 0) || (st <= 150) || (lastScrollTop <= delta)) {
                $(navbarID).removeClass('nav-down')
            }

            lastScrollTop = st;
        }

        // WAYPOINTS
        var waypoints = $('.waypoint-marker').waypoint(function (direction) {
            $('.direction-waypoint').removeClass('waypoint-marker');
            $(this.element).addClass('waypoint-marker');
            $(this.element).find('.animate__animated').each( function () {
                var animationStyle = $(this).attr('data-animation');
                $(this).addClass(''+animationStyle+'');
                $(this).addClass('animated');
            })
            $(this.element).addClass('visited-waypoint-marker');
        }, {
            offset: 700
        });

        // PREV NEXT FOR BLOG
        if($('.pagination').length > 0) {

            if ($('.btn-blog-next').length > 0) {
                $('.pagination .nav-next-trigger').show();
            }
            if ($('.btn-blog-prev').length > 0) {
                $('.pagination .nav-prev-trigger').show();
            }

            $('.posts .pagination .nav-next-trigger').click( function() {
                var url = $('.btn-blog-next').attr('href');
                location.href = url;
            });

            $('.posts .pagination .nav-prev-trigger').click( function() {
                var url = $('.btn-blog-prev').attr('href');
                location.href = url;
            });

            var relativePath = window.location.pathname+window.location.search;
            if(relativePath.includes('page')) {
                $('html, body').animate({
                    scrollTop: $("#posts-container").offset().top
                }, 500);
            }
        }

        // SWIPER
		if ($('.contentswiper').length > 0) {

            $('.element-contentswiper').each( function(index) {
                var idOfContentswiper = $(this).children('.contentswiper').attr('id');
                var idOfSwiper = $(this).children('.contentswiper').attr('id');

                $('#'+idOfContentswiper+'').next('.swiper-button-prev-content').addClass('swiper-button-prev-content-'+index)
                $('#'+idOfContentswiper+'').next().next('.swiper-button-next-content').addClass('swiper-button-next-content-'+index)

                idOfContentswiper = new Swiper('#'+idOfContentswiper+'', {
                    autoplay: {
                        delay: 2000,
                    },
                    effect: 'slide',
                    // loop: true,
                    centeredSlides: true,
                    rewind: true,
                    initialSlide: 0,
                    slidesPerView: 1,
                    speed: 2000,
                    spaceBetween: 0,
                    navigation: {
                        nextEl: '.swiper-button-next-content-'+index,
                        prevEl: '.swiper-button-prev-content-'+index,
                    },
                    breakpoints: {
                        320: {
                            spaceBetween: 40,
                            slidesPerView: 1,
                        },
                        574: {
                            slidesPerView: 1,
                        },
                        810: {
                            slidesPerView: 2,
                        },
                        1024: {
                            slidesPerView: 3,
                        },
                    },
                    on: {
                        init: function () {
                            checkForCopyrightAndChangeIt(idOfContentswiper.activeIndex,idOfSwiper);
                        },
                        slideChange: function () {
                            checkForCopyrightAndChangeIt(idOfContentswiper.activeIndex,idOfSwiper);
                        },
                    },
                });


                function checkForCopyrightAndChangeIt (index_currentSlide,idOfSwiper) {
                    // var corrected_index_currentSlide = index_currentSlide - 1; // FOR LOOP MODE
                    var corrected_index_currentSlide = index_currentSlide + 1;
                    var copyrightFromSlide = $('#'+idOfSwiper+' .swiper-slide').children('#figcaption-'+corrected_index_currentSlide).text();

                    var standardCopyrightText = "";
                    standardCopyrightText = $('#'+idOfSwiper+' .copyright').attr('data-copyright-text');

                    if(idOfSwiper == 'contentswiper-slider-block_63121ce8405d0') {
                        console.log(idOfSwiper)
                        console.log(index_currentSlide)
                        console.log(copyrightFromSlide)
                    }

                    if(copyrightFromSlide != "") {
                        $('#'+idOfSwiper).find('.copyright').html('<span class="">©</span>'+copyrightFromSlide);
                    } else {
                        $('#'+idOfSwiper).find('.copyright').html('<span class="">©</span>'+standardCopyrightText);
                    }
                }
            })
        }


		if ($('.sponsorswiper').length > 0) {

            $('.element-sponsorswiper').each( function() {

                var idOfSponsorswiper = $(this).children('.sponsorswiper').attr('id');

                idOfSponsorswiper = new Swiper('.sponsorswiper', {
                    autoplay: {
                        delay: 2000,
                    },
                    effect: 'slide',
                    loop: true,
                    speed: 1000,
                    slidesPerView: 1,
                    spaceBetween: 0,
                    navigation: {
                        nextEl: '.swiper-button-next-sponsor',
                        prevEl: '.swiper-button-prev-sponsor',
                    },
                    breakpoints: {
                        320: {
                            spaceBetween: 10,
                            slidesPerView: 1,
                        },
                        574: {
                            spaceBetween: 30,
                            slidesPerView: 2,
                        },
                        768: {
                            spaceBetween: 50,
                            slidesPerView: 3,
                        },
                        1024: {
                            spaceBetween: 100,
                            slidesPerView: 4,
                        },
                    }
                });
            })
	    }

		if ($('.eventswiper').length > 0) {

            $('.element-eventswiper').each( function() {

                var idOfSponsorswiper = $(this).children('.sponsorswiper').attr('id');

                idOfSponsorswiper = new Swiper('.eventswiper', {
                    // autoplay: {
                    //     delay: 2000,
                    // },
                    effect: 'slide',
                    loop: true,
                    speed: 1000,
                    slidesPerView: 1,
                    spaceBetween: 0,
                    navigation: {
                        nextEl: '.swiper-button-next-event',
                        prevEl: '.swiper-button-prev-event',
                    },
                    breakpoints: {
                        320: {
                            spaceBetween: 10,
                            slidesPerView: 1,
                        },
                        574: {
                            spaceBetween: 30,
                            slidesPerView: 2,
                        },
                        768: {
                            spaceBetween: 50,
                            slidesPerView: 2,
                        },
                        1024: {
                            spaceBetween: 100,
                            slidesPerView: 3,
                        },
                    }
                });
            })
	    }

        if ($('.headerswiper').length > 0) {
            var headerSwiper = new Swiper('.headerswiper', {
                direction: 'vertical',
                effect: 'fade',
                allowTouchMove : false,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        }

        // SCHEDULE SLIDER
        $('.schedule-navigation .swiper-button-prev').click(function() {
            $('.schedule-item.prev .date-element ').trigger('click');
        });

        $('.schedule-navigation .swiper-button-next').click(function() {
            $('.schedule-item.next .date-element ').trigger('click');
        });

        if(($('.scheduletabs').length > 0) && (window.innerWidth > 768)) {
            $('.schedule-item .date-element').click( function () {

                if($(this).parent().parent().hasClass('prev') || $(this).parent().parent().hasClass('next')) {

                    widthOfViewport = $('.schedule-item.active').width;

                    $(this).parent().parent().css({
                        'position' : 'relative',
                        'right' : '-='+widthOfViewport+'px'
                    });

                    if($(this).parent().parent().prev().hasClass('active')) {
                        // SLIDE TO THE LEFT
                        $(this).parent().parent().css({
                            right: "0"
                        })
                        // CHANGE STATES
                        $(this).parent().parent().prev().removeClass('active');
                        $(this).parent().parent().prev().addClass('prev');
                        $(this).parent().parent().prev().prev().removeClass('prev');
                        $(this).parent().parent().next().addClass('next');
                        $(this).parent().parent().next().next().removeClass('next');
                        $(this).parent().parent().removeClass('next');

                        $(this).parent().parent().prevAll().attr({'data-schedule-left': $(this).attr('data-schedule-right')});
                        $(this).parent().parent().prevAll().css({
                            'position' : 'absolute',
                            'right' : 'unset',
                            'left' : '-=300px'
                        });
                        $(this).parent().parent().prevAll().attr({'data-schedule-right': ''});
                        $(this).parent().parent().nextAll().css({
                            'position' : 'absolute',
                            'right' : '+=300px'
                        });

                    } else {
                        // SLIDE TO THE RIGHT
                        $(this).parent().parent().css({
                            right: "0",
                            left: "unset"
                        })

                        $(this).parent().parent().prev().addClass('prev');
                        $(this).parent().parent().removeClass('prev');
                        $(this).parent().parent().next().removeClass('active');
                        $(this).parent().parent().next().addClass('next');
                        $(this).parent().parent().next().next().removeClass('next');

                        $(this).parent().parent().prevAll().css({
                            'position' : 'absolute',
                            'right' : 'unset',
                            'left' : '+=300px'
                        });
                        $(this).parent().parent().nextAll().css({
                            'position' : 'absolute',
                            'left' : 'unset'
                        });
                        $(this).parent().parent().nextAll(':not(".next")').css({
                            'right' : '-=300px',
                        });
                    }

                    $(this).parent().parent().addClass('active');

                }

            });
        }

        // SET ALL LINKS IN PRESSINFORMATION AS BUTTONS
        if($('.element-pressinformation .accordion-body p a').length > 0) {
            $('.element-pressinformation .accordion-body p a').each( function() {
               $(this).addClass('btn');
            });
        }

        // EXTEND BANDEROLES
        if($('.element-full-width').length > 0) {
            expandBanderols();
        }

        function expandBanderols() {
            var width = $(window).width();
            var contentwidth = $(".site-inner .container").width();
            var margin = (contentwidth - width) / 2;

            $('.element-full-width').css({
                "width" : width,
                "margin-left" :  margin
            });
        }

        window.addEventListener("orientationchange", function() {
            expandBanderols();
        }, false);

        // SINGLE POST
        if($('.single-post .single-image').length > 0) {
            var width = $(window).width();
            var contentwidth = $(".site-inner .container").width();
            var marginLeft = (contentwidth - width) / 2;
            $('.single-image').css({
                "width" : width,
                "margin-left" :  marginLeft,
            });
        }

        // LINEUP
        if($('.element-lineup').length > 0) {
            var lineupIterator = 1;
            var lineupDelay = 0.5;

            $('.el-lineup').each( function() {
                var heightOfElement = $(this).width();
                // var lineupMargin = 10;
                //
                // if(lineupIterator % 3 == 0) {
                //     $(this).parent().addClass('3rd-element')
                //     lineupMargin = lineupMargin - lineupMargin;
                // } else if(lineupIterator % 2 == 0) {
                //     $(this).parent().addClass('2nd-element')
                //     lineupMargin = lineupMargin - 5;
                // }

                if($(window).width < 990) {
                    heightOfElement = heightOfElement + 80
                }


                $(this).css({
                   'height' : heightOfElement + 'px',
               });
                $(this).parent().css({
                   'animation-delay' : lineupDelay + 's',
                });

                lineupIterator++;
                lineupDelay = lineupDelay + 0.1;
            });
        }

        // SCROLLUP-BUTTON
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll >= 100) {
                $('.scrollup-button').addClass('show-scrollup-button');

            } else {
                $('.scrollup-button').removeClass('show-scrollup-button');
            }
        });
        //
        // $('.scrollup-button').click(function () {
        //     $('html, body').animate({scrollTop: 0}, 1000);
        // });

        // ANCHOR SCROLLING ON SITE
        $('.el-teaser a').click( function(e) {
            var URL = $(this).attr('href')
            var URL = URL.split("=");
            var URL = URL[1];

            if ((URL != "" ) && (typeof(URL) != 'undefined')) {
                e.preventDefault();
                $('html,body').animate({scrollTop:($("h2:nth-of-type(" + URL + ")").offset().top - 250)}, 500);

            } else {

            }
        });

        // TEAM FLIPPING
        if(window.innerWidth > 1200) {
            $('.team .team-left').hover( function() {
                $(this).addClass( 'hover');
            }, function() {
                $(this).removeClass( 'hover');
            });

            $('.team .team-left').click( function(e) {
                e.preventDefault();
                if($(this).hasClass('hover')) {
                    $(this).removeClass('hover');
                } else {
                    $(this).addClass('hover');
                }
            });
        } else {
            $('.team .team-left').click( function(e) {
                e.preventDefault();
                if($(this).hasClass('hover')) {
                    $(this).removeClass('hover');
                } else {
                    $(this).addClass('hover');
                }
            });
        }


        // $('.team .team-left').on('touchstart touchend', function(e) {
        //     e.preventDefault();
        //     $(this).toggleClass('hover');
        // });

        // KLARO BANNER SLIDE IN UP
        $('#klaro').addClass('show');

        // NAVBAR TOGGLER
        $('.navbar-toggler').click(function () {
            if ($('body').hasClass('menu-active')) {
                $('body').removeClass('menu-active');
                $('body').addClass("menu-deactivation").delay(1000).queue(function(){
                    $(this).removeClass("menu-deactivation").dequeue();
                });
            } else {
                $('body').addClass('menu-active');
            }
        });

        $('#main-nav .btn-close-main-nav').click( function() {
            $('body').removeClass('menu-active');
            $('body').addClass("menu-deactivation").delay(1000).queue(function(){
                $(this).removeClass("menu-deactivation").dequeue();
            });
        });


        $('#offcanvasWithContactForm .text-reset').click( function() {
            $('body').removeClass('menu-active');
            $('body').addClass("menu-deactivation").delay(1000).queue(function(){
                $(this).removeClass("menu-deactivation").dequeue();
            });
        });

        // DONT CLOSE MENU WHEN CLICKED OUTSIDE OFFCANVAS
        // var menuOffcanvas = document.getElementById('main-nav');
        // menuOffcanvas.addEventListener('hidden.bs.offcanvas', function () {
        //
        //     $('body').addClass("menu-active").delay(200).queue(function(){
        //         if($('#offcanvasWithContactForm').hasClass('show')) {
        //
        //         } else {
        //             $('body').removeClass('menu-active');
        //             $(this).removeClass("menu-deactivation").dequeue();
        //         }
        //     });
        //
        //     $('body').addClass("menu-deactivation").delay(1000).queue(function(){
        //         $('body').removeClass('menu-active');
        //         $(this).removeClass("menu-deactivation").dequeue();
        //     });
        // })

        // var contactOffcanvas = document.getElementById('offcanvasWithContactForm')
        // contactOffcanvas.addEventListener('hidden.bs.offcanvas', function () {
        //     $('body').removeClass('menu-active');
        //     $('body').addClass("menu-deactivation").delay(1000).queue(function(){
        //         $(this).removeClass("menu-deactivation").dequeue();
        //     });
        // })

        // STICKY MENU
        // $(window).scroll(function () {
        //     var scroll = $(window).scrollTop();
        //     if (scroll >= 100) {
        //         $('#masthead').addClass('shrink');
        //     } else {
        //         $('#masthead').removeClass('shrink');
        //     }
        // });

        // REMOVE BUTTONS
        if (window.location.href.indexOf("/projekte/") > -1) {
            $('.element-pressinformation a:contains("Projektseite")').hide();
            $('.element-pressinformation a:contains("Projektwebseite")').hide();
            $('.el-posts #category-filter').hide();
        }

        if (window.location.href.indexOf("/presse/") > -1) {
            $('a:contains("Presseseite")').hide();
            $('a:contains("Pressewebseite")').hide();
        }


        /* -- tabs --*/
        $('.tablinks').click( function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');

            } else {
                $('.tablinks').removeClass('active');
                $(this).addClass('active');

                var id = $(this).data('id');

                $('.tabcontent').removeClass('active');
                $('#tab-' + id).addClass('active');
            }
        });

        /* -- form --*/
        if ($('.wpcf7-form').length > 0) {
            $('input[name=rechnungsdaten1]').click(function() {
                var myrechnung = $('input[name=rechnungsdaten1]:checked', '.wpcf7-form').val();
                if (myrechnung == 'Daten abweichend (z.B. Teilnehmer oder ein Dritter)' ) {
                    $('.form-rechnungsdaten').show();
                } else {
                    $('.form-rechnungsdaten').hide();
                }
            });

            $('input[name=rechnungsdaten2]').click(function() {
                var myrechnung = $('input[name=rechnungsdaten2]:checked', '.wpcf7-form').val();
                if (myrechnung == 'Daten abweichend' ) {
                    $('.form-rechnungsdaten').show();
                } else {
                    $('.form-rechnungsdaten').hide();
                }
            });

        }

        /* -- fancybox -- */
        if ($('.fancybox').length > 0) {
            $("[data-fancybox]").fancybox({
                thumbs : {
                    autoStart : true
                }
            });
            $.fancybox.defaults.hash = false;

            $('.fancybox').fancybox();
        }


        $(".wp-block-gallery .blocks-gallery-item a").fancybox().attr('data-fancybox', 'gallery');

        // MOBILE STUFF

        if(window.innerWidth <= 810) {

            // hard facts
            var hardFactsHeight = $('.element-hard-facts .hard-facts-image img').width() / 1.1;
            $('.element-hard-facts .hard-facts-image').css('max-height', hardFactsHeight+'px');
        }

    });
});

// STYLE THE SELECTFIELD
function styleTheSelectField() {
    var x, i, j, l, ll, selElmnt, a, b, c;

    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;

        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);

        b = document.createElement("DIV");
        b.setAttribute("class", "select-items noize select-hide");
        for (j = 1; j < ll; j++) {
            c = document.createElement("a");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.setAttribute("href", selElmnt.options[j].getAttribute('value'));
            c.addEventListener("click", function(e) {


                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }

    function closeAllSelect(elmnt) {
        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }

    document.addEventListener("click", closeAllSelect);

}

//GETURLPARAMETER
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

