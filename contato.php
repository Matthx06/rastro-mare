<?php
require 'config.php'; $pageTitle='Contato — MARÉ e RASTRO'; $ok=''; $erro='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $nome=trim($_POST['nome']??'');$email=trim($_POST['email']??'');$assunto=trim($_POST['assunto']??'');$mensagem=trim($_POST['mensagem']??'');
  if(!$nome||!filter_var($email,FILTER_VALIDATE_EMAIL)||!$assunto||!$mensagem){$erro='Preencha todos os campos corretamente.';}
  else{try{db()->prepare('INSERT INTO contatos(nome,email,assunto,mensagem) VALUES(?,?,?,?)')->execute([$nome,$email,$assunto,$mensagem]);$ok='Mensagem registrada com sucesso. Obrigado pelo contato!';}catch(Throwable $e){$erro='Não foi possível registrar a mensagem. Verifique se o banco foi instalado.';}}
}
require 'header.php';
?>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Contato</div>
      <h1>Fale com a equipe</h1>
      <p>Envie uma dúvida, sugestão ou comentário sobre o projeto. Se for uma ocorrência ambiental real, use direto os canais oficiais ao lado — eles são mais rápidos que qualquer formulário.</p>
    </div>

    <div class="stat-band" style="margin-bottom:44px">
      <div class="stat-tile land"><div class="stat-num">190</div><div class="stat-label">Polícia Militar — flagrante de caça, maus-tratos ou transporte irregular de animais.</div></div>
      <div class="stat-tile water"><div class="stat-num">0800 61 8080</div><div class="stat-label">Linha Verde do IBAMA — denúncias de desmatamento, caça e tráfico de fauna, ligação gratuita.</div></div>
      <div class="stat-tile water"><div class="stat-num">(12) 3635-4091</div><div class="stat-label">CAS — Controle de Animais Sinantrópicos de Taubaté, para resgates e maus-tratos na cidade.</div></div>
      <div class="stat-tile land"><div class="stat-num">153</div><div class="stat-label">Guarda Civil Municipal — apoio local em ocorrências urbanas envolvendo animais.</div></div>
    </div>

    <div style="display:grid;grid-template-columns:1.2fr .8fr;gap:36px" class="contact-cols">
      <div class="project-box">
        <?php if($ok): ?><div class="notice"><?=e($ok)?></div><?php endif;?>
        <?php if($erro): ?><div class="notice error"><?=e($erro)?></div><?php endif;?>
        <form method="post">
          <div class="form-grid">
            <div class="field"><label>NOME</label><input name="nome" required maxlength="100"></div>
            <div class="field"><label>E-MAIL</label><input type="email" name="email" required maxlength="160"></div>
            <div class="field full"><label>ASSUNTO</label><input name="assunto" required maxlength="160"></div>
            <div class="field full"><label>MENSAGEM</label><textarea name="mensagem" required></textarea></div>
          </div>
          <button class="btn btn-primary" type="submit" style="margin-top:18px">Enviar mensagem</button>
        </form>
      </div>
      <div>
        <div class="icon-grid" style="grid-template-columns:1fr">
          <div class="icon-tile" style="text-align:left"><span class="ic-badge">14</span><h5>MARÉ · ODS 14</h5><p>Denúncias e dúvidas sobre vida marinha — pesca predatória, poluição, tráfico de fauna marinha.</p></div>
          <div class="icon-tile" style="text-align:left"><span class="ic-badge">15</span><h5>RASTRO · ODS 15</h5><p>Denúncias e dúvidas sobre vida terrestre — caça ilegal, tráfico, maus-tratos, desmatamento.</p></div>
          <div class="icon-tile" style="text-align:left"><span class="ic-badge">◈</span><h5>Etec Dr. José Geraldo R. Alckmin</h5><p>Centro Paula Souza · Taubaté — SP.</p></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section style="background:var(--panel2)">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Antes de escrever</div>
      <h2>Perguntas rápidas</h2>
    </div>
    <details class="faq-item" open>
      <summary>Este formulário é um canal de denúncia oficial?</summary>
      <div class="faq-body">Não. Este formulário é para contato com a equipe do projeto — dúvidas, sugestões, parcerias. Denúncias reais devem ser feitas aos canais oficiais listados acima (190, IBAMA, CAS).</div>
    </details>
    <details class="faq-item">
      <summary>Quanto tempo leva para receber uma resposta?</summary>
      <div class="faq-body">Como este é um projeto acadêmico, o retorno depende da disponibilidade da equipe — não há SLA de atendimento como em um canal oficial.</div>
    </details>
  </div>
</section>

<style>@media(max-width:900px){.contact-cols{grid-template-columns:1fr !important}}</style>
<?php require 'footer.php'; ?>
