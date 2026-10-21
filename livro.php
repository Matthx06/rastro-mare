<?php
require 'config.php';

$pageTitle = 'Livro de visitas — MARÉ e RASTRO';
$ok = '';
$erro = '';

$visitas = lerVisitas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    if (!$nome || !$comentario) {
        $erro = 'Informe seu nome e escreva uma opinião.';
    } elseif (mb_strlen($nome) > 100) {
        $erro = 'O nome deve ter no máximo 100 caracteres.';
    } elseif ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Informe um e-mail válido ou deixe o campo vazio.';
    } elseif (mb_strlen($email) > 160) {
        $erro = 'O e-mail deve ter no máximo 160 caracteres.';
    } elseif (mb_strlen($comentario) > 1000) {
        $erro = 'A opinião deve ter no máximo 1000 caracteres.';
    } else {
        $novaVisita = [
            'id' => proximoIdVisita($visitas),
            'nome' => $nome,
            'email' => $email,
            'comentario' => $comentario,
            'status' => 'pendente',
            'criado_em' => date('Y-m-d H:i:s'),
            'atualizado_em' => null
        ];

        $visitas[] = $novaVisita;

        if (salvarVisitas($visitas)) {
            $ok = 'Sua opinião foi enviada e ficará aguardando a aprovação da equipe.';
        } else {
            array_pop($visitas);
            $erro = 'Não foi possível registrar a opinião no arquivo de visitas.';
        }
    }
}

/*
 * REGRA DO LIVRO DE VISITAS:
 * somente registros com status "aprovado" são exibidos ao público.
 * Pendentes e rejeitados nunca aparecem nesta página.
 */
$publicadas = array_values(array_filter(
    $visitas,
    fn($visita) => ($visita['status'] ?? '') === 'aprovado'
));

usort($publicadas, function ($a, $b) {
    return strcmp($b['criado_em'] ?? '', $a['criado_em'] ?? '');
});

$total = count($visitas);
$aprovados = count(array_filter($visitas, fn($v) => ($v['status'] ?? '') === 'aprovado'));
$pendentes = count(array_filter($visitas, fn($v) => ($v['status'] ?? '') === 'pendente'));

function iniciaisNome($nome) {
    $partes = preg_split('/\s+/', trim($nome));
    $ini = mb_substr($partes[0] ?? '', 0, 1);

    if (count($partes) > 1) {
        $ini .= mb_substr($partes[count($partes) - 1], 0, 1);
    }

    return mb_strtoupper($ini);
}

require 'header.php';
?>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Participação da comunidade</div>
      <h1>Livro de visitas</h1>
      <p>Deixe sua opinião sobre o projeto. Os comentários passam por uma área administrativa antes de aparecer publicamente.</p>
      <div style="margin-top:18px">
        <a class="btn btn-ghost" href="admin/login.php">🔐 Acessar área ADM</a>
      </div>
    </div>

    <div class="stat-band" style="margin-bottom:40px">
      <div class="stat-tile water">
        <div class="stat-num"><?= (int)$total ?></div>
        <div class="stat-label">opiniões recebidas ao todo, desde o lançamento do site.</div>
      </div>
      <div class="stat-tile land">
        <div class="stat-num"><?= (int)$aprovados ?></div>
        <div class="stat-label">publicadas após aprovação da equipe.</div>
      </div>
      <div class="stat-tile water">
        <div class="stat-num"><?= (int)$pendentes ?></div>
        <div class="stat-label">aguardando moderação neste momento.</div>
      </div>
      <div class="stat-tile land">
        <div class="stat-num">TXT</div>
        <div class="stat-label">as opiniões são armazenadas em arquivo de texto e não no banco SQL.</div>
      </div>
    </div>

    <?php if ($ok): ?>
      <div class="notice"><?= e($ok) ?></div>
    <?php endif; ?>

    <?php if ($erro): ?>
      <div class="notice error"><?= e($erro) ?></div>
    <?php endif; ?>

    <div class="visits">
      <div>
        <h2 style="margin-bottom:18px">Opiniões publicadas</h2>

        <?php if (!$publicadas): ?>
          <div class="empty">Ainda não há comentários aprovados. Seja o primeiro a deixar uma opinião ao lado.</div>
        <?php else: ?>
          <?php foreach ($publicadas as $c): ?>
            <article class="comment">
              <header>
                <div class="person" style="gap:10px">
                  <span class="avatar" style="width:38px;height:38px;font-size:.85rem">
                    <?= e(iniciaisNome($c['nome'])) ?>
                  </span>
                  <strong><?= e($c['nome']) ?></strong>
                </div>
                <time><?= e(date('d/m/Y H:i', strtotime($c['criado_em']))) ?></time>
              </header>
              <p><?= e($c['comentario']) ?></p>
            </article>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="project-box">
        <div class="eyebrow">Deixe sua opinião</div>

        <form method="post">
          <div class="field">
            <label>NOME</label>
            <input name="nome" required maxlength="100">
          </div>

          <div class="field" style="margin-top:14px">
            <label>E-MAIL (OPCIONAL)</label>
            <input type="email" name="email" maxlength="160">
          </div>

          <div class="field" style="margin-top:14px">
            <label>OPINIÃO</label>
            <textarea name="comentario" maxlength="1000" required placeholder="O que você achou do projeto?"></textarea>
          </div>

          <button class="btn btn-primary" type="submit" style="margin-top:16px">Enviar opinião</button>
        </form>

        <p class="mono" style="font-size:.72rem;color:var(--dim);margin-top:16px">
          Sua opinião só aparece publicamente depois de aprovada pelo administrador na área administrativa.
        </p>
      </div>
    </div>
  </div>
</section>

<?php require 'footer.php'; ?>
