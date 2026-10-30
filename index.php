<?php require 'includes/header.php'; $pdo=db();
$cols="s.*,p.name provider";
$latest=$pdo->query("SELECT $cols FROM scholarships s JOIN providers p ON p.id=s.provider_id WHERE s.status='published' ORDER BY s.featured DESC,s.id DESC LIMIT 9")->fetchAll();
$soon=$pdo->query("SELECT $cols FROM scholarships s JOIN providers p ON p.id=s.provider_id WHERE s.status='published' AND s.deadline BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 45 DAY) ORDER BY s.deadline LIMIT 6")->fetchAll();
$total=$pdo->query("SELECT COUNT(*) FROM scholarships WHERE status='published'")->fetchColumn();
$countries=$pdo->query("SELECT DISTINCT country_of_study c FROM scholarships WHERE status='published' ORDER BY c")->fetchAll(PDO::FETCH_COLUMN); ?>
<section class="hero"><div class="wrap"><h1>Funding for the next African graduate, scholar and founder.</h1>
<p><?=$total?> scholarships, fellowships and grants. Search by country, level and deadline.</p>
<form action="scholarships.php" class="search"><input name="q" placeholder="Try &quot;PhD&quot;, &quot;Germany&quot; or &quot;engineering&quot;"><button>Search</button></form>
<div class="chips"><?php foreach(['Undergraduate','Master\'s','PhD','Fellowship'] as $l): ?><a href="scholarships.php?level=<?=urlencode($l)?>"><?=e($l)?></a><?php endforeach; ?><a href="scholarships.php?funding=Fully+funded">Fully funded</a></div></div></section>
<main class="wrap">
<?php if($soon): ?><h2>Closing soon</h2><div class="grid"><?php foreach($soon as $s) card($s); ?></div><?php endif; ?>
<?php ad(); ?>
<h2>Latest and featured</h2><div class="grid"><?php foreach($latest as $s) card($s); ?></div>
<p class="center"><a class="btn" href="scholarships.php">Browse all <?=$total?></a></p>
<h2>Study destinations</h2><div class="chips dark"><?php foreach($countries as $c): ?><a href="scholarships.php?country=<?=urlencode($c)?>"><?=e($c)?></a><?php endforeach; ?></div>
</main><?php require 'includes/footer.php';
