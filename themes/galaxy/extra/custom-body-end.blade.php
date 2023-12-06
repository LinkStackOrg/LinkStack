{{-- Crude fix for the stars on higher resolutions --}}
<script>

    const object1 = []
    const object2 = []
    const object3 = []
  
    const numberOfobject1 = '1000'
    const numberOfobject2 = '600'
    const numberOfobject3 = '100'
  
  
    for (let i = 0; i < numberOfobject1; i++) {
      const pos1 = (Math.floor(Math.random() * 5200))
      const pos2 = (Math.floor(Math.random() * 5200))
      object1.push(`${pos1}px ${pos2}px #fff`)
    }
  
    for (let i = 0; i < numberOfobject2; i++) {
      const pos1 = (Math.floor(Math.random() * 5200))
      const pos2 = (Math.floor(Math.random() * 5200))
      object2.push(`${pos1}px ${pos2}px #fff`)
    }
  
    for (let i = 0; i < numberOfobject3; i++) {
      const pos1 = (Math.floor(Math.random() * 5200))
      const pos2 = (Math.floor(Math.random() * 5200))
      object3.push(`${pos1}px ${pos2}px #fff`)
    }
  
    const addCSS = css => document.head.appendChild(document.createElement("style")).innerHTML = css;
  
    addCSS(`#object1{ box-shadow:${object1}}`)
    addCSS(`#object1:after{ box-shadow:${object1}}`)
  
    addCSS(`#object2{ box-shadow:${object2}}`)
    addCSS(`#object2:after{ box-shadow:${object2}}`)
  
    addCSS(`#object3{ box-shadow:${object3}}`)
    addCSS(`#object3:after{ box-shadow:${object3}}`)
  
  </script>