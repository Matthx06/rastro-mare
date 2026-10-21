<?php
require '../config.php';
session_start();

if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php');
    exit;
}

$visitas = lerVisitas();
$msg = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    $id = (int)($_POST['id'] ?? 0);

    $encontrado = false;

    foreach ($visitas as $indice => $visita) {
        if ((int)($visita['id'] ?? 0) !== $id) {
            continue;
        }

        $encontrado = true;

        if ($acao === 'aprovar') {
            $visitas[$indice]['status'] = 'aprovado';
            $visitas[$indice]['atualizado_em'] = date('Y-m-d H:i:s');
            $msg = 'Comentário aprovado e liberado para o Livro de Visitas.';
        } elseif ($acao === 'rejeitar') {
            $visitas[$indice]['status'] = 'rejeitado';
            $visitas[$indice]['atualizado_em'] = date('Y-m-d H:i:s');
            $msg = 'Comentário rejeitado. Ele não será exibido ao público.';
        } elseif ($acao === 'excluir') {
            unset($visitas[$indice]);
            $visitas = array_values($visitas);
            $msg = 'Comentário excluído do arquivo TXT.';
        } elseif ($acao === 'editar') {
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
                $visitas[$indice]['nome'] = $nome;
                $visitas[$indice]['comentario'] = $comentario;
                $visitas[$indice]['status'] = $status;
                $visitas[$indice]['atualizado_em'] = date('Y-m-d H:i:s');
                $msg = 'Comentário atualizado.';
            }
        }

        break;
    }

    if (!$encontrado && !$erro) {
        $erro = 'Comentário não encontrado.';
    }

    if (($msg || $acao === 'editar') && !$erro) {
        if (!salvarVisitas($visitas)) {
            $erro = 'Não foi possível salvar a alteração no arquivo TXT.';
            $msg = '';
        }
    }
}

usort($visitas, function ($a, $b) {
    return strcmp($b['criado_em'] ?? '', $a['criado_em'] ?? '');
});
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
<main class="admin-wrap">
  <div class="admin-top">
    <div>
      <div class="eyebrow">Área administrativa</div>
      <h1>Livro de visitas</h1>
      <p class="muted">
        Acesso de administrador. Aqui você pode permitir, editar, rejeitar ou excluir opiniões.
        Somente as opiniões aprovadas aparecem na página pública.
      </p>
    </div>

    <div class="actions">
      <a class="btn btn-ghost" href="../livro.php">Ver livro</a>
      <a class="btn btn-ghost" href="logout.php">Sair</a>
    </div>
  </div>

  <?php if ($msg): ?>
    <div class="notice"><?= e($msg) ?></div>
  <?php endif; ?>

  <?php if ($erro): ?>
    <div class="notice error"><?= e($erro) ?></div>
  <?php endif; ?>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>VISITANTE</th>
          <th>OPINIÃO</th>
          <th>STATUS</th>
          <th>DATA</th>
          <th>AÇÕES</th>
        </tr>
      </thead>

      <tbody>
      <?php if (!$visitas): ?>
        <tr>
          <td colspan="6">Nenhuma opinião cadastrada.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($visitas as $c): ?>
          <tr>
            <td>#<?= e($c['id']) ?></td>

            <td>
              <b><?= e($c['nome']) ?></b><br>
              <small><?= e($c['email'] ?? '') ?></small>
            </td>

            <td style="max-width:360px"><?= e($c['comentario']) ?></td>

            <td>
              <span class="status <?= e($c['status'] === 'aprovado' ? 'approved' : 'pending') ?>">
                <?= e(strtoupper($c['status'])) ?>
              </span>
            </td>

            <td><?= e(date('d/m/Y H:i', strtotime($c['criado_em']))) ?></td>

            <td>
              <div class="actions">
                <?php if (($c['status'] ?? '') !== 'aprovado'): ?>
                  <form method="post">
                    <input type="hidden" name="id" value="<?= e($c['id']) ?>">
                    <button class="btn mini btn-primary" name="acao" value="aprovar">Permitir</button>
                  </form>
                <?php endif; ?>

                <a class="btn mini btn-ghost" href="editar.php?id=<?= e($c['id']) ?>">Editar</a>

                <?php if (($c['status'] ?? '') !== 'rejeitado'): ?>
                  <form method="post">
                    <input type="hidden" name="id" value="<?= e($c['id']) ?>">
                    <button class="btn mini btn-ghost" name="acao" value="rejeitar">Rejeitar</button>
                  </form>
                <?php endif; ?>

                <form method="post" onsubmit="return confirm('Excluir este comentário definitivamente?')">
                  <input type="hidden" name="id" value="<?= e($c['id']) ?>">
                  <button class="btn mini btn-ghost" name="acao" value="excluir">Excluir</button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>
</body>
</html>
