<?php

    class DB{

        public $conlink;

        public function connect(){

            $host = '127.0.0.1';
            $user= 'rooter';
            $pass = 'toor';
            $db = 'testdb';

            //include_once dirname(__FILE__) . '/con-vars.php';
            try {
                //echo "hello " . $host . " " . $db ." " . $user . " " . $pass . "<br>";
                $conlink = new PDO("mysql:server=$host'; dbname=$db; charset=utf8;", $user, $pass);
                //echo "hello one <br>";
                $conlink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($conlink){
                    //echo "DB connected successfully<br>";
                }
            }
            catch(PDOException $e) {
                echo "Connection failed! " . $e->getMessage();
            }
            //echo "helllo<br>";
            return $conlink;
        }

        public function dbQuery($sql){

            $con = $this->connect();
            try {
                $stmt = $con->query($sql);
                if($stmt){
                    return $stmt;
                }
            } catch (PDOException $e) {
                echo "Database processing error. " . $e->getMessage();
            }
        }

    }

    // for simple testing purpose
    /*
    echo "hel<br>";
    $db = new DB();
    $c = $db->connect();
    $q = "SELECT * from users";
    $c1 = $db->dbQuery($q);

    if($c1->rowCount()>0){
        //echo "good<br>";echo '<br/>';
        $us = $c1->fetchAll();//echo '<br/>';
        foreach ($us as $u){
            echo $u[0] . " " .$u[1] . "<br/>";
        }
    }
    */
?>