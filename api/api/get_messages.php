<?php
header('Content-Type: application/json');

include '../db.php';

$page = $_GET['page'] ?? 1;
$page_size = 10;
$offset = ($page-1)*$page_size;


$sql = 'SELECT * FROM `message` ORDER BY created_on DESC LIMIT :offset, :page_size';
$stmnt = $db->prepare($sql);
$stmnt->bindParam(':offset',  $offset, PDO::PARAM_INT);
$stmnt->bindParam(':page_size',  $page_size, PDO::PARAM_INT);
$stmnt->execute( );
$messages = $stmnt->fetchAll();

echo json_encode($messages);