
function check_username_format(input) {
    var text = $(input).val();
    var regex = /^[0-9a-zA-Z_]{4,20}$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}

function check_email_format(input) {
    var text = $(input).val();
    var regex = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}

function check_phone_format(input) {
    var text = $(input).val();
    var regex = /^[0-9]{8,15}$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}

function check_number_format(input) {
    var text = $(input).val();
    var regex = /^\d{0,10}$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}

function check_price_format(input) {
    var text = $(input).val();
    var regex = /^\d{0,10}(\.\d{0,2}){0,1}$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}

function check_promptpay_format(input) {
    var text = $(input).val();
    var regex = /^[0-9]{10,13}$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}