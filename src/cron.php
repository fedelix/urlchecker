#!/opt/lampp/bin/php
<?php

require_once "database.php";

$stmt = $pdo->prepare("SELECT `id`, `url` FROM `url` ORDER BY id DESC");
if ($stmt->execute()) {

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);

        $statuscode = $headers['http_code'];

        $query = $pdo->prepare("UPDATE `url` SET `statuscode` = :statuscode WHERE id = :id");
        $query->bindParam(":statuscode", $statuscode);
        $query->bindParam(":id", $id);
        $query->execute();
    }
}