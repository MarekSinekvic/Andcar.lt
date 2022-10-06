<div <?php if ($_SESSION["IsLoggedIn"]) echo "hidden"; ?> id="login">
    <h2 style="width: 90%; float:left;">Login</h2><button onclick="$('#login').hide()" style="float: right; background:none; border:none; font-size: 19px;">X</button>
    <form>
        <input type="text" hidden name="id" value="<?php echo $_GET['id']; ?>">
        <input type="text" name="login-email" placeholder="Email"><br />
        <input type="text" name="login-password" placeholder="Password"><br />
        <input type="submit" name="login" value="Login"><input type="button" onclick="$('#login').hide(); $('#registration').show()" value="Register">
    </form>
</div>