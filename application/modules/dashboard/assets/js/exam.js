(function ($) {
    "use strict";
    $(document).ready(function () {
//        ========== its for summary editor ============
        CKEDITOR.replace('instruction', {
            toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                },
                {
                    "name": "paragraph",
                    "groups": ["list", "blocks"]
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                },
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });

        $('#time_duration').timepicker({
            timeFormat: "HH:mm"
        });
    });
})(jQuery);

"use strict";
//=========== its for coursewise_question ==========
$("#show_question").hide();
function coursewise_question() {
    $("#show_question").show();
}
