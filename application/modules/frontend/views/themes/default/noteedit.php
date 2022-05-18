<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="name" class="col-sm-4 mb-2"><?php echo display('notes') ?> <i
            class="text-danger"> * </i></label>
    <div class="col-sm-12">
        <textarea name="name" class="form-control" id="editoredt" cols="15" rows="5"><?php echo html_escape($noteeditdata->notes); ?></textarea>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <input type="hidden" id="noteid" name="noteid" value="<?php echo (!empty($noteeditdata->id) ? $noteeditdata->id : ''); ?>">
        <input type="hidden" id="lesson_id" name="lesson_id" value="<?php echo (!empty($noteeditdata->lesson_id) ? $noteeditdata->lesson_id : ''); ?>">
        <button type="button" class="btn btn-dark-cerulean" id="getdataedtit" style="float: right; margin-top: 20px;"
                ><?php echo display('update') ?></button>
    </div>
</div>
<?php echo form_close(); ?>

<script>
    $(document).ready(function () {
        let theEditor;

        ClassicEditor
                .create(document.querySelector('#editoredt'))
                .then(editor => {
                    theEditor = editor;

                })
                .catch(error => {
                    console.error(error);
                });


        function getDataFromTheEditor() {
            return theEditor.getData();
        }

        document.getElementById('getdataedtit').addEventListener('click', () => {
            var enterprise_shortname = $("#enterprise_shortname").val();
            var enterprise_id = $("#enterprise_id").val();
            var student_id = $("#student_id").val();
            var course_id = $("#course_id").val();
            var lesson_id = $("#lesson_id").val();
            var notes = getDataFromTheEditor();
            var noteid = $("#noteid").val();

            $.ajax({
                url: base_url + enterprise_shortname + "/course-notesave",
                type: "POST",
                data: {'csrf_test_name': CSRF_TOKEN, student_id: student_id, course_id: course_id, lesson_id: lesson_id, enterprise_id: enterprise_id, notes: notes, noteid: noteid},
                success: function (r) {
//                    toastrSuccessMsg(r);
                    $("#modal_info").modal("hide");
                    getnoteslist();
                }
            });
        });
    });

</script>