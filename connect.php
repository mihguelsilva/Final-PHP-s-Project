<?php
session_start();
global $pdo;
try {
    $pdo = new PDO('mysql:dbname=final_project;host=localhost', 'eadccna', 'eadCCn@');
} catch(PDOException $e) {
    echo "Database Error: " . $e->getMessage();
    exit();
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
