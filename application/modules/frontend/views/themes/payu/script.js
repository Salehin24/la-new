//all js 
$(".loader").delay(2000).fadeOut("slow");
$("#overlayer").delay(2000).fadeOut("slow");

var hash = $("#hash").val();
function submitPayuForm() {
    if (hash == '') {
        return;
    }
    var payuForm = document.forms.payuForm;
    payuForm.submit();
}