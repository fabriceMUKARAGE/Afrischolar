<?php require 'auth.php'; $p=db(); $id=(int)($_GET['id']??0); $s=[]; if($id){ $st=$p->prepare('SELECT s.*,pr.name provider FROM scholarships s JOIN providers pr ON pr.id=s.provider_id WHERE s.id=?'); $st->execute([$id]); $s=$st->fetch()?:[]; }
if($_SERVER['REQUEST_METHOD']==='POST'){ check_csrf(); $f=$_POST;
 $p->prepare('INSERT IGNORE INTO providers(name) VALUES(?)')->execute([trim($f['provider'])]); $q=$p->prepare('SELECT id FROM providers WHERE name=?'); $q->execute([trim($f['provider'])]); $pid=$q->fetchColumn();
 $dl=$f['deadline']?:null; $url=preg_match('#^https?://#',$f['application_url'])?$f['application_url']:'https://'.$f['application_url']; $slug=slugify($f['title']);
 $v=[$f['title'],$pid,$f['description'],$f['eligibility'],$f['benefits'],$f['country_of_study'],$f['degree_level'],$f['field']?:'All fields',$f['funding_type'],$dl,$url,isset($f['featured'])?1:0,$f['status']];
 if($id){ $p->prepare('UPDATE scholarships SET title=?,provider_id=?,description=?,eligibility=?,benefits=?,country_of_study=?,degree_level=?,field=?,funding_type=?,deadline=?,application_url=?,featured=?,status=? WHERE id=?')->execute([...$v,$id]); }
 else { $p->prepare('INSERT INTO scholarships(title,provider_id,description,eligibility,benefits,country_of_study,degree_level,field,funding_type,deadline,application_url,featured,status,slug) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)')->execute([...$v,$slug.'-'.substr(md5(uniqid()),0,4)]); }
 header('Location: dashboard.php'); exit; }
$g=fn($k,$d='')=>e($s[$k]??$d); ahead('Edit scholarship'); ?>
<h1 class="pt"><?=$id?'Edit':'Add'?> scholarship</h1><form method="post" class="form"><input type="hidden" name="csrf" value="<?=csrf()?>">
<label>Title<input name="title" value="<?=$g('title')?>" required></label><label>Provider<input name="provider" value="<?=$g('provider')?>" required></label>
<label>Study country<input name="country_of_study" value="<?=$g('country_of_study')?>" required></label>
<label>Level<select name="degree_level"><?php foreach(['Undergraduate',"Master's",'PhD','Fellowship',"Honours / Master's"] as $o) echo '<option'.(($s['degree_level']??'')==$o?' selected':'').'>'.e($o).'</option>'; ?></select></label>
<label>Funding<select name="funding_type"><?php foreach(['Fully funded','Partially funded'] as $o) echo '<option'.(($s['funding_type']??'')==$o?' selected':'').'>'.e($o).'</option>'; ?></select></label>
<label>Field<input name="field" value="<?=$g('field','All fields')?>"></label><label>Deadline (leave blank if unknown)<input type="date" name="deadline" value="<?=$g('deadline')?>"></label>
<label>Application link<input name="application_url" value="<?=$g('application_url')?>" required></label>
<label>Description<textarea name="description" rows="4"><?=$g('description')?></textarea></label><label>Eligibility<textarea name="eligibility" rows="4"><?=$g('eligibility')?></textarea></label><label>What is covered<textarea name="benefits" rows="3"><?=$g('benefits')?></textarea></label>
<label>Status<select name="status"><?php foreach(['published','draft','expired'] as $o) echo '<option'.(($s['status']??'published')==$o?' selected':'').'>'.$o.'</option>'; ?></select></label>
<label class="chk"><input type="checkbox" name="featured" <?=!empty($s['featured'])?'checked':''?>> Featured on homepage</label><button>Save</button></form></main>
