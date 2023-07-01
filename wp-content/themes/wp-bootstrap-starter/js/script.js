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

        // swiper
		if ($('.swiper-container').length > 0) {
            var swiper = new Swiper('.swiper-container', {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });
	    }
		if ($('.contentswiper').length > 0) {
            var swiper = new Swiper('.contentswiper', {
                effect: 'slide',
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });
	    }

        /* -- accordion --*/
        /*$('.el-accordion h3').click( function() {
            if ($(this).hasClass('active')) {
                $(this).next().hide();
                $(this).removeClass('active');
                $('i', this).removeClass('fa-minus');
                $('i', this).addClass('fa-plus');
            } else {
                $(this).next().show();
                $(this).addClass('active');
                $('i', this).removeClass('fa-plus');
                $('i', this).addClass('fa-minus');
            }
        });*/

        /* -- accordion --*/
        // $('h3.accordeon-header').click( function() {
        //     if ($(this).hasClass('active')) {
        //         $(this).next().hide();
        //         $(this).removeClass('active animateIn');
        //         $(this).addClass('animateOut');
        //     } else {
        //         $(this).next().fadeIn(500);
        //         $(this).addClass('active animateIn');
        //         $(this).removeClass('animateOut');
        //     }
        // });

        //SEARCH
        $('.search-submit').click(function (e) {
            e.preventDefault();
            if ($('.search-wrapper').hasClass('toggled-search')) {
                $('#searchform').submit();
            } else {
                 $('.search-wrapper input').show();
                 $('.search-wrapper input').focus();
                 $('.search-wrapper').addClass('toggled-search');
            }
        });

        // COUNTER
        $('.counter').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });

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


        var table =  $('#example').DataTable(
            {
                "ajax": '../../plugins/jw-jobs/data.txt',
                "username": "workinjena",
                "password": "M9bi_*u!ZTe3"
            }
        );

        $('#dropdown1').on('change', function () {

            var dropdown1 = ($('#dropdown1').val());
            var searchtext = '';

            if (dropdown1 != null) {

                for (i = 0; i < dropdown1.length; i++) {
                    searchtext += dropdown1[i] + ", ";
                }

            }
            searchtext = searchtext.substring(0,searchtext.length-2);
            table.columns(2).search( searchtext ).draw();

        } );
        $('#dropdown2').on('change', function () {
            table.columns(3).search( this.value ).draw();
        } );
        $('#dropdown3').on('change', function () {
            table.columns(4).search( this.value ).draw();
        } );

        $('.multiselect').fSelect({
            placeholder: '&nbsp;',
            numDisplayed: 3,
            showSearch: false
        });
    });


});




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