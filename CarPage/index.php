<?php
// include("../ReCaptcha.php");
if (!isset($mainDbHandler))
    include("../main.php");
if (!isset($_GET["id"])) {
    header("http://andcar.lt");
} else {
    $mainDbHandler->query("UPDATE `cars` SET `ClicksCount`=`ClicksCount`+1 WHERE `ID`=" . $_GET['id']);
}
$imageId = 0;
$sellerIP = "127.0.0.1";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Andcar</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='header.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='content.css'>
    <!-- <script src='main.js'></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
    <style>
        .half-division {
            display: flex;
            flex-direction: row;
            gap: 22px;
        }
    </style>
    <!-- <header>
        <div id="title">
            <div id="logo"></div>
            <div id="name">Andcar</div>
        </div>
        <div id="navigation-board">
            <span id="Home"><a href="http://andcar.lt/">Home</a></span>
            <span id="write_to_seller_link"><a href="http://andcar.lt/">Chat</a></span>
        </div>
        <div id="login-panel">
            <?php
            if ($_SESSION['IsLoggedIn']) {
                $carID = $_GET['id'];
                $carIdInput = '<input type="text" hidden name="id" value="' . $carID . '">';
                echo $_SESSION["Name"] . " <form>" . $carIdInput . "<input type='submit' name='logout' value='Logout'></form>";
            } else {
                echo "<input id='login-button' type='button' value='Login' onclick='$(\"#login\").show()'>";
            }
            ?>
        </div>
    </header> -->
    <?php
    include("../header.php");
    ?>
    <hr /><br />
    <content>
        <?php
        $cars->data_seek(intval($_GET['id']));
        $data = $cars->fetch_array();
        $imagesLinks = explode(';', $data[3]);
        ?>
        <div id="car-info">
            <div id="car-parameters" style="width: 30%">
                <span class="left-block-names"><?php echo translateTextEng("Mark", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[6]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Model", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[7]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Body type", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[8]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Fuel type", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[9]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Country / Town", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[11]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Car year", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[13]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Gearbox", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[14]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Colour", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[15]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Engine", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[16]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Drive wheels", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[17]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Defects", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[18]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Steering position", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[19]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Mass", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[20]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Date added", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[2]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Price", $mainDbHandler)[0][0]; ?><span class="right-block-names"><?php echo $data[5]; ?></span></span>
            </div>
            <div id="car-images" style="width: 70%">
                <div id="car-name"><?php echo $data[1]; ?></div>
                <div id="images-preview">
                    <!-- <img src="Images/leftarrow.svg" alt="Leftarrow" class="arrow"> -->
                    <img id="mainPreviewImage" src="../Cars/Images/<?php echo $imagesLinks[$imageId]; ?>" alt="CarImage">
                    <!-- <img src="Images/leftarrow.svg" alt="RightArrow" class="arrow" style="transform: rotate(180deg)"> -->
                </div>
                <div id="cars-mini-preview">
                    <?php
                    for ($i = 0; $i < count($imagesLinks); $i++) {
                        $link = "../Cars/Images/" . $imagesLinks[$i];
                        if ($i == $imageId) { //class='selectedImage' 
                            echo "<img class='prevImg' src=\"$link\" alt=\"CarImage\" onclick='changeMainPreviewImageOn(\"$link\")'>";
                        } else
                            echo "<img class='prevImg' src=\"$link\" alt=\"CarImage\" onclick='changeMainPreviewImageOn(\"$link\")'>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="car-description" style="margin: 15px 0px">
            <h2 style="color: rgb(76, 56, 254); font-family: Arial, Helvetica, sans-serif;"><?php echo translateTextEng("Description", $mainDbHandler)[0][0]; ?></h2>
            <span style="font-size: 18px">
                <?php
                echo $data["Description"];
                ?>
            </span>
        </div><br/>
        <style>
            #social-interaction {
                display: flex;
                justify-content: space-between;
                width: 100%;
            }
            #car-comments {
                display:flex;
                flex-direction: column;
                align-items: flex-end;
            }
        </style>
        <div id="social-interaction">
            <style>
                .review {
                    padding: 5px;
                    margin: 5px;
                    background-color: white;
                    border: 1px solid rgba(100,100,100,1);
                }
                .review-text {
                    margin-left: 10px;
                }
            </style>
            <div id="reviews">
                <h2><?php echo translateTextEng("Reviews", $mainDbHandler)[0][0]; ?></h2>
                <div id="reviews-rect">
                    <?php 
                        $carId = $_GET['id'];
                        $sqlReq = "SELECT * FROM `reviews` WHERE `CarID`='{$carId}'";
                        
                        $reviews = $mainDbHandler->query($sqlReq)->fetch_all(MYSQLI_BOTH);

                        for ($i = 0; $i < count($reviews); $i++) {
                            $userName = $mainDbHandler->query("SELECT `Name` FROM `users` WHERE ID='".$reviews["UserID"]."'")->fetch_array()[0];
                            echo <<<REVIEW
                                <div class="review">
                                    <div class="review-userName">{$userName}</div>
                                    <div class="review-text">{$reviews[$i]['Text']}</div>
                                </div>
REVIEW;
                        }
                    ?>
                </div>
                <form method="GET">
                    <?php 
                        if ($_SESSION["IsLoggedIn"]) {
                            echo '<input type="text" hidden name="id" value="'.$carId.'">';
                            echo '<textarea name="review-text" id="review-text" cols="20" rows="2" placeholder="Text"></textarea>';
                            echo '<br/>';
                            echo '<input id="send-review" type="submit" value="' . translateTextEng("Send review", $mainDbHandler)[0][0] . '" name="send-review">';
                        }
                    ?>
                </form>
            </div>
            <div id="car-comments">
                <h2><?php echo translateTextEng("Write to the seller", $mainDbHandler)[0][0]; ?></h2>
                <style>
                    #requisites {
                        margin-top: 15px;
                        margin-bottom: 30px;
                    }
                </style>
                <div id="requisites">
                    Requisites:
                    <div class="half-division" style="margin-left: 5px">
                        <div>
                            Email: <br/>
                            Tel. number: <br/>
                            Facebook link: <br/>
                        </div>
                        <div style="align-self: flex-end;">
                            loremipsum@gmail.com<br/>
                            +33366516651<br/>
                            facebook.com/user/651561
                        </div>
                    </div>
                </div>
                <div id="chat">
                    <div id="messages" style="margin-bottom: 10px">
                        <?php
                        if ($_SESSION['Name'] != "Seller") {
                            $messagesTable = $mainDbHandler->query("SELECT * FROM `chat` WHERE `CarID`={$_GET['id']} AND (`SenderUserID`={$_SESSION['ID']} OR `TargetSendID`={$_SESSION['ID']})");
                            for ($i = 0; $i < $messagesTable->num_rows; $i++) {
                                $messagesTable->data_seek($i);
                                $message = $messagesTable->fetch_array();
                                if ($message["SenderUserID"] == $_SESSION['ID']) {
                                    $sql = "SELECT * FROM `users` WHERE `ID`={$message["SenderUserID"]}";
                                    $userData = $mainDbHandler->query($sql);
                                    $user = $userData->fetch_array();
                                    echo '<div class="message buyer">
                                            <h3>You</h3>
                                            <span>' . $message["Text"] . '</span>
                                        </div>';
                                } else if ($message["TargetSendID"] == $_SESSION['ID']) {
                                    $sql = "SELECT * FROM `users` WHERE `ID`={$message["SenderUserID"]}";
                                    $userData = $mainDbHandler->query($sql);
                                    $user = $userData->fetch_array();
                                    echo '<div class="message seller">
                                        <h3>' . $user["Name"] . '</h3>
                                        <span>' . $message["Text"] . '</span>
                                    </div>';
                                }
                            }
                        } else {
                            $usersTable = $mainDbHandler->query("SELECT * FROM `chat` WHERE `TargetSendID`=0 AND `CarID`={$_GET['id']} ORDER BY `SenderUserID`"); // 0 id have seller

                            $selectedUser = 0;

                            echo "<div id='seller-table'>";
                            echo "<div id='users-list'>";
                            $lastSenderID = -1;
                            for ($i = 0; $i < $usersTable->num_rows; $i++) {
                                $usersTable->data_seek($i);
                                $userData = $usersTable->fetch_array();
                                if ($lastSenderID != $userData["SenderUserID"]) {
                                    $accountsTable = $mainDbHandler->query("SELECT * FROM `users` WHERE `ID` = " . $userData["SenderUserID"]);
                                    $accountData = $accountsTable->fetch_array();
                                    echo <<<USER
                                        <div class="user" onclick="selectUser({$userData['SenderUserID']}, (data)=>{showChatWithUser(data);})">
                                            <div id="avatar"></div>
                                            <div id="message-info" style="margin-left: 10px">
                                                <div id="user-name">{$accountData['Name']}</div>
                                                <div id="last-user-message">{$userData['Text']}</div> <!-- TODO: Last message + Name -->
                                            </div>
                                        </div>

USER;
                                    $lastSenderID = $userData["SenderUserID"];
                                }
                            }
                            echo "</div>";
                            echo "<div id='user-messages-history'>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>

                    <hr style="margin-bottom: 8px">
                    <div id="messages-sender">
                        <span>
                            <?php
                            if ($_SESSION["IsLoggedIn"] == true) {
                                $carID = $_GET['id'];
                                $carIdInput = '<input type="text" hidden name="id" value="' . $carID . '">';
                                echo $_SESSION["Name"];
                            } else {
                                echo translateTextEng("You are not signed in.", $mainDbHandler)[0][0];
                            }
                            if ($_GET['logout']) {
                                logout();
                                replaceUrlOn('http://andcar.lt/CarPage/index.php?id=' . $_GET['id']);
                            }
                            ?>
                        </span><br />
                        <form method="GET">
                            <?php 
                                if ($_SESSION["IsLoggedIn"]) {
                                    $carId = $_GET['id'];
                                    echo '<input type="text" hidden name="id" value="'.$carId.'">';
                                    echo '<textarea name="message-text" id="message-text" cols="20" rows="2" placeholder="Text"></textarea>';
                                    echo '<br/>';
                                    if ($_SESSION["Name"] == "Seller") {
                                        echo '<input id="send-message" type="button" value="' . translateTextEng("Send message", $mainDbHandler)[0][0] . '" onclick="sendMessage($(\'#message-text\').val())" name="send-message">';
                                    } else {
                                        echo '<input id="send-message" type="submit" value="' . translateTextEng("Send message", $mainDbHandler)[0][0] . '" name="send-message">';
                                    }
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </content>


    <script>
        var selectedUser = -1;

        function changeMainPreviewImageOn(src) {
            document.getElementById("mainPreviewImage").src = src;
        }

        function selectUser(senderId, onsuccess, receiverId = 0) {
            selectedUser = senderId;
            $.ajax({
                url: '/messages.php',
                method: 'get',
                dataType: 'html',
                data: {
                    selectedNewUser: 1,
                    carID: <?php echo $_GET['id']; ?>,
                    senderID: senderId,
                    receiverID: receiverId
                },
                success: function(data) {
                    onsuccess(data);
                }
            });
        }

        function sendMessage(message) {
            if (selectedUser > -1) {
                $.ajax({
                    url: '/messages.php',
                    method: 'get',
                    dataType: 'html',
                    data: {
                        sendedMessage: 1,
                        id: <?php echo $_GET['id']; ?>,
                        senderID: 0,
                        receiverID: selectedUser,
                        message: message
                    },
                    success: function(data) {
                        showChatWithUser(data);
                        console.log(data);
                    }
                });
            }
        }

        function showChatWithUser(data) {
            console.log(data);
            let messages = data.split(';');
            messages.splice(messages.length - 1, 1);
            $("#user-messages-history").empty();
            for (let i = 0; i < messages.length; i++) {
                let senderName = messages[i].split(">")[0];
                let receiverName = messages[i].split(">")[1];
                let nameTextData = receiverName.split(":");

                receiverName = nameTextData[0];
                let text = nameTextData[1];

                let personType = (receiverName == "Seller") ? "seller" : "buyer";

                $("#user-messages-history").append("<div class='message " + personType + "'><h3>" + senderName + "</h3><span>" + text + "</span></div>");
            }
        }
    </script>
</body>

</html>
<?php
if (isset($_GET["send-review"])) {
    $sqlReq = "INSERT INTO `reviews`(`UserID`, `CarID`, `Text`) VALUES ('{$_SESSION['ID']}','{$carId}','{$_GET['review-text']}')";
    $mainDbHandler->query($sqlReq);
    replaceUrlOn('http://andcar.lt/CarPage/index.php?id=' . $_GET['id']);
}
if (isset($_GET['send-message'])) {
    if ($_SESSION["ID"] == 0) {
        // sendMessage($_GET['message-text'], );
    } else {
        sendMessage($_GET['message-text'], 0, $mainDbHandler);
        replaceUrlOn('http://andcar.lt/CarPage/index.php?id=' . $_GET['id']);
    }
}
?>