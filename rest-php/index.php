<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/reports', 'getReports');
$app->get('/reports/:id', 'getReport');
$app->get('/users','getUsers');



$app->run();

function getReports() {

    $page =0;
    if (isset($_GET['page'])) {
     $page=$_GET['page'];
    }
    $page = $page*10;

    $sql = "SELECT * FROM REPORT ORDER BY CREATED_ON DESC LIMIT :page , 10";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("page", $page, PDO::PARAM_INT);
        $stmt->execute();
        $reports = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        // Include support for JSONP requests
        if (!isset($_GET['callback'])) {
            echo json_encode($reports);
        } else {
            echo $_GET['callback'] . '(' . json_encode($reports) . ');';
        }

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getReport($id) {
    $sql = "SELECT * FROM REPORT WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $report = $stmt->fetchObject();
        $db = null;

        // Include support for JSONP requests
        if (!isset($_GET['callback'])) {
            echo json_encode($report);
        } else {
            echo $_GET['callback'] . '(' . json_encode($report) . ');';
        }

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}




function getUsers() {

    $page =0;
    if (isset($_GET['page'])) {
     $page=$_GET['page'];
    }
    $page = $page*10;

    $sql = "SELECT * FROM V_AUTHOR_STATS ORDER BY REPORTS_COUNT DESC LIMIT :page , 10";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("page", $page, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        // Include support for JSONP requests
        if (!isset($_GET['callback'])) {
            echo json_encode($users);
        } else {
            echo $_GET['callback'] . '(' . json_encode($users) . ');';
        }

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}



function getConnection() {
    $dbhost="";
    $dbuser="";
    $dbpass="";
    $dbname="";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}