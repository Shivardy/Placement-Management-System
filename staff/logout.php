<?php
session_start();
unset($_SESSION['idno']);
session_destroy();
header("Location:../");
?>