<style>
    #login-form {
        font-size: 1.5em;
        padding: 20px;
        width: 21em;
    }

    #login_email {
        margin-left: 1em;
    }

    #login_pin {
        margin-left: 1.46em;
    }

    input[type="text"] {
        font-size: 1.5em;
        display: inline-block;
    }

    input[type="submit"] {
        display: block;
        position: relative;
        margin-left: 13.8em;
        clear: both;
    }
</style>
<div id="login-form">
<?php

    $login_email = array(
        'id' => "login_email",
        'name' => "login_email",
        'placeholder' => "you@email.com",
    );

    $login_pin = array(
        'id' => "login_pin",
        'name' => "login_pin",
        'placeholder' => "1234",
    );

    echo form_open("/login/authenticate");
    echo form_fieldset('Log in');
    echo form_label("Email", $login_email['name']);
    echo form_input($login_email);
    echo "<br />";
    echo form_label("PIN", $login_pin['name']);
    echo form_input($login_pin);

    echo form_submit("Login", "Login");
    echo form_fieldset_close();
    echo form_close();
?>
</div>