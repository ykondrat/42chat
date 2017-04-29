<?php
    function already_in_use() {
        $dom = new DOMDocument();
        @$dom->loadHTMLFile("create.html");

        $legend = $dom->getElementsByTagName('legend');
        for ($i = 0; $legend[$i]; $i++) {
            $legend[$i]->nodeValue = "Login already in use";
        }
        $legend->item(0)->setAttribute("style", "color: red");
        echo $dom->saveHTML();
    }

    if ($_POST['login'] && $_POST['passwd']) {
        if ($_POST['submit'] == "OK") {
            if (!file_exists("../private")) {
                mkdir("../private", 0777, TRUE);
            }
            if (!file_exists("../private/passwd")) {
               $array1 = array();
               $array['login'] = $_POST['login'];
               $array['passwd'] = hash('whirlpool', $_POST['passwd']);
               $array1[] = $array;
               file_put_contents("../private/passwd", serialize($array1));
               header("location: index.html");
            } else {
                $array = unserialize(file_get_contents("../private/passwd"));
                $login = 0;
                foreach ($array as $elem => $value) {
                   if ($value['login'] == $_POST['login']) {
                       $login = 1;
                   }
                }
                if ($login == 0) {
                   $acc['login'] = $_POST['login'];
                   $acc['passwd'] = hash('whirlpool', $_POST['passwd']);
                   $array[] = $acc;
                   file_put_contents("../private/passwd", serialize($array));
                   header("location: index.html");
                } else {
                   already_in_use();
                }
            }
        } else {
            already_in_use();
        }
    } else {
        already_in_use();
    }
?>