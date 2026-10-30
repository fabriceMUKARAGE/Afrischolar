<?php require_once __DIR__.'/../includes/db.php'; if(empty($_SESSION['admin'])){ header('Location: login.php'); exit; }
header('Content-Type: text/csv'); header('Content-Disposition: attachment; filename=subscribers.csv'); $o=fopen('php://output','w'); fputcsv($o,['email','level','status','subscribed_at']);
foreach(db()->query('SELECT email,degree_level,status,subscribed_at FROM subscribers') as $r) fputcsv($o,$r);
