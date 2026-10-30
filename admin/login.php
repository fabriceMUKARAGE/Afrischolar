<?php require '../includes/db.php'; $err='';
if($_SERVER['REQUEST_METHOD']==='POST'){ $st=db()->prepare('SELECT * FROM admins WHERE username=?'); $st->execute([$_POST['u']??'']); $a=$st->fetch();
 if($a&&password_verify($_POST['p']??'',$a['password_hash'])){ session_regenerate_id(true); $_SESSION['admin']=1; header('Location: dashboard.php'); exit; } $err='Wrong username or password.'; usleep(500000); } ?>
<!doctype html><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin login</title><link rel="stylesheet" href="../assets/style.css">
<main class="wrap narrow"><h1 class="pt">Admin login</h1><?php if($err) echo '<p class="alert">'.e($err).'</p>'; ?><form method="post" class="form"><label>Username<input name="u" required></label><label>Password<input name="p" type="password" required></label><button>Log in</button></form></main>
