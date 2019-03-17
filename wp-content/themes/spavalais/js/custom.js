(function ($) {

    $(document).ready(function () {
        try {
            dallinge_animate([
                dallinge_animate_element('.widget', dallinge_animate_animations.FADE_IN, false),
            ])
        } catch (error) {
            console.log(error);
        }
    });

})(jQuery);