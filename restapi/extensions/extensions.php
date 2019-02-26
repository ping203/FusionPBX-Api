<?php
/**
 * Created by PhpStorm.
 * User: aspurlock
 * Date: 2/26/2019
 * Time: 12:20 PM
 */

include '/var/www/fusionpbx/root.php';
require_once '/var/www/fusionpbx/resources/check_auth.php';

$domain_uuid = (isset($_GET['domain_uuid']) ? $_GET['domain_uuid']:null);
$extension = (isset($_GET['extension']) ? $_GET['extension']:null);

if ($domain_uuid == null) {
    echo json_encode(['message' => 'You must include the domain_uuid!']);
}

if ($extension == null) {
    $sql = "select * from v_extensions ";
    $sql .= "where domain_uuid = '$domain_uuid' ";
    $prep_statement = $db->prepare(check_sql($sql));
    $prep_statement->execute();
    $extensions = $prep_statement->fetchAll(PDO::FETCH_NAMED);
    unset($sql);
    echo json_encode($extensions);
}else{
    $sql = "select * from v_extensions ";
    $sql .= "where domain_uuid = '$domain_uuid' and extension = '$extension'";
    $prep_statement = $db->prepare(check_sql($sql));
    $prep_statement->execute();
    $extension = $prep_statement->fetchAll(PDO::FETCH_NAMED);
    unset($sql);
    echo json_encode($extension);
}

