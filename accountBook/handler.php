<?php
$newAcc = $_POST['acc'];
$newInfo = $_POST['info'];
$newType = $_POST['type'];
$today = $_POST['date'];
$tomonth = substr($today, 0, strpos($today, '-'));


if (($newAcc != null && $newType != null) && ($newType != null && $today != null)) {

    $jsonFile = file_get_contents('../Js/accountBook.json');
    $jsonFile = mb_convert_encoding($jsonFile, "UTF-8", "GBK");
    $jsonFile = str_replace(' ', '', $jsonFile);
    $jsonFile = str_replace("\n", '', $jsonFile);
    $jsonFile = str_replace("\r", '', $jsonFile);
    $json = json_decode($jsonFile, true);
    $days = $json['days'];
    $months = $json['months'];

    if ($newType == 'day') {
        $item = array("a" => $newAcc, "info" => $newInfo);
        $todaysDayItems = $days[$today];
        $itemsNumber = count($todaysDayItems);
        if ($itemsNumber == 0) {
            $todaysDayItems = array('item-1' => $item);
        } else {
            $itemsNumber += 1;
            $itemName = 'item-' . $itemsNumber;
            $todaysDayItems[$itemName] = $item;
        }
        $days[$today] = $todaysDayItems;
        header('Location: index.php');
    }

    if ($newType == 'month') {
        $item = array("a" => $newAcc, "info" => $newInfo);
        $todaysMonthItems = $months[$tomonth];
        $itemsNumber = count($todaysMonthItems);
        if ($itemsNumber == 0) {
            $todaysMonthItems = array('item-1' => $item);
        } else {
            $itemsNumber += 1;
            $itemName = 'item-' . $itemsNumber;
            $todaysMonthItems[$itemName] = $item;
        }
        $months[$tomonth] = $todaysMonthItems;
        header('Location: index.php');
    }
    $json['days'] = $days;
    $json['months'] = $months;
    $jsonFile = json_encode($json);
    file_put_contents('../Js/accountBook.json',$jsonFile);
}

