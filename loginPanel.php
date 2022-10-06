<div hidden id="registration">
    <h2 style="width: 90%; float:left;">Registration</h2><button onclick="$('#registration').hide()" style="float: right; background:none; border:none; font-size: 19px;">X</button>
    <form>
        <input type="text" hidden name="id" value="<?php echo $_GET['id']; ?>">
        <input type="text" name="register-name" placeholder="Name"><br />
        <input type="text" name="register-email" placeholder="Email"><br />
        <input type="text" onkeypress="" id="password" name="register-password" placeholder="Password"><br />
        <input type="text" onkeypress="" id="confirmPassword" placeholder="Confirm password"><br />
        <!-- <div class="g-recaptcha" data-sitekey="6LdkOJAcAAAAAG9GSzOLSV5DDJbO6eZNNFFfArJc"></div> -->
        <input type="submit" name="register" value="Create"><br />
        <?php

        if (isset($_GET['register'])) {
            echo register($_GET["register-name"], $_GET['register-email'], $_GET['register-password'], $mainDbHandler);
        }
        ?>
    </form>
</div>