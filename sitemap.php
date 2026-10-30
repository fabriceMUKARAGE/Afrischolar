<?php require 'includes/db.php'; header('Content-Type: application/xml; charset=utf-8'); echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach(['index.php','scholarships.php','about.php'] as $p) echo '<url><loc>'.e(SITE_URL.'/'.$p).'</loc></url>';
foreach(db()->query("SELECT slug,updated_at FROM scholarships WHERE status<>'draft'") as $r) echo '<url><loc>'.e(SITE_URL.'/scholarship.php?s='.$r['slug']).'</loc><lastmod>'.date('Y-m-d',strtotime($r['updated_at'])).'</lastmod></url>';
echo '</urlset>';
