<?php
$pageTitle = $pageTitle ?? 'RASTRO + MARÉ — ODS 14 e ODS 15';
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,900&family=Work+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header><nav class="wrap">
<a class="logo" href="index.php"><span class="logo-mark">◈</span> RASTRO <span style="color:var(--coral)">×</span> MARÉ</a>
<ul class="navlinks" id="navlinks">
<li><a href="index.php" class="<?= $current==='index.php'?'active':'' ?>">Início</a></li>
<li><a href="projeto.php" class="<?= $current==='projeto.php'?'active':'' ?>">Projeto</a></li>
<li><a href="especies.php" class="<?= $current==='especies.php'?'active':'' ?>">Espécies</a></li>
<li><a href="sobre.php" class="<?= $current==='sobre.php'?'active':'' ?>">Sobre</a></li>
<li><a href="contato.php" class="<?= $current==='contato.php'?'active':'' ?>">Contato</a></li>
<li><a href="livro.php" class="<?= $current==='livro.php'?'active':'' ?>">Livro de visitas</a></li>
<li><a href="https://unitau.br/cicted" target="_blank" rel="noopener">CICTED ↗</a></li>
</ul>
<a class="nav-cta" href="livro.php">Deixar opinião</a><button class="burger" id="burger" aria-label="Abrir menu">☰</button>
</nav></header>
