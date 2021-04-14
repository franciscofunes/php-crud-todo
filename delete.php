<?php

include 'db.php';

$id = (int)$_GET['id'];

$sql = "delete from task where id = '$id'";

$val = $db->query($sql);

if ($val) {
    echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
    exit();
};
