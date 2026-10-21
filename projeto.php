<?php require 'config.php'; $pageTitle='Projeto — MARÉ e RASTRO'; require 'header.php'; ?>

<section class="project-hero">
  <div class="project-visual" aria-hidden="true"></div>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Projeto acadêmico</div>
      <h1>MARÉ e RASTRO: plataforma digital de denúncia e educação ambiental para proteção da vida marinha e terrestre</h1>
      <p>Objetivos de Desenvolvimento Sustentável: <strong>ODS 14 — Vida na Água</strong> e <strong>ODS 15 — Vida Terrestre</strong>.</p>
      <div class="tag-row">
        <span class="tag-pill water">Fauna silvestre</span>
        <span class="tag-pill water">Biodiversidade</span>
        <span class="tag-pill land">Cidadania</span>
        <span class="tag-pill land">Tecnologia social</span>
        <span class="tag-pill water">Sustentabilidade</span>
      </div>
    </div>

    <div class="project-box" id="resumo">
      <div class="eyebrow">Resumo</div>
      <p>A perda de biodiversidade nos ecossistemas marinhos e terrestres avança de forma silenciosa e, muitas vezes, mais rápida do que a capacidade de fiscalização dos órgãos ambientais competentes, fenômeno diretamente relacionado às metas dos Objetivos de Desenvolvimento Sustentável (ODS) 14 e 15 da Agenda 2030 da ONU. Práticas como pesca predatória, vazamento de óleo, tráfico de fauna, caça ilegal e destruição de manguezais, recifes e áreas de preservação permanente frequentemente não são denunciadas, seja por desconhecimento da população sobre o que configura crime ambiental, seja pela falta de canais acessíveis, seguros e orientados que conectem o cidadão observador aos órgãos responsáveis.</p>
      <p>Diante desse cenário, o presente trabalho teve como objetivo desenvolver e integrar duas plataformas digitais colaborativas, MARÉ, voltada à vida marinha, e RASTRO, voltada à vida terrestre, destinadas a facilitar o registro de denúncias ambientais, ampliar o conhecimento da comunidade sobre legislação e crimes contra a fauna e a flora, e orientar o cidadão sobre os canais oficiais adequados para cada tipo de ocorrência.</p>
      <p>A metodologia adotada consistiu no desenvolvimento de aplicações web responsivas, construídas com tecnologias front-end modernas, contendo formulário de denúncia exclusivamente anônimo, mapa de referência com áreas sensíveis, como zonas de pesca ilegal, recifes de coral e manguezais, painel informativo com fichas de espécies ameaçadas segundo classificação da IUCN, e um módulo interativo de perguntas e respostas que apresenta situações reais para que o usuário exercite a identificação de condutas configuradas como crime ambiental antes de realizar o registro.</p>
      <p>Também foi planejada a implementação de um sistema de consulta do status da denúncia por meio de identificador único, de um banco de dados para armazenamento estruturado das ocorrências e de parceria institucional com a rede Traços para ampliar o alcance educativo e social da iniciativa, reforçando sempre o caráter independente do projeto em relação aos órgãos públicos de fiscalização.</p>
      <p>Como resultados esperados, projeta-se o aumento da qualidade e da quantidade de denúncias ambientais direcionadas aos órgãos competentes, a redução de registros duplicados ou incompletos por meio da etapa educativa prévia, e o fortalecimento da percepção da comunidade escolar e costeira como agente ativo de vigilância e conservação ambiental.</p>
      <p>Conclui-se que a integração entre tecnologia, educação ambiental e participação cidadã, alinhada aos ODS 14 e 15, apresenta-se como estratégia viável para aproximar a sociedade civil dos mecanismos formais de proteção da biodiversidade marinha e terrestre, contribuindo para a formação de jovens protagonistas comprometidos com a sustentabilidade e a conservação dos ecossistemas.</p>
      <p class="mono" style="margin-top:24px;color:var(--teal)">Palavras-chave: Fauna silvestre · Biodiversidade · Cidadania · Tecnologia social · Sustentabilidade</p>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Objetivos</div>
      <h2>O que o projeto se propõe a fazer</h2>
    </div>
    <div class="icon-grid">
      <div class="icon-tile"><span class="ic-badge">01</span><h5>Facilitar a denúncia</h5><p>Reduzir a distância entre quem observa e quem fiscaliza.</p></div>
      <div class="icon-tile"><span class="ic-badge">02</span><h5>Educar sobre legislação</h5><p>Explicar, em linguagem simples, o que a lei já considera crime.</p></div>
      <div class="icon-tile"><span class="ic-badge">03</span><h5>Orientar o canal certo</h5><p>Evitar denúncias perdidas no lugar errado.</p></div>
      <div class="icon-tile"><span class="ic-badge">04</span><h5>Monitorar espécies</h5><p>Reunir status de conservação num só painel, terra e mar.</p></div>
    </div>
  </div>
</section>

<section style="background:var(--panel2)">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Metodologia</div>
      <h2>Como o projeto foi construído</h2>
      <p>Etapas seguidas no desenvolvimento das duas plataformas, do planejamento à publicação.</p>
    </div>
    <div class="timeline">
      <div class="timeline-step"><span class="tnum">01</span><div><h4>Pesquisa e definição do problema</h4><p>Levantamento de dados sobre pesca predatória, tráfico de fauna, maus-tratos e desmatamento, com base em fontes oficiais e trabalhos apresentados no CICTED.</p></div></div>
      <div class="timeline-step"><span class="tnum">02</span><div><h4>Estruturação do conteúdo educativo</h4><p>Definição dos sinais de alerta, das espécies monitoradas e da legislação ambiental de referência para os dois ecossistemas.</p></div></div>
      <div class="timeline-step"><span class="tnum">03</span><div><h4>Desenvolvimento front-end</h4><p>Construção de páginas responsivas, com HTML5, CSS3 e JavaScript, priorizando acessibilidade e navegação simples.</p></div></div>
      <div class="timeline-step"><span class="tnum">04</span><div><h4>Banco de dados e formulários</h4><p>Integração do formulário de contato com SQL e criação da área administrativa para revisar as opiniões do Livro de Visitas, que são armazenadas em arquivo TXT.</p></div></div>
      <div class="timeline-step"><span class="tnum">05</span><div><h4>Testes e ajustes</h4><p>Validação de formulários, responsividade em diferentes telas e revisão do conteúdo com a orientação do professor.</p></div></div>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Resultados esperados</div>
      <h2>O que se espera alcançar</h2>
    </div>
    <div class="stat-band">
      <div class="stat-tile water"><div class="stat-num">↑</div><div class="stat-label">Mais denúncias chegando ao órgão certo, com menos informação perdida no caminho.</div></div>
      <div class="stat-tile land"><div class="stat-num">↓</div><div class="stat-label">Menos registros duplicados ou incompletos, graças à etapa educativa antes do formulário.</div></div>
      <div class="stat-tile water"><div class="stat-num">＋</div><div class="stat-label">Mais consciência da comunidade escolar sobre legislação ambiental básica.</div></div>
      <div class="stat-tile land"><div class="stat-num">🤝</div><div class="stat-label">Mais gente se enxergando como agente ativo de conservação, não só espectador.</div></div>
    </div>
    <div class="pull-quote">"A integração entre tecnologia, educação ambiental e participação cidadã é uma estratégia viável para aproximar a sociedade civil dos mecanismos formais de proteção da biodiversidade."</div>
  </div>
</section>

<section style="background:var(--panel2)">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow">Estrutura do projeto</div>
      <h2>Como as plataformas se complementam</h2>
    </div>
    <div class="cards">
      <div class="card"><div class="eyebrow">MARÉ</div><h3>ODS 14 — Vida na Água</h3><p>Plataforma dedicada às ocorrências e à conservação da vida marinha: pesca predatória, poluição, tráfico de fauna marinha e encalhes.</p></div>
      <div class="card"><div class="eyebrow">RASTRO</div><h3>ODS 15 — Vida Terrestre</h3><p>Plataforma dedicada às ocorrências e à conservação da vida terrestre: caça ilegal, tráfico de fauna, maus-tratos e desmatamento.</p></div>
    </div>
  </div>
</section>
<?php require 'footer.php'; ?>
