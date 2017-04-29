<?php
session_start();
if ($_SESSION['loggued_on_user'] != "") {
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == "SEND") {
            if (file_exists("../private/chat")) {
                $fd = fopen("../private/chat", "c+");
                flock($fd, LOCK_EX | LOCK_SH);
                $array = unserialize(file_get_contents("../private/chat"));
                $array[] = array('time'=>time(), 'login'=>$_SESSION['loggued_on_user'], 'msg'=>$_POST['msg']);
                file_put_contents("../private/chat", serialize($array));
                flock($fd, LOCK_UN);
            } else {
                $array = array();
                $array[] = array('time'=>time(), 'login'=>$_SESSION['loggued_on_user'], 'msg'=>$_POST['msg']);
                file_put_contents("../private/chat", serialize($array));
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Lobby</title>
        <script language="javascript">
            top.frames['chat'].location = 'chat.php';
        </script>
        <style>
            .form {
                max-width: 500px;
                margin: 10px auto;
                padding: 20px;
                background-color: rgba(61, 102, 109, 0.8);
                border-radius: 8px;
                font-family: Georgia, "Times New Roman", Times, serif;
                text-align: center;
            }
            .form fieldset{
                border: none;
            }
            .form legend {
                font-size: 2em;
                margin-bottom: 10px;
            }
            .form input[type="text"],
            .form input[type="password"] {
                font-family: Georgia, "Times New Roman", Times, serif;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                margin: 0 0 30px 0;
                outline: 0;
                padding: 7px;
                width: 100%;
                box-sizing: border-box;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                background-color: #e8eeef;
                color:#8a97a0;
                -webkit-box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
                box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
            }
            .form input[type="text"]:focus,
            .form input[type="password"]:focus {
                background: #d2d9dd;
            }
            .form input[type="submit"] {
                position: relative;
                display: block;
                padding: 10px 30px 10px 30px;
                color: #FFF;
                margin: -9px auto 15px auto;
                background: #1abc9c;
                font-size: 18px;
                text-align: center;
                font-style: normal;
                width: 100%;
                border: solid #16a085;
                border-width: 1px 1px 3px;
                border-radius: 8px;
            }
            .form input[type="submit"]:hover{
                background: #109177;
            }
        </style>
    </head>
    <body>
    <div class="form">
        <form method="POST" action="">
            <input type="text" name="msg" value ="" />
            <input type="submit" name="submit" value="SEND" />
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>