(function ($) {
    $(document).on('submit', '#greymodeForm', function (event) {
        var context = $(this);
        var fields = context.serializeArray();
        var isScroll = false;
        $.each(fields, function (index, field) {
            if(!field.value){
                var target = context.find('[name="'+ field.name +'"]');
                target.css('border-color', '#f11');
                setTimeout(function() {
                    target.css('border-color', '');
                }, 2500);
                event.preventDefault();
                if (!isScroll) {
                    $('html, body').animate({
                        scrollTop : target.offset().top - 64
                    }, 750);   
                }
                isScroll = true;
            }
        });
    });
})(jQuery);
