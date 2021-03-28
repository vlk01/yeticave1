<?php
    session_destroy();
    unset($_SESSION['auth']);
    header("Location: index.php");
?>