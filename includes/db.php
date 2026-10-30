<?php
require_once __DIR__.'/../config.php';
session_start();
function db(): PDO { static $p; if(!$p){ $p=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]); } return $p; }
function e($s){ return htmlspecialchars((string)$s,ENT_QUOTES,'UTF-8'); }
function slugify($s){ return trim(preg_replace('/[^a-z0-9]+/','-',strtolower($s)),'-'); }
function days_left($d){ if(!$d) return null; return (int)((strtotime($d)-strtotime(date('Y-m-d')))/86400); }
function deadline_label($d){ $n=days_left($d); if($n===null) return 'Check official site'; if($n<0) return 'Closed'; if($n==0) return 'Closes today'; return $n.' day'.($n==1?'':'s').' left'; }
function ad(){ if(!ADSENSE_CLIENT) return; echo '<aside class="ad" aria-label="Advertisement"><span class="ad-label">Advertisement</span><ins class="adsbygoogle" style="display:block" data-ad-client="'.e(ADSENSE_CLIENT).'" data-ad-slot="'.e(ADSENSE_SLOT).'" data-ad-format="auto" data-full-width-responsive="true"></ins><script>(adsbygoogle=window.adsbygoogle||[]).push({});</script></aside>'; }
function expire_old(){ db()->exec("UPDATE scholarships SET status='expired' WHERE status='published' AND deadline IS NOT NULL AND deadline<CURDATE()"); }
function csrf(){ return $_SESSION['csrf']??($_SESSION['csrf']=bin2hex(random_bytes(16))); }
function check_csrf(){ if(!hash_equals($_SESSION['csrf']??'',$_POST['csrf']??'')) die('Invalid request'); }
function card($s){ $n=days_left($s['deadline']); ?>
<a class="card" href="scholarship.php?s=<?=e($s['slug'])?>">
 <div class="tags"><span class="tag lvl"><?=e($s['degree_level'])?></span><span class="tag fund"><?=e($s['funding_type'])?></span></div>
 <h3><?=e($s['title'])?></h3>
 <p class="muted"><?=e($s['provider'])?> &middot; <?=e($s['country_of_study'])?></p>
 <p class="dl <?=($n!==null&&$n>=0&&$n<=14)?'hot':''?>"><?=e(deadline_label($s['deadline']))?></p>
</a><?php }
