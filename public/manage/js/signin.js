$(document).ready(function(){

// SIGN IN FORM
$('#form_signin').submit(function(){

	_submit_form(weburl+'manage/signin', '', {}, $(this), function (res) { 

		return false;

	});




});



});


// AJAX CALL FUNCTION.
function _submit_form(formAction, header, formdata, form, callback) {
    $.ajax({
        url: formAction,
        headers: header,
        data: formdata ? formdata : form.serialize(),
        dataType: 'json',
        type: 'POST',
        cache: false,
        success: function (data)
        {
            try {
                callback(data);
            } catch (err) {
                // alert(data);
            }
        }
    });
}