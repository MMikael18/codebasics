const template = document.createElement('template')

template.innerHTML = `
<style>
.st0{fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF;}
svg
{
	cursor: pointer;
}
</style>
<div part="navigation">
	<svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
	<rect x="15" y="21" class="st0" width="36" height="4"/>
	<rect x="15" y="31" class="st0" width="36" height="4"/>
	<rect x="15" y="41" class="st0" width="36" height="4"/>
	<g>
		<path class="st0" d="M14,1H6C3.24,1,1,3.24,1,6v8h4V7.38C5,6.06,6.06,5,7.38,5H14V1z"/>
		<path class="st0" d="M58,1h-8v4h6.63C57.94,5,59,6.06,59,7.38V14h4V6C63,3.24,60.76,1,58,1z"/>
	</g>
	<g>
		<path class="st0" d="M14,59H7.38C6.06,59,5,57.94,5,56.63V49H1v9c0,2.76,2.24,5,5,5h8V59z"/>
		<path class="st0" d="M59,49v7.63c0,1.31-1.06,2.38-2.38,2.38H50v4h8c2.76,0,5-2.24,5-5v-9H59z"/>
	</g>
	</svg>
</div>`;

class NavMenu extends HTMLElement {

  constructor() {
    super()
    this.attachShadow({mode: 'open'})
    this.shadowRoot.appendChild(template.content.cloneNode(true))
     
    // CSSPlugin.useSVGTransformAttr = true;

    // let tl = new TimelineMax({
    //   repeat: 0,
    //   repeatDelay: 0.65,
    //   yoyo: true
    // }),
    // paths = this.shadowRoot.querySelectorAll("path"),
    // stagger_val = 0.0125,
    // duration = 0.75

    // tl.timeScale(0.1)
    
    // paths.forEach((path) => {
    //   tl.set(path, {
    //     x: '+=' + getRandom(-500, 500),
    //     y: '+=' + getRandom(-500, 500),
    //     rotation: '+=' + getRandom(-720, 720),
    //     scale: 0,
    //     opacity: 0
    //   })
    // })
    
    // let stagger_opts_to = {
    //   x: 0,
    //   y: 0,
    //   opacity: 1,
    //   scale: 1,
    //   rotation: 0,
    //   ease: Power4.easeInOut
    // }
    
    // tl.staggerTo(paths, duration, stagger_opts_to, stagger_val);

    // function getRandom(min, max) {
    //   return Math.random() * (max - min) + min
    // }

  }
  
}
window.customElements.define('nav-menu', NavMenu)