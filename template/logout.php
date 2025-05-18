<?php
session_start();
session_destroy();
header('Location: /SitedoMuseu/template/login.php');
exit();
?>