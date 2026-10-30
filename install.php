<?php // Run once in the browser, then DELETE this file.
require 'config.php'; $msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $pdo=new PDO('mysql:host='.DB_HOST.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
 $pdo->exec('CREATE DATABASE IF NOT EXISTS `'.DB_NAME.'` CHARACTER SET utf8mb4'); $pdo->exec('USE `'.DB_NAME.'`');
 foreach(array_filter(array_map('trim',explode(';',file_get_contents(__DIR__.'/database/schema.sql')))) as $q) $pdo->exec($q);
 $pdo->prepare("REPLACE INTO admins(id,username,password_hash) VALUES(1,?,?)")->execute([$_POST['u'],password_hash($_POST['p'],PASSWORD_DEFAULT)]);
 if(!$pdo->query('SELECT COUNT(*) FROM scholarships')->fetchColumn()){ require __DIR__.'/database/seed.php'; seed($pdo); }
 $msg='Installed. Delete install.php, then log in at admin/login.php';
}?>
<!doctype html><meta charset="utf-8"><link rel="stylesheet" href="assets/style.css"><main class="wrap narrow"><h1 class="pt">Install</h1><?php if($msg) echo '<p class="alert">'.htmlspecialchars($msg).'</p>'; ?>
<form method="post" class="form"><label>Admin username<input name="u" required></label><label>Admin password (12+ chars)<input name="p" type="password" minlength="12" required></label><button>Create database and admin</button></form></main>
