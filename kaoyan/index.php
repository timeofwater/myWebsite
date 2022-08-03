<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv=”Pragma”content=”no-cache”>
    <title>考研</title>
    <link rel="shortcut icon" href="../pictures/shortcutLogo.png"/>
    <link rel="stylesheet" href="../Css/general.css" type="text/css">
    <link rel="stylesheet" href="../Css/navigator.css" type="text/css">
    <style>
        /* display goals */
        #goals-lib {
            background-color: #a8afbe;
            width: 100%;
            height: 70%;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .goal-to-display {
            background-color: #1a1a1a;
            width: 96%;
            height: auto;
            margin: 1% 2% 0 2%;
        }

        .goal-icon {
            background-color: #D2691E;
            width: 40px;
            height: 40px;
            margin: 0 1%;
            border-radius: 7px;
        }

        .icon-cat {
            background: url("../pictures/icon_for_catuuy_120_40.png") no-repeat 0 0;
        }

        .icon-bunny {
            background: url("../pictures/icon_for_catuuy_120_40.png") no-repeat -40px 0;
        }

        .icon-finished {
            background: url("../pictures/icon_for_catuuy_120_40.png") no-repeat -80px 0;
        }

        .goal-content {
            background-color: #34c2e3;
            width: calc(98% - 40px);
            height: 100%;
            left: calc(2% + 40px);
        }

    </style>
    <style>
        /* input goal */
        #input-zone {
            background-color: #64C333;
            width: 100%;
            height: calc(30% - 60px);
        }

        .content-writing {
            background-color: #FFFFFF;
            width: 80%;
            height: 90%;
            position: relative;
            top: 5%;
            left: 2%;
        }

        .content-submit {
            background-color: #D2691E;
            width: 10%;
            height: 20%;
            position: relative;
            top: 0%;
            left: 3%;
        }

    </style>

    <!-- script -->
    <script>
        <?echo file_get_contents('../Js/kaoyangoals.js');?>

        function setFinished(objectID, animal) {
            if (goalsJson[objectID]["status"] === "unfinished") {
                goalsJson[objectID]["status"] = "finished";
                document.getElementById(objectID).className = "goal-icon icon-finished";
            } else if (goalsJson[objectID]["status"] === "finished") {
                goalsJson[objectID]["status"] = "unfinished";
                document.getElementById(objectID).className = "goal-icon icon-" + animal;
            }

            objectIDInputDOM.setAttribute("value", objectID);
            formDOM.submit();
        }

        function addAGoal(objectID, animal, status, time, goalContent) {
            var goalsLib = document.getElementById("goals-lib");
            var goalDiv = document.createElement("div");
            var icon = document.createElement("div");
            var content = document.createElement("div");

            goalDiv.setAttribute("class", "goal-to-display");
            icon.setAttribute("id", objectID);
            icon.setAttribute("class", "goal-icon");
            icon.setAttribute("onclick", "setFinished('" + objectID + "','" + animal + "')");
            content.setAttribute("class", "goal-content");

            goalContent = goalContent.replace(/\n|\r|(\r\n)|(\u1145)/g, "<br/>");

            icon.className = "goal-icon icon-" + animal;
            if (status === "finished") icon.className = "goal-icon icon-finished";
            content.innerHTML = "[" + time + "] " + goalContent;

            goalsLib.appendChild(goalDiv);
            goalDiv.appendChild(icon);
            goalDiv.appendChild(content);

        }
    </script>
</head>
<body>
<iframe id="fraSubmit" name="fraSubmit" style="display:none;"></iframe>
<div id="goals-lib"></div>
<form id="input-zone" name="submitGoal" action="formHandler.php" method="post" target="fraSubmit"><!--fraSubmit-->
    <input id="input-input" class="content-writing" type="text" name="goalInputAndSubmit"/>
    <input id="date-input" type="hidden" name="date">
    <input id="animal-submit" type="hidden" name="animal">
    <input id="to-skip-enter-submit-the-form" type="text" name="uselessText" style="display: none;"/>
    <input class="content-submit" type="button" value="提交" onclick="submitThisForm()"/>
</form>

<!-- script -->
<script src="../Js/navigator.js"></script>
<script>
    // fill body the screen
    var headDOM = document.getElementsByTagName("head")[0];
    var fillScreenStyle = document.createElement("style");

    fillScreenStyle.innerHTML = "body{height:" + window.innerHeight + "px;"
        + "width: " + window.innerWidth + "px;" + "}"

    headDOM.appendChild(fillScreenStyle);
</script>
<script>
    // add goals
    for (var goalInfo in goalsJson) {
        addAGoal(goalInfo, goalsJson[goalInfo]["animal"], goalsJson[goalInfo]["status"],
            goalsJson[goalInfo]["date"], goalsJson[goalInfo]["content"]);
    }

</script>
<script>
    // forms with js
    var formDOM = document.createElement("form");
    formDOM.setAttribute("style", "display:none;");
    formDOM.setAttribute("action", "formHandler.php");
    formDOM.setAttribute("method", "post");
    formDOM.setAttribute("target", "fraSubmit");
    document.body.appendChild(formDOM);

    var objectIDInputDOM = document.createElement("input");
    objectIDInputDOM.setAttribute("type", "hidden");
    objectIDInputDOM.setAttribute("name", "objectID");
    formDOM.appendChild(objectIDInputDOM);

    var submitInputDOM = document.createElement("input");
    submitInputDOM.setAttribute("style", "display:none;");
    submitInputDOM.setAttribute("type", "submit");
    formDOM.appendChild(submitInputDOM);

</script>
<script>
    // forms with html
    var today = new Date();
    document.getElementById("date-input").setAttribute("value", "" + (today.getMonth() + 1) + "." + today.getDate());

    document.getElementById("animal-submit").setAttribute("value", (function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
        return null;
    })("animal"));

    function submitThisForm() {
        console.log(document.getElementById("input-input").value);
        if (document.getElementById("input-input").value != "") {
            document.getElementById("input-zone").submit();
            alert("提交成功");
            window.location.reload(true);
        }
    }
</script>
</body>
</html>