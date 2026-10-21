<?php
require '../config.php';
session_start();

if (isset($_SESSION['admin_logado'])) {
    header('Location: index.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (hash_equals(ADMIN_USER, $usuario) && hash_equals(ADMIN_PASS, $senha)) {
        session_regenerate_id(true);
        $_SESSION['admin_logado'] = true;
        $_SESSION['admin_usuario'] = ADMIN_USER;

        header('Location: index.php');
        exit;
    }

    $erro = 'Usuário ou senha inválidos.';
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Administração — RASTRO + MARÉ</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<main class="login">
  <div class="card">
    <div class="eyebrow">Área administrativa</div>
    <h1>Gerenciar livro de visitas</h1>

    <p class="muted" style="margin:12px 0 22px">
      Acesso restrito à pessoa responsável pela revisão das opiniões.
    </p>

    <?php if ($erro): ?>
      <div class="notice error"><?= e($erro) ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="field">
        <label>USUÁRIO</label>
        <input name="usuario" required autocomplete="username">
      </div>

      <div class="field" style="margin-top:14px">
        <label>SENHA</label>
        <input type="password" name="senha" required autocomplete="current-password">
      </div>

      <button class="btn btn-primary" type="submit" style="width:100%;margin-top:18px">
        Entrar
      </button>
    </form>

    <p class="password-note">
      Acesso inicial: <b>admin</b> / <b>admin123</b>.
      As credenciais podem ser alteradas em <code>config.php</code>.
    </p>

    <p style="margin-top:18px">
      <a href="../index.php">← Voltar ao site</a>
    </p>
  </div>
</main>
</body>
</html>
