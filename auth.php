<?php
    function auth($login, $passwd) {
        $array = unserialize(file_get_contents("../private/passwd"));
        $password = hash("whirlpool", $passwd);

        foreach ($array as $key => $value) {
            if ($value['login'] == $login && $value['passwd'] == $password) {
                return (TRUE);
            }
        }
        return (FALSE);
    }
?>