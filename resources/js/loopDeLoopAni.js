const path = document.getElementById('loopy-reveal');


const length = path.getTotalLength();
path.setAttribute('stroke-dasharray', `${length}`);
path.setAttribute('stroke-dashoffset', 0);

export function animateLoop() {
  setTimeout(() => {
    path.style.transition = 'stroke-dashoffset 6s ease-in-out';
    path.setAttribute(`stroke-dashoffset`, `${-length}`);
  }, 200);
}
window.animateLoop = animateLoop;
