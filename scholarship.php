<?php require_once 'includes/db.php'; $st=db()->prepare("SELECT s.*,p.name provider,p.website FROM scholarships s JOIN providers p ON p.id=s.provider_id WHERE s.slug=? AND s.status<>'draft'"); $st->execute([$_GET['s']??'']); $s=$st->fetch();
if(!$s){ http_response_code(404); $title='Not found'; require 'includes/header.php'; echo '<main class="wrap"><h1 class="pt">Scholarship not found</h1><p><a href="scholarships.php">Browse scholarships</a></p></main>'; require 'includes/footer.php'; exit; }
$title=$s['title']; $desc=mb_substr($s['description'],0,155); require 'includes/header.php'; $closed=$s['status']=='expired'; ?>
<main class="wrap detail"><article>
<p class="muted"><a href="scholarships.php">Scholarships</a> / <?=e($s['country_of_study'])?></p>
<h1><?=e($s['title'])?></h1><p class="muted"><?=e($s['provider'])?></p>
<dl class="facts"><div><dt>Level</dt><dd><?=e($s['degree_level'])?></dd></div><div><dt>Funding</dt><dd><?=e($s['funding_type'])?></dd></div><div><dt>Study in</dt><dd><?=e($s['country_of_study'])?></dd></div><div><dt>Field</dt><dd><?=e($s['field'])?></dd></div>
<div><dt>Deadline</dt><dd><?=$s['deadline']?e(date('j M Y',strtotime($s['deadline']))).' ('.e(deadline_label($s['deadline'])).')':'Check official site'?></dd></div></dl>
<?php if($closed): ?><p class="alert">Applications for this round are closed. <a href="scholarships.php">See open scholarships</a>.</p><?php endif; ?>
<?php ad(); ?>
<h2>About</h2><p><?=nl2br(e($s['description']))?></p>
<h2>Who can apply</h2><p><?=nl2br(e($s['eligibility']))?></p>
<h2>What is covered</h2><p><?=nl2br(e($s['benefits']))?></p>
<?php ad(); ?>
<p><a class="btn" href="<?=e($s['application_url'])?>" target="_blank" rel="noopener nofollow">Apply on the official website</a></p>
<p class="muted small">Details change each year. Confirm on the official site before you apply.</p>
</article></main>
<script type="application/ld+json"><?=json_encode(['@context'=>'https://schema.org','@type'=>'EducationalOccupationalProgram','name'=>$s['title'],'provider'=>['@type'=>'Organization','name'=>$s['provider']]],JSON_UNESCAPED_SLASHES)?></script>
<?php require 'includes/footer.php';
