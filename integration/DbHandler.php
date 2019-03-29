<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbHandler
 *
 * @author Demit
 */

$db = new DbHandler();
if ($db->findWord("lepel") == TRUE){
    $db->printWord();
}
else {
    echo "niets gevonden";
}


class DbHandler {
    //dit noemen we in OO een attribute
    private $woord;
    
    //een functie in OO heet een method
    function findWord($woord){
        $result = FALSE;
        $this->woord = $woord;
        
        //stap 1: instellen PDO
        $options = [
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES      => false,
        ];
        
        $host = 'localhost';
        $charset = 'utf8mb4';
        $db = 'palindroom';
        $user = 'root';
        $password = '';
        
        $host = "mysql:host=$host; dbname=$db; charset=$charset";
        
        $sql = "SELECT * FROM palindromen WHERE woord ='". $woord ."';";
        
        try {
            //stap 2: connect met de db
            $conn = new PDO($host, $user, $password, $options);
            
            //stap 3: run the query
            $stmt = $conn->query($sql);
            
            //stap 4: fetch
            if ($stmt->rowCount() == 1){
                $result = TRUE;
            }     
        }
        catch (PDOException $e){
            echo "jouw tekst" . $e->getMessage()."(".$e->getCode().").";
        }
        return $result;
    }
    
    function printWord(){
        echo $this->woord;
    }
}
