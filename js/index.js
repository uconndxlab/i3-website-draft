import projects from './projectData.js';





const sections = {
  hero: {
    div: document.getElementById('hero'),
    isOnScreen: false,
    top: document.getElementById('hero').offsetTop,
    height: document.getElementById('hero').offsetHeight,
    bottom: document.getElementById('hero').offsetTop + document.getElementById('hero').offsetHeight
  },
  story: {
    div: document.getElementById('story'),
    isOnScreen: false,
    top: document.getElementById('story').offsetTop,
    height: document.getElementById('story').offsetHeight,
    bottom: document.getElementById('story').offsetTop + document.getElementById('story').offsetHeight
  },
/*  projects: {
    div: document.getElementById('projects'),
    isOnScreen: false,
    top: document.getElementById('projects').offsetTop,
    height: document.getElementById('projects').offsetHeight,
    bottom: document.getElementById('projects').offsetTop + document.getElementById('projects').offsetHeight
  },
  team: {
    div: document.getElementById('team'),
    isOnScreen: false,
    top: document.getElementById('team').offsetTop,
    height: document.getElementById('team').offsetHeight,
    bottom: document.getElementById('team').offsetHeight + document.getElementById('team').offsetTop
  }*/
}


/* ------------------- OBSERVERS ------------------- */

// Element variables
// const starFade = document.querySelector('.star-canvas-fade');
const codeBGFade = document.querySelector('.blueprint-fade');
let statCircleOnScreen = false;
const animatedElements = document.querySelectorAll('.animated');
const ucHeaderRect = document.getElementById('uc-header').getBoundingClientRect();

let starsFaded = false;


const body = document.querySelector('body');

const statCircle = document.querySelector('.story-stat-wrapper')

let bgColor = 0;
const bgColors = [
  'rgb(38,38,38)',
  'rgb(10,22,38)',
  'rgb(24,0,40)',
  'rgb(38,38,38)'
]


/*function checkInitialIntersections() {
  for(let key in sections) {
    const section = sections[key];
    const rect = section.div.getBoundingClientRect();
    const inView = rect.top < window.innerHeight && rect.bottom > 0;
    if(section === sections.hero) {
      if(waveRect.top < window.innerHeight && waveRect.bottom > 0) {
        waveTrack.style.animationPlayState = 'running';
      }
    } else if(section === sections.story) {
      const circleRect = statCircle.getBoundingClientRect();
      if(circleRect.top < window.innerHeight && circleRect.bottom > 0 && !statCircleOnScreen) {
        statCircleOnScreen = true;
        startStoryLoop();
      }
    } else if(section === sections.projects) {
      if(inView && !codeBGLooping) {
        codeBGLooping = true;
        requestAnimationFrame(scrollCode)
      }
    }
  }
}*/


const heroObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      if(starsFaded) {
        canvas.style.display = 'block';
        canvas.style.opacity = '1';
        starsFaded = false;
      }
      if(bgColor !== 0) {
        body.style.backgroundColor = `${bgColors[0]}`;
        bgColor = 0;
      }
      if(!sections.hero.isOnScreen) {
        sections.hero.isOnScreen = true;
        if(!frameLooping) {
          frameLooping = true;
        }
        if(bgAnimated) animateFrame()
      }
      // if(!updateStarFade) updateStarFade = true;
    } else {
      if(sections.hero.isOnScreen) {
        sections.hero.isOnScreen = false;
        frameLooping = false;
      }
      // if(updateStarFade) updateStarFade = false;
    }
  })
}, {threshold: 0});
heroObserver.observe(document.querySelector('.hero-h1'));

const statCircleObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      if(bgColor !== 1) {
        body.style.backgroundColor = `${bgColors[1]}`;
        bgColor = 1;
      }
      if(!starsFaded) {
        canvas.style.opacity = '0';
        canvas.addEventListener('transitionend', function starsFadedOut() {
          canvas.removeEventListener('transitionend', starsFadedOut);
          starsFaded = true;
          canvas.style.display = 'none';
        })
      }

      if(!statCircleOnScreen) {
        statCircleOnScreen = true;
        startStoryLoop();
      }
    } else {
      if(statCircleOnScreen) {
        statCircleOnScreen = false;
        endStoryLoop();
      }
    }
  });
}, {threshold: .25});
statCircleObserver.observe(statCircle);

const projectRow2Observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      if(bgColor !== 2) {
        body.style.backgroundColor = `${bgColors[2]}`;
        bgColor = 2;
      }
      if(!starsFaded) {
        canvas.style.opacity = '0';
        canvas.addEventListener('transitionend', function starsFadedOut() {
          canvas.removeEventListener('transitionend', starsFadedOut);
          starsFaded = true;
          canvas.style.display = 'none';
        })
      }
    }
  })
}, {threshold: .15});
projectRow2Observer.observe(document.getElementById('row-2'));

const teamRowObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      if(bgColor !== 3) {
        body.style.backgroundColor = `${bgColors[3]}`;
        bgColor = 3;
      }
      if(!starsFaded) {
        canvas.style.opacity = '0';
        canvas.addEventListener('transitionend', function starsFadedOut() {
          canvas.removeEventListener('transitionend', starsFadedOut);
          starsFaded = true;
          canvas.style.display = 'none';
        })
      }
    }
  })
}, {threshold: .15});
teamRowObserver.observe(document.querySelector('.team-row'));
/*
const projectsObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      if(!sections.projects.isOnScreen) {sections.projects.isOnScreen = true}
      if(!codeBGLooping) {codeBGLooping = true; requestAnimationFrame(scrollCode)}
      if(!updateCodeBGFade) {updateCodeBGFade = true;}
      if(!rotateCodeRunning) {rotateCodeRunning = true; playRotateCode()}
    } else {
      if(sections.projects.isOnScreen) {
        sections.projects.isOnScreen = false;
      }
      if(codeBGLooping) {codeBGLooping = false}
      if(updateCodeBGFade) {updateCodeBGFade = false}
      randomizeProjects();
      if(rotateCodeRunning) {rotateCodeRunning = false; pauseRotateCode()}
    }
  });
}, {threshold: 0});
projectsObserver.observe(sections.projects.div);

const teamObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      if(!sections.team.isOnScreen) sections.team.isOnScreen = true;
      if(!teamLooping) { rotateCards(); teamLooping = true}
    } else {
      if(sections.team.isOnScreen) sections.team.isOnScreen = false;
      if(teamLooping) teamLooping = false;
    }
  })
}, {threshold: .1});
teamObserver.observe(sections.team.div);

*/


/* ------------------- BASE EVENT LISTENERS ------------------- */


// Call star background creation on load after short delay
window.addEventListener('load', () => {
  setCachedSectionSize()
  console.log(cachedStarSections, cachedStarSections[0].width)
  if(window.innerWidth < 1200) resizeTeamCards();
  setTimeout(createStarBG, 500);
  if(window.innerWidth > 1800) {
    document.documentElement.style.setProperty('--project-ani-dur', `${window.innerWidth * 8.5}ms`);
    if(window.innerWidth < 2100) {
      document.documentElement.style.setProperty('--project-ani-del', `${window.innerWidth * 1.5}ms`);
    } else {
      document.documentElement.style.setProperty('--project-ani-del', `${window.innerWidth * 1.2}ms`);
    }
  }
});

// Call resize star background function on window resize
window.addEventListener('resize', () => {
  resizeStarBG();
  if(window.innerWidth < 1200) resizeTeamCards();
  if(window.innerWidth > 1800) {
    document.documentElement.style.setProperty('--project-ani-dur', `${window.innerWidth * 8.5}`);
    document.documentElement.style.setProperty('--project-ani-del', `${window.innerWidth * 1.65}`);
  }
});

// Initialize mouse position variable
const mousePos = {x: 0, y: 0};

// Get mouse position on mouse move (will be changed depending on how I change star pulling for optimization)
window.addEventListener('mousemove', (event) => {
  mousePos.x = event.clientX
  mousePos.y = event.clientY - ucHeaderRect.height;
});

// Pause animations when unfocused
document.addEventListener('visibilitychange', () => {
  if(document.hidden) {
    animatedElements.forEach(element => {
      element.style.animationPlayState = 'paused';
    });
  // Play animated elements when refocused
  } else {
    animatedElements.forEach(element => {
      element.style.animationPlayState = 'running';
    });
  }
});


/* ------------------- SCROLL FUNCTIONS ------------------- */


window.addEventListener('scroll', consistentScroll);
/*
const scrollBreakpoints = {
  'heroEnd': sections.story.top,

  'storyEnd': sections.projects.top
}
*/

const maxScroll = window.innerHeight;

let updateStars = false;

const windowHeight = window.innerHeight;

let starFadeDecimal;
const storyRow = document.getElementById('story-row');
const storyRowRect = storyRow.getBoundingClientRect();
function consistentScroll() {
  const scroll = window.scrollY;
  if(linkCanvasActive) {
    document.body.removeChild(document.getElementById('constellationCanvas'));
    linkCanvasActive = false;
  }
}



/*
const angle = -30 * (Math.PI / 180);

const card1 = document.getElementById('project-card-1');
const card2 = document.getElementById('project-card-2');
const card3 = document.getElementById('project-card-3');
/!*
const card1Dist = calcCardTranslations(card1, angle);
const card2Dist = calcCardTranslations(card2, angle);
const card3Dist = calcCardTranslations(card3, angle);*!/

const card1DistX = Math.cos(angle) * card1Dist;
const card1DistY = Math.sin(angle) * card1Dist;

const card2DistX = Math.cos(angle) * card2Dist;
const card2DistY = Math.sin(angle) * card2Dist;

const card3DistX = Math.cos(angle) * card3Dist;
const card3DistY = Math.sin(angle) * card3Dist;

function calcCardTranslations(card, angle) {

  const cos = Math.abs(Math.cos(angle));
  const sin = Math.abs(Math.sin(angle));

  return (window.innerWidth + card.offsetWidth) * cos + (window.innerHeight + card.offsetHeight) * sin;
}

function calcMove(start, end, progress) {
  return start + (end - start) * progress;
}

const scrollStart = sections.projects.top - (windowHeight * .5);
const scrollEnd = sections.projects.top + windowHeight;
const range = scrollEnd - scrollStart;

let codeFadeDecimal = 0;

function fadeCodeBG(scroll) {
  const fadeStart = sections.projects.top - windowHeight;
  const decimal = Math.min((scroll - fadeStart) / windowHeight, 1);
  console.log(scroll)
  const color = changeBGColor(color2, color3, decimal);
  codeBGFade.style.background = `linear-gradient(to bottom,
          rgba(${color[0]}, ${color[1]}, ${color[2]}, 1) 0%,
          rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.6) 10%,
          rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.4) 15%,
          rgba(${color[0]}, ${color[1]}, ${color[2]}, 0) 25%,
          rgba(${color[0]}, ${color[1]}, ${color[2]}, 0) 75%,
          rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.4) 85%,
          rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.6) 90%,
          rgba(${color[0]}, ${color[1]}, ${color[2]}, 1) 100%
  )`;
  console.log('fadey')
}

const projectRow = document.querySelector('#row-1');
const projectRow2 = document.querySelector('#row-2')

function projectScroll(scroll) {
  const fadeStart = sections.projects.top - windowHeight;
  const decimal = Math.min((scroll - fadeStart) / windowHeight, 1);

  const bgColor = changeBGColor(color2, color3, decimal);
  body.style.backgroundColor = `rgb(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]})`;

  //codeBGFade.style.background = `linear-gradient(to bottom, rgba(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]}, 0) 40%, rgba(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]}, 1) 50%)`
  //codeBGFade.style.opacity = codeFadeDecimal;

  const progress = Math.min(Math.max((scroll - scrollStart) / range, 0), 1);

  console.log('scrolling cards')

  projectRow.style.transform = `rotate(-20deg) translateX(${calcMove(-500, 500, progress)}px)`;
  projectRow2.style.transform = `rotate(-20deg) translateX(${calcMove(500, -500, progress)}px`;
/!*  card1.style.transform = `translate(${calcMove(-card1DistX, card1DistX, progress)}px, ${calcMove(-card1DistY, card1DistY, progress)}px) rotate(-30deg)`;
  card2.style.transform = `translate(${calcMove(card2DistX, -card2DistX, progress)}px, ${calcMove(card2DistY, -card2DistY, progress)}px) rotate(-30deg)`;
  card3.style.transform = `translate(${calcMove(-card3DistX, card3DistX, progress)}px, ${calcMove(-card3DistY, card3DistY, progress)}px) rotate(-30deg)`;*!/
}

const featProjects = [
  {
    title: 'Research Insights for Faculty',
    image: 'img/i3/work/rif.png',
    link: 'unset',
    abbreviation: 'RIF'
  },
  {
    title: 'Nexus',
    image: 'img/i3/work/nexus.png',
    link: 'unset'
  },
  {
    title: 'WellSCAN',
    image: 'img/i3/work/wellscan.png',
    link: 'unset'
  },
  {
    title: 'Werth',
    image: 'img/i3/work/werth.png',
    link: 'unset'
  },
  {
    title: 'QuantumCT',
    image: 'img/i3/work/quantum.png',
    link: 'unset'
  },
  {
    title: 'Innovation in CT',
    image: 'img/i3/work/innovation-in-ct.png',
    link: 'unset',
    abbreviation: 'Innovation'
  },
  {
    title: 'HoneyCrisp (needs image)',
    image: 'img/i3/work/rif.png',
    link: 'unset'
  }
];

const card1Title = document.getElementById('card-1-title');
const card1Image = document.getElementById('card-1-image');
const card1CTAText = document.getElementById('card-1-CTA-text');

const card2Title = document.getElementById('card-2-title');
const card2Image = document.getElementById('card-2-image');
const card2CTAText = document.getElementById('card-2-CTA-text');

const card3Title = document.getElementById('card-3-title');
const card3Image = document.getElementById('card-3-image');
const card3CTAText = document.getElementById('card-3-CTA-text');

function randomizeProjects() {
  let projects = [...featProjects];
  let rand = Math.floor(Math.random() * projects.length)
  const [project1] = projects.splice(rand, 1);
  rand = Math.floor(Math.random() * projects.length);
  const [project2] = projects.splice(rand, 1);
  rand = Math.floor(Math.random() * projects.length);
  const [project3] = projects.splice(rand, 1);
  console.log(project1, project2, project3)

  card1Title.innerText = `${project1.title}`;
  card1Image.src = project1.image;
  card1Image.alt = project1.title;
  if(project1.abbreviation) {card1CTAText.innerText = `Visit ${project1.abbreviation}`}
  else {card1CTAText.innerText = `Visit ${project1.title}`}

  card2Title.innerText = project2.title;
  card2Image.src = project2.image;
  card2Image.alt = project2.title;
  if(project2.abbreviation) {card2CTAText.innerText = `Visit ${project2.abbreviation}`}
  else {card2CTAText.innerText = `Visit ${project2.title}`}

  card3Title.innerText = project3.title;
  card3Image.src = project3.image;
  card2Image.alt = project3.title;
  if(project3.abbreviation) {card3CTAText.innerText = `Visit ${project3.abbreviation}`}
  else {card3CTAText.innerText = `Visit ${project3.title}`}
}


const codeCanvas = document.getElementById('codeCanvas');
const codeCTX = codeCanvas.getContext('2d');
codeCanvas.width = window.innerWidth;
codeCanvas.height = Math.floor(window.innerHeight + (window.innerHeight * .2));
console.log(window.innerHeight + (window.innerHeight * .2))

const text1 = document.getElementById('rotating-text-1');
const text2 = document.getElementById('rotating-text-2');

let startOffset = 0;

const codeSnippets = [
  '<div class="container">',
  '<section id="main-content">',
  'body { background: #111; color: #eee; }',
  'const fetchData = () => fetch("/api")',
  '<?php echo "Hello, World!"; ?>',
  'function updateDOM(data) { render(data); }',
  '.grid { display: flex; gap: 2rem; }',
  'let user = JSON.parse(localStorage.getItem("user"));',
  'if ($valid) { saveToDB($entry); }',
  'return view("dashboard", $data);',
  'const animate = () => requestAnimationFrame(animate);'
];

const scrollLines = [];

for (let i = 0; i < 55; i++) {
  scrollLines.push({
    x: Math.random() * codeCanvas.width,
    y: -(Math.random() * codeCanvas.height),
    text: codeSnippets[i % codeSnippets.length],
    speed: 1.5 + Math.random() * 1.5,
    opacity: 0
  });
}
codeCTX.font = '14px monospace';
codeCTX.fillStyle = 'rgba(77,179,255,0.2)';
codeCTX.textAlign = 'center';

const fadeInStart = 50;
const fadeInEnd = 200;
const fadeOutStart = codeCanvas.height - 200;
const fadeOutEnd = codeCanvas.height - 50;

function scrollCode() {
  codeCTX.clearRect(0, 0, codeCanvas.width, codeCanvas.height);
  scrollLines.forEach(line => {
    if(line.y < fadeInStart) {
      line.opacity = 0;
    } else if(line.y < fadeInEnd) {
      line.opacity = (line.y - fadeInStart) / (fadeInEnd - fadeInStart);
    } else if(line.y < fadeOutStart) {
      line.opacity = 1;
    } else if(line.y < fadeOutEnd) {
      line.opacity = 1 - (line.y - fadeOutStart) / (fadeOutEnd - fadeOutStart)
    } else {
      line.opacity = 0;
    }
    codeCTX.save();
    codeCTX.globalAlpha = line.opacity;
    codeCTX.translate(line.x, line.y);
    codeCTX.rotate(Math.PI / 2);
    codeCTX.fillText(line.text, 0, 0);
    codeCTX.restore();

    line.y += line.speed;

    if(line.y > fadeOutEnd) {
      line.y = -200;
      line.opacity = 0;
      line.x = Math.random() * codeCanvas.width;
      line.text = codeSnippets[Math.floor(Math.random() * codeSnippets.length)];
    }


  });
  if(codeBGLooping) {requestAnimationFrame(scrollCode);}
}

let rotateCodeRunning = false;

const rotateCodeText = "import json;   config = json.loads(raw_input);   names = [f.upper() for f in files if f.endswith('.txt')];"
const rotateCode = document.querySelector('.rotating-code');
let delay = 0;
for(let i = rotateCodeText.length; i >= 0; i--) {
  const span = document.createElement('span');
  span.innerText = `${rotateCodeText.charAt(i)}`
  span.style.opacity = '0';
  rotateCode.appendChild(span);
}
const spans = rotateCode.querySelectorAll('span');
for(let i = 0; i < spans.length; i++) {
  spans[i].classList.add('rotating-code-char');
  spans[i].style.animationDelay = `${delay}s`;
  setTimeout(() => {spans[i].style.opacity = '1'}, delay*1000);
  if(spans[i+1]) {
    switch(spans[i+1].innerText) {
      case 'm':
      case 'w':
        delay += .05;
        break;
      case 'i':
      case 'l':
      case 'f':
      case '.':
        delay -= .05;
        break;
    }
  }

  delay += .1;
}

spans[spans.length - 1].addEventListener('animationiteration', () => {
  if(!sections.projects.isOnScreen) {
    pauseRotateCode()
  }
}, {once:true})

function pauseRotateCode() {
  for(let i = 0; i < spans.length; i++) {
    spans[i].style.animationPlayState = 'paused';
  }
  console.log('rotate paused')
}
function playRotateCode() {
  for(let i = 0; i < spans.length; i++) {
    spans[i].style.animationPlayState = 'running';
  }
  console.log('rotate played')
}*/

const projectsRow1 = document.querySelector('#row-1');
const projectsRow2 = document.querySelector('#row-2');

const projectDivs = [];

let linkCanvasActive = false;

projects.forEach(project => {
  const wrapper = document.createElement('div');
  wrapper.classList.add('project-wrapper');
  wrapper.style.background = `url('${project.img}') center center / cover no-repeat`;

  const title = document.createElement('h5');
  title.innerText = `${project.name}`;
  title.classList.add('project-title');
  wrapper.appendChild(title);

  const overlay = document.createElement('div');
  overlay.classList.add('project-overlay');
  wrapper.appendChild(overlay);

  const wrapperAbsolute = document.createElement('div');
  wrapperAbsolute.classList.add('project-wrapper-abs');
  wrapperAbsolute.appendChild(wrapper);
  wrapperAbsolute.id = project.name;

  const wrapperBorder = document.createElement('div');
  wrapperBorder.classList.add('project-wrapper-border');
  wrapperAbsolute.appendChild(wrapperBorder);

  projectDivs.push(wrapperAbsolute);

})

let cardWidth = 320;

for(let i = 0, i2 = projectDivs.length - 1; i < Math.floor(projectDivs.length / 2); i++, i2--) {
  projectDivs[i].style.left = `-${cardWidth + (cardWidth / 2)}px`;
  projectDivs[i2].style.right = `-${cardWidth + (cardWidth / 2)}px`;
  projectsRow1.appendChild(projectDivs[i]);
  projectsRow2.appendChild(projectDivs[i2]);
}



let row1Index = 0;
let row2Index = 0;
for(let card of projectsRow1.children) {
  card.addEventListener('mouseenter', () => {
    projectsHover(card);
  });
  card.addEventListener('mouseleave', projectsUnHover);
  card.addEventListener('animationstart', function nextCard() {
    row1Index = (row1Index + 1) % projectsRow1.children.length;
    animateProjectCardRow1(projectsRow1.children[row1Index])
  })
  card.addEventListener('animationend', function resetCard() {
    card.classList.remove('project-ani');
  })
}
for(let card of projectsRow2.children) {
  card.addEventListener('mouseenter', () => {
    projectsHover(card)
  });
  card.addEventListener('mouseleave', projectsUnHover);
  card.addEventListener('animationstart', function nextCard() {
    row1Index = (row1Index + 1) % projectsRow2.children.length;
    animateProjectCardRow2(projectsRow2.children[row1Index])
  })
  card.addEventListener('animationend', function resetCard() {
    card.classList.remove('project-ani');
  })
}


let cardsOnScreen = [];



function projectsHover(card) {
  cardsOnScreen = [];
  for(let card of projectsRow1.children) {
    const rect = card.getBoundingClientRect();
    if(rect.x > 25 && rect.x < window.innerWidth - 25) cardsOnScreen.push(card);
    const border = card.querySelector('.project-wrapper-border');
    const wrapper = card.querySelector('.project-wrapper');

    border.style.transform = 'translateX(30px) translateY(-20px)';
    wrapper.style.transform = 'translateX(50px)';
    card.style.animationPlayState = 'paused';


  }
  for(let card of projectsRow2.children) {
    const rect = card.getBoundingClientRect();
    if(rect.x > 25 && rect.x < window.innerWidth - 25) cardsOnScreen.push(card);
    const border = card.querySelector('.project-wrapper-border');
    const wrapper = card.querySelector('.project-wrapper');

    border.style.transform = 'translateX(-70px) translateY(-20px)';
    wrapper.style.transform = 'translateX(-50px)';
    card.style.animationPlayState = 'paused';
  }
  linkCards(card);
}
function projectsUnHover() {
  if(linkCanvasActive) {
    document.body.removeChild(document.getElementById('constellationCanvas'));
    linkCanvasActive = false;
  }
  cardsOnScreen = [];
  for(let card of document.querySelectorAll('.project-card-hover')) {
    card.classList.remove('project-card-hover');
    card.style.opacity = '1';
  }

  for(let card of [...projectsRow1.children, ...projectsRow2.children]) {
    const border = card.querySelector('.project-wrapper-border');
    const wrapper = card.querySelector('.project-wrapper');
    border.style.transform = '';
    border.style.opacity = '1';
    wrapper.style.transform = '';
    card.style.opacity = '1';
    card.style.animationPlayState = 'running';
  }

}

function linkCards(hoveredCard) {
  const hoveredProject = projects.find(p => p.name === hoveredCard.id);
  const tagFreq = getTagFrequencies();
  const sortedTags = sortTagFrequencies(hoveredProject.tags, tagFreq);

  const linkLoop = getLinkLoop(hoveredCard);

  const [card1, card2, card3, complete, tag1, tag2, tag3] = linkLoop;
  const linkedCards = [card1].filter(Boolean);
  if(card2) linkedCards.push(card2);
  if(card3) linkedCards.push(card3);

  const linkedTags = [tag1].filter(Boolean);
  if(tag2) linkedTags.push(tag2);
  if(Array.isArray(tag3)) {linkedTags.push(tag3[0])}
  else if(tag3) {linkedTags.push(tag3)}


  if(linkedCards.length > 1) {
    getLinkCenters(linkedCards, linkedTags, complete);
  }

  const linkedSet = new Set(linkedCards);

  const unLinked = [
    ...Array.from(projectsRow1.children),
    ...Array.from(projectsRow2.children)
  ].filter(card => !linkedSet.has(card));

  const hoveredIndex = cardsOnScreen.indexOf(hoveredCard);
  if (hoveredIndex !== -1) cardsOnScreen.splice(hoveredIndex, 1);



  linkedCards.forEach(card => {
    if(card.parentElement === projectsRow1) {
      card.style.opacity = '.85';
      card.firstElementChild.style.transform = 'translateX(50px) scale(1.1)';
      card.lastElementChild.style.transform = 'translateX(50px) translateY(0)';
      card.lastElementChild.style.opacity = '0';
    } else {
      card.style.opacity = '.85';
      card.firstElementChild.style.transform = 'translateX(-50px) scale(1.1)';
      card.lastElementChild.style.transform = 'translateX(-50px) translateY(0)';
      card.lastElementChild.style.opacity = '0';
    }

    card.firstElementChild.classList.add('project-card-hover');
  })
  unLinked.forEach(card => {
    card.style.opacity = '0.15';
  })
}

function getTagFrequencies() {
  const freq = {};
  cardsOnScreen.forEach(card => {
    const project = projects.find(p => p.name === card.id);
    project.tags.forEach(tag => {
      if(freq[tag]) {freq[tag] += 1}
      else {freq[tag] = 1}
    });
  });
  return freq;
}

function weightedShuffle(cards, targetTag) {
  const weightedCards = cards.map(card => {
    const project = projects.find(p => p.name === card.id);
    const hasTargetTag = project.tags.includes(targetTag);
    if(hasTargetTag) {
      return {
        card,
        weight: 1
      }
    } else {
      return {
        card,
        weight: .5
      }
    }
  });

  weightedCards.sort(() => Math.random() - 0.5);

  weightedCards.sort((a, b) => b.weight - a.weight);

  return weightedCards.map(entry => entry.card);
}
function hasTooManyInRow(rows) {
  const amount = {};
  for(let row of rows) {
    if(amount[row]) {amount[row] += 1} else {amount[row] = 1}
    if(amount[row] > 2) return true;
  }
  return false;

}

function getCardRow(card) {
  return projectsRow1.contains(card) ? 'row1' : 'row2';
}

function sortTagFrequencies(projectTags, tagFreq) {
  const tags = [...projectTags];
  tags.sort((a,b) => {
    const freqA = tagFreq[a] || 0;
    const freqB = tagFreq[b] || 0;
    return(freqA - freqB);
  });
  let filtered = tags.filter(tag => tagFreq[tag] >= 2);
  if(filtered.length < 1) filtered = tags;
  return filtered;
}

const tagPriority = [
  'Mobile PWA',
  'UI Design',
  'Email Marketing',
  'Print Production',
  'UX Design',
  'Web Development'
]

function getLinkLoop(hoveredCard, recall = false) {
  const hoveredProject = projects.find(p => p.name === hoveredCard.id);

  const hoveredTags = hoveredProject.tags.slice().sort((a, b) => {
    let aIndex = tagPriority.indexOf(a);
    let bIndex = tagPriority.indexOf(b);
    if(aIndex === -1) aIndex = 999;
    if(bIndex === -1) bIndex = 999;
    return aIndex - bIndex;
  });
  const getProject = (card) => projects.find(p => p.name === card.id);

  const cardPool = weightedShuffle(cardsOnScreen.filter(card => card !== hoveredCard));

  let card2 = null;
  let tag1 = null;
  const row1 = getCardRow(hoveredCard);

  for(let tag of hoveredTags) {
    card2 = cardPool.find(card => {
      const project = getProject(card);
      return project.tags.includes(tag);
    });
    if(card2) {
      tag1 = tag;
      break;
    }
  }
  if(!card2) {
    return [hoveredCard, null, null, false, null, null, null];
  }

  const cardPool2 = weightedShuffle(cardPool.filter(card => card !== card2));
  const card2Project = getProject(card2);
  const row2 = getCardRow(card2);

  let card3 = null;
  let tag2 = null;

  for(let tag of hoveredTags) {
    if(tag === tag1) continue;
    card3 = cardPool2.find(card => {
      const project = getProject(card);
      return project.tags.includes(tag) && card2Project.tags.includes(tag);
    });
    if(card3) {
      tag2 = tag;
      break;
    }
  }
  if(!card3) {
    card3 = cardPool2.find(card => {
      const project = getProject(card);
      return project.tags.includes(tag1) && card2Project.tags.includes(tag1);
    });
  }
  if(card3 && !tag2) {
    tag2 = tag1;
  }
  if(!card3) {
    return [hoveredCard, card2, null, false, tag1, null, null];
  }

  const card3Project = getProject(card3);
  const row3 = getCardRow(card3);

  const backTag = hoveredProject.tags.filter(tag => card3Project.tags.includes(tag)) || null;

  const loop = [hoveredCard, card2, card3];

  const rows = loop.reduce((obj, card) => {
    const row = getCardRow(card);
    if(obj[row]) {obj[row] += 1} else {obj[row] = 1}
    return obj;
  }, {});

  const tooManyInRow = Object.values(rows).some(count => count > 2);

  if(tooManyInRow && !recall) {
    return getLinkLoop(hoveredCard, true)
  }

  return [
    hoveredCard,
    card2,
    card3,
    !tooManyInRow && backTag.length > 0,
    tag1,
    tag2,
    backTag.length > 0 ? backTag : null
  ];
}

function getLinkCenters(linkedCards, tags, complete) {
  if(linkedCards.length === 1) return;

  const getCenter = (card) => {
    const rect = card.getBoundingClientRect();
    if(projectsRow1.contains(card)) {
      return {
        x: (rect.left + rect.width / 2) + 50,
        y: rect.top + rect.height / 2
      }
    } else {
      return {
        x: (rect.left + rect.width / 2) - 50,
        y: rect.top + rect.height / 2
      }
    }

  }

  const centers = [getCenter(linkedCards[0]), getCenter(linkedCards[1])];
  if(linkedCards.length > 2) {
    centers.push(getCenter(linkedCards[2]));
    if(complete) centers.push(getCenter(linkedCards[0]));
  }
  console.log('centers', centers)
  animateLinks(centers, tags, complete);

}

function animateLinks(centers, tags, complete) {
  linkCanvasActive = true;
  const canvas = createCanvas();
  const ctx = canvas.getContext('2d');

  let speed = 0.025;
  let progress = 0;
  let circleFade = 0.1;

  const tag1Text = tags[0];
  console.log(tags[0])
  ctx.font = '20px "area-normal", sans-serif';
  const tag1Width = ctx.measureText(tag1Text).width;

  const lineLength = Math.hypot(
    centers[1].x - centers[0].x,
    centers[1].y - centers[0].y
  );

  const tag1Start = (lineLength / 2) - (tag1Width / 2);
  const tag1StartProg = tag1Start / lineLength;


  const midX = (centers[0].x + centers[1].x) / 2;
  const midY = (centers[0].y + centers[1].y) / 2;

  function drawCircles() {
    centers.forEach(center => {
      ctx.beginPath();
      ctx.arc(center.x, center.y, 6, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(138,205,255, ${circleFade})`;
      ctx.fill();
    });
    circleFade = Math.min(circleFade + .1, 1);
  }

  function drawTag(start, end, mid, tag, tagStartProg, prog) {
    const tagWidth = ctx.measureText(tag).width;
    let tagAngle = Math.atan2(
      end.y - start.y,
      end.x - start.x
    );

    if(Math.abs(tagAngle) > Math.PI / 2) {
      tagAngle += Math.PI;
    }

    const offset = 15;
    const offsetX = Math.sin(tagAngle) * offset;
    const offsetY = -Math.cos(tagAngle) * offset;

    const visLetterCount = Math.min(
      Math.floor((prog - tagStartProg) * 30),
      tag.length);

    ctx.save();
    ctx.fillStyle = '#f1f1f1';
    ctx.translate(mid.x, mid.y);
    ctx.rotate(tagAngle);


    let xOffset = -tagWidth / 2;
    let displayText;
    const isLeftward = start.x > end.x;

    if (isLeftward) {
      displayText = tag.split('').reverse().join('');
      xOffset = tagWidth / 2;

      for (let i = 0; i < visLetterCount; i++) {
        const letter = displayText[i];
        const charWidth = ctx.measureText(letter).width;
        xOffset -= charWidth;
        ctx.fillText(letter, xOffset, -10);
      }

    } else {
      displayText = tag;

      for (let i = 0; i < visLetterCount; i++) {
        const letter = displayText[i];
        const charWidth = ctx.measureText(letter).width;
        ctx.fillText(letter, xOffset, -10);
        xOffset += charWidth;
      }
    }




    ctx.restore();
  }

  function drawStaticLine(start, end, tagText = null) {
    ctx.strokeStyle = '#8acdff';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(start.x, start.y);
    ctx.lineTo(end.x, end.y);
    ctx.stroke();

    if(tagText) {
      const mid = {
        x: (start.x + end.x) / 2,
        y: (start.y + end.y) / 2
      };
      drawTag(start, end, mid, tagText, 0, 1);
    }
  }


  console.log('animatingggggg');

  function draw1Link() {
    console.log('drawingggg 1 link')
    ctx.clearRect(0,0, canvas.width, canvas.height);

    const start = centers[0];
    const end = centers[1];

    const aniX = start.x + (end.x - start.x) * progress;
    const aniY = start.y + (end.y - start.y) * progress;


    ctx.strokeStyle = '#8acdff';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(start.x, start.y);
    ctx.lineTo(aniX, aniY);

    ctx.stroke();

    drawCircles();

    if(progress >= tag1StartProg) drawTag(start, end, {x: midX,y:midY}, tag1Text, tag1StartProg, progress);

    progress = Math.min(progress + speed, 1);


    if(progress < 1) {
      requestAnimationFrame(draw1Link);
    } else {
      drawStaticLine(start,end,tag1Text);
    }
  }

  function draw2Links() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    const [start, mid, end] = centers;
    const tag1Text = tags[0];
    const tag2Text = tags[1];
    const tag1Width = ctx.measureText(tag1Text).width;
    const tag2Width = ctx.measureText(tag2Text).width;
    let localProg = 0;

    const lineLength1 = Math.hypot(
      mid.x - start.x,
      mid.y - start.y
    );
    const lineLength2 = Math.hypot(
      end.x - mid.x,
      end.y - mid.y
    )

    const tag1Start = (lineLength1 / 2) - (tag1Width / 2);
    const tag1StartProg = tag1Start / lineLength1;

    const tag2Start = (lineLength2 / 2) - (tag2Width / 2);
    const tag2StartProg = tag2Start / lineLength2;


    function drawLine1() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      const aniX = start.x + (mid.x - start.x) * localProg;
      const aniY = start.y + (mid.y - start.y) * localProg;

      ctx.strokeStyle = '#8acdff';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(start.x, start.y);
      ctx.lineTo(aniX, aniY);
      ctx.stroke();

      drawCircles();

      if(localProg >= tag1StartProg) {
        const mid1 = {
          x: (start.x + mid.x) / 2,
          y: (start.y + mid.y) / 2
        };
        drawTag(start, mid, mid1, tag1Text, tag1StartProg, localProg);

      }

      localProg = Math.min(localProg + speed, 1);

      if(localProg < 1) {
        requestAnimationFrame(drawLine1);
      } else {
        drawStaticLine(start, mid, tag1Text);
        localProg = 0;
        requestAnimationFrame(drawLine2)
      }

    }

    function drawLine2() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      const aniX = mid.x + (end.x - mid.x) * localProg;
      const aniY = mid.y + (end.y - mid.y) * localProg;

      ctx.strokeStyle = '#8acdff';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(mid.x, mid.y);
      ctx.lineTo(aniX, aniY);
      ctx.stroke();

      drawStaticLine(start,mid,tag1Text);
      drawCircles();

      if(localProg >= tag2StartProg) {
        const mid2 = {
          x: (mid.x + end.x) / 2,
          y: (mid.y + end.y) / 2
        };
        drawTag(mid, end, mid2, tag2Text, tag2StartProg, localProg);
      }

      localProg = Math.min(localProg + speed, 1);

      if(localProg < 1) {
        requestAnimationFrame(drawLine2);
      } else {
        drawStaticLine(mid,end,tag2Text);
      }
    }
    drawLine1();
  }

  function drawLoop() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    const [start, mid, end, back] = centers;
    const [tag1Text, tag2Text, tag3Text] = tags;

    const tag1Width = ctx.measureText(tag1Text).width;
    const tag2Width = ctx.measureText(tag2Text).width;
    const tag3Width = ctx.measureText(tag3Text).width;

    let localProg = 0;

    const line1Length = Math.hypot(mid.x - start.x, mid.y - start.y);
    const line2Length = Math.hypot(end.x - mid.x, end.y - mid.y);
    const line3Length = Math.hypot(back.x - end.x, back.y - end.y);

    const tag1StartProg = ((line1Length / 2) - (tag1Width / 2)) / line1Length;
    const tag2StartProg = ((line2Length / 2) - (tag2Width / 2)) / line2Length;
    const tag3StartProg = ((line3Length / 2) - (tag3Width / 2)) / line3Length;

    function drawLine(startPoint, endPoint, tag, tagStartProg, prog) {
      const aniX = startPoint.x + (endPoint.x - startPoint.x) * prog;
      const aniY = startPoint.y + (endPoint.y - startPoint.y) * prog;

      ctx.strokeStyle = '#8acdff';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(startPoint.x, startPoint.y);
      ctx.lineTo(aniX, aniY);
      ctx.stroke();

      const midPoint = {
        x: (startPoint.x + endPoint.x) / 2,
        y: (startPoint.y + endPoint.y) / 2
      };

      if(prog >= tagStartProg) {
        drawTag(startPoint, endPoint, midPoint, tag, tagStartProg, prog);
      }
    }

    function step1() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      drawLine(start, mid, tag1Text, tag1StartProg, localProg);
      drawCircles();

      localProg = Math.min(localProg + speed, 1);

      if(localProg < 1) {
        requestAnimationFrame(step1);
      } else {
        drawStaticLine(start,mid,tag1Text);
        drawCircles();
        localProg = 0;
        requestAnimationFrame(step2);
      }
    }

    function step2() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      drawStaticLine(start, mid, tag1Text);
      drawLine(mid, end, tag2Text, tag2StartProg, localProg);
      drawCircles();

      localProg = Math.min(localProg + speed, 1);

      if(localProg < 1) {
        requestAnimationFrame(step2);
      } else {
        drawStaticLine(mid, end, tag2Text);
        drawCircles();
        localProg = 0;
        requestAnimationFrame(step3);
      }

    }

    function step3() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      drawStaticLine(start,mid,tag1Text);
      drawStaticLine(mid,end,tag2Text);
      drawLine(end, back, tag3Text, tag3StartProg, localProg);
      drawCircles();

      localProg = Math.min(localProg + speed, 1);
      if(localProg < 1) {
        requestAnimationFrame(step3);
      } else {
        drawStaticLine(end,back,tag3Text)
        drawCircles();
      }

    }
    requestAnimationFrame(step1);
  }

  if(centers.length === 2) {
    draw1Link()
  } else if(centers.length === 3) {
    draw2Links()
  } else if(centers.length === 4 && complete && tags.length === 3) {
    drawLoop();
  } else {
    draw2Links()
  }

}

function createCanvas() {
  const canvas = document.createElement('canvas');
  canvas.id = 'constellationCanvas';
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  canvas.style.width = `${window.innerWidth}px`;
  canvas.style.height = `${window.innerHeight}px`;

  canvas.style.position = 'fixed';
  canvas.style.top = '0';
  canvas.style.left = '0';
  canvas.style.pointerEvents = 'none';
  canvas.style.zIndex = '200';


  document.body.appendChild(canvas);
  return canvas;
}

let row1IndexRect = projectsRow1.children[row1Index].getBoundingClientRect();
/*function row1Ani() {
  if(!projectsRow1.children[row1Index].classList.contains('project-ani')) {
    animateProjectCard(projectsRow1.children[row1Index]);
  }
  row1IndexRect = projectsRow1.children[row1Index].getBoundingClientRect();
  if(row1IndexRect.left > 50) {
    row1Index++;
    animateProjectCard(projectsRow1.children[row1Index])
  }
  setTimeout(row1Ani, 50);

}*/

animateProjectCardRow1(projectsRow1.children[row1Index])
animateProjectCardRow2(projectsRow2.children[row2Index])

function animateProjectCardRow1(card) {
  card.style.setProperty('--project-ani-dist', `${window.innerWidth + cardWidth * 2}px`);
  card.classList.add('project-ani');
}
function animateProjectCardRow2(card) {
  card.style.setProperty('--project-ani-dist', `-${window.innerWidth + cardWidth * 2}px`);
  card.classList.add('project-ani');
}


function placeProjects() {
  let cardSpace = 1;
  const cardSize = projectsRow1.firstElementChild.getBoundingClientRect().width;
  const totalWidth = window.innerWidth;
  const totalCount = projectsRow1.children.length;

  const countOnScreen = Math.max(1, Math.min(totalCount, Math.floor((totalWidth + cardSpace) / (cardSize + cardSpace)))) + 1;
  const totalCardWidth = countOnScreen * cardSize;
  const totalSpacing = totalWidth - totalCardWidth;
  const space = totalSpacing / (countOnScreen + 1);
  for(let i = 0; i < countOnScreen; i++) {
    const translate = i * (cardSize + cardSpace);
    projectsRow1.children[i].style.transform = `translateX(${translate}px)`;
    projectsRow2.children[i].style.transform = `translateX(${translate - 100}px)`;
  }
  for(let i = countOnScreen; i <= totalCount - 1; i++) {
    projectsRow1.children[i].style.transform = `translateX(-${cardSize + cardSpace}px)`;
    projectsRow2.children[i].style.transform = `translateX(-${cardSize + cardSpace + 100}px)`;

  }
}
//placeProjects();

const employees = [
  {
    name: 'Joel Salisbury',
    id: 'joel-salis',
    title: 'Director of Internal Insights and Innovation',
    img: 'img/i3/people/salisbury.jpg',
    gradient: '7, 51, 51',
    linkedIn: 'https://www.linkedin.com/in/salisburyj/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Brian Kelleher',
    id: 'brian-kell',
    title: 'Senior Applications Developer',
    img: 'img/i3/people/kelleher.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://www.linkedin.com/in/briankelleher1/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Natalie Lacroix',
    id: 'natalie-lacr',
    title: 'Senior UI/UX Designer',
    img: 'img/i3/people/lacroix.jpg',
    gradient: '48, 10, 49',
    linkedIn: 'https://www.linkedin.com/in/natalie-lacroix-510a42188/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Jeff Winston',
    id: 'jeff-winst',
    title: 'Director of Nexus Student Success Platform',
    img: 'img/i3/people/winston.jpg',
    gradient: '51, 37, 7',
    linkedIn: 'https://www.linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Brian Daley',
    id: 'brian-daley',
    title: 'DMD Faculty Advisor',
    img: 'img/i3/people/daley.jpg',
    gradient: '7, 14, 51',
    linkedIn: 'https://www.linkedin.com/in/brianpdaley/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Michael Vertefeuille',
    id: 'mike-vert',
    title: 'DMD Faculty Advisor',
    img: 'img/i3/people/vert.jpg',
    gradient: '51, 31, 7',
    linkedIn: 'https://www.linkedin.com/in/michaelvertefeuille/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Emma Adams',
    id: 'emma-adams',
    title: 'Student Web Developer',
    img: 'img/i3/people/adams.jpg',
    gradient: '7, 46, 51',
    linkedIn: 'https://linkedin.com/',
    tags: ['Laravel', 'Javascript'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Lauren Busavage',
    id: 'lauren-busav',
    title: 'Student Web Developer',
    img: 'img/i3/people/busavage.png',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Aurora', 'Sketches'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."

  },
  {
    name: 'Kelis Clarke',
    id: 'kelis-clarke',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Ryan Cohutt',
    id: 'ryan-cohutt',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Maggie Danielewicz',
    id: 'maggie-daniel',
    title: 'Student Web Developer',
    img: 'img/i3/people/danielewicz.jpg',
    gradient: '30, 50, 30',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Luna Gonzalez',
    id: 'luna-gonzal',
    title: 'Student Illustrator',
    img: 'img/i3/people/luna.jpg',
    gradient: '30, 50, 30',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Aaron Mark',
    id: 'aaron-mark',
    title: 'Student Web Developer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Jack Medrek',
    id: 'jack-medrek',
    title: 'Student Software Developer',
    img: 'img/i3/people/medrek.jpg',
    gradient: '1, 7, 41',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Kailey Moore',
    id: 'kailey-moore',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/moore.jpg',
    gradient: '38, 0, 76',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'William Shostak',
    id: 'william-shostak',
    title: 'Student Software Developer',
    img: 'img/i3/people/shostak.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Emelia Salmon',
    id: 'emelia-salmon',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  },
  {
    name: 'Victoria Brey',
    id: 'victoria-brey',
    title: 'Student Web Developer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/',
    tags: ['Tag 1', 'Tag 2'],
    bio: "Whoah this person is so cool they like do design stuff and they're a student and like they're talented and probably have hobbies that's wild. " +
      "I wonder if any of the students have pets that'd be cool. I bet they've got some interesting stuff to put in their bio I should probably get those bios huh. " +
      "Lots of cool stuff goin on over here like cool student work and stuff."
  }
]

const teamRow = document.querySelector('.team-row');

employees.forEach((employee, index) => {
  const card = document.createElement('div');
  card.classList.add('main-employee-card');
  card.classList.add('d-flex');

  const front = document.createElement('div');
  front.classList.add('employee-card-front', 'employee-card-face');

  const back = document.createElement('div');
  back.classList.add('employee-card-back', 'employee-card-face');

  const link = document.createElement('a');
  link.href = `${employee.linkedIn}`;
  link.classList.add('linked-in-wrap');
  const icon = document.createElement('img');
  icon.src = '/img/i3/linked-in.svg';
  icon.alt = 'LinkedIn';
  icon.target = '_blank';
  icon.classList.add('linked-in');
  link.appendChild(icon);
  back.appendChild(link);

  const textWrap = document.createElement('div');
  textWrap.classList.add('employee-card-text-wrap');
  const name = document.createElement('h4');
  name.classList.add('employee-name-main');
  name.innerText = `${employee.name}`;
  const title = document.createElement('h6');
  title.classList.add('employee-title-main');
  title.innerText = `${employee.title}`;
  const tag1 = document.createElement('h6');
  const tag2 = document.createElement('h6');
  tag1.classList.add('employee-tag');
  tag2.classList.add('employee-tag');
  tag1.innerText = employee.tags[0];
  tag2.innerText = employee.tags[1];
  const tagWrapper = document.createElement('div');
  tagWrapper.classList.add('employee-tag-wrapper');
  tagWrapper.appendChild(tag1);
  tagWrapper.appendChild(tag2);

  textWrap.appendChild(name);
  textWrap.appendChild(title);
  textWrap.appendChild(tagWrapper);

  front.appendChild(textWrap);

  card.style.setProperty('--gradient-start', `rgba(${employee.gradient}, .7)`);
  card.style.setProperty('--gradient-end', `rgba(${employee.gradient}, 0)`);
  const gradient = document.createElement('div');
  gradient.classList.add('employee-card-gradient');

  front.appendChild(gradient);

  const hover = document.createElement('div');
  hover.classList.add('employee-card-hover');
  front.appendChild(hover);

  const img = document.createElement('img');
  img.src = `${employee.img}`;
  img.alt = `${employee.name}`;
  img.classList.add('employee-card-img');
  img.loading = 'lazy';

  front.appendChild(img);

  const bio = document.createElement('p');
  bio.classList.add('employee-card-bio');
  bio.innerText = employee.bio;

  back.appendChild(bio);

  card.appendChild(front);
  card.appendChild(back);

  const cardWrap = document.createElement('div');
  cardWrap.classList.add('employee-card-wrap');
  cardWrap.appendChild(card);

  cardWrap.id = `${employee.id}-card`;

  teamRow.appendChild(cardWrap)

});

let empCardIndex = 0;
let empCardWidth = 288;

for(let card of teamRow.children) {
  card.style.left = `-${empCardWidth + (empCardWidth / 2)}px`;
  card.addEventListener('animationstart', function nextCard() {
    empCardIndex = (empCardIndex + 1) % teamRow.children.length;
    animateEmployeeCard(teamRow.children[empCardIndex])
  })
  card.addEventListener('animationend', function resetCard() {
    card.classList.remove('employee-ani');
  })
}


function animateEmployeeCard(card) {
  card.style.setProperty('--employee-ani-dist', `${window.innerWidth + empCardWidth + (empCardWidth/2)}px`);
  card.classList.add('employee-ani')
}

animateEmployeeCard(teamRow.children[empCardIndex])



const phrases = [
  "build systems",
  "create websites",
  "explore tech",
  "implement solutions",
  "develop apps"
];

const moveText = document.getElementById('move-text');
const moveText2 = document.getElementById('move-text-2');
const forUconn = document.getElementById('forUconn');
const charWidth = 20;
const maxPhraseLength = Math.max(...phrases.map(p => p.length));
moveText.style.width = (maxPhraseLength * charWidth) + "px";
moveText2.style.width = (maxPhraseLength * charWidth) + "px"; // For consistency
let color = '#8dc1ff';
let currPhrase = 0;
forUconn.style.marginLeft = '8px';
forUconn.style.transform = `translateX(${-(maxPhraseLength * charWidth) + phrases[currPhrase].length}px)`;
buildPhrase1();

function buildPhrase1() {
  let direction = 1;
  moveText.innerHTML = '';
  for (let char of phrases[currPhrase]) {
    let span = document.createElement('span');
    span.classList.add('move-char');
    span.style.display = 'inline-block';
    span.style.opacity = '0';
    span.style.position = 'relative';
    span.style.color = `${color}`
    span.style.transition = 'transform .54s cubic-bezier(.6,.2,.25,1), opacity .54s';
    if(char === ' ') {
      span.innerHTML = '&nbsp';
      span.classList.add('space-char');
      color = '#348fff';
    } else {
      span.innerText = char;
    }
    switch(direction) {
      case 1: span.style.transform = 'translate(-50px, -45px)'; break;
      case 2: span.style.transform = 'translate(50px, -45px)'; break;
      case 3: span.style.transform = 'translate(50px, 45px)'; break;
      case 4: span.style.transform = 'translate(-50px, 45px)'; break;
    }
    moveText.appendChild(span);
    direction = (direction % 4) + 1;
  }
  setTimeout(phrase1In, 50)

  color = '#8dc1ff';
  currPhrase = (currPhrase + 1) % phrases.length;
}

function buildPhrase2() {
  let direction = 1;
  moveText2.innerHTML = '';
  for (let char of phrases[currPhrase]) {
    let span = document.createElement('span');
    span.classList.add('move-char');
    span.style.display = 'inline-block';
    span.style.opacity = '0';
    span.style.position = 'relative';
    span.style.color = `${color}`
    span.style.transition = 'transform .54s cubic-bezier(.6,.2,.25,1), opacity .54s';
    if(char === ' ') {
      span.innerHTML = '&nbsp';
      span.classList.add('space-char');
      color = '#348fff';
    } else {
      span.innerText = char;
    }
    switch(direction) {
      case 1: span.style.transform = 'translate(-50px, -45px)'; break;
      case 2: span.style.transform = 'translate(50px, -45px)'; break;
      case 3: span.style.transform = 'translate(50px, 45px)'; break;
      case 4: span.style.transform = 'translate(-50px, 45px)'; break;
    }
    moveText2.appendChild(span);
    direction = (direction % 4) + 1;
  }
  setTimeout(phrase2In, 150);
  color = '#8dc1ff';
  currPhrase = (currPhrase + 1) % phrases.length;
}

function phrase1In() {
  let delay = 0.08;
  alignForUConn(moveText);
  for(let char of moveText.children) {
    char.style.transitionDelay = `${delay}s`;
    char.style.transform = 'none';
    char.style.opacity = '1';
    delay += 0.06;
  }
  setTimeout(phrase1Out, getAnimationDuration(phrases[currPhrase].length));
}

function phrase2In() {
  let delay = (0.06 * phrases[currPhrase].length) + .5;
  alignForUConn(moveText2);
  for(let char of moveText2.children) {
    char.style.transitionDelay = `${delay}s`;
    char.style.transform = 'none';
    char.style.opacity = '1';
    delay -= 0.06;
  }
  setTimeout(phrase2Out, getAnimationDuration(phrases[currPhrase].length));
}

function phrase1Out() {
  let delay = 0.06 * moveText.children.length;
  let direction = 1;
  for (let char of moveText.children) {
    char.style.transitionDelay = `${delay}s`;
    switch (direction) {
      case 1:
        char.style.transform = 'translate(-50px, -45px)';
        break;
      case 2:
        char.style.transform = 'translate(50px, -45px)';
        break;
      case 3:
        char.style.transform = 'translate(50px, 45px)';
        break;
      case 4:
        char.style.transform = 'translate(-50px, 45px)';
        break;
    }
    char.style.opacity = '0';
    direction = (direction % 4) + 1;
    delay -= 0.06;
  }
  setTimeout(buildPhrase2, 100)
}

function phrase2Out() {
  let delay = 0.08;
  let direction = 1;
  for (let char of moveText2.children) {
    char.style.transitionDelay = `${delay}s`;
    switch (direction) {
      case 1:
        char.style.transform = 'translate(-50px, -45px)';
        break;
      case 2:
        char.style.transform = 'translate(50px, -45px)';
        break;
      case 3:
        char.style.transform = 'translate(50px, 45px)';
        break;
      case 4:
        char.style.transform = 'translate(-50px, 45px)';
        break;
    }
    char.style.opacity = '0';
    direction = (direction % 4) + 1;
    delay += 0.06;
  }
  setTimeout(buildPhrase1, 100)
}

function getAnimationDuration(numLetters) {
  const perLetterDelay = 0.06;
  const baseDelay = 0.08;
  const duration = 0.54;
  const buffer = 1.25;
  return (baseDelay + perLetterDelay * (numLetters - 1) + duration + buffer) * 1000;
}

function alignForUConn(wrapper) {
  const charWidth = 20;
  const textWidth = wrapper.children.length * charWidth;
  forUconn.style.transition = 'transform 1.725s cubic-bezier(.5,.1,.3,1)';
  forUconn.style.marginLeft = '8px';
  forUconn.style.transform = `translateX(${-(maxPhraseLength * charWidth) + textWidth}px)`;

}

/* ------------------- ANIMATION FRAME LOOP ------------------- */


let lastTime = 0;
const frameRate = 1000 / 60;
let frameTest = 3000;
let frameCount = 0;
let bgAnimated = false;
let frameLooping = false;
// Call animation frame
function animateFrame(now) {
  // Check framerate sync
  if(now - lastTime >= frameRate) {
    console.log('frame')
    lastTime = now;
    if(!bgAnimated) animateStarBG();
    if(bgAnimated) animateStarPull();
  }
  if(sections.hero.isOnScreen || !bgAnimated) requestAnimationFrame(animateFrame)
}


/* ------------------- STAR CACHING ------------------- */


// Define section sizes
let sectionWidth = Math.ceil(window.innerWidth / 3);
let sectionHeight = Math.ceil(window.innerHeight / 2);

// Initialize star cache object
const cachedStarSections = {}

// Define cached section breakpoints
const cacheSectionOffsets = {
  0: [0, sectionHeight],
  1: [0, 0],
  2: [sectionWidth, sectionHeight],
  3: [sectionWidth, 0],
  4: [sectionWidth * 2, sectionHeight],
  5: [sectionWidth * 2, 0]
}

// Track sections live vs static (cached)
const sectionStatic = {
  0: false,
  1: false,
  2: false,
  3: false,
  4: false,
  5: false
}

// Set cache section size
function setCachedSectionSize() {
  // For each section set it's size + canvas
  for(let code = 0; code <= 5; code++) {
    if(cachedStarSections[code]) delete cachedStarSections[code];
    const canvas = document.createElement('canvas');
    canvas.width = sectionWidth;
    canvas.height = sectionHeight + spacing;
    cachedStarSections[code] = canvas;
  }
}

// Cache each section's stars
function cacheStaticStars() {

  // For each section add all section stars to canvas
  for(let code = 0; code <= 5; code++) {
    // Get section stars/offsets
    const sectionStars = getStarsByCode(code);
    const ctx = cachedStarSections[code].getContext('2d');
    const [offsetX, offsetY] = cacheSectionOffsets[code];

    // Define star shadows
    ctx.shadowColor = 'rgba(241, 241, 241, 0.2)';
    ctx.shadowBlur = 4;
    ctx.shadowOffsetX = 0;
    ctx.shadowOffsetY = 0;

    // Draw star on canvas
    ctx.clearRect(0, 0, sectionWidth, sectionHeight)
    sectionStars.forEach(star => {
      ctx.save();
      ctx.translate(star.x - offsetX, star.y - offsetY);
      ctx.rotate(star.rotation);
      ctx.beginPath();
      ctx.ellipse(0, 0, star.rx, star.ry, 0, 0, Math.PI * 2);
      ctx.fillStyle = 'rgb(77,179,255)';
      ctx.globalAlpha = 0.25;
      ctx.fill();
      ctx.restore();
    })
  }
}

// Get all stars in each section
function getStarsByCode(code) {
  switch(code) {
    case 0: return allStars.starsBotLeft;
    case 1: return allStars.starsTopLeft;
    case 2: return allStars.starsBotMid;
    case 3: return allStars.starsTopMid;
    case 4: return allStars.starsBotRight;
    case 5: return allStars.starsTopRight;
  }
}


/* ------------------- STAR CREATION ------------------- */


// Define canvas/ctx variables
const canvas = document.getElementById('star-canvas');
const ctx = canvas.getContext('2d');

canvas.style.top = `${ucHeaderRect.height}px`;
document.getElementById('i3-head').style.top = `${ucHeaderRect.height}px`

// Set space between stars
const spacing = window.innerWidth / 30;
// Set section breakpoints
const horizBreak = Math.floor(screen.height / 2);
const leftVertBreak = Math.floor(screen.width / 3);
const rightVertBreak = Math.floor((screen.width / 3) * 2);

let fadeInIncomplete = false;

// Initialize stars array
const allStars = {
  // Number code: 0
  starsBotLeft: [],
  // Number code: 1
  starsTopLeft: [],
  // Number code: 2
  starsBotMid: [],
  // Number code: 3
  starsTopMid: [],
  // Number code: 4
  starsBotRight: [],
  // Number code: 5
  starsTopRight: [],
};

// Resize star background (needs work)
function resizeStarBG() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  for(let code = 0; code <= 5; code++) {
    let [x, y] = cacheSectionOffsets[code];
    ctx.drawImage(cachedStarSections[code], Math.round(x), Math.round(y))
  }
}


// Set frame number to 0
let frame = 0;

// Create star background
function createStarBG() {
  // Set canvas width/height to window width/height
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  // Set canvas style to viewport height/width
  canvas.style.width = '100vw';
  canvas.style.height = '100vh';

  // Calculate rows/columns needed depending on screen's resolution
  const rows = Math.floor((screen.height) / spacing);
  const cols = Math.floor(screen.width / spacing);

  // Initialize x/y variables
  let x;
  let y;

  // For each row of stars
  for (let row = 0; row < rows; row++) {

    // For each column of stars
    for (let col = 0; col < cols; col++) {

      // Set x to col's spacing value +/- ~7 with offset by 10 for first col to ensure it is drawn onscreen
      if(col === 0) {
        // Set x to column's spacing value +/- ~7 with offset to ensure onscreen
        x = (col*spacing) + (Math.random() * 8 - 4) + 5;
      } else {
        // Set x to column's spacing value +/- ~7
        x = (col * spacing) + (Math.random() * 8 - 4);
      }

      // Set y to row's spacing value +/- ~7 with offset by 10 for first row to ensure it is drawn onscreen
      if(row === 0) {
        y = (row * spacing) + (Math.random() * 8 - 4) + 5;
      } else {
        y = (row * spacing) + (Math.random() * 8 - 4);
      }

      // Set delay based on row and column number
      const delay = (row + col);

      // Set rx/ry/rotation to random values within respective range
      const rx = Math.random() * 0.75 + 1.25;
      const ry = rx * (Math.random() * 0.3 + 1.1);
      const rotation = Math.random() * Math.PI * 2;

      // Check which section created star is in, add to corresponding array
      if(x <= leftVertBreak) {
        if(y <= horizBreak) {allStars.starsTopLeft.push({x, y, originX: x, originY: y, rx, ry, rotation, alpha: 0, delay})}
        else {allStars.starsBotLeft.push({x, y, originX: x, originY: y, rx, ry, rotation, alpha: 0, delay})}
      }
      else if(x > leftVertBreak && x <= rightVertBreak) {
        if(y <= horizBreak) {allStars.starsTopMid.push({x, y, originX: x, originY: y, rx, ry, rotation, alpha: 0, delay})}
        else {allStars.starsBotMid.push({x, y, originX: x, originY: y, rx, ry, rotation, alpha: 0, delay})}
      }
      else {
        if(y <= horizBreak) {allStars.starsTopRight.push({x, y, originX: x, originY: y, rx, ry, rotation, alpha: 0, delay})}
        else {allStars.starsBotRight.push({x, y, originX: x, originY: y, rx, ry, rotation, alpha: 0, delay})}
      }
    }
  }
  // Call cache function
  cacheStaticStars();

  // Begin animation frame loop
  requestAnimationFrame(animateFrame)
}

// Animate stars fading in
function animateStarBG() {
  // Set star shadows
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  ctx.shadowColor = 'rgba(241, 241, 241, 0.2)';
  ctx.shadowBlur = 4;
  ctx.shadowOffsetX = 0;
  ctx.shadowOffsetY = 0;

  // Set animation end checker to false
  fadeInIncomplete = false;

  // For each section array
  for(const key in allStars) {
    // Get section
    const section = allStars[key];

    // For each star in section
    for(let i = 0; i < section.length; i++) {
      // Get star
      const star = section[i];

      // If frame (star fade-in frame) larger than delay
      if (frame > star.delay) {
        // Draw star
        drawStarInitial(star);

        // If star alpha is smaller than .5 add .1
        if (star.alpha < 0.25) {
          star.alpha += 0.05;

          // Set star animation incomplete true when star alpha < .5
          fadeInIncomplete = true;
        }
      }
      else {
        // Set animation incomplete to true when frame < delay
        fadeInIncomplete = true;
      }

    }
  }
  // If animation complete set bgAnimated to true;
  if(!fadeInIncomplete) {
    bgAnimated = true;
  }
  // Increment frame
  frame++
}

// Animate star gravitational pull
function animateStarPull() {
  // Clear canvas
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // Check active star sections
  const activeSections = checkStarSection();

  // For each section
  for(let code = 0; code <= 5; code++) {
    // If section is active
    if(activeSections.includes(code)) {
      // Set moving variable
      let sectionMoving = false;

      // For each star in section
      getStarsByCode(code).forEach(star => {
        // Set moving to pullStar's stillMoving return value
        const moving = pullStar(star);

        // If stars are moving set sectionMoving to true
        if(moving) sectionMoving = true;
      });
      // Set section's static cache to false
      sectionStatic[code] = false;

    // If section is animating
    } else if(!sectionStatic[code]) {
      // Default all stars in section are static
      let allStarsStatic = true;

      // Get all stars in section
      getStarsByCode(code).forEach(star => {
        const moving = pullStar(star);

        // If star is moving set allStarsStatic to false
        if(moving) allStarsStatic = false;
      });
      // If all stars are not moving set section to static
      if(allStarsStatic) {
        sectionStatic[code] = true;
      }
    // If section is not active
    } else {
      // Get section offset
      const [offsetX, offsetY] = cacheSectionOffsets[code];

      // Draw cached stars
      ctx.drawImage(cachedStarSections[code], Math.round(offsetX), Math.round(offsetY));
    }
  }
}

// Pull star function
function pullStar(star) {
  // Calculate distance from mouse
  const distX = mousePos.x - star.originX;
  const distY = mousePos.y - star.originY;
  const dist = (distX * distX) + (distY * distY)

  // Set pull radius
  const pullRadius = 100;

  // Default still moving to false
  let stillMoving = false;

  // If distance is larger than pull radius (hypotenuse without Math.hypot() for optimization
  if(dist < (pullRadius * pullRadius)) {
    // Lerp star closer to mouse
    star.x += (mousePos.x - star.x) * 0.15;
    star.y += (mousePos.y - star.y) * 0.15;

    // Set still moving to true
    stillMoving = true;

  // If distance is smaller than pull radius
  } else {
    // Calculate distance between star's current position and origin
    const distXOrigin = star.originX - star.x;
    const distYOrigin = star.originY - star.y;

    // If distance is larger than .5
    if(Math.abs(distXOrigin) > .5 || Math.abs(distYOrigin) > .5) {
      // Lerp star towards origin
      star.x += distXOrigin * 0.1;
      star.y += distYOrigin * 0.1;

      // Set still moving to true
      stillMoving = true;

    // If star is close enough to origin lock it to origin
    } else {
      star.x = star.originX;
      star.y = star.originY;
    }
  }
  // Draw star
  drawStar(star);

  // Return if any stars are moving
  return stillMoving;
}

// Check section of star
function checkStarSection() {
  // Check vertical section
  let section = checkStarSectionVert();

  // Active section code array
  let sectionCodes = [];

  // Check horizontal sections with given vertical values, return number codes for active sections
  if(mousePos.x <= leftVertBreak - spacing) {
    section.forEach(vert => sectionCodes.push(vert === 'bottom' ? 0 : 1));

  } else if(mousePos.x > leftVertBreak - spacing && mousePos.x <= leftVertBreak + spacing) {
    section.forEach(vert => {
      if(vert === 'bottom') {sectionCodes.push(0, 2)} else {sectionCodes.push(1, 3)}
    });

  } else if(mousePos.x > leftVertBreak + spacing && mousePos.x <= rightVertBreak - spacing) {
    section.forEach(vert => sectionCodes.push(vert === 'bottom' ? 2 : 3));

  } else if(mousePos.x > rightVertBreak - spacing && mousePos.x <= rightVertBreak + spacing) {
    section.forEach(vert => {
      if(vert === 'bottom') {sectionCodes.push(2, 4)} else {sectionCodes.push(3,5)}
    });

  } else {
    section.forEach(vert => sectionCodes.push(vert === 'bottom' ? 4 : 5));
  }
  return sectionCodes;
}

// Check vertical section
function checkStarSectionVert() {
  if(mousePos.y <= horizBreak - spacing) {return ['top']}
  else if(mousePos.y > horizBreak - spacing && mousePos.y <= horizBreak + spacing) {return  ['bottom','top']}
  else {return ['bottom']}
}

// Basic draw star function
function drawStar(star) {
  // Buffer to only draw stars on screen
  const buffer = 25;

  // Check star x/y with buffer
  if(star.x < -buffer || star.x > window.innerWidth + buffer
    || star.y < -buffer || star.y > window.innerHeight + buffer) {
    return
  }
  ctx.shadowColor = 'rgba(241, 241, 241, 0.2)';
  ctx.shadowBlur = 4;
  ctx.shadowOffsetX = 0;
  ctx.shadowOffsetY = 0;
  // Draw star
  ctx.save();
  ctx.translate(star.x, star.y);
  ctx.rotate(star.rotation);
  ctx.beginPath();
  ctx.ellipse(0, 0, star.rx, star.ry, 0, 0, Math.PI * 2);
  ctx.fillStyle = 'rgb(77,179,255)';
  ctx.globalAlpha = 0.25;
  ctx.fill();
  ctx.restore();
}

// Initial draw star function
function drawStarInitial(star) {
  // Buffer to only draw stars on screen
  const buffer = 25;

  // Check star x/y with buffer
  if(star.x < -buffer || star.x > window.innerWidth + buffer
    || star.y < -buffer || star.y > window.innerHeight + buffer) {
    return
  }
  ctx.shadowColor = 'rgba(241, 241, 241, 0.2)';
  ctx.shadowBlur = 4;
  ctx.shadowOffsetX = 0;
  ctx.shadowOffsetY = 0;
  // Draw star
  ctx.save();
  ctx.translate(star.x, star.y);
  ctx.rotate(star.rotation);
  ctx.beginPath();
  ctx.ellipse(0, 0, star.rx, star.ry, 0, 0, Math.PI * 2);
  ctx.fillStyle = 'rgb(77,179,255)';
  ctx.globalAlpha = star.alpha;
  ctx.fill();
  ctx.restore();
}





// List of statistics
const statList = [
  {
    head: "30+",
    text: "Grant-funded Projects"
  },
  {
    head: "50+",
    text: "Students Employed All-time"
  },
  {
    head: "1000+",
    text: "Monthly Pageviews"
  },
  {
    head: "1",
    text: "Factoid Left to Think Of"
  }
]

// Defining element variables
const circle = document.querySelector('.svg-wrapper');
const statTextWrapper = document.querySelector('.story-stat')
const statHead = document.querySelector('#stat-head');
const statSpan = document.querySelector('#stat-span');

// Defining animation variables
let animationLooping = false;
let statNum = 1;
let spinCount = 0
let statTimeout = null;

function startStoryLoop() {
  if(!animationLooping) {
    // Reset animationLooping and spinCount to default
    animationLooping = true;
    spinCount = 0;

    // Force circle and stat text to default transforms without transition
    statTextWrapper.style.transition = 'none';
    statTextWrapper.style.transform = `scale(1) rotate(0)`;
    statTextWrapper.offsetHeight;
    circle.style.transition = 'none';
    circle.style.transform = 'rotate(0)';
    circle.offsetHeight;

    // Enable circle and stat text transitions
    statTextWrapper.style.transition = 'transform .65s ease-in-out';
    circle.style.transition = 'transform 1.5s ease-in-out';

    // Call animateStat with short delay
    statTimeout = setTimeout(animateStat, 1000);

  }
}

function endStoryLoop() {
  // Animation looping to false
  animationLooping = false;

  // Remove event listeners
  statTextWrapper.removeEventListener('transitionend', changeStat);
  circle.removeEventListener('transitionend', resetCircle);

  // Clear statTimeout
  if(statTimeout) {
    clearTimeout(statTimeout);
    statTimeout = null;
  }

  // Force circle and stat text to default transforms without transition
  circle.style.transition = 'none';
  circle.style.transform = 'rotate(0deg)';
  circle.offsetHeight;
  statTextWrapper.style.transition = 'none';
  statTextWrapper.style.transform = `scale(1) rotate(0)`;
  statTextWrapper.offsetHeight;

  // Enable circle and stat text transitions
  circle.style.transition = 'transform 1.5s ease-in-out';
  statTextWrapper.style.transition = 'transform .65s ease-in-out';
}


// Reset circle
function resetCircle() {
  if(!animationLooping) return;
  circle.style.transition = 'none';
  circle.style.transform = 'rotate(0deg)';
  circle.offsetHeight
  circle.style.transition = 'transform 1.5s ease-in-out';
}

// Animate statistic
function animateStat() {
  if(!animationLooping) return;
  // Remove event listeners
  statTextWrapper.removeEventListener('transitionend', changeStat)
  circle.removeEventListener('transitionend', resetCircle)

  // Add event listeners
  circle.addEventListener('transitionend', resetCircle, {once:true});
  statTextWrapper.addEventListener('transitionend', changeStat, {once:true})

  // Increment spinCount
  spinCount += 1;

  // Rotate circle
  circle.style.transform = 'rotate(360deg)';

  // Rotate text based on spinCount (rotate halfway)
  statTextWrapper.style.transform = `scale(0) rotate(${180 * spinCount}deg)`;
}

// Change statistic
function changeStat() {
  if(!animationLooping) return;

  // Set stat head and span text
  statHead.innerText = statList[statNum].head;
  statSpan.innerText = statList[statNum].text;

  // Increment spinCount
  spinCount += 1;

  // Set stat transform based on spinCount (rotate from halfway to full rotation)
  statTextWrapper.style.transform = `scale(1) rotate(${180 * spinCount}deg)`;

  // Increment statNum/reset if reached statList length
  statNum = (statNum + 1) % statList.length;

  // If animation is looping set 2s delay, then call animateStat
  if(animationLooping) statTimeout = setTimeout(animateStat, 2000);
}

const arrowSVG = '<svg class="arrow-btn" width="40" height="40" viewBox="0 0 32 32" fill="none">' +
  '<line x1="9" y1="16" x2="24" y2="16" stroke="#f1f1f1" stroke-width="2" stroke-linecap="round"/>' +
  '<polyline points="17,10 24,16 17,22" stroke="#f1f1f1" stroke-width="2" fill="none" stroke-linecap="round"/>' +
  '</svg>'

const cardArrowSVG = '<svg class="card-arrow-btn" width="40" height="40" viewBox="0 0 32 32" fill="none">' +
  '<line x1="9" y1="16" x2="24" y2="16" stroke="#f1f1f1" stroke-width="2" stroke-linecap="round"/>' +
  '<polyline points="17,10 24,16 17,22" stroke="#f1f1f1" stroke-width="2" fill="none" stroke-linecap="round"/>' +
  '</svg>'

  const arrowSVGElems = document.querySelectorAll('.arrow-btn-circle');
  for(let i = 0; i < arrowSVGElems.length; i++) {
    arrowSVGElems[i].innerHTML = arrowSVG;
  }


const cardArrows = document.querySelectorAll('.card-link');
for(let i = 0; i < cardArrows.length; i++) {
  cardArrows[i].innerHTML += cardArrowSVG;
}



/*typewriter*/
const TxtType = function (el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

TxtType.prototype.tick = function () {
  const i = this.loopNum % this.toRotate.length;
  const fullTxt = this.toRotate[i];
  const typeCursor = document.getElementById('typeCursor');

  if (typeCursor.classList.contains("blinking")) {
    typeCursor.classList.remove("blinking");
  }

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  const splitWord = this.txt.split(" ");
  if (splitWord[1] !== undefined) {
    this.el.innerHTML = '<span style="color:#A3D3FF">' + splitWord[0] + '</span> <span style="color:#70BAFF">' + splitWord[1] + '</span>';
  }
  else {
    this.el.innerHTML = '<span style="color:#A3D3FF">' + splitWord[0] + '</span>';
  }


  const that = this;
  let delta = 200 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
    typeCursor.classList.add("blinking");
  }
  else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
    typeCursor.classList.add("blinking");
  }

  setTimeout(function () {
    that.tick();
  }, delta);
};

window.onload = function () {
  const elements = document.getElementsByClassName('typewrite');
  for (let i = 0; i < elements.length; i++) {
    const toRotate = elements[i].getAttribute('data-type');
    const period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtType(elements[i], JSON.parse(toRotate), period);
    }
  }
};

