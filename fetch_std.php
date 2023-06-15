<?php

include 'model.php';

$model = new Model();

$rows = $model->fetch_tpn();

echo json_encode($rows);


