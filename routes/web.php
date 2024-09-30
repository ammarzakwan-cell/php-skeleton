<?php

use App\Controllers\HomeController;

$app->get('/', HomeController::class . ':index');
$app->get('/employeeAttend', HomeController::class . ':employeeAttendDatatable');
