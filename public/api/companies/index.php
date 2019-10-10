<?php
header('Content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
include('../../../app/config/db.php');
$response = array();
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'GET':
    $data = $_GET;
    $lead = $_GET['nombre'];
    $email = $_GET['email'];
    $telefono = $_GET['telefono'];
    $local = $_GET['local'];

    $response['type'] = 'GET Request';

    try {

      DB::query('INSERT INTO leads values(null,:lead,:email,:telefono,:local, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)', array(
        ':lead' => $lead,
        ':email' => $email,
        ':telefono' => $telefono,
        ':local' => $local
      ));
      $response['status'] = 'success';
    } catch (Exception $e) {
      $response['err'] = $e;
    }
    $response['data'] = $data;
    break;
  case 'POST':
    $response['status'] = 'POST Request';
    break;
  default:
    $response['status'] = "invalid method";;
    break;
}


echo json_encode($response);