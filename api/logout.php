<?php
setcookie("role", "", time() - 3600, "/");
setcookie("nama", "", time() - 3600, "/");
header("Location: ../index.html");
exit;
?>