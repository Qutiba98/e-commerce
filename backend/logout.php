<?php
session_start();
session_destroy();
header("Location: http://localhost/e-commerce/backend/index.php");
?>
