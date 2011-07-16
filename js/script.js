$(function(){

    $('#homepage-slider').size() && (function(){

        var slider = $('#homepage-slider'),
            slides = slider.find('.slide'),
            all = slides.size(),
            current = 0, interval = null, timeout = null,

            to = function( nth ){
                var c = slides.eq(slider.data('current'));
                slides.eq(nth).css('z-index', 200).hide().fadeIn('fast');
                c.fadeOut('fast');
                slider.data('current', nth);
                return true;
            },

            next = function(){
                var current = slider.data('current');
                return to(( current + 1 >= slider.data('all') ) ? 0 : current + 1)
            },

            prev = function(){
                var current = slider.data('current');
                return to(( current -1 < 0 ) ? slider.data('all') - 1  : current - 1)
            };




        slider.delegate('.ir', 'click', function(ev){
            ev.preventDefault();
            interval && clearInterval(interval);
            timeout && clearTimeout(timeout);
            timeout = setTimeout(function(){
                interval = setInterval(next, 3000);
            }, 2000)
            $(this).is('.prev') && prev() || next();
        });

        interval = setInterval(next, 3000);

        slider.data('current', 0);
        slider.data('all', all);

    })();

});
