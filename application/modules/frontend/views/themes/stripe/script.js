
//Stripe.setPublishableKey($form.data('stripe-publishable-key'));
// Callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        // Enable the submit button
        $('#payBtn').removeAttr("disabled");
        // Display the errors on the form
        $(".errorMsg").html('<p>' + response.error.message + '</p>');
    } else {
        var form$ = $("#payment-form");
        // Get token id
        var token = response.id;
        // Insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        // Submit form to the server
        form$.get(0).submit();
    }
}

$(document).ready(function () {
    var purlisherKey = $("#purlisherKey").val();
    // On form submit
    $("#payment-form").submit(function () {
        // Disable the submit button to prevent repeated clicks
        $('#payBtn').attr("disabled", "disabled");

// Set your publishable key
        Stripe.setPublishableKey(purlisherKey);
        // Create single-use token to charge the user
        Stripe.createToken({
            name: $('#cardName').val(),
            number: $('#cardNumber').val(),
            exp_month: $('#card_exp_month').val(),
            exp_year: $('#card_exp_year').val(),
            cvc: $('#card_cvc').val()
        }, stripeResponseHandler);

        // Submit from callback
        return false;
    });
});

