<?php

include 'db.php';

if (isset($_POST['send'])) {
    $name = htmlspecialchars($_POST['task']);

    $sql = "insert into task (name) values ('$name')";

    $val = $db->query($sql);

    if ($val) {
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit();
    }
}
