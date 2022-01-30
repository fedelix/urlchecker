<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();

if (!$_SESSION["loggedin"]) {
    header("location: index.php");
}

require_once "src/database.php";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cadurl = trim($_POST["url"]);

    if (filter_var($cadurl, FILTER_VALIDATE_URL)) {
        $sql = "SELECT url FROM url WHERE url = :cadurl";
            
        if ($stmt = $pdo->prepare($sql)) {

            $stmt->bindParam(":cadurl", $cadurl, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    echo json_encode(array("code" => 0, "message" => "URL já cadastrada no banco."));

                } else {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $cadurl);
                    curl_setopt($ch, CURLOPT_HEADER, 1);
                    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($ch);
                    $headers = curl_getinfo($ch);
                    curl_close($ch);

                    $data = date("Y-m-d H:i:s");
                    $time = strtotime("now");
                    $code = $headers['http_code'];

                    $sql = 'INSERT INTO `url` (`url`, `data`, `timestamp`, `statuscode`) VALUES (:cadurl, :caddata, :cadtimestamp, :cadstatuscode)';
                    $stm = $pdo->prepare($sql);

                    $stm->bindParam(':cadurl', $cadurl);
                    $stm->bindParam(':caddata', $data);
                    $stm->bindParam(':cadtimestamp', $time);
                    $stm->bindParam(':cadstatuscode', $code);
                    $stm->execute();

                    echo json_encode(array("code" => 1, "message" => "URL cadastrada com sucesso!"));
                }
            } else {
                echo json_encode(array("code" => 0, "message" => "Ops! Algo deu errado. Por favor, tente novamente mais tarde."));
            }
        }

    } else {
        echo json_encode(array("code" => 0, "message" => "URL inválida"));
    }
    unset($pdo, $stmt, $stm);
}