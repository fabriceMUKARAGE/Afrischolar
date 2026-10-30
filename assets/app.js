document.querySelectorAll('[data-sub]').forEach(f=>f.addEventListener('submit',async ev=>{
 ev.preventDefault(); const m=document.getElementById('submsg'), b=f.querySelector('button'); b.disabled=true;
 try{ const r=await fetch('subscribe.php',{method:'POST',body:new FormData(f)}); const j=await r.json(); m.textContent=j.msg; m.className='msg '+(j.ok?'ok':'err'); if(j.ok) f.reset(); }
 catch(x){ m.textContent='Something went wrong. Try again.'; m.className='msg err'; } b.disabled=false; }));
