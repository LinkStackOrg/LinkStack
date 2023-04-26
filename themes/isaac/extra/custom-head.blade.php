<style>

@font-face{font-family:'upheavtt';src:url({{themeAsset('upheavtt.ttf')}})}
@font-face{font-family:'boi';src:url({{themeAsset('boi.otf')}})}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body{
  font-family: "boi", sans-serif;
}

h1{
  font-family: "upheavtt", sans-serif;
}

@media (max-width: 400px) {
  .button,
    button {
      display: inline-block;
      text-decoration: none;
      text-align: center;
      vertical-align: middle;
      font-size: 14px !important;
      color: #000 !important;
      height: 48px;
      width: 100%;
      font-weight: 100;
      line-height: 48px;
      letter-spacing: 0.1px;
      white-space: wrap;
      cursor: pointer;
      font-family: "boi", sans-serif !important;
      text-transform: uppercase;
      background: url({{themeAsset('button2.png')}}) 0 0/100% 100% no-repeat !important;
     }
  }
  
  @media (max-width: 550px) {
    .button,
      button {
        display: inline-block;
        text-decoration: none;
        text-align: center;
        vertical-align: middle;
        font-size: 14px !important;
        color: #000 !important;
        height: 48px;
        width: 80%;
        font-weight: 100;
        line-height: 48px;
        letter-spacing: 0.1px;
        white-space: wrap;
        cursor: pointer;
        font-family: "boi", sans-serif !important;
        text-transform: uppercase;
        background: url({{themeAsset('button2.png')}}) 0 0/100% 100% no-repeat !important;
       }
    }

  @media (min-width: 551px) {
  .button,
    button {
      display: inline-block;
      text-decoration: none;
      text-align: center;
      vertical-align: middle;
      font-size: 14px !important;
      color: #000 !important;
      height: 60px;
      width: 400px;
      font-weight: 100;
      line-height: 60px;
      letter-spacing: 0.1px;
      white-space: wrap;
      cursor: pointer;
      font-family: "boi", sans-serif !important;
      text-transform: uppercase;
      background: url({{themeAsset('button2.png')}}) 0 0/100% 100% no-repeat !important;
     }
  }

  .sharebutton,
  sharebutton {
    display: inline-block;
    text-decoration: none;
    height: 48px;
    text-align: center;
    vertical-align: middle;
    font-size: 14px;
    width: 48px;
    font-weight: 100;
    line-height: 48px;
    letter-spacing: 0.1px;
    white-space: wrap;
    border-radius: 8px;
    cursor: pointer;
    color: #000 !important; 
    background: url({{themeAsset('button2.png')}}) 0 0/100% 100% no-repeat !important;
   }
@media screen and (min-width: 600px) {
  .sharebutton,
  sharebutton {
    display: inline-block;
    text-decoration: none;
    height: 48px;
    text-align: center;
    vertical-align: middle;
    font-size: 14px;
    width: 150px;
    font-weight: 100;
    line-height: 48px;
    letter-spacing: 0.1px;
    white-space: wrap;
    border-radius: 8px;
    cursor: pointer;
    color: #000 !important; 
    background: url({{themeAsset('button2.png')}}) 0 0/100% 100% no-repeat !important;
   }
}
sharebutton:hover,
.sharebutton:hover {
  color: #000000;
  opacity: 0.85;
  filter: alpha(opacity=40);
  border-color: #888;
  text-shadow: none !important;
  -webkit-transform:scale(1.00) !important;
  transform:scale(1.00) !important;
  outline: 0; }
.sharebutton.sharebutton-primary {
  color: #FFFFFF;
  filter: brightness(90%) }
.sharebutton.sharebutton-primary:hover,
.sharebutton.sharebutton-primary:focus {
  color: #FFFFFF;
  filter: brightness(90%) }

  /* ===== Hidden Scrollbar ===== */
  * {
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
    scrollbar-width: none;  /* Firefox */ }
  *::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */ }

.wrapper {
  margin-top: -85vh;
  height: 100%;

  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
  z-index: -100;

}

.satan {
  width: 600px;
  margin-top: 10vh;
  height: 200px;
  display: flex;
  justify-content: space-between;
  filter: blur(2px);
  animation: blink-satan 3s both infinite;
  opacity: 0;
}

.satan-eye {
  width: 180px;
  height: 200px;
  border-top: 10px solid #22222255;
  position: relative;
  overflow: hidden;
}

.satan-eye:first-child {
  border-radius: 20% 300px;
}
.satan-eye:last-child {
  border-radius: 300px 20%;
}

.satan-eye::before,
.satan-eye::after {
  content: '';
  position: absolute;
  margin-left: 50%;
  background: #960018;
}

.satan-eye::before {
  width: 10%;
  height: 50%;
  transform: translate(-50%, 0);
}

.satan-eye::after {
  width: 20%;
  height: 4%;
  margin-top: 10%;
  transform: translate(-50%, 666%);
}

.satan-eye:first-child::before,
.satan-eye:first-child::after {
  border-radius: 0 0 50% 100px;
}
.satan-eye:last-child::before,
.satan-eye:last-child::after {
  border-radius: 0 0 100px 50%;
}


.isaac {
  margin: auto;
  width: fit-content;
  position: relative;
  animation: blink 3s both infinite;
  opacity: .7;
}

@media (max-width: 640px) {
  .isaac {
    transform: scale(.3);
    transform-origin: top;
  }
  .satan {
    max-width: 100vw;
  }
}

h1 {
  color: white;
  text-align: center;
}

.head {
  width: 410px;
  height: 360px;
  border-radius: 100%;
  background: radial-gradient(#E3C6C5 30%, #D09C9B 70%, #B97371 90%);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 35px 0;
  position: relative;
  z-index: -1;
  overflow: hidden;
  animation: eye-shake 1ms infinite;
}

.eye {
  width: 100px;
  height: 100px;
  border-radius: 100%;
  background: #111;
  position: relative;
}

.eye-left::before,
.eye-right::after {
  content: '';
  position: absolute;
  width: 90%;
  height: 200%;
  background: linear-gradient(#9CC9CD, transparent 90%);
  top: 50%;
  z-index: -4;
}

.eye-right::after {
  animation: shake-right 2s infinite ease-out;
}

.eye-left::before {
  animation: shake-left 2s infinite ease-out;
}

@keyframes shake-right {
  0 {
    transform: scale(0.8) translateX(0) skewX(0);
  }
  30% {
    transform: scale(0.90, 1) translateX(-4px) skewX(-2deg);
  }
  40% {
    transform: scale(0.95, 1) translateX(-6px) skewX(-1deg);
  }
  60% {
    transform: scale(0.94, 1) translateX(-1px) skewX(2deg);
  }
  75% {
    transform: scale(0.90, 1) translateX(-4px) skewX(-2deg);
  }
  90% {
    transform: scale(0.92, 1) translateX(-6px) skewX(-1deg);
  }
}

@keyframes shake-left {
  0 {
    transform: scale(0.8) translateX(0) skewX(0);
  }
  25% {
    transform: scale(0.90, 1) translateX(4px) skewX(2deg);
  }
  35% {
    transform: scale(0.95, 1) translateX(6px) skewX(1deg);
  }
  60% {
    transform: scale(0.94, 1) translateX(1px) skewX(-2deg);
  }
  75% {
    transform: scale(0.90, 1) translateX(4px) skewX(2deg);
  }
  85% {
    transform: scale(0.92, 1) translateX(6px) skewX(1deg);
  }
}

.eye::before {
  left: -5px;
  transform: skew(-3deg);  
}
.eye::after {
  right: -5px;
  transform: skew(3deg);
}

.eye-shine {
  width: 50%;
  height: 50%;
  background: white;
  border-radius: 100%;
  transform: skew(-15deg);
  margin: 8%;
  position: relative;
  animation: eye-shake 0.1ms infinite;
}

@keyframes eye-shake {
  50% {
    transform: translateX(1px);
  }
}

.eye-shine-sm {
  position: absolute;
  background: #fff;
  width: 20px;
  height: 15px;
  bottom: 13%;
  right: 16%;
  border-radius: 100%;
  transform: rotate(-45deg);
  animation: eye-shake .1s infinite;
}

.mouth {
  margin-top: 100px;
  width: 60px;
  height: 50px;
  background: transparent;
  border-top: 4px solid #111;
  border-radius: 100%;
  position: relative;
  animation: mouth-shake 1ms infinite;
}

@keyframes mouth-shake {
  to {
    transform: translateY(1px);
  }
}

.mouth::before {
  content: '';
  position: absolute;
  width: 16px;
  height: 15px;
  background: transparent;
  bottom: 18px;
  left: -8px;
  border-radius: 50%;
  border-bottom: 2px solid #111;
  transform: rotate(45deg);
}

.mouth::after {
  content: '';
  position: absolute;
  width: 8px;
  height: 8px;
  background: transparent;
  bottom: 20px;
  right: -6px;
  border-radius: 50%;
  border-bottom: 2px solid #111;
  transform: rotate(-45deg);
}


.body {
  width: 60%;
  margin: auto;
  position: relative;
}

.torso {
  width: 160px;
  height: 160px;
  margin: auto;
  position: relative;
  z-index: -3;
  transform: translateY(-80px);
  background: radial-gradient(#E3C6C5 40%, #D09C9B 80%, #B97371 90%);
  border-radius: 150px 150px 70% 70%;
}

.arm {
  width: 80px;
  height: 130px;
  z-index: -6;
  background: #E3C6C5;
  position: absolute;
  top: -50px;
  background: radial-gradient(#E3C6C5 10%, #D09C9B 70%, #B97371 90%);
}

.arm-left {
  border-radius: 30% 30% 30% 60%;  
  left: 20px;
  transform: skew(-5deg) rotate(25deg);
}

.arm-right {
  border-radius: 30% 30% 60% 30%;
  right: 20px;
  transform: skew(5deg) rotate(-25deg);
}

.foot-left {
  width: 30%;
  height: 120px;
  background: orange;
  position: absolute;
  top: 10%;
  left: 16%;
  transform: rotate(5deg);
  border-radius: 0 60% 30px 30px;
  z-index: -5;
  background: radial-gradient(#E3C6C5 20%, #D09C9B 90%, #B97371);
}

.foot-right {
  width: 30%;
  height: 120px;
  background: orange;
  position: absolute;
  top: 10%;
  right: 16%;
  transform: rotate(-5deg);
  border-radius: 60% 0 30px 30px;
  z-index: -5;
  background: radial-gradient(#E3C6C5 20%, #D09C9B 90%, #B97371);
}


.head,
.arm,
.foot,
.eye::after,
.eye::before {
  border: 4px solid #111;  
}

.torso {
  border-left: 4px solid #111;  
  border-right: 4px solid #111;
}

.isaac::after {
  content: '';
  position: absolute;
  z-index: -10;
  width: 540px;
  height: 120px;
  border-radius: 100%;
  background: #634937;
  bottom: -10px;
  margin-left: 50%;
  transform: translateX(-50%);
  filter: blur(1px);
  opacity: .3;
}

@if(theme('disable_flicker') != "true")
@keyframes blink {
  14% {
    opacity: .7;
  }
  15% {
    opacity: .5;
  }
  16% {
    opacity: .7;
  }
  20% {
    opacity: .5;
  }
  60% {
    opacity: .7;
  }
  61% {
    opacity: .2;
  }
  62% {
    opacity: .7;
  }
  64% {
    opacity: .3;
  }
  65% {
    opacity: .7;
  }
  70% {
    opacity: .6
  }
  71% {
    opacity: .4;
  }
  76% {
    opacity: 0.4;
  }
  82% {
    opacity: .5;
  }
}
@endif

@if(theme('disable_flicker') == "true")
@keyframes blink-satan {
  0% {
    opacity: 1;
    filter: blue(1px);
    transform: scale(1);
  }
  100% {
    opacity: 1;
    filter: blue(1px);
    transform: scale(1);
  }
}
@else
@keyframes blink-satan {
  0% {
    opacity: 0;
  }
  20% {
    opacity: .2;
  }
  60% {
    opacity: 0;
  }
  61% {
    opacity: .1;
    transform: scale(1);
  }
  62% {
    opacity: .2;
  }
  64% {
    opacity: .7;
  }
  65% {
    opacity: .1;
  }
  70% {
    opacity: 0;
  }
  71% {
    opacity: .7;
    
  }
  76% {
    opacity: .6;
  }
  82% {
    opacity: .6;
  }
  95% {
    transform: scale(1.1);
    filter: blur(0);
  }
  100% {
    opacity: 0;
    filter: blue(1px);
    transform: scale(1);
  }
}
@endif

/* Light On */
.isaac::before {
  content: '';
  position: absolute;
  width: 540px;
  height: 100vh;
  bottom: 50px;
  margin-left: 50%;
  transform: translateX(-50%);
  background: linear-gradient(#FAEBD722, transparent);
  clip-path: polygon(40% 0, 60% 0, 100% 100%, 0 100%);
  z-index: -5;
  filter: blur(200px);
  opacity: 0;
}




#light-toggler {
  position: absolute;
  padding: 3px;
  height: 120px;
  background: burlywood;
  border-radius: 30px;
  top: -60px;
  z-index: 99;
  transition: all .3s;
  border: 10px solid transparent;
  background-clip: padding-box;
  cursor: pointer;
  animation: light-toggler 4s infinite ease-in-out;
}

@keyframes light-toggler {
  0% {
    transform: translateX(-15px) translateY(0px) rotate(15deg);
  }
  50% {
    transform: translateX(15px) translateY(10px) rotate(-15deg);
  }
  100% {
    transform: translateX(-15px) translateY(0px) rotate(15deg);
  }
}

#light-toggler:hover,
#light-toggler:focus {
  height: 140px;
}

#light {
  display: none;
}

#light:checked ~ *,
#light:checked ~ *::before,
#light:checked ~ *::after,
#light:checked ~ * *,
#light:checked ~ * *::before,
#light:checked ~ * *::after {
  animation-duration: 4s;
}

#light:checked ~ .satan {
  animation: unset;
}

#light:checked ~ .isaac::before {
  opacity: .7;
}

#light:checked ~ .isaac::after {
  opacity: .7;
}

#light:checked ~ * .mouth {
  transform: rotateX(180deg) scale(1.2, .8);
  animation: unset;
}
</style>