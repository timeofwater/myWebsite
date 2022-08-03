<?
// form post
$goalContent=$_POST["goalInputAndSubmit"];
$animal=$_POST["animal"];
$date=$_POST["date"];

if (!is_null($animal)) {
    $goalsJson = json_decode(substr(file_get_contents('../Js/kaoyangoals.js'),15),true);
    $index = 'goal_info'.(count($goalsJson)+1);
    $goalsJson[$index]["animal"]=$animal;
    $goalsJson[$index]["status"]='unfinished';
    $goalsJson[$index]["date"]=$date;
    $goalsJson[$index]["content"]=$goalContent;
    $goalsJsonStr = json_encode($goalsJson);
    file_put_contents('../Js/kaoyangoals.js','var goalsJson ='.$goalsJsonStr);
}


// json data post
$changed_object_id=$_POST["objectID"];

if (!is_null($changed_object_id)) {
    $goalsJson = json_decode(substr(file_get_contents('../Js/kaoyangoals.js'),15),true);
    if($goalsJson[$changed_object_id]["status"]=='finished'){
        $goalsJson[$changed_object_id]["status"]='unfinished';
    }elseif ($goalsJson[$changed_object_id]["status"]=='unfinished'){
        $goalsJson[$changed_object_id]["status"]='finished';
    }
    $goalsJsonStr = json_encode($goalsJson);
    file_put_contents('../Js/kaoyangoals.js','var goalsJson ='.$goalsJsonStr);
}

?>