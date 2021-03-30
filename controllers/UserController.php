<?php

require_once "helper/Database.php";
require_once 'helper/User.php';
require_once 'helper/Log.php';

class UserController
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }


    public function registerUser ($name, $surname, $email, $password, $type, $google_id, $secret) {
        if (isset($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $stmt = $this->conn->prepare("insert into users (name,surname, email, password, type , google_id, secret) values (:name, :surname, :email, :password, :type , :google_id, :secret)");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_STR);
        $stmt->bindParam(":google_id", $google_id, PDO::PARAM_STR);
        $stmt->bindParam(":secret", $secret, PDO::PARAM_STR);


        $stmt->execute();

        $stmt = $this->conn->prepare("select id from users where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $fetchedId = $stmt->fetch();

//        $this->recordLog($fetchedId['id']);

////        $datetime = date("Y-m-d") . " " . date("h:i:sa");
//        $stmt = $this->conn->prepare("insert into logs (user_id) values (:user_id)");
//        $stmt->bindParam(":user_id", $fetchedId['id'], PDO::PARAM_STR);
////        $stmt->bindParam(":timestamp", $datetime, PDO::PARAM_STR);
//
//        $stmt->execute();
    }

    public function isRegistered($email): bool
    {
        $stmt = $this->conn->prepare("select id from users where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $fetchedId = $stmt->fetch();


        if ($fetchedId == "") {
            return false;
        }
        else
            return true;
    }

    public function recordLog($uid) {
        $stmt = $this->conn->prepare("insert into logs (user_id) values (:user_id)");
        $stmt->bindParam(":user_id", $uid, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function getSecret($email) {
        $stmt = $this->conn->prepare("select secret from users where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $fetchedSecret = $stmt->fetch();

        return $fetchedSecret['secret'];
    }

    public function getUser($email) {
        $stmt = $this->conn->prepare("select id,name,surname,email,type from users where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS,'User');
        $stmt->execute();
        $user = $stmt->fetch();

        $stmt = $this->conn->prepare("select user_id, timestamp from logs where user_id = :user_id order by timestamp DESC limit 10;");
        $stmt->bindParam(":user_id",$user->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_CLASS, "Log");
        $user->setLogs($logs);
        if (isset($user)) {
            return $user;
        }
        else return null;
    }


    public function loginValidation ($email, $password): bool
    {
        $stmt = $this->conn->prepare("select password from users where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $fetchedPass = $stmt->fetch();

        if (!$fetchedPass) {
            return false;
        }
        else {
            if (password_verify ($password,$fetchedPass['password'])) {
                return true;
            }
            else
                return false;
        }
    }

    public function getUserId($email) {
        $stmt = $this->conn->prepare("select id from users where email = :email;");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $uid = $stmt->fetch();
        if (isset($uid)) {
            return $uid['id'];
        }
        else return null;
    }

    public function getClassicType() {
        $stmt = $this->conn->prepare("SELECT COUNT(id) FROM users WHERE type = 'classic'");

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['COUNT(id)'];
    }

    public function getGoogleType() {
        $stmt = $this->conn->prepare("SELECT COUNT(id) FROM users WHERE type = 'google'");

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['COUNT(id)'];
    }

    public function getLdapType() {
        $stmt = $this->conn->prepare("SELECT COUNT(id) FROM users WHERE type = 'ldap'");

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['COUNT(id)'];
    }
}