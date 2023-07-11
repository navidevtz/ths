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


        function add($name){
            
            $user = "INSERT INTO users (id,name) VALUES (?,?)"; 
            $stmt = $this->con->prepare($user);
            $stmt->bind_param("is", $id, $name);
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
                    'name' => $userdata['name']
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
                       'name' => $u['name']                   
                    );
                    array_push($users, $user);

                }
            }
            return $users;
        }

        function update($id,$name){
            
            $sql = "UPDATE users SET name = ? WHERE id = ?";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("is", $id, $name);

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
            
            $stmt = $this->con->prepare("DELETE FROM users WHERE id = ? ");
            $stmt->bind_param("i", $id);
            //
            $result = $db->dbQuery($sql);

            if($stmt->execute()){
                return true; 
            }
            else return false; 
        }
    }


    //$us = new UserModel;
    // $users = $us->view_all();
?>