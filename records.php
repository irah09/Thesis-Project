<?php

include 'model.php';

$model = new Model();

if (isset($_POST['tpn']) && !empty($_POST['tpn'])) {
    $tpn = $_POST['tpn'];


    $rows = $model->fetch_filter($tpn);
} else {
    $rows = $model->fetch(0);
}

echo json_encode($rows);