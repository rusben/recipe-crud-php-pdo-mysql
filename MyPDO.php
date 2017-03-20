<?php
 
class MyPDO {
    static function getConnection() 
    {
        $dbhost= 'localhost';
        $dbuser= 'username';
        $dbpass= 'password';
        $dbname= 'database';
 
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", 
                        $dbuser,
                        $dbpass,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
}
 
/**
 * Get a collection of examples
 */
function getExamples() {
 
    $sql = "SELECT * FROM example WHERE name = :name";
    $name = "John";
 
    try {
        $db = MyPDO::getConnection();
        $stmt = $db->prepare($sql);  
	$stmt->bindParam("name", $name);
	$stmt->execute();
	$examples = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $examples;
    } catch(PDOException $e) {
        $error = array("error"=> array("text"=>$e->getMessage()));
        return $error;
    }
}
 
/**
 * Get an example
 */
function getExample($id) {
 
    $sql = "SELECT * FROM example WHERE id = :id LIMIT 1";
 
    try {
        $db = MyPDO::getConnection();
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $example = $stmt->fetchObject();
        $db = null;
        return $example;
    } catch(PDOException $e) {
        $error = array("error"=> array("text"=>$e->getMessage()));
        return $error;
    }
}
 
/**
 * Insert an example
 */
function insertExample() {
    $sql = "INSERT INTO example (name) VALUES (:name)";
    $name = "John";
 
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("name", $name);
        $stmt->execute();
	$db = null;
    } catch(PDOException $e) {
        $error = array("error"=> array("text"=>$e->getMessage()));
        return $error;
    }
}
 
/**
 * Update an example
 */
function updateExample($id) {
    $sql = "UPDATE example SET name = :name WHERE id=:id";
    $name = "Peter";
 
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
	$stmt->bindParam("name", $name);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        $error = array("error"=> array("text"=>$e->getMessage()));
        return $error;
    }
}
 
/**
 * Delete an example
 */
function deleteExample($id) {
    $sql = "DELETE FROM example WHERE id = :id LIMIT 1";
 
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        $error = array("error"=> array("text"=>$e->getMessage()));
        return $error;
    }
}
?>
