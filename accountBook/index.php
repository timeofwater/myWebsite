<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>记账</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="../pictures/shortcutLogo.png"/>
    <link rel="stylesheet" href="../Css/general.css" type="text/css">
    <link rel="stylesheet" href="../Css/navigator.css" type="text/css">
    <link rel="stylesheet" href="../Css/cute-calender.css" type="text/css">
    <style>
        body {
            color: #a8afbe;
        }

        #time {
            display: block;
            position: relative;
            top: 30px;
            width: 200px;
            height: 300px;
            margin: 0 auto;
        }

        .form {
            display: block;
            position: relative;
            top: 50px;
            width: 300px;
            margin: 0 auto;
            line-height: 2rem;
            text-align: center;
            border-radius: 20%;
            border: 1px solid #0fd293;
        }

        .line {
            display: block;
            width: 300px;
            margin: 10px auto;
            line-height: 2rem;
            text-align: center;
        }

        .line * {
            margin: 5px;
        }

        .text-info {
            display: inline-block;
        }

        .day,
        .month {
            display: block;
            position: relative;
            top: 70px;
            width: 200px;
            margin: 0 auto;
            line-height: 2rem;
            text-align: center;
            border-radius: 20%;
            border: 1px solid #0fd293;
        }

        .month {
            top: 90px;
        }

        .display-acc {
            display: block;
            position: relative;
            width: 200px;
            min-height: 2rem;
            color: #a8afbe;
        }
    </style>
</head>
<body>
<div id="time"></div>
<form class="form" action="handler.php" method="post" target="_self">
    <div class="line">
        <div class="text-info">金额：</div>
        <input name="acc" type="text"/>
    </div>
    <div class="line">
        <div class="text-info">介绍：</div>
        <input name="info" type="text"/>
    </div>
    <div class="line">
        <label>
            <input name="type" type="radio" value="day" checked/>日度
        </label>
        <label>
            <input name="type" type="radio" value="month"/>月度
        </label>
        <input id="date" name="date" type="hidden"/>
        <input type="submit" name="submit" value=" 提交 "/>
    </div>
</form>
<div id="day" class="day">
    <div id="day-total" class="display-acc"></div>
</div>
<div id="month" class="month">
    <div id="total" class="display-acc"></div>
    <div id="month-total" class="display-acc"></div>
</div>

<script>
    !function display() {

        var timeToday = new Date();
        var today = (timeToday.getMonth() + 1) + "-" + timeToday.getDate();
        var daysInMonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var tomonth = timeToday.getMonth() + 1;

        var jsonFile = null;
        <?php
        $today = date('n-j');
        $tomonth = date('n');

        $jsonFile = file_get_contents('../Js/accountBook.json');
        $jsonFile = mb_convert_encoding($jsonFile, "UTF-8", "GBK");
        $jsonFile = str_replace(' ', '', $jsonFile);
        $jsonFile = str_replace("\n", '', $jsonFile);
        $jsonFile = str_replace("\r", '', $jsonFile);
        $json = json_decode($jsonFile, true);
        $days = $json['days'];
        $months = $json['months'];
        $daysInThisMonth = array($today => array('item-1' => array('a' => '0', 'info' => 'null')));
        $monthsInThisMonth = array($tomonth => array('item-1' => array('a' => '0', 'info' => 'null')));

        foreach ($days as $i => $v) {
            if (substr($i, 0, strpos($today, '-')) === $tomonth) {
                $daysInThisMonth[$i] = $days[$i];
            }
        }

        foreach ($months as $i => $v) {
            if ('' . $i === $tomonth) {
                $monthsInThisMonth[$i] = $months[$i];
            }
        }

        echo 'jsonFile = ' . json_encode(array('days' => $daysInThisMonth, 'months' => $monthsInThisMonth)) . ';';
        ?>
        if (typeof (jsonFile) != null) {
            var days = jsonFile["days"];
            var months = jsonFile["months"];
            var dayDiv = document.getElementById("day");
            var monthDiv = document.getElementById("month");
            var todaysNames = Object.getOwnPropertyNames(days[today]);
            var monthsNames = Object.getOwnPropertyNames(months[tomonth]);
            var daysNames = Object.getOwnPropertyNames(days);
            var dayMoney = 0;
            var monthMoney = 0;
            var totalMoney = 0;
            var dayTotalDiv = document.getElementById("day-total");
            var totalDiv = document.getElementById("total");
            var monthTotalDiv = document.getElementById("month-total");
            for (var i = 1; i < todaysNames.length + 1; i++) {
                var newDiv = document.createElement("div");
                newDiv.setAttribute("class", "display-acc");
                if (days[today]["item-" + i]["a"] !== "0") {
                    newDiv.innerText = days[today]["item-" + i]["a"] + ", " + days[today]["item-" + i]["info"];
                }
                dayDiv.appendChild(newDiv);
                dayMoney += parseFloat(days[today]["item-" + i]["a"]);
                console.log(days[today]["item-" + i]);
            }
            for (var i = 1; i < monthsNames.length + 1; i++) {
                var newDiv = document.createElement("div");
                newDiv.setAttribute("class", "display-acc");
                if (months[tomonth]["item-" + i]["a"] !== "0") {
                    newDiv.innerText = months[tomonth]["item-" + i]["a"] + ", " + months[tomonth]["item-" + i]["info"];
                }
                monthDiv.appendChild(newDiv);
                monthMoney += parseFloat(months[tomonth]["item-" + i]["a"]);
                console.log(months[tomonth]["item-" + i]);
            }
            for (var i = 0; i < daysNames.length; i++) {
                var thisDayNames = Object.getOwnPropertyNames(days[daysNames[i]]);
                for (var j = 0; j < thisDayNames.length; j++) {
                    totalMoney += parseFloat(days[daysNames[i]][thisDayNames[j]]["a"]);
                }
            }

            totalMoney += monthMoney;
            monthMoney += dayMoney * (daysInMonth[tomonth - 1] - timeToday.getDate());
            dayTotalDiv.innerText = "今天一共花了" + dayMoney + "块";
            totalDiv.innerText = "已经花了" + totalMoney + "块";
            monthTotalDiv.innerText = "这样下去估计花" + (monthMoney + totalMoney) + "块";
        }
    }();
</script>
<script>
    !function formDiy() {
        var timeToday = new Date();
        var today = (timeToday.getMonth() + 1) + "-" + timeToday.getDate();
        var dateForm = document.getElementById("date");
        dateForm.setAttribute("value", today);
    }();
</script>
<script src="../Js/cute-calendar.js"></script>
<script>
    !function () {
        var timeDiv = document.getElementById("time");
        timeDiv.appendChild(genCuteCalendar(new Date()));
    }();
</script>
<script src="../Js/navigator.js"></script>
</body>
</html>