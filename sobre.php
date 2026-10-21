<?php
require 'config.php'; $pageTitle='Sobre o grupo — MARÉ e RASTRO';
$autores = ['Matheus Ricardo','Samuel Gondim','Davi Araújo','Melissa Rosa','Matheus Augusto','Miguel Torres','Rodrigo Farrapo','Thiago Chiroque'];
function iniciais($nome){
  $partes = explode(' ', trim($nome));
  $ini = mb_substr($partes[0],0,1);
  if(count($partes) > 1) $ini .= mb_substr($partes[count($partes)-1],0,1);
  return mb_strtoupper($ini);
}
require 'header.php';
?>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Sobre</div>
      <h1>Quem está por trás do projeto</h1>
      <p>O trabalho reúne os autores indicados no resumo enviado ao CICTED e identifica separadamente os responsáveis pelo desenvolvimento do site.</p>
    </div>
    <div class="stat-band" style="margin-bottom:40px">
      <div class="stat-tile water"><div class="stat-num"><?= count($autores) ?></div><div class="stat-label">autores assinam o trabalho acadêmico completo.</div></div>
      <div class="stat-tile land"><div class="stat-num">2</div><div class="stat-label">ODS trabalhados: vida na água e vida terrestre.</div></div>
      <div class="stat-tile water"><div class="stat-num">2</div><div class="stat-label">orientadores acompanharam o desenvolvimento.</div></div>
      <div class="stat-tile land"><div class="stat-num">1</div><div class="stat-label">site, desenvolvido individualmente por um dos autores.</div></div>
    </div>
    <div class="divider-label">AUTORES DO TRABALHO</div>
    <div class="authors">
      <?php foreach($autores as $name): ?>
        <div class="person">
          <span class="avatar"><?= e(iniciais($name)) ?></span>
          <div class="person-info"><h3><?= e($name) ?></h3><small>Autor(a) do trabalho · Turma 2B</small></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section style="background:var(--panel2)">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Orientação</div>
      <h2>Orientadores</h2>
      <p>Responsáveis por acompanhar e validar o desenvolvimento do trabalho junto ao grupo.</p>
    </div>
    <div class="cards">
      <div class="card">
        <div class="person" style="margin-bottom:14px"><span class="avatar">GM</span><div class="person-info"><h3>Guizela Silva Medeiros</h3><small>Orientadora do trabalho</small></div></div>
        <p>Acompanhou a definição do escopo do projeto, a estrutura do site e a adequação às exigências do CICTED.</p>
      </div>
      <div class="card">
        <div class="person" style="margin-bottom:14px"><span class="avatar">RT</span><div class="person-info"><h3>Ricardo José Rodrigues de Toledo</h3><small>Orientador do trabalho</small></div></div>
        <p>Contribuiu com a orientação técnica e pedagógica ao longo do desenvolvimento do projeto.</p>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Desenvolvimento web</div>
      <h2>Criação do site</h2>
      <p>Conforme a orientação do CICTED, o site apresentado nesta versão foi desenvolvido individualmente.</p>
    </div>
    <div class="cards">
      <div class="card">
        <div class="person" style="margin-bottom:14px"><span class="avatar">MB</span><div class="person-info"><h3>Matheus Augusto Landim Bacellar</h3><small>Desenvolvimento individual deste site</small></div></div>
        <p>Responsável pela estrutura, design, banco de dados e integração das páginas desta versão do MARÉ + RASTRO, a partir do trabalho em grupo registrado no CICTED.</p>
      </div>
    </div>
    <div class="callout" style="margin-top:28px">
      <span class="callout-label">INSTITUIÇÃO</span>
      <p><strong>Etec Dr. José Geraldo Rodriguez Alckmin</strong> · Centro Paula Souza · Taubaté — SP. Trabalho apresentado no XV CICTED, categoria ENIC Teens.</p>
    </div>
  </div>
</section>
<?php require 'footer.php'; ?>
