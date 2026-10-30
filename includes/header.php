<?php require_once __DIR__.'/db.php'; expire_old(); $title=($title??'Scholarships for African students').' | '.SITE_NAME; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=e($title)?></title><meta name="description" content="<?=e($desc??'Search scholarships, fellowships and grants for African students.')?>">
<link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
<?php if(ADSENSE_CLIENT): ?><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?=e(ADSENSE_CLIENT)?>" crossorigin="anonymous"></script><?php endif; ?>
</head><body>
<header class="top"><div class="wrap nav"><a class="logo" href="index.php"><?=e(SITE_NAME)?></a>
<nav><a href="scholarships.php">All scholarships</a><a href="scholarships.php?closing=1">Closing soon</a><a href="scholarships.php?funding=Fully+funded">Fully funded</a><a href="about.php">About</a></nav></div></header>
