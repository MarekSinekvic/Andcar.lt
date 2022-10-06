<?php
include "main.php";

function getMessageHistoryWith($receiverId, $senderId, $carId, $dbHandler)
{
    $senderUserData = getUserById($senderId, $dbHandler);
    $receiverUserData = getUserById($receiverId, $dbHandler);

    $sql = "SELECT * FROM `chat` WHERE `CarID`={$carId} AND ((`SenderUserID`,`TargetSendID`)=($senderId,$receiverId) OR (`SenderUserID`,`TargetSendID`)=($receiverId,$senderId))";
    $chatWithUser = $dbHandler->query($sql);

    $history = "";
    for ($i = 0; $i < $chatWithUser->num_rows; $i++) {
        $chatWithUser->data_seek($i);
        $message = $chatWithUser->fetch_array();

        $senderData = getUserById($message["SenderUserID"], $dbHandler);
        $receiverData = getUserById($message["TargetSendID"], $dbHandler);

        $history = $history . $senderData["Name"] . ">" . $receiverData["Name"] . ":";
        $history = $history . $message['Text'] . ";";
    }
    return $history;
}

if (isset($_GET['selectedNewUser'])) {
    /*$carId = $_GET['carID'];
    $senderId = $_GET['senderID'];
    $receiverId = $_GET['receiverID'];

    $senderUserData = getUserById($senderId, $mainDbHandler);
    $receiverUserData = getUserById($receiverId, $mainDbHandler);

    // echo $_GET["senderID"] . " -> " . $_GET['receiverID'];
    $sql = "SELECT * FROM `chat` WHERE `CarID`={$carId} AND ((`SenderUserID`,`TargetSendID`)=($senderId,$receiverId) OR (`SenderUserID`,`TargetSendID`)=($receiverId,$senderId))";
    $chatWithUser = $mainDbHandler->query($sql);
    for ($i = 0; $i < $chatWithUser->num_rows; $i++) {
        $chatWithUser->data_seek($i);
        $message = $chatWithUser->fetch_array();

        echo $senderUserData["Name"] . ">" . $receiverUserData["Name"] . ":";
        echo $message['Text'] . ";";
    }*/
    echo getMessageHistoryWith($_GET['receiverID'], $_GET['senderID'], $_GET["carID"], $mainDbHandler);
}
if (isset($_GET['sendedMessage'])) {
    $carId = $_GET['id'];
    $senderId = $_GET['senderID'];
    $receiverId = $_GET['receiverID'];
    $message = $_GET["message"];

    // $userData = $mainDbHandler->query("select * from `users` where `ID`=" . $senderId);
    // $userData = $userData->fetch_array();


    sendMessage($message, $receiverId, $mainDbHandler);
    echo getMessageHistoryWith($_GET['receiverID'], $_GET['senderID'], $_GET["id"], $mainDbHandler);
}
