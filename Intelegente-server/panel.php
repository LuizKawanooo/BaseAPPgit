<?php require_once __DIR__.'/config.php'; ?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Painel ESP8266 (UOL Host)</title>
<style>
  body{font-family:system-ui,Arial; background:#f7f7fb; margin:0; color:#222;}
  header{padding:16px 24px; background:#111827; color:#fff;}
  .container{max-width:980px; margin:24px auto; padding:0 16px;}
  .grid{display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:16px;}
  .card{background:#fff; border-radius:14px; box-shadow:0 6px 20px rgba(0,0,0,.07); padding:16px; text-align:center;}
  .name{font-weight:700; font-size:18px;}
  .muted{color:#666; font-size:12px;}
  .row{display:flex; gap:8px; justify-content:center; margin-top:10px;}
  button{border:0; padding:10px 16px; border-radius:10px; cursor:pointer; font-weight:600;}
  .on{background:#10b981; color:#fff;}
  .off{background:#ef4444; color:#fff;}
  .pin{background:#e5e7eb; color:#111; cursor:default;}
  .ok{color:#059669; font-weight:700;}
  .warn{color:#ea580c;}
  table{width:100%; border-collapse:collapse; margin-top:24px; background:#fff; border-radius:12px; overflow:hidden;}
  th,td{padding:10px; border-bottom:1px solid #eee; text-align:left;}
  footer{padding:24px; text-align:center; color:#666;}
</style>
</head>
<body>
<header><strong>Painel ESP8266 (via UOL Host)</strong></header>
<div class="container">
  <p>Controle remoto do ESP: <strong><?php echo htmlspecialchars($ALLOWED_ESPS[0]); ?></strong></p>
  <p>Status do arquivo de estados:
    <?php
      $sf = state_file($ALLOWED_ESPS[0]);
      if (file_exists($sf)) {
        $j = json_decode(file_get_contents($sf), true);
        echo '<span class="ok">atualizado em '.htmlspecialchars($j['updated_at']).'</span>';
      } else {
        echo '<span class="warn">ainda sem atualização do ESP</span>';
      }
    ?>
  </p>

  <div class="grid">
    <?php foreach ($PREDEFINED as $d): ?>
      <div class="card">
        <div class="name"><?= htmlspecialchars($d['name']) ?></div>
        <div class="muted"><?= htmlspecialchars($d['type']) ?> • GPIO <?= (int)$d['pin'] ?></div>
        <div class="row">
          <button class="on"  onclick="sendCmd('<?= $d['name'] ?>','ON')">LIGAR</button>
          <button class="off" onclick="sendCmd('<?= $d['name'] ?>','OFF')">DESLIGAR</button>
          <button class="pin" disabled>PIN <?= (int)$d['pin'] ?></button>
        </div>
        <div id="state-<?= htmlspecialchars($d['name']) ?>" class="muted">estado: ?</div>
      </div>
    <?php endforeach; ?>
  </div>

  <h3>Estados atuais</h3>
  <table>
    <thead><tr><th>Dispositivo</th><th>Tipo</th><th>GPIO</th><th>Estado</th></tr></thead>
    <tbody id="states-table">
      <?php foreach ($PREDEFINED as $d): ?>
        <tr>
          <td><?= htmlspecialchars($d['name']) ?></td>
          <td><?= htmlspecialchars($d['type']) ?></td>
          <td><?= (int)$d['pin'] ?></td>
          <td id="row-<?= htmlspecialchars($d['name']) ?>">?</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h3>Mapa rápido (NodeMCU → GPIO)</h3>
  <table>
    <tr><th>D</th><th>GPIO</th></tr>
    <tr><td>D0</td><td>16</td></tr>
    <tr><td>D1</td><td>5</td></tr>
    <tr><td>D2</td><td>4</td></tr>
    <tr><td>D3</td><td>0</td></tr>
    <tr><td>D4</td><td>2</td></tr>
    <tr><td>D5</td><td>14</td></tr>
    <tr><td>D6</td><td>12</td></tr>
    <tr><td>D7</td><td>13</td></tr>
    <tr><td>D8</td><td>15</td></tr>
    <tr><td>RX</td><td>3</td></tr>
    <tr><td>TX</td><td>1</td></tr>
  </table>

  <footer>Use HTTPS no domínio e troque a <code>SECRET_KEY</code> no <code>config.php</code>.</footer>
</div>

<script>
const SECRET_KEY = '<?= SECRET_KEY ?>';
const ESP = '<?= $ALLOWED_ESPS[0] ?>';

async function sendCmd(name, action){
  try{
    const url = `set_command.php?esp=${encodeURIComponent(ESP)}&key=${encodeURIComponent(SECRET_KEY)}&name=${encodeURIComponent(name)}&action=${encodeURIComponent(action)}`;
    const r = await fetch(url, {cache:'no-store'});
    if(!r.ok) throw new Error('Falha no comando');
    const j = await r.json();
    console.log('Queued:', j);
  }catch(e){ alert('Erro: '+e.message); }
}

async function refreshStates(){
  try{
    const r = await fetch(`states_${ESP}.json?ts=${Date.now()}`, {cache:'no-store'});
    if(!r.ok) return;
    const j = await r.json();
    const states = j.states || {};
    Object.keys(states).forEach(name=>{
      const v = states[name] ? 'ON' : 'OFF';
      const cell = document.getElementById('row-'+name);
      const tag  = document.getElementById('state-'+name);
      if(cell) cell.textContent = v;
      if(tag)  tag.textContent  = 'estado: '+v.toLowerCase();
    });
  }catch(e){ /* sem estados ainda */ }
}

setInterval(refreshStates, 1500);
refreshStates();
</script>
</body>
</html>
