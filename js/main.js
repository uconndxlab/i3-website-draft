
const sections = {
  hero: {
    div: document.getElementById('hero'),
    isOnScreen: false,
    top: document.getElementById('hero').offsetTop,
    height: document.getElementById('hero').offsetHeight,
    bottom: document.getElementById('hero') + document.getElementById('hero').offsetHeight
  },
  story: {
    div: document.getElementById('story'),
    isOnScreen: false,
    top: document.getElementById('story').offsetTop,
    height: document.getElementById('story').offsetHeight,
    bottom: document.getElementById('story') + document.getElementById('story').offsetHeight
  },
  projects: {
    div: document.getElementById('projects'),
    isOnScreen: false,
    top: document.getElementById('projects').offsetTop,
    height: document.getElementById('projects').offsetHeight,
    bottom: document.getElementById('projects') + document.getElementById('projects').offsetHeight
  },
  team: {
    div: document.getElementById('team'),
    isOnScreen: false,
    top: document.getElementById('team').offsetTop,
    height: document.getElementById('team').offsetHeight,
    bottom: document.getElementById('team') + document.getElementById('team').offsetHeight
  }
}


/* ------------------- OBSERVERS ------------------- */

// Element variables
const starFade = document.querySelector('.star-canvas-fade');
const codeBGFade = document.querySelector('.blueprint-fade');
let statCircleOnScreen = false;
const animatedElements = document.querySelectorAll('.animated');



const body = document.querySelector('body');

const statCircle = document.querySelector('.story-stat-wrapper')

const waveTrack = document.querySelector('.wave-track');
const wave1 = waveTrack?.firstElementChild;
const wave2 = waveTrack?.lastElementChild;
const wave = waveTrack;
const waveRect = wave.getBoundingClientRect();

function checkInitialIntersections() {
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
}


const waveObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      if(!updateWave) updateWave = true;
      console.log('wave running')
      waveTrack.style.animationPlayState = 'running';
    } else {
      if(updateWave) updateWave = false;
      console.log('wave paused')
      waveTrack.style.animationPlayState = 'paused';
    }
  })
}, {threshold: 0});
waveObserver.observe(wave);

const heroObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      if(!sections.hero.isOnScreen) {
        sections.hero.isOnScreen = true;
        if(!frameLooping) {
          frameLooping = true;
        }
        if(bgAnimated) animateFrame()
      }
      if(!updateStarFade) updateStarFade = true;
    } else {
      if(sections.hero.isOnScreen) {
        sections.hero.isOnScreen = false;
        frameLooping = false;
      }
      if(updateStarFade) updateStarFade = false;
    }
  })
}, {threshold: 0});
heroObserver.observe(sections.hero.div);

const statCircleObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
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
}, {threshold: .1});
statCircleObserver.observe(statCircle);

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



/* ------------------- BASE EVENT LISTENERS ------------------- */


// Call star background creation on load after short delay
window.addEventListener('load', () => {
  setTimeout(checkInitialIntersections, 100);
  setCachedSectionSize()
  console.log(cachedStarSections, cachedStarSections[0].width)
  if(window.innerWidth < 1200) resizeTeamCards();
  setTimeout(createStarBG, 500);
});

// Call resize star background function on window resize
window.addEventListener('resize', () => {
  resizeStarBG();
  if(window.innerWidth < 1200) resizeTeamCards();
});

// Initialize mouse position variable
const mousePos = {x: 0, y: 0};

// Get mouse position on mouse move (will be changed depending on how I change star pulling for optimization)
window.addEventListener('mousemove', (event) => {
  mousePos.x = event.pageX
  mousePos.y = event.pageY;
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
const scrollBreakpoints = {
  'heroEnd': sections.story.top,

  'storyEnd': sections.projects.top
}

const maxScroll = window.innerHeight;

let updateStars = false;
let updateStarFade = false;
let updateWave = false;
let updateCodeBG = false;
let updateCodeBGFade = false;
let codeBGLooping = false;

let prevWaveScroll = null;
let waveY = 75;

const windowHeight = window.innerHeight;

let starFadeDecimal;

function consistentScroll() {
  const scroll = window.scrollY;
  if (scroll < sections.story.top) {
    if (updateWave) waveScroll(scroll);
    if (updateStarFade) { starFadeScroll(scroll); console.log(updateStarFade) }

  } else if (scroll >= sections.story.top && scroll < sections.projects.top - windowHeight) {
    body.style.backgroundColor = `rgb(${color2[0]}, ${color2[1]}, ${color2[2]})`;

  } else {
    if(updateCodeBGFade) fadeCodeBG(scroll);
    projectScroll(scroll);
  }
}

const color1 = [38, 38, 38];
const color2 = [10, 22, 38];
const color3 = [20, 20, 20];

function changeBGColor(start, end, decimal) {
  const r = Math.round(calcBGFade(start[0], end[0], decimal));
  const g = Math.round(calcBGFade(start[1], end[1], decimal));
  const b = Math.round(calcBGFade(start[2], end[2], decimal));
  return [r, g, b]
}
function calcBGFade(start, end, decimal) {
  return start + (end - start) * decimal;
}


function waveFall() {
  wave1.style.transform = 'translateY(75%) scaleY(1)';
  wave2.style.transform = 'translateY(75%) scaleY(1)';
  wave1.addEventListener('transitionend', waveFallComplete);
}


function waveFallComplete() {
  wave1.removeEventListener('transitionend', waveFallComplete);
  waveTrack.classList.add('wave-flow');
  // Set wave scroll transitions
  wave1.style.transition = 'transform .05s ease-in-out';
  wave2.style.transition = 'transform .05s ease-in-out';
  updateWave = true;
}



// Adjust wave flow upon iteration
waveTrack.addEventListener('animationiteration', () => {
  // Set 25%, 50%, and 75% css variables with +/- 200
  const wave25Percent = -(Math.floor(Math.random() * 200) + 650);
  const wave50Percent = -(Math.floor(Math.random() * 200) + 1400);
  const wave75Percent = -(Math.floor(Math.random() * 200) + 2150);
  document.documentElement.style.setProperty('--waveX25Percent', `${wave25Percent}px`);
  document.documentElement.style.setProperty('--waveX50Percent', `${wave50Percent}px`);
  document.documentElement.style.setProperty('--waveX75Percent', `${wave75Percent}px`);
});
function waveScroll(scroll) {
  waveY = 75 - Math.min(scroll * .3, 75);
  // Set wave transforms
  requestAnimationFrame(() => {
    wave1.style.transform = `translateY(${waveY}%)`;
    wave2.style.transform = `translateY(${waveY}%)`;
  })


}


function starFadeScroll(scroll) {
  if(scroll < sections.story.top) {
    starFadeDecimal = Math.min(scroll / sections.story.top, 1);
  } else if(scroll < maxScroll * 2) {
    starFadeDecimal = 1 - Math.min((scroll - sections.story.top) / ((sections.story.top * 2) - sections.story.top), 1);
  } else {
    starFadeDecimal = 0;
  }
  const decimal = Math.min(scroll / sections.story.top, 1);
  heroToStoryScroll(decimal, starFadeDecimal);
}


function heroToStoryScroll(decimal, starFadeDecimal) {
  const bgColor = changeBGColor(color1, color2, decimal);
  starFade.style.background = `linear-gradient(to bottom, rgba(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]}, 0) 40%, rgba(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]}, 1) 50%)`
  starFade.style.opacity = `${starFadeDecimal}`;
  console.log(starFadeDecimal)
  // Set previous scroll to current scroll
  body.style.backgroundColor = `rgb(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]})`;
}


function storyToProjectsScroll(scroll) {

}
const angle = -30 * (Math.PI / 180);

const card1 = document.getElementById('project-card-1');
const card2 = document.getElementById('project-card-2');
const card3 = document.getElementById('project-card-3');

const card1Dist = calcCardTranslations(card1, angle);
const card2Dist = calcCardTranslations(card2, angle);
const card3Dist = calcCardTranslations(card3, angle);

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
  const fadeStart = sections.projects.top + sections.projects.height * 0.75;
  const fadeEnd = sections.team.top;

  let codeFadeDecimal = (scroll - fadeStart) / (fadeEnd - fadeStart);
  codeFadeDecimal = Math.min(Math.max(codeFadeDecimal, 0), 1);

  codeBGFade.style.opacity = `${codeFadeDecimal}`;
}

function projectScroll(scroll) {
  const fadeStart = sections.projects.top - windowHeight;
  const decimal = Math.min((scroll - fadeStart) / windowHeight, 1);

  const bgColor = changeBGColor(color2, color3, decimal);
  body.style.backgroundColor = `rgb(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]})`;

  codeBGFade.style.background = `linear-gradient(to bottom, rgba(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]}, 0) 40%, rgba(${bgColor[0]}, ${bgColor[1]}, ${bgColor[2]}, 1) 50%)`
  codeBGFade.style.opacity = codeFadeDecimal;

  const progress = Math.min(Math.max((scroll - scrollStart) / range, 0), 1);

  console.log('scrolling cards')
  card1.style.transform = `translate(${calcMove(-card1DistX, card1DistX, progress)}px, ${calcMove(-card1DistY, card1DistY, progress)}px) rotate(-30deg)`;
  card2.style.transform = `translate(${calcMove(card2DistX, -card2DistX, progress)}px, ${calcMove(card2DistY, -card2DistY, progress)}px) rotate(-30deg)`;
  card3.style.transform = `translate(${calcMove(-card3DistX, card3DistX, progress)}px, ${calcMove(-card3DistY, card3DistY, progress)}px) rotate(-30deg)`;
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
codeCanvas.height = window.innerHeight;

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
    y: Math.random() * codeCanvas.height,
    text: codeSnippets[i % codeSnippets.length],
    speed: 1.5 + Math.random() * 1.5
  });
}
codeCTX.font = '14px monospace';
codeCTX.fillStyle = 'rgba(0,255,200,0.2)';
codeCTX.textAlign = 'center';

function scrollCode() {
  codeCTX.clearRect(0, 0, codeCanvas.width, codeCanvas.height);
  scrollLines.forEach(line => {
    codeCTX.save();
    codeCTX.translate(line.x, line.y);
    codeCTX.rotate(Math.PI / 2);
    codeCTX.fillText(line.text, 0, 0);
    codeCTX.restore();

    line.y += line.speed;

    if (line.y > codeCanvas.height + 200) {
      line.y = -200;
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
}

/* ------------------- ANIMATION FRAME LOOP ------------------- */


let lastTime = 0;
const frameRate = 1000 / 60;
let bgAnimated = false;
let frameLooping = false;
// Call animation frame
function animateFrame(now) {
  frameLooping = true;
  console.log('frame')
  // Check framerate sync
  if(now - lastTime >= frameRate) {
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
    ctx.shadowColor = 'rgba(241, 241, 241, 0.4)';
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
      ctx.fillStyle = 'rgb(241,241,241)';
      ctx.globalAlpha = 0.5;
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
const canvas = document.querySelector('canvas');
const ctx = canvas.getContext('2d');

// Set space between stars
const spacing = 50;

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
        x = (col*spacing) + (Math.random() * 14 - 7) + 10;
      } else {
        // Set x to column's spacing value +/- ~7
        x = (col * spacing) + (Math.random() * 14 - 7);
      }

      // Set y to row's spacing value +/- ~7 with offset by 10 for first row to ensure it is drawn onscreen
      if(row === 0) {
        y = (row * spacing) + (Math.random() * 14 - 7) + 10;
      } else {
        y = (row * spacing) + (Math.random() * 14 - 7);
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
  ctx.shadowColor = 'rgba(241, 241, 241, 0.4)';
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
        if (star.alpha < 0.5) {
          star.alpha += 0.1;

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
    setTimeout(waveFall, 0);
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
  // Draw star
  ctx.save();
  ctx.translate(star.x, star.y);
  ctx.rotate(star.rotation);
  ctx.beginPath();
  ctx.ellipse(0, 0, star.rx, star.ry, 0, 0, Math.PI * 2);
  ctx.fillStyle = 'rgb(241,241,241)';
  ctx.globalAlpha = 0.5;
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

  // Draw star
  ctx.save();
  ctx.translate(star.x, star.y);
  ctx.rotate(star.rotation);
  ctx.beginPath();
  ctx.ellipse(0, 0, star.rx, star.ry, 0, 0, Math.PI * 2);
  ctx.fillStyle = 'rgb(241,241,241)';
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

const team = [
  {
    name: 'Joel Salisbury',
    title: 'Director of i3',
    img: 'img/i3/people/salisbury.jpg'
  },
  {
    name: 'Brian Kelleher',
    title: 'Senior Applications Developer',
    img: 'img/i3/people/kelleher.jpg'
  },
  {
    name: 'Natalie Lacroix',
    title: 'Senior UX Designer',
    img: 'img/i3/people/lacroix.jpg'
  },
  {
    name: 'Jeff Winston',
    title: 'Director: - Nexus',
    img: 'img/i3/people/winston.jpg'
  },
  {
    name: 'Brian Daley',
    title: 'Faculty Advisor - DMD',
    img: 'img/i3/people/daley.jpg'
  },
  {
    name: 'Michael Vertefeuille',
    title: 'Faculty Advisor - DMD',
    img: 'img/i3/people/vert.jpg'
  },
  {
    name: 'Emma Adams',
    title: 'Student Web Developer',
    img: 'img/i3/people/adams.jpg'
  },
  {
    name: 'Lauren Busavage',
    title: 'Student Web Developer',
    img: 'img/i3/people/busavage.png'
  },
  {
    name: 'Kelis Clarke',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg'
  },
  {
    name: 'Ryan Cohutt',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg'
  },
  {
    name: 'Maggie Danielewicz',
    title: 'Student Web Developer',
    img: 'img/i3/people/danielewicz.jpg'
  },
  {
    name: 'Luna Gonzalez',
    title: 'Student Illustrator',
    img: 'img/i3/people/luna.jpg'
  },
  {
    name: 'Aaron Mark',
    title: 'Student Web Developer',
    img: 'img/i3/people/jonathan.jpg'
  },
  {
    name: 'Jack Medrek',
    title: 'Student Software Developer',
    img: 'img/i3/people/medrek.jpg'
  },
  {
    name: 'Kailey Moore',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/moore.jpg'
  },
  {
    name: 'William Shostak',
    title: 'Student Software Developer',
    img: 'img/i3/people/shostak.jpg'
  },
  {
    name: 'Emelia Salmon',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg'
  }
]


const cards = [
  {
    wrapper: document.getElementById('team-card-1'),
    container: document.getElementById('team-card-1').querySelector('.team-card-container'),
    front: document.getElementById('team-card-1').querySelector('.team-card-container').querySelector('.card-front'),
    name: document.getElementById('team-card-1').querySelector('.team-card-container').querySelector('.card-front').querySelector('.team-name'),
    title: document.getElementById('team-card-1').querySelector('.team-card-container').querySelector('.card-front').querySelector('.team-title'),
    position: 'left',
    id: 0
  },
  {
    wrapper: document.getElementById('team-card-2'),
    container: document.getElementById('team-card-2').querySelector('.team-card-container'),
    front: document.getElementById('team-card-2').querySelector('.team-card-container').querySelector('.card-front'),
    name: document.getElementById('team-card-2').querySelector('.team-card-container').querySelector('.card-front').querySelector('.team-name'),
    title: document.getElementById('team-card-2').querySelector('.team-card-container').querySelector('.card-front').querySelector('.team-title'),
    position: 'center',
    id: 1
  },
  {
    wrapper: document.getElementById('team-card-3'),
    container: document.getElementById('team-card-3').querySelector('.team-card-container'),
    front: document.getElementById('team-card-3').querySelector('.team-card-container').querySelector('.card-front'),
    name: document.getElementById('team-card-3').querySelector('.team-card-container').querySelector('.card-front').querySelector('.team-name'),
    title: document.getElementById('team-card-3').querySelector('.team-card-container').querySelector('.card-front').querySelector('.team-title'),
    position: 'right',
    id: 2
  }
];

let cardYRotates = [60, 180, -60];
let cardRotates = [-2, 0, 2];
let leftRem = '-22rem';
let rightRem = '22rem';

cards[0].wrapper.addEventListener('animationend', () => {
  cards.forEach(card => {
    if(card.wrapper.classList.contains('left2center-arc')) {
      card.wrapper.classList.remove('left2center-arc');
      card.wrapper.style.transform = 'translateX(0rem) scale(1.3)';
    }
    else if(card.wrapper.classList.contains('center2right-arc')) {
      card.wrapper.classList.remove('center2right-arc');
      card.wrapper.style.transform = `translateX(${rightRem}) scale(0.5)`;
    }
    else if(card.wrapper.classList.contains('right2left-arc')) {
      card.wrapper.classList.remove('right2left-arc')
      card.wrapper.style.transform = `translateX(${leftRem}) scale(0.5)`;
    }
  })
  randomTeam();
  if(sections.team.isOnScreen) {
    setTimeout(rotateCards, 2000)
  } else {
    cards.forEach(card => {
      if(card.position === 'left') { card.wrapper.style.transform = `translateX(${leftRem}) scale(0.5)` }
      else if(card.position === 'center') { card.wrapper.style.transform = `translateX(0) scale(1.3)` }
      else if(card.position === 'right') { card.wrapper.style.transform = `translateX(${rightRem}) scale(0.5)`}
    })
  }
})

let teamLooping = false;
let teamSelectable = [...team]
let teamTimeout = [];
let initialRandom = true;
function randomTeam() {
  cards.forEach(card => {
    if(card.position === 'right' || initialRandom) {
      const rand = Math.floor(Math.random() * teamSelectable.length)
      card.front.style.background = `url("${teamSelectable[rand].img}") no-repeat center / cover`;
      if(card.name === 'Maggie Danielewicz') {
        if(window.innerWidth < 768 || (window.innerWidth > 992 && window.innerWidth < 1200)) {card.title.style.marginTop = '-20px'}
        else {card.title.style.marginTop = '0'}
      }
      card.name.innerText = `${teamSelectable[rand].name}`;
      card.title.innerText = `${teamSelectable[rand].title}`;
      teamTimeout.push(teamSelectable[rand]);
      teamSelectable.splice(rand, 1)
      if(teamTimeout.length > 5) { teamSelectable.push(teamTimeout.splice(0, 1)[0]) }
    }
  });
  initialRandom = false;
}
randomTeam()

function rotateCards() {
  cardYRotates = cardYRotates.map(y => y + 120);
  cardRotates = cardRotates.map(y => y <= 0 ? y + 2 : y - 4);



  cards.forEach(card => {
    card.wrapper.style.transform = 'none';
    switch(card.position) {
      case 'left':
        card.wrapper.style.setProperty('--start-rem', leftRem);
        card.wrapper.style.setProperty('--end-rem', '0rem');
        card.wrapper.classList.add('left2center-arc');
        setTimeout(() => {card.wrapper.style.zIndex = '4'}, 500);
        card.position = 'center';
        break;
      case 'center':
        card.wrapper.style.setProperty('--start-rem', '0rem');
        card.wrapper.style.setProperty('--end-rem', rightRem)
        card.wrapper.classList.add('center2right-arc');
        setTimeout(() => {card.wrapper.style.zIndex = '2'}, 2000);
        card.position = 'right';
        break;
      case 'right':
        card.wrapper.style.setProperty('--start-rem', rightRem);
        card.wrapper.style.setProperty('--end-rem', leftRem)
        card.wrapper.classList.add('right2left-arc');
        setTimeout(() => {card.wrapper.style.zIndex = '1'}, 450);
        card.position = 'left';
        break;
    }
    card.container.style.transform = `rotateY(${cardYRotates[card.id]}deg) rotate(${cardRotates[card.id]}deg) rotateX(-10deg)`;
  })
}

function resizeTeamCards() {
  if(window.innerWidth <= 768) {
    leftRem = '-12rem';
    rightRem = '12rem';
  } else if(window.innerWidth <= 992) {
    leftRem = '-14rem';
    rightRem = '14rem';
  } else if(window.innerWidth <= 1200) {
    leftRem = '-16rem';
    rightRem = '16rem'
  }
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

