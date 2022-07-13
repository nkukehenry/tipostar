$(document).ready(function () {
    // Called when token created successfully.
    var successCallback = function (data) {
        var myForm = document.getElementById('payment-form');

        // Set the token as the value for the token input
        myForm.token.value = data.response.token.token;

        // Submit the form
        myForm.submit();
    };

    // Called when token creation fails.
    var errorCallback = function (data) {
        if (data.errorCode === 200) {
            tokenRequest();
        } else {
            alert(data.errorMsg);
        }
    };

    var tokenRequest = function () {
        // Setup token request arguments
        var args = {
            sellerId: "sandbox-seller-id",
            publishableKey: "sandbox-publishable-key",
            ccNo: $("#card_num").val(),
            cvv: $("#cvv").val(),
            expMonth: $("#exp_month").val(),
            expYear: $("#exp_year").val()
        };

        // Make the token request
        TCO.requestToken(successCallback, errorCallback, args);
    };

    $(function () {
        // Pull in the public encryption key for our environment
        TCO.loadPubKey('sandbox');

        $("#payment-form").submit(function (e) {
            // Call our token request function
            tokenRequest();

            // Prevent form from submitting
            return false;
        });
    });
});
