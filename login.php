<?php
    include ('auth.php');
    session_start();

    if (isset($_POST['submit'])) {
        if (auth($_POST['login'], $_POST['passwd']) == TRUE) {
            $_SESSION['loggued_on_user'] = $_POST['login'];
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <meta name="author" content="ykondrat" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link href='https://signin.intra.42.fr/assets/42_logo_black-684989d43d629b3c0ff6fd7e1157ee04db9bb7a73fba8ec4e01543d650a1c607.png' rel='icon' type='image/svg' />
                <title>42chat</title>
                <style>
                    body {
                        background-image: url("http://www.ie-wallpapers.com/data/out/2/37506703-abstract.jpg");
                        overflow-x: hidden;
                    }
                    hr {
                        border: none;
                        margin-bottom: 30px;
                        background: #109177;
                        background: -webkit-linear-gradient(left, #109177 , #1abc9c);
                        background: -o-linear-gradient(right, #109177, #1abc9c);
                        background: -moz-linear-gradient(right, #109177, #1abc9c);
                        background: linear-gradient(to right, #109177 , #1abc9c);
                        width: 100%;
                        height: 5px;
                    }
                    h2 {
                        display: inline;
                    }
                    span {
                        display: inline;
                        position: fixed;
                        right: 10px;
                        top: 10px;
                    }
                    span > a {
                        font: 2em Georgia, "Times New Roman", Times, serif;
                        text-decoration: none;
                        color: #1abc9c;
                        font-weight: bold;
                    }
                    span > a:hover {
                        color: #109177;
                    }
                    h2, h3 {
                        color: #ffffff;
                        font-weight: bold;
                        font-family: Georgia, "Times New Roman", Times, serif;
                        opacity: 0.8;
                    }
                    a {
                        text-decoration: none;
                        color: #109177;
                        font-weight: bold;
                    }
                    a:hover {
                        color: #1abc9c;
                        text-decoration: underline;
                    }
                    iframe {
                        border: none;
                    }
                    .container {
                        display: inline;
                    }
                    .login {
                        display: inline;
                        height: 300px;
                        margin-left: 25%;
                    }
                    .login > p {
                        text-align: center;
                        display: inline;
                        font: 2em bold Georgia, "Times New Roman", Times, serif;
                    }
                    footer > p {
                        text-align: right;
                        color: floralwhite;
                        font: italic bold 1.5em monospace;
                    }
                </style>
            </head>
            <body>
            <h2>Chat: </h2><span><a href="logout.php">Log Out</a></span>
                <iframe name="chat" src="chat.php" width="100%" height="300px"></iframe>
                <h3>Write your massage: </h3>
                <div class="container">
                    <iframe name="speak" src="speak.php" width="50%" height="200px"></iframe>
                    <div class="login">
                        <p>
                            <a href="modif.html">
                                <?php echo $_SESSION['loggued_on_user']?>
                            </a>
                        </p>
                    </div>
                </div>
                <footer>
                    <hr />
                    <p>
                        &copy ykondrat 2017
                    </p>
                </footer>
            </body>
            <?php
                    } else {
                        $_SESSION['loggued_on_user'] = "";
                        header("location: index.html");
                    }
                }
            ?>