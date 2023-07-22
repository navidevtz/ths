<?php

    /*
        we are using user model to make our DB operations
    */

    class UserModel{
        private $con;

        // this constructor makes connection whenever the file is created
        function __construct(){
            require_once '../src/connection.php';
            $db = new DB();
            $this->con = $db->connect();

        }


        function add($username){
            $user = "INSERT INTO users (id,username,password,email) VALUES (?,?,?,?)";
            $stmt = $this->con->prepare($user);
            $stmt->bindParam("is", $id, $username, $password, $email);
            if($stmt->execute()){
                return true;
            }
            else return false;
        }

        function view($id){
            $db = new DB();
            $sql = "SELECT * from users where id = $id";

            $result = $db->dbQuery($sql);

            $userdata = $result->fetch(PDO::FETCH_ASSOC);
            //$user = array();

            if($userdata['id'] != null){
                $user = array(
                    'id' => $userdata['id'],
                    'username' => $userdata['username'],
                    'email' => $userdata['email']
                );
            }
            return $user;
        }

        function view_all(){
            $db = new DB();
            $sql = "SELECT * from users";
            $result = $db->dbQuery($sql);

            $users = array();
            $userdata = $result->fetchAll(PDO::FETCH_ASSOC);

            if($userdata != null){
                foreach($userdata as $u){
                    $user = array (
                        'id' => $u['id'],
                        'username' => $userdata['username'],
                        'email' => $userdata['email']
                    );
                    array_push($users, $user);
                }
            }
            return $users;
        }

        function changeUsername($id,$username){
            $db = new DB();
            $sql = "UPDATE users SET username = ? WHERE id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("is", $id, $username);

            $result = $db->dbQuery($sql);

            if($stmt->execute()){
                return true;
            }
            else return false;
        }

        function changePassword($id,$password){
            $db = new DB();
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam("is", $id, $password);

            $result = $db->dbQuery($sql);

            if($stmt->execute()){
                return true;
            }
            else return false;
        }

        function confirm($id){
            $db = new DB;
            $sql = "UPDATE users SET status = 'active' WHERE id = $id";
            $result = $db->dbQuery($sql);

            if($result){
                return true;
            }
            else return false;
        }

        function delete($id){
            $db = new DB();
            $stmt = $this->con->prepare("DELETE FROM users WHERE id = ? ");
            $stmt->bindParam("i", $id);
            //
            $result = $db->dbQuery($stmt);

            if($stmt->execute()){
                return true;
            }
            else return false;
        }
    }


    $us = new UserModel;
    $users = $us->view_all();
    foreach($users as $u){
        echo $users['username'] . "<br>";
    }
?>