const burger=document.getElementById('burger');
const nav=document.getElementById('navlinks');
if(burger&&nav){burger.addEventListener('click',()=>nav.classList.toggle('open'));nav.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>nav.classList.remove('open')))}
const clock=document.getElementById('clock');
function tick(){if(clock)clock.textContent=new Date().toTimeString().slice(0,8)}
if(clock){tick();setInterval(tick,1000)}

// página de espécies: expandir/recolher ficha ao clicar
document.querySelectorAll('.sp-toggle').forEach(btn=>{
  btn.addEventListener('click',()=>{
    const panel=document.getElementById(btn.getAttribute('aria-controls'));
    const open=btn.getAttribute('aria-expanded')==='true';
    btn.setAttribute('aria-expanded', open? 'false':'true');
    btn.querySelector('.chev').textContent = open ? '▾' : '▴';
    if(panel){ panel.style.maxHeight = open ? '0px' : panel.scrollHeight+'px'; }
  });
});

// página de espécies: filtros por grupo/status
const spFilters=document.getElementById('spFilters');
if(spFilters){
  spFilters.querySelectorAll('.sp-filter-btn').forEach(btn=>{
    btn.addEventListener('click',()=>{
      spFilters.querySelectorAll('.sp-filter-btn').forEach(b=>b.classList.remove('active'));
      btn.classList.add('active');
      const f=btn.dataset.f;
      document.querySelectorAll('#spGrid .sp-card').forEach(card=>{
        const show = f==='todas' || card.dataset.grupo===f || card.dataset.status===f;
        card.style.display = show ? '' : 'none';
      });
    });
  });
}
