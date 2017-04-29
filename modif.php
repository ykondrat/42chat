<?php
        function incorrect_pass() {
            $dom = new DOMDocument();
            @$dom->loadHTMLFile("modif.html");

            $legend = $dom->getElementsByTagName('legend');
            for ($i = 0; $legend[$i]; $i++) {
                $legend[$i]->nodeValue = "You enter incorrect password or login";
            }
            $legend->item(0)->setAttribute("style", "color: red");
            echo $dom->saveHTML();
        }

        if ($_POST["submit"] == "OK") {
            if ($_POST["newpw"] == "") {
                incorrect_pass();
            } else {
                $login = FALSE;
                $file = unserialize(file_get_contents("../private/passwd"));
                $index = 0;
                foreach ($file as $elem) {
                    if ($elem["login"] == $_POST["login"]) {
                        if ($elem["passwd"] == hash("whirlpool", $_POST["oldpw"])) {
                            $file[$index]["passwd"] = hash("whirlpool", $_POST["newpw"]);
                            $login = TRUE;
                        }
                        $index++;
                    }
                }
                if ($login) {
                    file_put_contents("../private/passwd", serialize($file));
                    header("location: index.html");
                } else {
                    incorrect_pass();
                }
            }
        }
?>
