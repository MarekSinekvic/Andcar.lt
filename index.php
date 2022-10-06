<?php
include "main.php";

$carsCountOnPage = 10;
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
    include("header.php");
    ?>
    <hr />
        <style>
            #search div div div span {
                display: flex;
                align-items: center;
            }
            #authorDescription {
                display: flex;
                justify-content: center;
                font-size: 22px;
                gap: 20px;
                background-color: white;
                margin: 0px 50px;
                margin-top:18px;
                box-shadow: 0px 0px 12px 0px rgb(0, 0, 0);
                border-radius: 5px;
                padding: 20px;
            }
            content {
                display: flex;
                justify-content: center;
            }
            #main-content {
                width: 80%;
                border-right: 1px solid black;
                border-left: 1px solid black;
            }
            .sidebar {
                padding: 8px;
                width: 8%;
            }
        </style>
    <content>
        <div class="sidebar">Left sidebar</div>
        <div id="main-content">
        <div id="authorDescription">
            <div style="width: 50%">
                1test1<br/>
                1test2<br/>
                1test3<br/>
            </div>
            <div style="width: 50%">
                2test1<br/>
                2test2<br/>
                2test3<br/>
            </div>
        </div>
        <div id="search">
            <div style="border-right: 1px solid rgb(158, 158, 158); width: 50%">
                <h2><?php echo translateTextEng("Searcher", $mainDbHandler)[0][0]; ?></h2>
                <div id="search-filter-blocks">
                    <div id="search-filter-left">
                        <span>
                            <?php echo translateTextEng("Mark", $mainDbHandler)[0][0]; ?>
                        </span>
                        <select name="Mark" id="search-mark">
                            <option disabled selected></option>
                            <?php
                            $marks = $mainDbHandler->query("select `Mark` from `cars` GROUP BY `Mark`")->fetch_all();
                            for ($mark = 0; $mark < count($marks); $mark++) {
                                echo "<option>{$marks[$mark][0]}</option>";
                            }
                            ?>
                        </select>

                        <br />
                        <span>
                            <?php echo translateTextEng("Body type", $mainDbHandler)[0][0]; ?>
                        </span>
                        <select name="BodyType" id="search-bodyType">
                            <option disabled selected></option>
                            <?php
                            $bodys = $mainDbHandler->query("select `Body_type` from `cars` GROUP BY `Body_type`")->fetch_all();
                            for ($body = 0; $body < count($bodys); $body++) {
                                echo "<option>{$bodys[$body][0]}</option>";
                            }
                            ?>
                        </select>
                        <br />
                        <span>
                            <?php echo translateTextEng("Price", $mainDbHandler)[0][0]; ?>
                        </span>
                        <span style="display: inline">
                            <input style="width: 45%" id="search-price-from" type="Number" value="<?php echo $_GET["PriceFrom"]; ?>" placeholder="From">
                            <input style="width: 45%" id="search-price-to" type="Number" value="<?php echo $_GET["PriceTo"]; ?>" placeholder="To">
                        </span>
                        <br /><br />
                        <span>
                        <?php echo translateTextEng("Description", $mainDbHandler)[0][0]; ?>
                        </span>
                        <input type="text" placeholder="Search auto">
                    </div>
                    <div id="search-filter-right">
                        <span>
                        <?php echo translateTextEng("Model", $mainDbHandler)[0][0]; ?>
                        </span>
                        <select name="Model" id="search-model">
                            <option disabled selected></option>
                            <?php
                            $models = $mainDbHandler->query("select `Model` from `cars` GROUP BY `Model`")->fetch_all();
                            for ($model = 0; $model < count($models); $model++) {
                                echo "<option>{$models[$model][0]}</option>";
                            }
                            ?>
                        </select>
                        <br />
                        <span>
                            <?php echo translateTextEng("Fuel type", $mainDbHandler)[0][0]; ?>
                        </span>
                        <select name="Fuel_type" id="search-fuelType">
                            <option disabled selected></option>
                            <?php
                            $fuels = $mainDbHandler->query("select `Fuel_type` from `cars` GROUP BY `Fuel_type`")->fetch_all();
                            for ($fuel = 0; $fuel < count($fuels); $fuel++) {
                                echo "<option>{$fuels[$fuel][0]}</option>";
                            }
                            ?>
                        </select>
                        <br /><br />
                        <input type="button" onclick="search()" value="<?php echo translateTextEng("Search", $mainDbHandler)[0][0]; ?>">
                        <input type="button" onclick="cancelSearch()" value="<?php echo translateTextEng("Cancel search", $mainDbHandler)[0][0]; ?>">
                        <script>
                            function cancelSearch() {
                                window.location.replace(convertReqObjToStr(makeGetReqWithout(["IsWithSearch"]))[1]);
                                // console.log(convertReqObjToStr(makeGetReqWithout(["IsWithSearch"]))[1]);
                            }

                            function search() {
                                let priceFrom = $("#search-price-from").val();
                                let priceTo = $("#search-price-to").val();
                                window.location.replace(convertReqObjToStr(makeGetReq({
                                    IsWithSearch: "1",
                                    Mark: $("#search-mark option:selected").text(),
                                    Model: $("#search-model option:selected").text(),
                                    BodyType: $("#search-bodyType option:selected").text(),
                                    FuelType: $("#search-fuelType option:selected").text(),
                                    PriceFrom: (priceFrom == "") ? 0 : priceFrom,
                                    PriceTo: (priceTo == "") ? 999999999999999999 : priceTo,
                                    Description: "0",
                                }))[1]);
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div id="search-right-side" style="width: 50%"></div>
        </div>
        <div id="cars-recommendations-filters">
            <div id="recommendation-filters" style="width: 40%">
                <!-- <div class="recommendation-filter">New</div> -->
                <input class="recommendation-filter" type="button" value="<?php echo translateTextEng("New", $mainDbHandler)[0][0]; ?>" onclick="ApplyRecommendationFilter('New')">
                <input class="recommendation-filter" type="button" value="<?php echo translateTextEng("Popular", $mainDbHandler)[0][0]; ?>" onclick="ApplyRecommendationFilter('Popular')">
                <input class="recommendation-filter" type="button" value="<?php echo translateTextEng("Price", $mainDbHandler)[0][0]; ?>" onclick="ApplyRecommendationFilter('Expensive')">
            </div>
            <div style="width: 60%; border-bottom: 2px solid rgb(199, 199, 199);"></div>
        </div>
        <div id="cars-list">
            <?php
            $startIndex = 0;
            if (isset($_GET['cars_page']))
                $startIndex = ($_GET['cars_page'] - 1) * $carsCountOnPage;

            $orderTarget = "";

            $mark = $_GET['Mark'];
            $model = $_GET['Model'];
            $fuelType = $_GET['FuelType'];
            $bodyType = $_GET['BodyType'];
            $priceFrom = $_GET['PriceFrom'];
            $priceTo = $_GET['PriceTo'];

            $searchSqlPart = "((`Mark` like '%{$mark}%') and (`Model` like '%{$model}%') and (`Body_type` like '%{$bodyType}%') and (`Fuel_type` like '%{$fuelType}%')) and (`Price`>={$priceFrom} and `Price`<={$priceTo})";

            if (isset($_GET['IsWithSearch'])) {
                $sql = "SELECT * FROM `cars` WHERE " . $searchSqlPart;
            } else
                $sql = "SELECT * FROM `cars`";

            $orderDirection = "";
            if ($_GET['filterDirection'] == "MaxToMin")
                $orderDirection = "DESC";
            else if ($_GET['filterDirection'] == "MinToMax")
                $orderDirection = "ASC";
            if (isset($_GET["filterName"])) {
                $filterName = $_GET["filterName"];
                switch ($filterName) {
                    case "New":
                        $orderTarget = "Date";
                        break;
                    case "Popular":
                        $orderTarget = "ClicksCount";
                        break;
                    case "Expensive":
                        $orderTarget = "Price";
                        break;
                }
                if (isset($_GET['IsWithSearch']))
                    $sql = "SELECT * FROM `cars` " . " WHERE " . $searchSqlPart . " ORDER BY `" . $orderTarget . "` " . $orderDirection;
                else
                    $sql = "SELECT * FROM `cars` ORDER BY `" . $orderTarget . "` " . $orderDirection;
            }
            $orderedCarsList = $mainDbHandler->query($sql);

            for ($i = $startIndex; $i < $startIndex + $carsCountOnPage; $i++) {
                if ($i >= $orderedCarsList->num_rows) break;
                $orderedCarsList->data_seek($i);
                $carData = $orderedCarsList->fetch_array();
                $firstImage = explode(';', $carData[3])[0];

                if (strlen($carData[9]) > 80) {
                    $carData[9] = substr($carData[9], 0, 80);
                    $carData[9] .= "...";
                }
                echo <<<CAR
                    <div class="car">
                        <a href="/CarPage/index.php?id=$carData[0]">
                            <div class="image">
                                <img src="/Cars/Images/$firstImage" alt="CarPreview">
                                <span class="price">$carData[5] €</span>
                            </div>
                            <div class="info">
                                <div class="name">$carData[1]</div>
                                <div class="description">$carData[10]</div>
                            </div>
                        </a>
                    </div>
CAR;
            }
            ?>
            <script>
                function ApplyRecommendationFilter(filterName) {
                    if (window.location.href.search("MinToMax") != -1) {
                        window.location.replace(convertReqObjToStr(makeGetReq({
                            filterName: filterName,
                            filterDirection: "MaxToMin"
                        }))[1]);
                    } else {
                        window.location.replace(convertReqObjToStr(makeGetReq({
                            filterName: filterName,
                            filterDirection: "MinToMax"
                        }))[1]);
                    }
                }

                function makeGetReq(ReqObj) {
                    let href = window.location.href;
                    if (href.search("\\?") == -1)
                        href += "?";
                    let reqStr = href.split("?")[1];

                    let eReqs = {};
                    reqStr.split("&").forEach((i) => {
                        let reqData = i.split("=");
                        eReqs[reqData[0]] = reqData[1];
                    });

                    for (let req in ReqObj) {
                        let isExist = false;
                        for (let eReq in eReqs) {
                            if (req == eReq) {
                                eReqs[eReq] = ReqObj[req];
                                isExist = true;
                            }
                        }
                        if (!isExist) {
                            eReqs[req] = ReqObj[req];
                        }
                    }
                    return eReqs;
                }

                function makeGetReqWithout(reqsNameArr) {
                    let req = makeGetReq({});
                    reqsNameArr.forEach(name => {
                        for (let eReq in req) {
                            if (name == eReq) {
                                delete(req[eReq]);
                            }
                        }
                    })
                    return req;
                }

                function convertReqObjToStr(reqObj) {
                    let origin = window.location.origin;
                    let str = "/?";
                    for (let req in reqObj) {
                        if (req == "") continue; // костыль
                        str += req + "=" + reqObj[req] + "&";
                    }
                    if (str[str.length - 1] == "&") str = str.substr(0, str.length - 1);
                    return [str, origin + str];
                }

                function getElementCountInRowOnFlex(ClassName) {
                    let elemsCountInRow = 0;
                    $(ClassName).css("top", 0);
                    let startHeight = $(ClassName).position().top;
                    $(ClassName).each(function(index) {
                        if ($(this).position().top == startHeight) {
                            elemsCountInRow++;
                        }
                    });
                    return elemsCountInRow;
                }

                function getRowSize(ClassName, index) {
                    let elemsCountInRow = getElementCountInRowOnFlex(ClassName);
                    let maxHeight = 0;
                    for (let i = 0; i < elemsCountInRow; i++) {
                        let height = $(ClassName).eq(i + (elemsCountInRow * index)).outerHeight();
                        if (height > maxHeight) {
                            maxHeight = height;
                        }
                    }
                    return maxHeight;
                }

                function alignTopOffset(ClassName, elemsCountInRow, offset = 10) {
                    $(ClassName).each(function(index) {
                        if (index >= elemsCountInRow) {
                            let topElement = $(".car").eq(index - elemsCountInRow);
                            let topElementHeight = topElement.height();
                            let topElementPosition = topElement.position().top;

                            let deltaPosition = $(this).position().top - topElementPosition;
                            // let topElementHeight_FlexHeightOffset = getRowSize(ClassName, Math.floor((index - (elemsCountInRow)) / (elemsCountInRow))) - topElementHeight;
                            console.log(deltaPosition + ", " + topElementHeight);
                            $(this).css("top", -(deltaPosition - topElementHeight - offset));
                        }
                    });
                }
            </script>
        </div>
        <div id="pages-scroller">
            <?php
            $carsCount = $mainDbHandler->query("select * from `cars`")->num_rows;
            for ($i = 0; $i < $carsCount / $carsCountOnPage; $i++) {
                echo '<span class="page" onclick="window.location.replace(convertReqObjToStr(makeGetReq({cars_page:' . ($i + 1) . '}))[1])">' . ($i + 1) . '</span>';
            }
            ?>
            <!-- <span class="page" onclick="window.location.replace(convertReqObjToStr(makeGetReq({cars_page:1}))[1])">1</span>
            <span class="page" onclick="window.location.replace(convertReqObjToStr(makeGetReq({cars_page:2}))[1])">2</span>
            <span class="page" onclick="window.location.replace(convertReqObjToStr(makeGetReq({cars_page:3}))[1])">3</span> -->
        </div>
        </div>
        <div class="sidebar">Right sidebar</div>
    </content>
    <script>
        let eCountInRow = getElementCountInRowOnFlex(".car");
        alignTopOffset(".car", eCountInRow);
        window.onresize = function() {
            eCountInRow = getElementCountInRowOnFlex(".car");
            alignTopOffset(".car", eCountInRow);
        }
    </script>
</body>

</html>

<?php
$cars->free();
?>