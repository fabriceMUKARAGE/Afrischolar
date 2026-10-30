<?php $title='Unsubscribe'; require 'includes/header.php'; $m='';
if($_SERVER['REQUEST_METHOD']==='POST'){ $st=db()->prepare("UPDATE subscribers SET status='unsubscribed' WHERE email=?"); $st->execute([trim($_POST['email']??'')]); $m='Done. You will not receive more emails.'; }
if(!empty($_GET['t'])){ $st=db()->prepare("UPDATE subscribers SET status='unsubscribed' WHERE unsubscribe_token=?"); $st->execute([$_GET['t']]); $m='Done. You will not receive more emails.'; } ?>
<main class="wrap narrow"><h1 class="pt">Unsubscribe</h1><?php if($m) echo '<p class="alert">'.e($m).'</p>'; ?>
<form method="post" class="subform"><input type="email" name="email" placeholder="Your email" required><button>Unsubscribe</button></form></main><?php require 'includes/footer.php';
