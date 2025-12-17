<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: index.php");
  exit;
}
?>

<?php
session_start();
session_destroy();
header("Location: index.php");
?>
