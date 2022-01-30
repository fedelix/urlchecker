<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();

require_once "src/database.php";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM usuarios WHERE user = :username";
        
    if($stmt = $pdo->prepare($sql)) {
        $username = trim($_POST["user"]);
        $password = $_POST['pass'];

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        
        if($stmt->execute()) {
            if($stmt->rowCount() == 1){
                if($row = $stmt->fetch()){
                    $id = $row["id"];
                    $username = $row["user"];
                    $hashed_password = $row["pass"];
                    if(password_verify($password, $hashed_password)){
                        session_start();
                        
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        
                        echo json_encode(array("code" => 1, "message" => ""));
                        
                    } else {
                        echo json_encode(array("code" => 0, "message" => "Nome de usuário ou senha inválidos"));
                    }
                }
            } else {
                echo json_encode(array("code" => 0, "message" => "Nome de usuário ou senha inválidos."));
            }
        } else {
            echo json_encode(array("code" => 0, "message" => "Ops! Algo deu errado. Por favor, tente novamente mais tarde."));
        }
        unset($stmt);
    }
    unset($pdo);
}