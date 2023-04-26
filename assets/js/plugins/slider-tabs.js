class SliderTab {
  constructor(element = undefined, option = undefined) {
    if (element !== undefined) {
      this.init(element, option)
    }
  }

  init (element = null, option = undefined) {
    this.option = option
    this.element = element;
    this.slider = document.createElement('div') 
    this.sliderThumb = 'nav-slider-thumb'
    this.elemClass = 'nav-slider'
    const firstChild = this.element.querySelector('.nav-item:first-child .nav-link');
    const tab = firstChild.cloneNode();
    tab.innerHTML = "";
    this.slider.classList.add(this.sliderThumb, 'position-absolute', 'nav-link');
    this.element.classList.add(this.elemClass);
    this.slider.appendChild(tab);
    this.element.appendChild(this.slider);
    this.resetSlider()
    this.mouseClick()
    this.resize()
    this.updateRTL()
  }

  resetSlider () {
    this.slider.style.padding = '0px';
    this.slider.style.width = this.element.querySelector('.nav-item:nth-child(1)').offsetWidth + 'px';
    this.slider.style.height = this.element.querySelector('.nav-item:nth-child(1)').offsetHeight + 'px';
    this.slider.style.transform = 'translate3d(0px, 0px, 0px)';
    this.slider.style.transition = '300ms ease-in-out';
  }

  mouseClick () {
    this.element.onclick = (event) => {
      const target = this.getEventTarget(event);
      const item = target.closest('.nav-item');
      const items = Array.from(this.element.children);
      const index = items.indexOf(item) + 1;
      if(item !== null) {
        this.updateSlide(item, items, index)
      }
    }
  }

  updateSlide (item, items, index, cb = undefined) {
    this.slider = this.element.querySelector(`.${this.sliderThumb}`);
    const prevItem = this.element.querySelectorAll('.nav-item')
    let elem
    Array.from(prevItem,(elem) => {
      elem.querySelector('.nav-link').classList.remove('active')
    })
    let sum = 0;
    if (this.element.classList.contains('flex-column')) {
      let j = 1
      for (j; j <= items.indexOf(item); j++) {
        sum += this.element.querySelector('li:nth-child(' + j + ')').offsetHeight;
      }
      this.slider.style.transform = 'translate3d(0px,' + sum + 'px, 0px)';
      elem = this.element.querySelector('.nav-item:nth-child(' + j + ')')
      elem.querySelector('.nav-link').classList.add('active')
      this.slider.style.height = elem.offsetHeight;
      this.slider.style.width = '100%'
    } else {
      let j = 1
      for (j ; j <= items.indexOf(item); j++) {
        sum += this.element.querySelector('.nav-item:nth-child(' + j + ')').offsetWidth;
      }
      if(document.querySelector('html').getAttribute('dir') == 'rtl'){
        this.slider.style.transform = 'translate3d(-' + sum + 'px, 0px, 0px)';
      }
      else{
        this.slider.style.transform = 'translate3d(' + sum + 'px, 0px, 0px)';
      }
      elem = this.element.querySelector('.nav-item:nth-child(' + index + ')')
      elem.querySelector('.nav-link').classList.add('active')
      this.slider.style.width = this.element.querySelector('.nav-item:nth-child(' + index + ')').offsetWidth + 'px';
    }
    if(cb !== null && cb !== undefined && typeof cb === 'function') {
      cb(elem)
    }
  }

  getEventTarget (event) {
    event = event || window.event;
    return event.target || event.srcElement;
  }

  destroy () {
    this.element.removeEventListener('mousemove', this.mouseOver)
    this.element.querySelector(`.${this.sliderThumb}`).remove()
    this.element.classList.remove(this.elemClass)
  }

  resize () {
    window.addEventListener('resize', (event) => {
      const target = this.element.querySelector('.active');
      const item = target.closest('.nav-item');
      const items = Array.from(this.element.children);
      const index = items.indexOf(item) + 1;
      this.updateSlide(item, items, index)
    })
  }
  updateRTL () {
    // mutation observer for rtl
    const observer = new MutationObserver(mutations => {
      mutations.forEach(mutation => {
        if (mutation.type === 'attributes') {
          if (mutation.attributeName === 'dir') {
              const target = this.element.querySelector('.active');
              const item = target.closest('.nav-item');
              const items = Array.from(this.element.children);
              const index = items.indexOf(item) + 1;
              this.updateSlide(item, items, index)
          }
        }
      })
    })
    observer.observe(document.querySelector('html'), {
      attributes: true
    })
  }
}

window.SliderTab = new SliderTab()