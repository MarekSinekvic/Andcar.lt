<?php
include("../main.php");
if (!isset($_GET["id"])) {
    header("http://andcar.lt");
}
if ($_SESSION['Name'] != "Seller")
    header("http://andcar.lt");
$imageId = 0;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- <script src='main.js'></script> -->
</head>

<body>
    <?php
    include("../header.php");
    ?>
    <hr /><br /><br />
    <content>
        <?php
        $cars->data_seek(intval($_GET['id']));
        $data = $cars->fetch_array();
        $imagesLinks = explode(';', $data[3]);
        ?>
        <div id="car-info">
            <?php
            $cars->data_seek(intval($_GET['id']));
            $data = $cars->fetch_array();
            $imagesLinks = explode(';', $data[3]);
            ?>
            <div id="car-parameters" style="width: 30%">
                <span class="left-block-names"><?php echo translateTextEng("Mark", $mainDbHandler)[0][0]; ?> <span class="right-block-names">
                        <input type="text" name="car-mark" form="newCarSendForm" class="values-block-editor" id="car-mark-editor" hidden onkeydown="applyInputTo('#car-mark-editor','#car-mark-info')" value="Mark">
                        <span id="car-mark-info" ondblclick="swapHiddenElements('#car-mark-editor','#car-mark-info')">Mark</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Model", $mainDbHandler)[0][0]; ?> <span class="right-block-names">
                        <input type="text" name="car-model" form="newCarSendForm" class="values-block-editor" id="car-model-editor" hidden onkeydown="applyInputTo('#car-model-editor','#car-model-info')" value="Model">
                        <span id="car-model-info" ondblclick="swapHiddenElements('#car-model-editor','#car-model-info')">Model</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Body type", $mainDbHandler)[0][0] ?><span class="right-block-names">
                        <input type="text" name="car-bodyType" form="newCarSendForm" class="values-block-editor" id="car-bodytype-editor" hidden onkeydown="applyInputTo('#car-bodytype-editor','#car-bodytype-info')" value="Body type">
                        <span id="car-bodytype-info" ondblclick="swapHiddenElements('#car-bodytype-editor','#car-bodytype-info')">Body type</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Fuel type", $mainDbHandler)[0][0] ?><span class="right-block-names">
                        <input type="text" name="car-fuelType" form="newCarSendForm" class="values-block-editor" id="car-fueltype-editor" hidden onkeydown="applyInputTo('#car-fueltype-editor','#car-fueltype-info')" value="Fuel type">
                        <span id="car-fueltype-info" ondblclick="swapHiddenElements('#car-fueltype-editor','#car-fueltype-info')">Fuel type</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Country / Town", $mainDbHandler)[0][0]; ?><span class="right-block-names">
                        <input type="text" name="car-townCountry" form="newCarSendForm" class="values-block-editor" id="car-towncountry-editor" hidden onkeydown="applyInputTo('#car-towncountry-editor','#car-towncountry-info')" value="Страна / город">
                        <span id="car-towncountry-info" ondblclick="swapHiddenElements('#car-towncountry-editor','#car-towncountry-info')">Страна / город</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Car year", $mainDbHandler)[0][0] ?><span class="right-block-names">
                        <input type="text" name="car-yearOfAuto" form="newCarSendForm" class="values-block-editor" id="car-yearofauto-editor" hidden onkeydown="applyInputTo('#car-yearofauto-editor','#car-yearofauto-info')" value="Год автомобиля">
                        <span id="car-yearofauto-info" ondblclick="swapHiddenElements('#car-yearofauto-editor','#car-yearofauto-info')">Год автомобиля</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Gearbox", $mainDbHandler)[0][0];  ?><span class="right-block-names">
                        <input type="text" name="car-gearbox" form="newCarSendForm" class="values-block-editor" id="car-gearbox-editor" hidden onkeydown="applyInputTo('#car-gearbox-editor','#car-gearbox-info')" value="Коробка передач">
                        <span id="car-gearbox-info" ondblclick="swapHiddenElements('#car-gearbox-editor','#car-gearbox-info')">Коробка передач</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Colour", $mainDbHandler)[0][0]; ?><span class="right-block-names">
                        <input type="text" name="car-color" form="newCarSendForm" class="values-block-editor" id="car-color-editor" hidden onkeydown="applyInputTo('#car-color-editor','#car-color-info')" value="Цвет">
                        <span id="car-color-info" ondblclick="swapHiddenElements('#car-color-editor','#car-color-info')">Цвет</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Engine", $mainDbHandler)[0][0]; ?><span class="right-block-names">
                        <input type="text" name="car-engine" form="newCarSendForm" class="values-block-editor" id="car-engine-editor" hidden onkeydown="applyInputTo('#car-engine-editor','#car-engine-info')" value="Двигатель">
                        <span id="car-engine-info" ondblclick="swapHiddenElements('#car-engine-editor','#car-engine-info')">Двигатель</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Drive wheels", $mainDbHandler)[0][0] ?><span class="right-block-names">
                        <input type="text" name="car-drivingWheels" form="newCarSendForm" class="values-block-editor" id="car-drivingwheels-editor" hidden onkeydown="applyInputTo('#car-drivingwheels-editor','#car-drivingwheels-info')" value="Ведущие колёса">
                        <span id="car-drivingwheels-info" ondblclick="swapHiddenElements('#car-drivingwheels-editor','#car-drivingwheels-info')">Ведущие колёса</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Defects", $mainDbHandler)[0][0]; ?><span class="right-block-names">
                        <input type="text" name="car-defects" form="newCarSendForm" class="values-block-editor" id="car-defects-editor" hidden onkeydown="applyInputTo('#car-defects-editor','#car-defects-info')" value="Дефекты">
                        <span id="car-defects-info" ondblclick="swapHiddenElements('#car-defects-editor','#car-defects-info')">Дефекты</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Steering position", $mainDbHandler)[0][0] ?><span class="right-block-names">
                        <input type="text" name="car-steeringWheels" form="newCarSendForm" class="values-block-editor" id="car-SteeringWheelPosition-editor" hidden onkeydown="applyInputTo('#car-SteeringWheelPosition-editor','#car-SteeringWheelPosition-info')" value="Положение руля">
                        <span id="car-SteeringWheelPosition-info" ondblclick="swapHiddenElements('#car-SteeringWheelPosition-editor','#car-SteeringWheelPosition-info')">Положение руля</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Mass", $mainDbHandler)[0][0]; ?><span class="right-block-names">
                        <input type="number" name="car-mass" form="newCarSendForm" class="values-block-editor" id="car-mass-editor" hidden onkeydown="applyInputTo('#car-mass-editor','#car-mass-info')" value="0">
                        <span id="car-mass-info" ondblclick="swapHiddenElements('#car-mass-editor','#car-mass-info')">Масса</span><br /></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Date added", $mainDbHandler)[0][0] ?><span class="right-block-names"><?php echo $data[2]; ?></span></span>
                <span class="left-block-names"><?php echo translateTextEng("Price", $mainDbHandler)[0][0]; ?><span class="right-block-names">
                        <input type="number" name="car-price" form="newCarSendForm" class="values-block-editor" id="car-price-editor" hidden onkeydown="applyInputTo('#car-price-editor','#car-price-info')" value="0">
                        <span id="car-price-info" ondblclick="swapHiddenElements('#car-price-editor','#car-price-info')">0</span><br /></span></span>

            </div>
            <div id="car-images" style="width: 70%">
                <!-- How so stupid? -->
                <input type="text" name="car-name" form="newCarSendForm" id="car-name-editor" hidden onkeydown="applyInputTo('#car-name-editor','#car-name')" value="Name">
                <div id="car-name" ondblclick="swapHiddenElements('#car-name-editor','#car-name')"><?php echo translateTextEng("Name",$mainDbHandler)[0][0]; ?></div>


                <div id="images-preview">
                    <!-- <img src="Images/leftarrow.svg" alt="Leftarrow" class="arrow"> -->
                    <img id="mainPreviewImage" src="../Images/NoImage.svg" alt=" CarImage">
                    <!-- <img src="Images/leftarrow.svg" alt="RightArrow" class="arrow" style="transform: rotate(180deg)"> -->
                </div>
                <style>
                    #cars-mini-preview {
                        display: flex;
                        flex-direction: column;
                        margin: 10px 0px;
                        width: 100%;
                    }
                    #preview-images {
                        display: flex;
                    }
                </style>
                <div id="cars-mini-preview">
                    <div id="preview-images">
                    </div>
                    <div>
                        <input type="file" name="imagesToUpload[]" form="newCarSendForm" value="Add image" multiple accept=".jpg, .jpeg, .png" id="imageAdder">
                        <input type="button" value="Add video" onclick="var videoUrl = prompt('Write video URL'); addNewVideoToPreview(videoUrl);">
                        <input type="button" value="Clear" onclick='$("#preview-images")[0].innerHTML = "";'>
                    </div>
                    <script>
                        $("#imageAdder").on("change",(e)=>{
                            addImages($("#imageAdder")[0].files);
                        });
                        let videosCount = 0;
                        function addNewVideoToPreview(url) {
                            let visualLabel = jQuery("<label>", {for:"videoUrl"+videosCount});
                            let video = jQuery("<input>",{id:"videoUrl"+videosCount,value:url,hidden:"",name:"videosToUpload[]", form:"newCarSendForm"});
                            let iframe = jQuery("<iframe>",{src:url});
                            visualLabel.append(iframe);
                            $("#preview-images").append(visualLabel);
                            $("#preview-images").append(video);
                            videosCount++;
                        }
                        function addNewImageToPreview(src) {
                            let img = jQuery("<img>",{src:src,alt:"preview-image",name:"image-to-save",form:"newCarSendForm"});
                            $("#preview-images").append(img);
                        }
                        function addImages(images) {
                            $("#preview-images")[0].innerHTML = "";
                            for (let i = 0; i < images.length; i++) {
                                const image = images[i];
                                let reader = new FileReader();
                                reader.onload = (e) => {
                                    addNewImageToPreview(reader.result);
                                };
                                reader.readAsDataURL(image);    
                            }
                        }
                    </script>
                    <!-- <img src="Images/CarPreview1.jpg" alt="CarImage" onclick='changeMainPreviewImageOn("Images/CarPreview1.jpg")'>
                    <img src="Images/CarPreview2.jpg" alt="CarImage" onclick='changeMainPreviewImageOn("Images/CarPreview2.jpg")'>
                    <img src="Images/CarPreview3.jpg" alt="CarImage" onclick='changeMainPreviewImageOn("Images/CarPreview3.jpg")'>
                    <img src="Images/CarPreview4.jpg" alt="CarImage" onclick='changeMainPreviewImageOn("Images/CarPreview4.jpg")'>
                    <img src="Images/CarPreview5.jpg" alt="CarImage" onclick='changeMainPreviewImageOn("Images/CarPreview5.jpg")'> -->
                </div>
            </div>
        </div>
        <div id="car-description" style="margin-left: 10px">
            <h2 style="color: rgb(76, 56, 254); font-family: Arial, Helvetica, sans-serif;"><?php echo translateTextEng("Description",$mainDbHandler)[0][0]; ?></h2>
            <textarea form="newCarSendForm" style="font-size: 18px" name="car-description" id="car-description" cols="60" rows="8"></textarea>
        </div><br />
        <form method="post" id="newCarSendForm" enctype="multipart/form-data">
            <input type="submit" id="add-car" name="AddNewCar" value="<?php echo translateTextEng("Add new car",$mainDbHandler)[0][0]; ?>">
        </form>
        <script>
            $("#newCarSendForm, input").bind("keypress keydown keyup", (e) => {
                (e.keyCode == 13) ? e.preventDefault(): 0;
            });
        </script>

    </content>
    <script>
        function addNewCarToDB() {
            let files = [];
            $(".imgUpload").each((i, e) => {
                if (i < $(".imgUpload").length - 1) {
                    files.push(e.value);
                }
            });
            $.post("CarCreater.php", {
                AddNewCar2: "",
                files: files
            }, (data) => {
                console.log(data);
            });
        }
    </script>
    <script>
        function swapHiddenElements(elem1, elem2) {
            if ($(elem1).is(":hidden")) {
                $(elem1).removeAttr("hidden");
                $(elem2).attr("hidden", true);
                if ($(elem1).is("input")) {
                    $(elem1).focus();
                }
            } else {
                $(elem1).attr("hidden", true);
                $(elem2).removeAttr("hidden");
                if ($(elem2).is("input")) {
                    $(elem2).focus();
                }
            }
        }

        function applyInputTo(inputName, target) {
            $(inputName).keydown(function(event) {
                console.log(event);
                if (event.keyCode == 13) {
                    $(target).html($(inputName).val());
                    swapHiddenElements(inputName, target);
                }
            });
        }
    </script>
</body>

</html>
<?php
if (isset($_POST["AddNewCar"])) {
    $id = $mainDbHandler->query("select * from `cars`")->num_rows;
    $date = date("Y.m.d G:i:s");

    $newCar = new Car(
        $_POST['car-name'],
        $_POST['car-mark'],
        $_POST['car-model'],
        $_POST['car-bodyType'],
        $_POST['car-fuelType'],
        $_POST['car-description'],
        $_POST['car-price']
    );

    $imagePaths = array();
    $photosNames = $_FILES["imagesToUpload"]["name"];
    $photosPaths = $_FILES["imagesToUpload"]["tmp_name"];
    for ($i = 0; $i < count($photosNames); $i++) {
        $explodedName = explode('.', $photosNames[$i]);
        $extension = $explodedName[count($explodedName) - 1];

        $path = "Car" . (count(scandir("../Cars/Images")) - 2) . "." . $extension;
        array_push($imagePaths, $path);
        copy($photosPaths[$i], "../Cars/Images/" . $path);
    }

    $imageFullPath = implode(";", $imagePaths);

    $town = explode("/", $_POST["car-townCountry"])[0];
    $country = explode("/", $_POST["car-townCountry"])[1];

    $videoPathsArr = array();
    for ($i = 0; $i < count($_POST["videosToUpload"]); $i++) {
        array_push($videoPathsArr,$_POST["videosToUpload"][$i]);
    }
    $videosPaths = implode(";",$videoPathsArr);

    $sqlRequest = "INSERT INTO `cars`(`ID`, `Name`, `Date`, `ImageLink`, `VideosLinks`, `Price`, `Mark`, `Model`, `Body_type`, `Fuel_type`, `Description`, `Town`, `Country`, `AutoYear`, `GearBox`, `Color`, `Engine`, `DrivingWheels`, `Defects`, `SteeringWheelPosition`, `Mass`) VALUES 
        ({$id},'{$_POST["car-name"]}','$date','{$imageFullPath}','{$videosPaths}',{$_POST["car-price"]},'{$_POST["car-mark"]}','{$_POST["car-model"]}','{$_POST["car-bodyType"]}','{$_POST["car-fuelType"]}','{$_POST["car-description"]}','{$country}','{$town}',
        '{$_POST["car-yearOfAuto"]}','{$_POST["car-gearbox"]}','{$_POST["car-color"]}','{$_POST["car-engine"]}','{$_POST["car-drivingWheels"]}','{$_POST["car-defects"]}','{$_POST["car-steeringWheels"]}',{$_POST["car-mass"]})";
    // echo $sqlRequest;

    $mainDbHandler->query($sqlRequest);
}
if (isset($_FILES['newImg'])) {
    var_dump($_FILES['newImg']);
}
?>