<!-- <script src="http://code.jquery.com/jquery-1.7.min.js"></script> -->
<style>
body {
    background: #edf1f4 url(bg.jpg);
    font-family: "Segoe UI", Candara, "Bitstream Vera Sans", "DejaVu Sans", "Bitstream Vera Sans", "Trebuchet MS", Verdana, "Verdana Ref", sans serif;
    font-size: 16px;
    color: #444;
}

ul,
li {
    margin: 0;
    padding: 0;
    list-style-type: none;
}

#container {
    width: 400px;
    padding: 0px;
    background: #fefefe;
    margin: 0 auto;
    border: 1px solid #c4cddb;
    border-top-color: #d3dbde;
    border-bottom-color: #bfc9dc;
    box-shadow: 0 1px 1px #ccc;
    border-radius: 5px;
    position: relative;
}

/* h1 {
    margin: 0;
    padding: 10px 0;
    font-size: 24px;
    text-align: center;
    background: #eff4f7;
    border-bottom: 1px solid #dde0e7;
    box-shadow: 0 -1px 0 #fff inset;
    border-radius: 5px 5px 0 0;
    text-shadow: 1px 1px 0 #fff;
} */

form ul li {
    margin: 10px 20px;

}

/* form ul li:last-child {
    text-align: center;
    margin: 20px 0 25px 0;
} */

input {
    padding: 10px 10px;
    border: 1px solid #d5d9da;
    border-radius: 5px;
    box-shadow: 0 0 5px #e8e9eb inset;
    width: 328px;
    font-size: 1em;
    outline: 0;
}

/* input:focus {
    border: 1px solid #b9d4e9;
    border-top-color: #b6d5ea;
    border-bottom-color: #b8d4ea;
    box-shadow: 0 0 5px #b9d4e9;
} */

/* label {
    color: #555;
} */

/* #container span {
    background: #f6f6f6;
    padding: 3px 5px;
    display: block;
    border-radius: 5px;
    margin-top: 5px;
} */


#pswd_info {
    position: absolute;
    bottom: -75px;
    bottom: -115px\9;
    /* IE Specific */
    right: 55px;
    width: 250px;
    padding: 15px;
    background: #fefefe;
    font-size: .875em;
    border-radius: 5px;
    box-shadow: 0 1px 3px #ccc;
    border: 1px solid #ddd;
}

#pswd_info h4 {
    margin: 0 0 10px 0;
    padding: 0;
    font-weight: normal;
}

#pswd_info::before {
    content: "\25B2";
    position: absolute;
    top: -12px;
    left: 45%;
    font-size: 14px;
    line-height: 14px;
    color: #ddd;
    text-shadow: none;
    display: block;
}

.invalid {
    /* background:url(../images/invalid.png) no-repeat 0 50%; */
    padding-left: 22px;
    line-height: 24px;
    color: #ec3f41;
}

.valid {
    /* background:url(../images/valid.png) no-repeat 0 50%; */
    padding-left: 22px;
    line-height: 24px;
    color: #3a7d34;
}

#pswd_info {
    display: none;
}
</style>
<!DOCTYPE html>
<html>

<head>
    <title>Password Verification</title>
</head>

<body>
    <div id="container">
        <h1>Password Verification</h1>
        <form>
            <ul>
                <li>
                    <label for="username">Username:</label>
                    <span><input id="username" name="username" type="text" /></span>
                </li>
                <li>
                    <label for="pswd">Password:</label>
                    <span><input id="pswd" type="password" name="pswd" /></span>
                </li>
                <li>
                    <button type="submit">Register</button>
                </li>
            </ul>
        </form>
        <div id="pswd_info">
            <h4>Password must meet the following requirements:</h4>
            <ul>
                <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                <li id="number" class="invalid">At least <strong>one number</strong></li>
                <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
            </ul>
        </div>
    </div>
</body>

</html>
<script>
$(document).ready(function() {
    $('input[type=password]').keyup(function() {
        // keyup code here

        // set password variable
        var pswd = $("#pswd").val();
        //validate the length

        if (pswd.length < 8) {
            $('#length').removeClass('valid').addClass('invalid');
            var error = 0;
        } else {
            $('#length').removeClass('invalid').addClass('valid');
            var error = 1;
        }
        //validate letter
        if (pswd.match(/[A-z]/)) {
            $('#letter').removeClass('invalid').addClass('valid');
            var error1 = 1;
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
            var error1 = 0;
        }

        //validate capital letter
        if (pswd.match(/[A-Z]/)) {
            $('#capital').removeClass('invalid').addClass('valid');
            var error2 = 1;
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
            var error2 = 0;
        }

        //validate number
        if (pswd.match(/\d/)) {
            $('#number').removeClass('invalid').addClass('valid');
            var error3 = 1;
        } else {
            $('#number').removeClass('valid').addClass('invalid');
            var error3 = 0;
        }
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#pswd_info').hide();
        }else{
            $('#pswd_info').show();
        }
        // alert(error+'_'+error1+'_'+error2+'_'+error3);

    }).focus(function() {
        $('#pswd_info').show();
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#pswd_info').hide();
        } else {
            $('#pswd_info').show();
        }
    }).blur(function() {
        $('#pswd_info').hide();
        if (error == 1 && error1 == 1 && error2 == 1 && error3 == 1) {
            $('#pswd_info').hide();
        } else {
            $('#pswd_info').show();
        }
    });

});
</script>