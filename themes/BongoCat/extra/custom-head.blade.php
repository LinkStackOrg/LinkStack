
<style>

@font-face { font-family: comic; src: url('{{themeAsset('comicboys.otf')}}'); } 

:root {
  --bg: #1a1e2d;
  --green: #a5ea9b;
  --pink: #ff61d8;
  --blue: #569cfa;
  --orange: #ffcc81;
  --cyan: #7ed1e2;
}

body {
  height: 100vh;
  width: 100vw;
  background: var(--bg);
  place-content: center;
  overflow-x: hidden;
}

.container-cat {
  width: 80vw;
  height: 80vh;
  position: absolute;
  width: 100%;
  height: 98%;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: 50% 50%;
}
.container-cat svg {
  height: 100%;
  width: 100%;
  overflow: visible;
  filter: blur(8px);
}

#bongo-cat {
  fill: var(--bg);
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-width: 4;
}
#bongo-cat .laptop-cover,
#bongo-cat .headphone .band {
  fill: none;
}
#bongo-cat .paw, #bongo-cat .head {
  stroke: var(--orange);
}
#bongo-cat .laptop-keyboard {
  stroke-width: 2;
}
#bongo-cat .terminal-code {
  stroke-width: 5;
}
#bongo-cat .music .note,
#bongo-cat .laptop-base,
#bongo-cat .laptop-cover,
#bongo-cat .paw .pads {
  stroke: var(--pink);
}
#bongo-cat .table line,
#bongo-cat .headphone .band,
#bongo-cat .headphone .speaker path:nth-child(3) {
  stroke: var(--green);
}
#bongo-cat .terminal-frame,
#bongo-cat .laptop-keyboard,
#bongo-cat .headphone .speaker path:nth-child(2) {
  stroke: var(--blue);
}
#bongo-cat .terminal-code,
#bongo-cat .headphone .speaker path:first-child {
  stroke: var(--cyan);
}
</style>