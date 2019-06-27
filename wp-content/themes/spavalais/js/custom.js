(function ($) {

    $(document).ready(function () {
            if ($.isFunction("dallinge_animate"))
            {
                dallinge_animate([
                    dallinge_animate_element('.widget', dallinge_animate_animations.FADE_IN, false),
                ])
            }
    });

})(jQuery);


