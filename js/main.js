/* ------------------- BASE EVENT LISTENERS ------------------- */


// Call star background creation on load after short delay
window.addEventListener('load', () => {
  setCachedSectionSize()
  console.log(cachedStarSections, cachedStarSections[0].width)
  setTimeout(createStarBG, 500);
});

// Call resize star background function on window resize
window.addEventListener('resize', () => {
  resizeStarBG();
});

// Initialize mouse position variable
const mousePos = {x: 0, y: 0};

// Get mouse position on mouse move (will be changed depending on how I change star pulling for optimization)
window.addEventListener('mousemove', (event) => {
  mousePos.x = event.clientX;
  mousePos.y = event.clientY;
});

// Pause animations when unfocused
document.addEventListener('visibilitychange', () => {
  const animatedElements = document.querySelectorAll('.animated');
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


/* ------------------- ANIMATION FRAME LOOP ------------------- */


let lastTime = 0;
const frameRate = 1000 / 60;
let bgAnimated = false;

// Call animation frame
function animateFrame(now) {
  // Check framerate sync
  if(now - lastTime >= frameRate) {
    lastTime = now;
    if(!bgAnimated) animateStarBG();
    if(bgAnimated) animateStarPull();
  }
  requestAnimationFrame(animateFrame)
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


/* ------------------- WAVE SCROLL ------------------- */


// Define wave element variables
const waveTrack = document.querySelector('.wave-track');
const wave1 = waveTrack.firstElementChild;
const wave2 = waveTrack.lastElementChild;

// Enable scroll after fall transition (will be changed)
setTimeout(() => {
  wave1.style.transform = 'translateY(75%) scaleY(1)';
  wave2.style.transform = 'translateY(75%) scaleY(1)';
  wave1.addEventListener('transitionend', enableScroll);
});

// Current scroll value
let scroll = 0;

// Previous scroll value
let prevScroll = 0;

// Wave y translate value
let waveY = 75;

// Enable scroll function
function enableScroll() {
  // Remove event listener on wave
  wave1.removeEventListener('transitionend', enableScroll);
  // Add wave-flow class to wave track
  waveTrack.classList.add('wave-flow');
  // Set wave scroll transitions
  wave1.style.transition = 'transform .05s linear';
  wave2.style.transition = 'transform .05s linear';

  // Add scroll listener
  window.addEventListener('scroll', () => {
    // Set scroll to current scroll
    scroll = window.scrollY;

    // Check if scroll has changed from previous value
    if(scroll !== prevScroll) {
      // Set waveY minimum value of scrollY * .3 and 75
      waveY = 75 - Math.min(scrollY * .3, 75);

      // Set wave transforms
      wave1.style.transform = `translateY(${waveY}%)`;
      wave2.style.transform = `translateY(${waveY}%)`;

      // Set previous scroll to current scroll
      prevScroll = window.scrollY;
    }
  });
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


/* ------------------- BASE EVENT LISTENERS ------------------- */


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
const circle = document.querySelector('.about-stat-circle');
const statTextWrapper = document.querySelector('.about-stat')
const statHead = document.querySelector('#stat-head');
const statSpan = document.querySelector('#stat-span');
const aboutUs = document.querySelector('#about-us');

// Defining animation variables
let animationLooping = true;
let statNum = 1;
let spinCount = 0
let statTimeout = null;

// Observer for about section
const aboutObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
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
    // If about section not on screen
    } else {
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
  });
}, {threshold: 0.1});

// Call observer to observe aboutUs
aboutObserver.observe(aboutUs)

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


const card1Wrapper = document.getElementById('team-card-1');
const card1Container = card1Wrapper.firstElementChild;
const card2Wrapper = document.getElementById('team-card-2');
const card2Container = card2Wrapper.firstElementChild;
const card3Wrapper = document.getElementById('team-card-3');
const card3Container = card3Wrapper.firstElementChild;

let card1Pos = 'left';
let card2Pos = 'center';
let card3Pos = 'right';

let leftRotate = 'rotateY(45deg) rotate(180deg)';
let rightRotate = 'rotateY(-45deg) rotate(180deg)';
let leftScale = 'scale(.75)';
let rightScale = 'scale(.75)';
let leftTranslate = '-22rem';
let rightTranslate = '22rem';

function rotateCards() {
  card1Wrapper.style.transform = 'scale(1) translateX(0)';
  card1Container.style.transform = 'rotateY(0) rotate(180deg)';
  card2Wrapper.style.transform = 'scale(.75) translateX(22rem)';
  card2Container.style.transform = 'rotateY(-45deg) rotate(180deg)';
  card3Wrapper.style.transform = 'scale(.75) translateX(-22rem)';
  card3Container.style.transform = 'rotateY(45deg) rotate(180deg)';

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

