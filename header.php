<?php
// include("main.php");
?>
<style>
    * {
        margin: 0px 0px;
        padding: 0px 0px;
        cursor: default;
    }

    a {
        text-decoration: none;
        color: black;
    }

    body {
        background-color: rgb(245, 245, 245);
    }

    header {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    header {
        display: flex;
        justify-content: flex-start;
        flex-direction: row;
        padding: 0px 0px;
        width: 100%;
        height: 60px;
    }

    header #title {
        font-size: 33px;
        margin-left: 50px;
    }

    #navigation-board {
        margin: 0px 0px 0px 90px;
        display: flex;
        align-items: center;
        text-align: center;
    }

    #navigation-board>span {
        border-right: 1px solid rgb(202, 202, 202);

        padding: 16px 30px;
        width: 150px;
    }

    #navigation-board a {
        font-size: 22px;
    }

    #navigation-board>span:hover {
        background-color: rgb(202, 202, 202);
    }

    #navigation-board>span:last-child {
        border: none;
    }



    #left-part {
        display: flex;
        width: 50%;
        height: 100%;
        align-items: center;
    }

    #right-part {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 50%;
        height: 100%;
        margin-right: 30px;
    }
</style>
<style>
    #registration,
    #login {
        font-family: 'Segoe UI',
            Tahoma,
            Geneva,
            Verdana,
            sans-serif;
    }

    #registration {
        position: fixed;
        left: 38%;
        top: 40%;
        background-color: rgb(255, 255, 255);
        color: rgb(76, 56, 254);
        box-shadow: 0px 0px 12px 0px rgb(0, 0, 0);
        padding: 15px 50px;
        border-radius: 10px;
        z-index: 100;
    }

    #registration input[type=text] {
        width: 200px;
        font-size: 18px;
    }

    #registration input[type=submit] {
        min-width: 100px;
        margin-top: 10px;
        font-size: 16px;
    }

    #login {
        position: fixed;
        left: 38%;
        top: 40%;
        background-color: rgb(255, 255, 255);
        color: rgb(76, 56, 254);
        box-shadow: 0px 0px 12px 0px rgb(0, 0, 0);
        padding: 15px 50px;
        border-radius: 10px;
        z-index: 100;
    }

    #login input[type=text] {
        width: 200px;
        font-size: 18px;
    }

    #login input[type=submit] {
        min-width: 100px;
        margin-top: 10px;
        font-size: 16px;
    }

    #login input[type=button] {
        min-width: 100px;
        margin-top: 10px;
        font-size: 16px;
    }
</style>
<style>
    .language {
        width: 40px;
        border: 2px solid rgb(202, 202, 202);
        margin-right: 10px;
    }

    #language-select:hover #selectors {
        display: block;
        opacity: 1;
        top: auto;
    }

    #selectors {
        position: absolute;
        transition: 0.5s;
        opacity: 0;
        top: -100px;
        /* display: none; */
    }
</style>
<style>
    #user-panel {
        position: relative;
    }

    #user-panel img {
        width: 32px;
        height: 32px;
        align-self: center;
    }

    #user_dropdown_menu {
        display: flex;
        flex-direction: column;
        position: absolute;
        --wid: 110px;
        width: var(--wid);
        text-align: center;
        background-color: rgb(245, 245, 245);
        border: 1px solid rgb(160, 160, 160);
        box-shadow: 0px 0px 20px -8px rgb(0, 0, 0);
        border-radius: 3px;
        left: -46px;
        opacity: 0;
        transition: 0.5s opacity;
        top: -200px;
        padding: 1px;
    }

    #user_dropdown_menu input {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        height: 30px;
        align-self: center;
        width: 100%;
    }

    <?php
    if ($_SESSION["IsLoggedIn"]) {
        echo "#user-panel:hover #user_dropdown_menu {
                opacity: 1;
                top: 50px;
            }";
    }
    ?>#user_dropdown_menu input {
        padding: 4px;
        border: none;
        background-color: rgb(245, 245, 245);
    }

    #user_dropdown_menu input:hover {
        background-color: rgb(255, 255, 255);
    }

    #user-logo {
        display: flex;
        flex-direction: column;
        text-align: center;
    }
</style>
<header>
    <div id="left-part">
        <div id="title">
            <div id="logo"></div>
            <div id="name">Andcar</div>
        </div>
        <div id="navigation-board">
            <style>
                #Home {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                #Home a {
                    display: flex;
                    align-items: center;
                    font-size: 18px;
                    gap: 8px;
                }
            </style>
            <span id="Home"><a href="http://andcar.lt/"><img src="Images/Home.svg" height="30" /> <?php echo translateTextEng("Home",$mainDbHandler)[0][0]; ?></a></span>
            <span id="Home"><a href="http://andcar.lt/"><img src="Images/Search.svg" height="30" /> <?php echo translateTextEng("Search",$mainDbHandler)[0][0]; ?></a></span>
            <!-- <span id="write_to_seller_link"><a href="http://andcar.lt/">Chat</a></span> -->
        </div>
    </div>
    <div id="right-part">
        <div id="language-select" style="margin-right: 8px;">
            <img class="language unhidden" onclick='document.cookie = "language=Lithuanian"; window.location.reload()' src="http://andcar.lt/Images/Lithuania.png" alt="Lithuanian">
            <div id="selectors">
                <img class="language" onclick='document.cookie = "language=Russian"; window.location.reload()' src="http://andcar.lt/Images/Russia.png" alt="Russia"><br />
                <img class="language" onclick='document.cookie = "language=English"; window.location.reload()' src="http://andcar.lt/Images/english.jpg" alt="English">
            </div>
        </div>
        <style>
            #fastmessages img:hover #fastmessages-dropdown-menu {
                display: none;
            }
            #fastmessages-dropdown-menu {
                 position: absolute;
                background-color: rgba(240,210,210,0.9);
                padding: 10px;
                border-radius: 5px;
                opacity:1; 
            }
        </style>
        <?php
            if ($_SESSION['IsLoggedIn']) {
        ?>
        <div id="fastmessages" style="margin-right: 10px">
            <img id="fastmessages-img" src="Images/mail.svg" alt="mail" width="40">
            <div id="fastmessages-dropdown-menu">
                <?php 
                    $sqlReq = "SELECT * FROM `chat` WHERE `TargetSendID`=".$_SESSION['ID']." and `IsReaded`=0";
                    $messages = $mainDbHandler->query($sqlReq)->fetch_all();
                    
                    for ($i = 0; $i < count($messages)-3; $i++) {
                        $senderID = $messages[$i][2];
                        $senderName = $mainDbHandler->query("select `Name` from `users` where `ID`=".$senderID)->fetch_all()[0][0];
                        $carID = $messages[$i][5];

                        echo <<<Message
                            <div class="fastmessage">
                                <a href="http://andcar.lt/CarPage/index.php?id={$carID}">{$senderName}</a>
                            </div>
Message;
                    }
                ?>
                <!-- <div>Messafsffege1</div>
                <div>Message2</div>
                <div>asgaegasg</div> -->
            </div>
        </div>
        <?php } ?>
        <div id="user-panel">
            <div id="user-logo">
                <img <?php if (!$_SESSION['IsLoggedIn']) echo "onclick='$(\"#login\").show()'"; ?> id="logo" src="http://andcar.lt/Images/UserLogo.svg" alt="user">
                <span id="name"><?php if ($_SESSION['IsLoggedIn']) echo $_SESSION["Name"]; ?></span>
            </div>
            <div id="user_dropdown_menu">
                <!-- <input type="submit" value="<?php echo translateTextEng("Messages",$mainDbHandler)[0][0]; ?>">
                <hr /> -->
                <a href="#"><input type="submit" value="<?php echo translateTextEng("Favourite",$mainDbHandler)[0][0]; ?>"></a>
                <hr />
                <input type="submit" form="logout" name="logout" value="<?php echo translateTextEng("Logout",$mainDbHandler)[0][0]; ?>">
                <?php
                if ($_SESSION["Name"] == "Seller") {
                    echo '<hr/><a href="http://andcar.lt/AdminPage/"><input type="submit" value="' . translateTextEng("New car",$mainDbHandler)[0][0] . '"/></a>';
                }
                ?>
            </div>
        </div>
        <form id="logout"></form>
        <?php

        if ($_GET['logout']) {
            logout();
            replaceUrlOn('http://andcar.lt/');
        }
        ?>
    </div>
</header>
<div hidden id="registration">
    <h2 style="width: 90%; float:left;"><?php echo translateTextEng("Registration",$mainDbHandler)[0][0]; ?></h2><button onclick="$('#registration').hide()" style="float: right; background:none; border:none; font-size: 19px;">X</button>
    <form>
        <input type="text" hidden name="id" value="<?php echo $_GET['id']; ?>">
        <input type="text" name="register-name" placeholder="<?php echo translateTextEng("Name",$mainDbHandler)[0][0]; ?>"><br />
        <input type="text" name="register-email" placeholder="<?php echo translateTextEng("Email",$mainDbHandler)[0][0]; ?>"><br />
        <input type="text" onkeypress="" id="password" name="register-password" placeholder="<?php echo translateTextEng("Password",$mainDbHandler)[0][0]; ?>"><br />
        <input type="text" onkeypress="" id="confirmPassword" placeholder="<?php echo translateTextEng("Confirm password",$mainDbHandler)[0][0]; ?>"><br />
        <!-- <div class="g-recaptcha" data-sitekey="6LdkOJAcAAAAAG9GSzOLSV5DDJbO6eZNNFFfArJc"></div> -->
        <input type="submit" name="register" value="<?php echo translateTextEng("Create",$mainDbHandler)[0][0]; ?>"><br />
        <?php

        if (isset($_GET['register'])) {
            echo register($_GET["register-name"], $_GET['register-email'], $_GET['register-password'], $mainDbHandler);
        }
        ?>
    </form>
</div>
<div <?php if ($_SESSION["IsLoggedIn"]) echo "hidden"; ?> id="login">
    <h2 style="width: 90%; float:left;"><?php echo translateTextEng("Login",$mainDbHandler)[0][0]; ?></h2><button onclick="$('#login').hide()" style="float: right; background:none; border:none; font-size: 19px;">X</button>
    <form>
        <input type="text" hidden name="id" value="<?php echo $_GET['id']; ?>">
        <input type="text" name="login-email" placeholder="<?php echo translateTextEng("Email",$mainDbHandler)[0][0] . " / " . translateTextEng("Login",$mainDbHandler)[0][0]; ?>"><br />
        <input type="text" name="login-password" placeholder="<?php echo translateTextEng("Password",$mainDbHandler)[0][0]; ?>"><br />
        <input type="submit" name="login" value="<?php echo translateTextEng("Login",$mainDbHandler)[0][0]; ?>"><input type="button" onclick="$('#login').hide(); $('#registration').show()" value="<?php echo translateTextEng("Registration",$mainDbHandler)[0][0]; ?>">
    </form>
    <?php
    if (isset($_GET['login'])) {
        $loginData = login($_GET['login-email'], $_GET['login-password'], $mainDbHandler);
        if ($loginData == "You succesfuly logged in")
            replaceUrlOn('http://andcar.lt');
        else
            echo $loginData;
    }
    ?>
</div>

<?php
if ($_GET['logout']) {
    logout();
    replaceUrlOn('http://andcar.lt/');
}
?>