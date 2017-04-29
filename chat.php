<?php
    date_default_timezone_set('Europe/Kiev');

    if (file_exists("../private/chat") == TRUE) {
        $array = unserialize(file_get_contents("../private/chat"));
        echo "<meta http-equiv=\"refresh\" content=\"7\">";

        foreach ($array as $value) {
            echo "<span style='color:#FFFFFF'>";
            echo "[";
            echo date("H:i", $value['time']);
            echo "] ";
            echo "<b style='color: #1abc9c'>";
            echo $value['login'];
            echo "</b>: ";
            echo $value['msg'];
            echo "</span>";
            echo "<br />";
        }
    }
?>