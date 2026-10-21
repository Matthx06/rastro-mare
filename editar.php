<?php
require '../config.php';
session_start();

if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php');
    exit;
}

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$visitas = lerVisitas();
$indiceEncontrado = null;

foreach ($visitas as $indice => $visita) {
    if ((int)($visita['id'] ?? 0) === $id) {
        $indiceEncontrado = $indice;
        break;
    }
}

if ($indiceEncontrado === null) {
    header('Location: index.php');
    exit;
}

$c = $visitas[$indiceEncontrado];
$msg = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');
    $status = $_POST['status'] ?? 'pendente';

    if (!$nome || !$comentario) {
        $erro = 'Nome e opinião são obrigatórios.';
    } elseif (mb_strlen($nome) > 100 || mb_strlen($comentario) > 1000) {
        $erro = 'Verifique o limite de caracteres do nome e da opinião.';
    } elseif (!in_array($status, ['pendente', 'aprovado', 'rejeitado'], true)) {
        $erro = 'Status inválido.';
    } else {
        $visitas[$indiceEncontrado]['nome'] = $nome;
        $visitas[$indiceEncontrado]['comentario'] = $comentario;
        $visitas[$indiceEncontrado]['status'] = $status;
        $visitas[$indiceEncontrado]['atualizado_em'] = date('Y-m-d H:i:s');

        if (salvarVisitas($visitas)) {
            $c = $visitas[$indiceEncontrado];
            $msg = 'Comentário atualizado.';
        } else {
            $erro = 'Não foi possível salvar a alteração no arquivo TXT.';
        }
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Editar comentário — RASTRO + MARÉ</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<main class="admin-wrap">
  <div class="login" style="margin:30px auto">
    <div class="card">
      <div class="eyebrow">Moderação</div>
      <h1>Editar opinião #<?= e($id) ?></h1>

      <?php if ($msg): ?>
        <div class="notice"><?= e($msg) ?></div>
      <?php endif; ?>

      <?php if ($erro): ?>
        <div class="notice error"><?= e($erro) ?></div>
      <?php endif; ?>

      <form method="post">
        <input type="hidden" name="id" value="<?= e($id) ?>">

        <div class="field">
          <label>NOME</label>
          <input name="nome" value="<?= e($c['nome']) ?>" required maxlength="100">
        </div>

        <div class="field" style="margin-top:14px">
          <label>STATUS</label>
          <select name="status">
            <option value="pendente" <?= $c['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="aprovado" <?= $c['status'] === 'aprovado' ? 'selected' : '' ?>>Aprovado</option>
            <option value="rejeitado" <?= $c['status'] === 'rejeitado' ? 'selected' : '' ?>>Rejeitado</option>
          </select>
        </div>

        <div class="field" style="margin-top:14px">
          <label>OPINIÃO</label>
          <textarea name="comentario" required maxlength="1000"><?= e($c['comentario']) ?></textarea>
        </div>

        <button class="btn btn-primary" type="submit" style="margin-top:16px">
          Salvar alterações
        </button>

        <a class="btn btn-ghost" href="index.php" style="margin-top:10px;width:100%">
          Cancelar
        </a>
      </form>
    </div>
  </div>
</main>
</body>
</html>
