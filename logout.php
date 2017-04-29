<?php
    session_start();
    $_SESSION['loggued_on_user'] = "";
    header("location: index.html");
?>