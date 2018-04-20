<?php


$destination = dirname(dirname(__FILE__)) . $_POST['destination'];

$filename = $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], $destination . $filename);
