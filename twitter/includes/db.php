<?php

CONST DB_DSN = 'mysql:dbname=twitter;host=127.0.0.1;port=3306';
CONST DB_USER = 'root';
CONST DB_PWD = 'secret';

//connectie maken met DB
$db = new PDO(DB_DSN, DB_USER, DB_PWD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);