$(function(){

    $('#homepage-slider').size() && (function(){

        var slider = $('#homepage-slider'),
            slides = slider.find('.slide'),
            all = slides.size(),
            current = 0, interval = null, timeout = null,

            to = function( nth ){
                var c = slides.eq(slider.data('current')).css('z-index', 99);
                slides.eq(nth).css('z-index', 100).hide().fadeIn('fast');
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


        if(all < 2){
            return;
        }


        slider.delegate('.ir', 'click', function(ev){
            ev.preventDefault();
            interval && clearInterval(interval);
            timeout && clearTimeout(timeout);
            timeout = setTimeout(function(){
                interval = setInterval(next, 7000);
            }, 2000)
            $(this).is('.prev') && prev() || next();
        });

        interval = setInterval(next, 7000);

        slider.data('current', 0);
        slider.data('all', all);

    })();

    $('a[rel~=external]').live('click', function(ev){
        ev.preventDefault();
        window.open(this.href);
    });
    
    $('.panes .pane tr:nth-child(even)').addClass('even');
    $('.panes .pane li:nth-child(odd)').addClass('odd');
    
    $('.collapse').filter(':not(:first)').each(function(){
        var $this = $(this);
        $this.find('.collapse-me').slideUp();
        if(! $this.is('.pane')){
            $this.find('.pane').css('height', 'auto');
        }
    }).find('.top').addClass('collapser').end()
    .end().delegate('.top', 'click', function(ev){
        var $this = $(this);
        $this.toggleClass('collapser').parents('.collapse').find('.collapse-me').slideToggle('fast');
        if(! $this.is('.pane')){
            $this.parents('.pane').css('height', 'auto');
        }
    });

});
