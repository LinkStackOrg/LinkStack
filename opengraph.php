<?php
$sample = [
    'username' => 'alex',
    'display_name' => 'Alex on Livelatch',
    'bio' => 'Builder, creator, and curator of useful links.',
    'url' => 'https://dev.livelatch.com/@alex',
    'avatar' => 'assets/img/user.png',
    'brand' => 'Livelatch',
];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Livelatch Open Graph Studio</title>
  <style>
    :root {
      --bg: #0f1117;
      --panel: #171a23;
      --panel-2: #202432;
      --line: #34394a;
      --text: #f4f7fb;
      --muted: #a8b0bf;
      --accent: #21c7a8;
      --accent-2: #e3b341;
      --danger: #ef6b73;
      --radius: 8px;
      --font: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    * { box-sizing: border-box; }
    body {
      margin: 0;
      background: var(--bg);
      color: var(--text);
      font-family: var(--font);
      font-size: 14px;
    }

    button, input, select, textarea {
      font: inherit;
    }

    .app {
      display: grid;
      grid-template-columns: 360px minmax(520px, 1fr) 380px;
      min-height: 100vh;
    }

    aside {
      background: var(--panel);
      border-right: 1px solid var(--line);
      padding: 16px;
      overflow: auto;
      max-height: 100vh;
    }

    aside.right {
      border-right: 0;
      border-left: 1px solid var(--line);
    }

    main {
      padding: 18px;
      overflow: auto;
    }

    h1, h2, h3 {
      margin: 0;
      line-height: 1.15;
    }

    h1 {
      font-size: 18px;
      margin-bottom: 4px;
    }

    h2 {
      font-size: 13px;
      color: var(--muted);
      font-weight: 600;
      margin: 18px 0 8px;
      text-transform: uppercase;
    }

    .sub {
      color: var(--muted);
      margin: 0 0 14px;
      line-height: 1.45;
    }

    .field {
      display: grid;
      gap: 6px;
      margin-bottom: 10px;
    }

    label {
      color: var(--muted);
      font-size: 12px;
    }

    input, select, textarea {
      width: 100%;
      background: #0f121a;
      color: var(--text);
      border: 1px solid var(--line);
      border-radius: 6px;
      padding: 8px 9px;
      outline: none;
    }

    textarea {
      min-height: 88px;
      resize: vertical;
      line-height: 1.4;
    }

    input[type="color"] {
      height: 38px;
      padding: 3px;
    }

    input[type="range"] {
      padding: 0;
    }

    .row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
    }

    .row3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 8px;
    }

    .toolbar {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin: 12px 0;
    }

    button {
      background: var(--panel-2);
      color: var(--text);
      border: 1px solid var(--line);
      border-radius: 6px;
      min-height: 36px;
      padding: 8px 10px;
      cursor: pointer;
    }

    button.primary {
      background: var(--accent);
      border-color: var(--accent);
      color: #041410;
      font-weight: 700;
    }

    button.warn {
      background: transparent;
      color: var(--danger);
      border-color: rgba(239, 107, 115, 0.45);
    }

    .stage-wrap {
      display: grid;
      gap: 12px;
      justify-items: center;
    }

    .stage-shell {
      width: min(100%, 1200px);
      aspect-ratio: 1200 / 630;
      background: #080a0f;
      border: 1px solid var(--line);
      border-radius: var(--radius);
      overflow: hidden;
      position: relative;
      box-shadow: 0 24px 80px rgba(0, 0, 0, 0.35);
    }

    #stage {
      width: 100%;
      height: 100%;
      display: block;
      background: #11151e;
    }

    .discord-card {
      width: min(100%, 540px);
      background: #2b2d31;
      border-left: 4px solid #21c7a8;
      border-radius: 4px;
      padding: 12px;
      color: #dbdee1;
    }

    .discord-title {
      color: #00a8fc;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .discord-desc {
      color: #dbdee1;
      font-size: 13px;
      line-height: 1.35;
      margin-bottom: 10px;
    }

    .discord-img {
      width: 100%;
      aspect-ratio: 1200 / 630;
      border-radius: 4px;
      background: #111;
      overflow: hidden;
    }

    .discord-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .layer-list {
      display: grid;
      gap: 8px;
    }

    .layer {
      display: grid;
      gap: 8px;
      background: #10131b;
      border: 1px solid var(--line);
      border-radius: var(--radius);
      padding: 10px;
    }

    .layer-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 8px;
    }

    .pill {
      color: var(--muted);
      background: #0b0d13;
      border: 1px solid var(--line);
      border-radius: 999px;
      padding: 3px 7px;
      font-size: 11px;
    }

    .small {
      font-size: 12px;
      color: var(--muted);
      line-height: 1.45;
    }

    .output {
      min-height: 180px;
      font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
      font-size: 12px;
      white-space: pre;
    }

    .drop {
      border: 1px dashed var(--line);
      border-radius: var(--radius);
      padding: 10px;
      color: var(--muted);
      text-align: center;
      margin-bottom: 10px;
    }

    .preview-meta {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 8px;
      width: min(100%, 1200px);
    }

    .metric {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: var(--radius);
      padding: 10px;
    }

    .metric strong {
      display: block;
      font-size: 18px;
    }

    @media (max-width: 1180px) {
      .app {
        grid-template-columns: 1fr;
      }

      aside, aside.right {
        max-height: none;
        border: 0;
        border-bottom: 1px solid var(--line);
      }
    }
  </style>
</head>
<body>
<div class="app">
  <aside>
    <h1>Open Graph Studio</h1>
    <p class="sub">Design a Discord-optimized profile preview, then export an implementation brief for Codex.</p>

    <h2>Sample Data</h2>
    <div class="field"><label>Username</label><input id="username" value="<?php echo htmlspecialchars($sample['username']); ?>"></div>
    <div class="field"><label>Display name</label><input id="display_name" value="<?php echo htmlspecialchars($sample['display_name']); ?>"></div>
    <div class="field"><label>Bio / description</label><textarea id="bio"><?php echo htmlspecialchars($sample['bio']); ?></textarea></div>
    <div class="field"><label>Profile URL</label><input id="url" value="<?php echo htmlspecialchars($sample['url']); ?>"></div>
    <div class="field"><label>Avatar URL</label><input id="avatar" value="<?php echo htmlspecialchars($sample['avatar']); ?>"></div>
    <div class="field"><label>Brand</label><input id="brand" value="<?php echo htmlspecialchars($sample['brand']); ?>"></div>

    <div class="drop" id="drop">Drop an avatar/image here to use it as a data URL.</div>

    <h2>Canvas</h2>
    <div class="row">
      <div class="field"><label>Width</label><input id="canvasW" type="number" value="1200"></div>
      <div class="field"><label>Height</label><input id="canvasH" type="number" value="630"></div>
    </div>
    <div class="row">
      <div class="field"><label>Background</label><input id="bg1" type="color" value="#101820"></div>
      <div class="field"><label>Accent</label><input id="bg2" type="color" value="#21c7a8"></div>
    </div>
    <div class="field">
      <label>Background style</label>
      <select id="bgStyle">
        <option value="linear">Linear gradient</option>
        <option value="radial">Radial spotlight</option>
        <option value="mesh">Mesh ribbons</option>
        <option value="solid">Solid</option>
      </select>
    </div>
    <div class="row">
      <div class="field"><label>Noise</label><input id="noise" type="range" min="0" max="40" value="8"></div>
      <div class="field"><label>Vignette</label><input id="vignette" type="range" min="0" max="100" value="45"></div>
    </div>

    <h2>Presets</h2>
    <div class="toolbar">
      <button data-preset="clean">Clean</button>
      <button data-preset="bold">Bold</button>
      <button data-preset="editorial">Editorial</button>
      <button data-preset="neon">Neon</button>
      <button data-preset="minimal">Minimal</button>
    </div>
  </aside>

  <main>
    <div class="stage-wrap">
      <div class="stage-shell">
        <svg id="stage" viewBox="0 0 1200 630" xmlns="http://www.w3.org/2000/svg"></svg>
      </div>
      <div class="preview-meta">
        <div class="metric"><span class="small">Discord ratio</span><strong>1200 x 630</strong></div>
        <div class="metric"><span class="small">Elements</span><strong id="layerCount">0</strong></div>
        <div class="metric"><span class="small">Image mode</span><strong id="imageMode">SVG/PNG</strong></div>
      </div>
      <div class="discord-card">
        <div class="discord-title" id="discordTitle"></div>
        <div class="discord-desc" id="discordDesc"></div>
        <div class="discord-img"><img id="discordImg" alt="Discord preview"></div>
      </div>
    </div>
  </main>

  <aside class="right">
    <h2>Layers</h2>
    <div class="toolbar">
      <button class="primary" id="addText">Add Text</button>
      <button id="addShape">Add Shape</button>
      <button id="addAvatar">Add Avatar</button>
      <button id="addVector">Add Vector</button>
    </div>
    <div class="layer-list" id="layers"></div>

    <h2>Export</h2>
    <div class="toolbar">
      <button id="downloadSvg">Download SVG</button>
      <button id="downloadPng">Download PNG</button>
      <button id="copyBrief" class="primary">Copy Codex Brief</button>
      <button id="copyJson">Copy JSON</button>
    </div>
    <div class="field">
      <label>Codex implementation brief</label>
      <textarea id="brief" class="output" spellcheck="false"></textarea>
    </div>
    <p class="small">Placeholders: <span class="pill">{username}</span> <span class="pill">{display_name}</span> <span class="pill">{bio}</span> <span class="pill">{url}</span> <span class="pill">{avatar}</span> <span class="pill">{brand}</span></p>
  </aside>
</div>

<script>
const $ = (id) => document.getElementById(id);
const state = {
  layers: [
    { id: crypto.randomUUID(), type: 'shape', name: 'Accent panel', x: 70, y: 80, w: 1060, h: 470, fill: '#151b26', opacity: 0.72, radius: 34, rotate: 0 },
    { id: crypto.randomUUID(), type: 'avatar', name: 'Avatar', x: 78, y: 150, w: 220, h: 220, radius: 110, opacity: 1, rotate: 0 },
    { id: crypto.randomUUID(), type: 'text', name: 'Title', text: '{display_name}', x: 340, y: 205, size: 68, fill: '#f7fbff', weight: 800, max: 720, opacity: 1, rotate: 0 },
    { id: crypto.randomUUID(), type: 'text', name: 'Bio', text: '{bio}', x: 344, y: 305, size: 32, fill: '#c8d2df', weight: 500, max: 700, opacity: 1, rotate: 0 },
    { id: crypto.randomUUID(), type: 'text', name: 'URL', text: '{url}', x: 344, y: 420, size: 24, fill: '#21c7a8', weight: 700, max: 640, opacity: 1, rotate: 0 },
    { id: crypto.randomUUID(), type: 'vector', name: 'Sparkline', x: 850, y: 390, w: 190, h: 70, fill: '#e3b341', opacity: 0.9, rotate: 0, variant: 'spark' },
  ]
};

const controls = ['username', 'display_name', 'bio', 'url', 'avatar', 'brand', 'canvasW', 'canvasH', 'bg1', 'bg2', 'bgStyle', 'noise', 'vignette'];
controls.forEach(id => $(id).addEventListener('input', render));

function data() {
  return {
    username: $('username').value || 'username',
    display_name: $('display_name').value || `${$('username').value || 'username'} on Livelatch`,
    bio: $('bio').value || `View ${$('username').value || 'username'}'s Livelatch profile.`,
    url: $('url').value || '',
    avatar: $('avatar').value || 'assets/img/user.png',
    brand: $('brand').value || 'Livelatch',
  };
}

function text(input) {
  const d = data();
  return String(input || '').replace(/\{(username|display_name|bio|url|avatar|brand)\}/g, (_, key) => d[key] || '');
}

function esc(value) {
  return String(value).replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
}

function wrapWords(value, maxChars) {
  const words = text(value).split(/\s+/);
  const lines = [];
  let line = '';
  words.forEach(word => {
    const next = line ? `${line} ${word}` : word;
    if (next.length > maxChars && line) {
      lines.push(line);
      line = word;
    } else {
      line = next;
    }
  });
  if (line) lines.push(line);
  return lines.slice(0, 4);
}

function backgroundSvg(w, h) {
  const bg1 = $('bg1').value;
  const bg2 = $('bg2').value;
  const style = $('bgStyle').value;
  const noise = Number($('noise').value);
  const vig = Number($('vignette').value) / 100;
  let bg = '';
  if (style === 'solid') bg = `<rect width="${w}" height="${h}" fill="${bg1}"/>`;
  if (style === 'linear') bg = `<linearGradient id="bg" x1="0" x2="1" y1="0" y2="1"><stop offset="0" stop-color="${bg1}"/><stop offset="1" stop-color="${bg2}"/></linearGradient><rect width="${w}" height="${h}" fill="url(#bg)"/>`;
  if (style === 'radial') bg = `<rect width="${w}" height="${h}" fill="${bg1}"/><radialGradient id="spot" cx="70%" cy="25%" r="80%"><stop offset="0" stop-color="${bg2}" stop-opacity=".9"/><stop offset="1" stop-color="${bg2}" stop-opacity="0"/></radialGradient><rect width="${w}" height="${h}" fill="url(#spot)"/>`;
  if (style === 'mesh') bg = `<rect width="${w}" height="${h}" fill="${bg1}"/><path d="M-80 510 C220 300 380 730 680 420 S980 170 1320 260" fill="none" stroke="${bg2}" stroke-width="160" stroke-opacity=".38"/><path d="M-140 130 C180 30 410 230 600 120 S990 -10 1300 110" fill="none" stroke="#ffffff" stroke-width="90" stroke-opacity=".10"/>`;
  const filter = noise ? `<filter id="noise"><feTurbulence type="fractalNoise" baseFrequency=".9" numOctaves="2" stitchTiles="stitch"/><feColorMatrix type="saturate" values="0"/><feComponentTransfer><feFuncA type="table" tableValues="0 ${noise / 100}"/></feComponentTransfer></filter><rect width="${w}" height="${h}" filter="url(#noise)" opacity=".65"/>` : '';
  const vignette = vig ? `<radialGradient id="vig" cx="50%" cy="50%" r="75%"><stop offset="45%" stop-color="#000" stop-opacity="0"/><stop offset="100%" stop-color="#000" stop-opacity="${vig}"/></radialGradient><rect width="${w}" height="${h}" fill="url(#vig)"/>` : '';
  return bg + filter + vignette;
}

function layerSvg(layer) {
  const common = `opacity="${layer.opacity ?? 1}" transform="rotate(${layer.rotate || 0} ${(layer.x || 0) + (layer.w || 0) / 2} ${(layer.y || 0) + (layer.h || 0) / 2})"`;
  if (layer.type === 'shape') {
    return `<rect x="${layer.x}" y="${layer.y}" width="${layer.w}" height="${layer.h}" rx="${layer.radius || 0}" fill="${layer.fill}" ${common}/>`;
  }
  if (layer.type === 'avatar') {
    const clip = `clip-${layer.id.replaceAll('-', '')}`;
    return `<defs><clipPath id="${clip}"><rect x="${layer.x}" y="${layer.y}" width="${layer.w}" height="${layer.h}" rx="${layer.radius || 0}"/></clipPath></defs><image href="${esc(text('{avatar}'))}" x="${layer.x}" y="${layer.y}" width="${layer.w}" height="${layer.h}" preserveAspectRatio="xMidYMid slice" clip-path="url(#${clip})" ${common}/>`;
  }
  if (layer.type === 'text') {
    const chars = Math.max(8, Math.floor((layer.max || 600) / ((layer.size || 32) * 0.52)));
    return `<text x="${layer.x}" y="${layer.y}" fill="${layer.fill}" font-size="${layer.size}" font-weight="${layer.weight || 700}" font-family="Inter, Arial, sans-serif" ${common}>${wrapWords(layer.text, chars).map((line, i) => `<tspan x="${layer.x}" dy="${i === 0 ? 0 : (layer.size || 32) * 1.18}">${esc(line)}</tspan>`).join('')}</text>`;
  }
  if (layer.type === 'vector') {
    if (layer.variant === 'rings') {
      return `<g ${common} fill="none" stroke="${layer.fill}" stroke-width="8"><circle cx="${layer.x + layer.w / 2}" cy="${layer.y + layer.h / 2}" r="${Math.min(layer.w, layer.h) * .28}"/><circle cx="${layer.x + layer.w / 2}" cy="${layer.y + layer.h / 2}" r="${Math.min(layer.w, layer.h) * .46}" opacity=".45"/></g>`;
    }
    if (layer.variant === 'grid') {
      let out = `<g ${common} fill="${layer.fill}">`;
      for (let x = 0; x < 6; x++) for (let y = 0; y < 3; y++) out += `<circle cx="${layer.x + x * layer.w / 5}" cy="${layer.y + y * layer.h / 2}" r="5" opacity="${0.28 + (x + y) / 12}"/>`;
      return out + '</g>';
    }
    return `<path d="M${layer.x} ${layer.y + layer.h * .7} C${layer.x + layer.w * .25} ${layer.y} ${layer.x + layer.w * .45} ${layer.y + layer.h} ${layer.x + layer.w * .65} ${layer.y + layer.h * .35} S${layer.x + layer.w * .9} ${layer.y + layer.h * .15} ${layer.x + layer.w} ${layer.y + layer.h * .5}" fill="none" stroke="${layer.fill}" stroke-width="12" stroke-linecap="round" ${common}/>`;
  }
  return '';
}

function svgString() {
  const w = Number($('canvasW').value) || 1200;
  const h = Number($('canvasH').value) || 630;
  return `<svg xmlns="http://www.w3.org/2000/svg" width="${w}" height="${h}" viewBox="0 0 ${w} ${h}">${backgroundSvg(w, h)}${state.layers.map(layerSvg).join('')}</svg>`;
}

function render() {
  const svg = svgString();
  $('stage').setAttribute('viewBox', `0 0 ${Number($('canvasW').value) || 1200} ${Number($('canvasH').value) || 630}`);
  $('stage').innerHTML = svg.replace(/^<svg[^>]*>|<\/svg>$/g, '');
  const url = `data:image/svg+xml;charset=utf-8,${encodeURIComponent(svg)}`;
  $('discordImg').src = url;
  $('discordTitle').textContent = `${data().display_name} (@${data().username}) on Livelatch`;
  $('discordDesc').textContent = data().bio || `View ${data().username}'s Livelatch profile.`;
  $('layerCount').textContent = state.layers.length;
  renderLayers();
  buildBrief();
}

function renderLayers() {
  $('layers').innerHTML = '';
  state.layers.forEach((layer, index) => {
    const el = document.createElement('div');
    el.className = 'layer';
    el.innerHTML = `
      <div class="layer-head"><strong>${esc(layer.name)}</strong><span class="pill">${layer.type}</span></div>
      <div class="row"><div class="field"><label>X</label><input type="number" data-k="x" value="${layer.x || 0}"></div><div class="field"><label>Y</label><input type="number" data-k="y" value="${layer.y || 0}"></div></div>
      ${layer.type !== 'text' ? `<div class="row"><div class="field"><label>W</label><input type="number" data-k="w" value="${layer.w || 100}"></div><div class="field"><label>H</label><input type="number" data-k="h" value="${layer.h || 100}"></div></div>` : ''}
      ${layer.type === 'text' ? `<div class="field"><label>Text</label><input data-k="text" value="${esc(layer.text || '')}"></div><div class="row3"><div class="field"><label>Size</label><input type="number" data-k="size" value="${layer.size || 32}"></div><div class="field"><label>Weight</label><input type="number" data-k="weight" value="${layer.weight || 700}"></div><div class="field"><label>Max</label><input type="number" data-k="max" value="${layer.max || 600}"></div></div>` : ''}
      ${layer.type === 'vector' ? `<div class="field"><label>Variant</label><select data-k="variant"><option value="spark"${layer.variant === 'spark' ? ' selected' : ''}>Sparkline</option><option value="rings"${layer.variant === 'rings' ? ' selected' : ''}>Rings</option><option value="grid"${layer.variant === 'grid' ? ' selected' : ''}>Dot grid</option></select></div>` : ''}
      <div class="row3"><div class="field"><label>Fill</label><input type="color" data-k="fill" value="${layer.fill || '#ffffff'}"></div><div class="field"><label>Opacity</label><input type="number" min="0" max="1" step=".05" data-k="opacity" value="${layer.opacity ?? 1}"></div><div class="field"><label>Rotate</label><input type="number" data-k="rotate" value="${layer.rotate || 0}"></div></div>
      <div class="toolbar"><button data-action="up">Up</button><button data-action="down">Down</button><button class="warn" data-action="delete">Delete</button></div>
    `;
    el.querySelectorAll('[data-k]').forEach(input => {
      input.addEventListener('input', () => {
        const k = input.dataset.k;
        layer[k] = input.type === 'number' ? Number(input.value) : input.value;
        render();
      });
    });
    el.querySelectorAll('[data-action]').forEach(btn => {
      btn.addEventListener('click', () => {
        const action = btn.dataset.action;
        if (action === 'delete') state.layers.splice(index, 1);
        if (action === 'up' && index > 0) [state.layers[index - 1], state.layers[index]] = [state.layers[index], state.layers[index - 1]];
        if (action === 'down' && index < state.layers.length - 1) [state.layers[index + 1], state.layers[index]] = [state.layers[index], state.layers[index + 1]];
        render();
      });
    });
    $('layers').appendChild(el);
  });
}

function addLayer(type) {
  const base = { id: crypto.randomUUID(), type, name: `${type} layer`, x: 120, y: 120, w: 240, h: 120, fill: '#ffffff', opacity: 1, rotate: 0 };
  if (type === 'text') Object.assign(base, { name: 'Text', text: '{username}', size: 48, weight: 800, max: 620 });
  if (type === 'shape') Object.assign(base, { name: 'Shape', fill: '#21c7a8', radius: 18 });
  if (type === 'avatar') Object.assign(base, { name: 'Avatar', w: 180, h: 180, radius: 90 });
  if (type === 'vector') Object.assign(base, { name: 'Vector', fill: '#e3b341', variant: 'spark' });
  state.layers.push(base);
  render();
}

function buildBrief() {
  const brief = {
    goal: 'Implement this generated Open Graph preview card for Livelatch profiles.',
    output_size: `${$('canvasW').value}x${$('canvasH').value}`,
    discord: {
      card: 'summary_large_image',
      cache: 'Use /media/profile/{userId}?v={cache_buster} or generated OG route. Return absolute URLs.',
    },
    placeholders: data(),
    design: {
      background: { style: $('bgStyle').value, color_a: $('bg1').value, color_b: $('bg2').value, noise: $('noise').value, vignette: $('vignette').value },
      layers: state.layers,
    },
    implementation_notes: [
      'Use dynamic placeholders from the user record: {username}, {display_name}, {bio}, {url}, {avatar}, {brand}.',
      'Keep image output 1200x630 for Discord/Open Graph.',
      'Serve the generated image from a public app URL, not a signed S3 URL.',
      'Set Cache-Control: public, max-age=3600, s-maxage=86400.',
      'Fallback to assets/img/user.png when avatar/profile image is missing.',
    ],
  };
  $('brief').value = JSON.stringify(brief, null, 2);
}

function download(name, content, type) {
  const a = document.createElement('a');
  a.href = URL.createObjectURL(new Blob([content], { type }));
  a.download = name;
  a.click();
  setTimeout(() => URL.revokeObjectURL(a.href), 1000);
}

$('addText').onclick = () => addLayer('text');
$('addShape').onclick = () => addLayer('shape');
$('addAvatar').onclick = () => addLayer('avatar');
$('addVector').onclick = () => addLayer('vector');
$('downloadSvg').onclick = () => download('livelatch-og.svg', svgString(), 'image/svg+xml');
$('copyJson').onclick = () => navigator.clipboard.writeText(JSON.stringify({ data: data(), canvas: { w: $('canvasW').value, h: $('canvasH').value }, layers: state.layers }, null, 2));
$('copyBrief').onclick = () => navigator.clipboard.writeText($('brief').value);
$('downloadPng').onclick = () => {
  const img = new Image();
  const w = Number($('canvasW').value) || 1200;
  const h = Number($('canvasH').value) || 630;
  img.onload = () => {
    const canvas = document.createElement('canvas');
    canvas.width = w;
    canvas.height = h;
    canvas.getContext('2d').drawImage(img, 0, 0);
    canvas.toBlob(blob => {
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = 'livelatch-og.png';
      a.click();
    }, 'image/png');
  };
  img.src = `data:image/svg+xml;charset=utf-8,${encodeURIComponent(svgString())}`;
};

document.querySelectorAll('[data-preset]').forEach(btn => btn.onclick = () => {
  const p = btn.dataset.preset;
  if (p === 'clean') { $('bg1').value = '#101820'; $('bg2').value = '#21c7a8'; $('bgStyle').value = 'linear'; }
  if (p === 'bold') { $('bg1').value = '#111827'; $('bg2').value = '#e3b341'; $('bgStyle').value = 'mesh'; }
  if (p === 'editorial') { $('bg1').value = '#20242b'; $('bg2').value = '#b9d7ff'; $('bgStyle').value = 'radial'; }
  if (p === 'neon') { $('bg1').value = '#090b16'; $('bg2').value = '#20f0bd'; $('bgStyle').value = 'mesh'; }
  if (p === 'minimal') { $('bg1').value = '#f4f7fb'; $('bg2').value = '#21c7a8'; $('bgStyle').value = 'solid'; }
  render();
});

$('drop').addEventListener('dragover', event => {
  event.preventDefault();
});
$('drop').addEventListener('drop', event => {
  event.preventDefault();
  const file = event.dataTransfer.files[0];
  if (!file || !file.type.startsWith('image/')) return;
  const reader = new FileReader();
  reader.onload = () => {
    $('avatar').value = reader.result;
    render();
  };
  reader.readAsDataURL(file);
});

render();
</script>
</body>
</html>
