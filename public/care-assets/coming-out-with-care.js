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


  const blocksData = {
    'section1': {
      'secBlock': null,
      'delay': 815,
      'duration': 650,
      'blocks': []
    },
    'section2': {
      'secBlock': null,
      'delay': 1100,
      'duration': 1500,
      'blocks': []
    },
    'section3': {
      'secBlock': null,
      'delay': 815,
      'duration': 650,
      'blocks': []
    },
    'section4': {
      'secBlock': null,
      'delay': 1100,
      'duration': 1500,
      'blocks': []
    },
    'arrows': [

    ]
  }
  const blocksSVG = document.querySelector('#blocks-svg');

  function getBlockData() {
    let hasNull = false;
    if(!blocksSVG) { return false;}

    const sections = Array.from(document.querySelectorAll('g[id$="-group"]'));
    if(sections.length === 0) { return false; }
      sections.forEach((section, idx) => {
        let arr = Array.from(section.children).reverse();
        if(arr.length === 0) { hasNull = true; return; }


        const secBlock = arr.find(b => b.id.endsWith('0'));
        if(!secBlock) { hasNull = true; return; }

        arr.splice(arr.indexOf(secBlock), 1);
        blocksData[`section${idx + 1}`].secBlock = secBlock;

        arr = arr.map(b => {
          const textEl = b.querySelector('tspan');
          if(!textEl) { hasNull = true; return; }
          const text = textEl.innerHTML.replace('...', '')
          return {
            'el': b,
            'text': text
          }
        })
        blocksData[`section${idx + 1}`].blocks.push(...arr)
      })

    const arrows = Array.from(document.querySelectorAll('[id^="arrow-"]'))
    if(arrows.length === 0) return false;

    arrows.forEach(arrow => {
      const line = arrow.querySelector('path');
      const arrowPoints = Array.from(arrow.querySelectorAll('line'));
      if(!line || arrowPoints.length !== 2) { hasNull = true; return; }
      blocksData.arrows.push({
        'line': line,
        'points': arrowPoints
      })
    })


    if(!hasNull) {
      [
        blocksData.section1.secBlock,
        blocksData.section2.secBlock,
        blocksData.section3.secBlock,
        blocksData.section4.secBlock
      ].forEach(b => {
        b.style.opacity = '0';
        b.style.transform = 'translateY(-3%)';
      });

      [
        ...blocksData.section1.blocks,
        ...blocksData.section2.blocks,
        ...blocksData.section3.blocks,
        ...blocksData.section4.blocks
      ].forEach(b => {
        const i = parseInt(b.el.id.at(-1));
        if(i === null) return;
        b.el.style.transform = `translateY(-${(i * 11.2) + 3}%)`;
        b.el.style.opacity = '0';
      })

      blocksData.arrows.forEach(arrow => {
        const lineLen = arrow.line.getTotalLength();
        arrow.line.style.strokeDasharray = `${lineLen}px`;
        arrow.line.style.strokeDashoffset = `${lineLen}px`;
        arrow.points.forEach(point => {
          const len = point.getTotalLength();
          point.style.strokeDasharray = `${len}px`;
          point.style.strokeDashoffset = `${len}px`;
        })
      })

    }
    return !hasNull;
  }


  if(getBlockData()) blocksSVG.parentElement.addEventListener('transitionend', animateSVG, {once:true});

  async function animateSVG() {

    await Promise.all(blocksData.arrows.map(arrow => aniArrow(arrow.line, arrow.points)));

    for(const section of [blocksData.section1, blocksData.section2, blocksData.section3, blocksData.section4]) { await aniSection(section) }

    blocksSVG.parentElement.setAttribute('data-aos', 'fade-right');

  }

  async function aniArrow(line, points) {
    return new Promise(resolve => {
        line.style.transition = 'stroke-dashoffset 2s ease';
        line.style.strokeDashoffset = '0px';

        line.addEventListener('transitionstart', () => {
          points.forEach(point => {
            point.style.transition = 'stroke-dashoffset 1s ease';
            point.style.transitionDelay = '1.75s'
            point.style.strokeDashoffset = '0px'
          });
          points[0].addEventListener('transitionstart', () => {
            setTimeout(resolve, 500)
          })
        }, {once:true})
    })
  }

  async function aniSection(section) {
    return new Promise(async resolveSection => {

      section.secBlock.style.transition = 'opacity .75s ease, transform .75s ease';
      section.blocks.forEach(b => b.el.style.transition = `transform ${section.duration}ms ease`);

      section.secBlock.addEventListener('transitionstart', async function start() {
        section.secBlock.removeEventListener('transitionstart', start)
        for(const [idx, curr] of section.blocks.entries()) {
          await new Promise(resolve => setTimeout(resolve, section.delay))
          await aniBlock(section.blocks.slice(idx));
        }
      })

      requestAnimationFrame(() => {
        section.secBlock.style.opacity = '1';
        section.secBlock.style.transform = 'none';
        section.blocks.forEach(b => {
          const cur = b.el.style.transform;
          const curPercent = cur.match(/\d+\.?\d*/g)[0];
          if(curPercent) {
            b.el.style.transform = `translateY(-${curPercent - 3}%)`;
          }
        })
      })
      resolveSection()
    })



  }

  async function aniBlock(remBlocks) {
    return new Promise(resolve => {
        remBlocks[0].el.addEventListener('transitionstart', function next(e) {
          remBlocks[0].el.removeEventListener('transitionstart', next);
          resolve();
        })
      remBlocks[0].el.style.opacity = '1';
      remBlocks.forEach((block, idx) => {
        if(idx === 0) {
          block.el.style.transform = 'none';
        } else {
          const cur = block.el.style.transform;
          const curPercent = cur.match(/\d+\.?\d*/g)[0];
          if(curPercent) {
            block.el.style.transform = `translateY(-${curPercent - 11.2}%)`;
          }
        }
      })

    })

  }

  const flipWrap = document.querySelector('.cards-abs');
  const flipCards = Array.from(document.querySelectorAll('.flip-card'));
  if(flipCards.length > 0) {
    flipCards.forEach((card, idx) => {
      const inner = card.querySelector('.flip-card-inner');
      if(!inner) return;
      inner.style.transitionDelay = `${idx * .15}s`
    })
    flipCards[flipCards.length - 1].parentElement.addEventListener('transitionend', () => {
      if(flipWrap) {

        requestAnimationFrame(() => {
          flipWrap.classList.add('flipped')
        })
      }
    }, {once:true})

  }

})

