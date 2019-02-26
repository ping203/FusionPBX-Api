<?php
/**
 * Created by PhpStorm.
 * User: aspurlock
 * Date: 2/26/2019
 * Time: 2:20 PM
 */

header('Content-Type: application/json');

include '/var/www/fusionpbx/root.php';
require_once '/var/www/fusionpbx/resources/check_auth.php';

$message = array();

$domain_uuid = (isset($_GET['domain_uuid']) ? $_GET['domain_uuid'] : null);

if ($domain_uuid = null) {

    $sql = "select * from v_destinations ";
    $prep_statement = $db->prepare(check_sql($sql));
    $prep_statement->execute();
    $destinations = $prep_statement->fetchAll(PDO::FETCH_NAMED);
    $message = $destinations;

}else{

    $sql = "select * from v_destinations where domain_uuid = '$domain_uuid'";
    $prep_statement = $db->prepare(check_sql($sql));
    $prep_statement->execute();
    $destinations = $prep_statement->fetchAll(PDO::FETCH_NAMED);
    $message = $destinations;

}

echo(json_encode(['destinatons' => $message]));
