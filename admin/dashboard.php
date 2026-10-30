<?php require 'auth.php'; ahead('Dashboard'); $p=db();
$c=fn($q)=>$p->query($q)->fetchColumn();
if(isset($_GET['del'])){ $p->prepare('DELETE FROM scholarships WHERE id=?')->execute([(int)$_GET['del']]); } ?>
<h1 class="pt">Dashboard</h1><div class="grid">
<div class="card"><h3><?=$c("SELECT COUNT(*) FROM scholarships WHERE status='published'")?> published</h3><p class="muted"><?=$c("SELECT COUNT(*) FROM scholarships WHERE status='draft'")?> drafts, <?=$c("SELECT COUNT(*) FROM scholarships WHERE status='expired'")?> expired</p></div>
<div class="card"><h3><?=$c("SELECT COUNT(*) FROM scholarships WHERE deadline BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 7 DAY)")?> close this week</h3><p class="muted"><?=$c("SELECT COUNT(*) FROM scholarships WHERE deadline IS NULL")?> have no deadline set</p></div>
<div class="card"><h3><?=$c("SELECT COUNT(*) FROM subscribers WHERE status='active'")?> subscribers</h3><p class="muted"><a href="subscribers.php">Export CSV</a></p></div></div>
<h2>All scholarships</h2><div style="overflow-x:auto"><table><tr><th>Title</th><th>Level</th><th>Deadline</th><th>Status</th><th></th></tr>
<?php foreach($p->query('SELECT id,title,degree_level,deadline,status FROM scholarships ORDER BY id DESC') as $r): ?>
<tr><td><?=e($r['title'])?></td><td><?=e($r['degree_level'])?></td><td><?=e($r['deadline']?:'Not set')?></td><td><?=e($r['status'])?></td><td><a href="edit.php?id=<?=$r['id']?>">Edit</a> &middot; <a href="?del=<?=$r['id']?>" onclick="return confirm('Delete this scholarship?')">Delete</a></td></tr><?php endforeach; ?></table></div></main>
