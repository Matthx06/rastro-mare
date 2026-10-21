<?php
require 'config.php'; $pageTitle='Espécies em risco — MARÉ e RASTRO';
$especies = require 'dados-especies.php';
require 'header.php';
?>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Monitoramento</div>
      <h1>Animais em risco de extinção</h1>
      <p>Onze espécies brasileiras monitoradas pelo MARÉ e pelo RASTRO, da água e da terra. Clique em cada card para ver ficha completa: nome científico, peso, tamanho, alimentação, habitat e principais ameaças.</p>
    </div>

    <div class="stat-band" style="margin-bottom:36px">
      <div class="stat-tile water"><div class="stat-num"><?= count(array_filter($especies, fn($e)=>$e['grupo']==='agua')) ?></div><div class="stat-label">espécies marinhas ou de água doce monitoradas pelo MARÉ.</div></div>
      <div class="stat-tile land"><div class="stat-num"><?= count(array_filter($especies, fn($e)=>$e['grupo']==='terra')) ?></div><div class="stat-label">espécies terrestres monitoradas pelo RASTRO.</div></div>
      <div class="stat-tile water"><div class="stat-num"><?= count(array_filter($especies, fn($e)=>$e['status']==='CR')) ?></div><div class="stat-label">classificadas como criticamente ameaçadas de extinção.</div></div>
      <div class="stat-tile land"><div class="stat-num">IUCN</div><div class="stat-label">classificação internacional usada como referência de status.</div></div>
    </div>

    <div class="sp-filters" id="spFilters">
      <button class="sp-filter-btn active" data-f="todas">TODAS</button>
      <button class="sp-filter-btn" data-f="agua">ODS 14 · ÁGUA</button>
      <button class="sp-filter-btn" data-f="terra">ODS 15 · TERRA</button>
      <button class="sp-filter-btn" data-f="CR">CRIT. AMEAÇADAS</button>
    </div>

    <div class="sp-card-grid" id="spGrid">
      <?php foreach($especies as $i => $sp): ?>
      <article class="sp-card" id="<?=e($sp['id'])?>" data-grupo="<?=e($sp['grupo'])?>" data-status="<?=e($sp['status'])?>">
        <div class="sp-photo-full" style="background-image:url('<?=e($sp['foto'])?>')">
          <span class="sp-tag"><?= $sp['grupo']==='agua' ? 'ODS 14' : 'ODS 15' ?></span>
          <span class="status-pill status-<?=e(strtolower($sp['status']))?>"><?=e(strtoupper($sp['status']))?></span>
        </div>
        <div class="sp-card-body">
          <h3><?=e($sp['nome'])?></h3>
          <div class="sci"><?=e($sp['cientifico'])?></div>
          <button class="sp-toggle" aria-expanded="false" aria-controls="det-<?=e($sp['id'])?>">
            Ver ficha completa <span class="chev">▾</span>
          </button>
          <div class="sp-details" id="det-<?=e($sp['id'])?>">
            <div class="sp-details-inner">
              <div class="sp-fact"><span class="k">Status</span><span class="v"><?=e($sp['status_label'])?></span></div>
              <div class="sp-fact"><span class="k">Peso</span><span class="v"><?=e($sp['peso'])?></span></div>
              <div class="sp-fact"><span class="k">Tamanho</span><span class="v"><?=e($sp['tamanho'])?></span></div>
              <div class="sp-fact"><span class="k">Alimentação</span><span class="v"><?=e($sp['alimentacao'])?></span></div>
              <div class="sp-fact"><span class="k">Habitat</span><span class="v"><?=e($sp['habitat'])?></span></div>
              <div class="sp-fact"><span class="k">Ameaças</span><span class="v"><?=e($sp['ameacas'])?></span></div>
            </div>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="callout" style="margin-top:36px">
      <p><strong>Fontes:</strong> classificações de status baseadas na Lista Vermelha da IUCN e em avaliações do ICMBio/MMA para espécies brasileiras. Fotografias: Wikimedia Commons, sob licenças Creative Commons — cada foto pertence ao fotógrafo e ao projeto original que a disponibilizou.</p>
    </div>
  </div>
</section>
<?php require 'footer.php'; ?>
