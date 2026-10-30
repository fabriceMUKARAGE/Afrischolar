<?php require 'includes/db.php'; header('Content-Type: application/json');
$em=filter_var(trim($_POST['email']??''),FILTER_VALIDATE_EMAIL); if(!$em){ echo json_encode(['ok'=>false,'msg'=>'Enter a valid email address.']); exit; }
$deg=substr($_POST['degree']??'',0,40);
$st=db()->prepare("INSERT INTO subscribers(email,degree_level,unsubscribe_token) VALUES(?,?,?) ON DUPLICATE KEY UPDATE degree_level=VALUES(degree_level),status='active'");
$st->execute([$em,$deg,bin2hex(random_bytes(16))]); echo json_encode(['ok'=>true,'msg'=>'You are subscribed. New scholarships arrive on Mondays.']);
