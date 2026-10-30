<?php $title='Search scholarships'; require 'includes/header.php'; $pdo=db();
$w=["s.status IN ('published','expired')"]; $a=[];
if(($q=trim($_GET['q']??''))!==''){ $w[]="(s.title LIKE ? OR p.name LIKE ? OR s.field LIKE ? OR s.country_of_study LIKE ? OR s.description LIKE ?)"; array_push($a,...array_fill(0,5,"%$q%")); }
foreach(['level'=>'s.degree_level','country'=>'s.country_of_study','funding'=>'s.funding_type'] as $k=>$col) if(!empty($_GET[$k])){ $w[]="$col=?"; $a[]=$_GET[$k]; }
if(!empty($_GET['closing'])) $w[]="s.deadline BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 30 DAY)"; else if(empty($_GET['all'])) $w[]="s.status='published'";
$st=$pdo->prepare("SELECT s.*,p.name provider FROM scholarships s JOIN providers p ON p.id=s.provider_id WHERE ".implode(' AND ',$w)." ORDER BY s.deadline IS NULL,s.deadline,s.title"); $st->execute($a); $rows=$st->fetchAll();
function opts($col,$sel){ foreach(db()->query("SELECT DISTINCT $col v FROM scholarships ORDER BY v")->fetchAll(PDO::FETCH_COLUMN) as $v) echo '<option'.($v==$sel?' selected':'').'>'.e($v).'</option>'; } ?>
<main class="wrap"><h1 class="pt">Find a scholarship</h1>
<form class="filters" method="get"><input name="q" value="<?=e($q)?>" placeholder="Keyword">
<select name="level"><option value="">Any level</option><?php opts('degree_level',$_GET['level']??''); ?></select>
<select name="country"><option value="">Any destination</option><?php opts('country_of_study',$_GET['country']??''); ?></select>
<select name="funding"><option value="">Any funding</option><?php opts('funding_type',$_GET['funding']??''); ?></select>
<label class="chk"><input type="checkbox" name="closing" value="1" <?=!empty($_GET['closing'])?'checked':''?>> Closing in 30 days</label><button>Filter</button></form>
<p class="muted"><?=count($rows)?> result<?=count($rows)==1?'':'s'?></p>
<?php if(!$rows): ?><p class="empty">No match. Remove a filter or <a href="scholarships.php">see everything</a>.</p><?php endif; ?>
<div class="grid"><?php foreach($rows as $i=>$s){ card($s); } ?></div><?php ad(); ?></main><?php require 'includes/footer.php';
