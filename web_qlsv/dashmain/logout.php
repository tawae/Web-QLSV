<?php
session_start();
session_destroy();
header("Location: /web_qlsv/dashmain/login.html");
exit();
?>