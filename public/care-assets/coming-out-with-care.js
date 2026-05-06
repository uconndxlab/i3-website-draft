document.addEventListener('DOMContentLoaded', () => {
  const flowerSVG = document.querySelector('#flower-svg')
  if(flowerSVG) {
    const flowerPetals = Array.from(flowerSVG.querySelectorAll('path[id^="petal"]'));
    const flowerCenter = flowerSVG.querySelector('#flower-center');
    if(flowerPetals.length > 0 && flowerCenter) {
      let delay = 1;
      flowerCenter.style.transitionDelay = '.9s';
      flowerPetals.forEach(petal => {
        petal.style.transitionDelay = `${delay}s`;
        delay += .1;
      })

      flowerCenter.style.transform = 'none';
      flowerPetals.forEach(petal => petal.style.transform = 'none')
    }
  }


  const processCards = Array.from(document.querySelectorAll('.process-card'));
  const requiresArrowTap = () => window.matchMedia('(hover: none) and (pointer: coarse)').matches;

  processCards.forEach(card => {
    // Touch devices: flip only from the arrow tap to avoid scroll hijacking.
    card.addEventListener('pointerdown', (e) => {
      if (requiresArrowTap()) {
        const tappedArrow = Boolean(e.target.closest('.card-arrow, .arrow-bg'));
        const isFlipped = card.classList.contains('flipped');

        if (!tappedArrow && !isFlipped) {
          return;
        }
      }

      toggleCard(card);
    });

    // Handle keyboard interactions (Enter and Space)
    card.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleCard(card);
      }
    });
  });

  function toggleCard(card) {
    const isFlipped = card.classList.toggle('flipped');
    card.setAttribute('aria-pressed', isFlipped);
  }






})

