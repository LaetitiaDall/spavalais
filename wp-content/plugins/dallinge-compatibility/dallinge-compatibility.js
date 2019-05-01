/**
 * Protect window.console method calls, e.g. console is not defined on IE
 * unless dev tools are open, and IE doesn't define console.debug
 *
 * Chrome 41.0.2272.118: debug,error,info,log,warn,dir,dirxml,table,trace,assert,count,markTimeline,profile,profileEnd,time,timeEnd,timeStamp,timeline,timelineEnd,group,groupCollapsed,groupEnd,clear
 * Firefox 37.0.1: log,info,warn,error,exception,debug,table,trace,dir,group,groupCollapsed,groupEnd,time,timeEnd,profile,profileEnd,assert,count
 * Internet Explorer 11: select,log,info,warn,error,debug,assert,time,timeEnd,timeStamp,group,groupCollapsed,groupEnd,trace,clear,dir,dirxml,count,countReset,cd
 * Safari 6.2.4: debug,error,log,info,warn,clear,dir,dirxml,table,trace,assert,count,profile,profileEnd,time,timeEnd,timeStamp,group,groupCollapsed,groupEnd
 * Opera 28.0.1750.48: debug,error,info,log,warn,dir,dirxml,table,trace,assert,count,markTimeline,profile,profileEnd,time,timeEnd,timeStamp,timeline,timelineEnd,group,groupCollapsed,groupEnd,clear
 */
(function () {
    // Union of Chrome, Firefox, IE, Opera, and Safari console methods
    var methods = ["assert", "cd", "clear", "count", "countReset",
        "debug", "dir", "dirxml", "error", "exception", "group", "groupCollapsed",
        "groupEnd", "info", "log", "markTimeline", "profile", "profileEnd",
        "select", "table", "time", "timeEnd", "timeStamp", "timeline",
        "timelineEnd", "trace", "warn"];
    var length = methods.length;
    var console = (window.console = window.console || {});
    var method;
    var noop = function () {
    };
    while (length--) {
        method = methods[length];
        // define undefined methods as noops to prevent errors
        if (!console[method])
            console[method] = noop;
    }
})();


function dallinge_compatibility_check_browser() {
    var classes = "";

    var bowser = window.bowser;

        if (
            ((bowser.name === 'Firefox') && (bowser.version < 4))
            ||
            ((bowser.name === 'Internet Explorer' && (bowser.version < 9))
                ||
                ((bowser.name === 'Safari') && (bowser.version < 4))
            )
        ) {
            classes += 'no-media-support ';
            classes += 'fixed-width-site ';
        }

        if (
            ((bowser.name === 'Firefox') && (bowser.version < 29))
            ||
            ((bowser.name === 'Chrome') && (bowser.version < 30))
            ||
            ((bowser.name === 'Internet Explorer'))
            ||
            ((bowser.name === 'Safari') && (bowser.version < 6))
            ||
            ((bowser.name === 'Opera') && (bowser.version < 17)
            )
        ) {
            classes += 'no-flex-support ';
            classes += 'no-font-icon-support ';
        }

        if (
            ((bowser.name === 'Firefox') && (bowser.version < 6))
            ||
            ((bowser.name === 'Chrome') && (bowser.version < 5))
            ||
            ((bowser.name === 'Internet Explorer'))
            ||
            ((bowser.name === 'Safari') && (bowser.version < 5))
            ||
            ((bowser.name === 'Opera') && (bowser.version < 15)
            )
        ) {
            classes += 'no-animation-support ';
        }

        if (
            ((bowser.name === 'Firefox') && (bowser.version < 35))
            ||
            ((bowser.name === 'Chrome') && (bowser.version < 18))
            ||
            ((bowser.name === 'Internet Explorer') && (bowser.version >= 9))
            ||
            ((bowser.name === 'Safari') && (bowser.version < 6))
            ||
            ((bowser.name === 'Opera') && (bowser.version < 15)
            )
        ) {
            classes += 'no-filter-support ';
        }

        if (
            ((bowser.name === 'Internet Explorer' && (bowser.version < 8)))
        ) {
            classes += 'no-unicode-content-support ';
        }

        function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-')
                ;
        }

        (function ($) {
            $('document').ready(function () {

                console.log("Adding classes to body:" + convertToSlug(bowser.name) + "-" + convertToSlug(bowser.version) + " " + classes);
                $("body").addClass( convertToSlug(bowser.name) + "-" +convertToSlug(bowser.version)+ " " + classes);

            });
        })(jQuery);


}
