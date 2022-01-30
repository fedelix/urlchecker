<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();

if (!$_SESSION["loggedin"]) {
    header("location: index.php");
}

require_once "src/database.php";

$sql = "SELECT `id`, `url`, DATE_FORMAT(`data`, '%d/%m/%Y %H:%i:%S') as `data`, `timestamp`, `statuscode` FROM `url` ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
if ($stmt->execute()) {
    $urls = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $urlItens = array(
            "id" => $id,
            "url" => $url,
            "data" => $data,
            "timestamp" => $timestamp,
            "statuscode" => $statuscode,
        );
        array_push($urls, $urlItens);
    }
    echo json_encode($urls);

} else {
    echo json_encode(array("code" => 0, "message" => "Ops! Algo deu errado. Por favor, tente novamente mais tarde."));
}
unset($pdo, $stmt, $stm);