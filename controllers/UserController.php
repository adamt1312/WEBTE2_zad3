<?php

require_once "helper/Database.php";

class UserController
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }


    public function registerUser ($name, $surname, $email, $password, $type, $google_id) {
        if (isset($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $stmt = $this->conn->prepare("insert into users (name,surname, email, password, type , google_id) values (:name, :surname, :email, :password, :type , :google_id)");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_STR);
        $stmt->bindParam(":google_id", $google_id, PDO::PARAM_STR);

        $stmt->execute();

        $stmt = $this->conn->prepare("select id from users where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $fetchedId = $stmt->fetch();

//        $datetime = date("Y-m-d") . " " . date("h:i:sa");
        $stmt = $this->conn->prepare("insert into logs (user_id) values (:user_id)");
        $stmt->bindParam(":user_id", $fetchedId['id'], PDO::PARAM_STR);
//        $stmt->bindParam(":timestamp", $datetime, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function isRegistered($email): bool
    {
        $stmt = $this->conn->prepare("select id from users where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $fetchedId = $stmt->fetch();


        if (isset($fetchedId)) {
            return true;
        }
        else
            return false;
    }

}