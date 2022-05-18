(function ($) {
    "use strict";
    $(document).ready(function () {
        $(".sendClass").on('click', function () {
            var getcls = $(this).children().attr('class');
            window.opener.document.getElementById('icon').value = getcls;
            window.close();
        });
    });
})(jQuery);