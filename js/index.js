// Import dynamic data
import projects from './projectData.js';
import employees from './employeeData.js';

console.log('window', window.gsap)

/* ------------------- OBSERVERS ------------------- */

// Define initial animated elements
const animatedElements = document.querySelectorAll('.animated');

// Define UConn header rect
const ucHeaderRect = document.getElementById('uc-header').getBoundingClientRect();
const sections = document.querySelectorAll('.section');

let scrolling = false;
let scrollStopTimeout;
// Track hero on screen
let heroOnScreen = false;

// Track stars faded
let starsFaded = false;

// Track story row on screen
let storyRowOnScreen = false;

let storyHeadAnimated = false;

// Define story row
const storyRow = document.querySelector('#story-row');

// Track if story is looping
let storyLooping = false;

// Track projects on screen
let projectsOnScreen = false;

// Define project rows
const projectsRow1 = document.querySelector('#row-1');
const projectsRow2 = document.querySelector('#row-2');
let projectsRow3;
// Track if projects are animating
let projectHeadAnimated = false;
let projectsAnimating = false;
let projectsStarted = false;

// Track team on screen
let teamHeadAnimated = false;
let teamOnScreen = false;
let teamStarted = false;

// Define team row
const teamRow = document.querySelector('.team-row');

// Track if team is animating
let teamAnimating = false;

const footer = document.querySelector('footer');
let footerOnScreen = false;
let footerAnimated = false;

// Define body element
const body = document.querySelector('body');

// Track background color
let bgColor = 0;

// Define background colors
const bgColors = [
  'rgb(38,38,38)',
  'rgb(10,22,38)',
  'rgb(24,0,40)',
  'rgb(38,38,38)'
];



/* ------------------- BASE EVENT LISTENERS ------------------- */

let isMobile = false;
let windowWidth = window.innerWidth;
// After content loaded
window.addEventListener('load', () => {

  isMobile = window.matchMedia('(max-width: 768px)').matches;
  console.log('mobile', isMobile);
  if(!isMobile) {
    loadPC();
  } else {
    loadMobile();
  }
});

let aniResizeTimer= null;
let resizedLarger = false;
// On window resize
window.addEventListener('resize', () => {
  // Call star background resize
  resizeStarBG(windowWidth);

  windowWidth = window.innerWidth;





  if(!isMobile) {
    getProjectWidth();
    getEmpWidth();
    if(projectsAnimating) projectsAnimating = false;
    if(teamAnimating) teamAnimating = false;
    clearTimeout(aniResizeTimer);
    aniResizeTimer = null;
    aniResizeTimer = setTimeout(() => {
      console.log('reset');
      resetRows()
    }, 1000);

  }


});



// Initialize mouse position variable
const mousePos = {x: 0, y: 0};

// Get mouse position on mouse move
window.addEventListener('mousemove', (event) => {
  mousePos.x = event.clientX
  mousePos.y = event.clientY - (ucHeaderRect.height / 2)
});

// Pause animations when unfocused
document.addEventListener('visibilitychange', () => {
  if(document.hidden) {
    animatedElements.forEach(element => {
      element.style.animationPlayState = 'paused';
    });
    if(teamAnimating) pauseTeam();
    if(projectsAnimating) pauseProjects();
    if(storyLooping) {
      endStoryLoop();
      storyLooping = false;
    }
  // Play animated elements when refocused
  } else {
    animatedElements.forEach(element => {
      element.style.animationPlayState = 'running';
    });
    if(teamOnScreen) playTeam();
    if(projectsOnScreen) playProjects();
    if(storyRowOnScreen) {
      startStoryLoop();
      storyLooping = true;
    }
  }
});

// Scroll listener
window.addEventListener('scroll', consistentScroll);


function checkInitialIntersections() {
  let sectionNum = 0;
  const scrollY = window.scrollY + window.innerHeight / 2;
  const sections = [...document.querySelectorAll('.section')];
  for (let i = 0; i < sections.length; i++) {
    const top = sections[i].offsetTop;
    const height = sections[i].offsetHeight;
    const mid = top + height / 2;
    if (scrollY >= mid) {
      sectionNum = i;
    } else {
      break;
    }
  }
  return sectionNum;
}

function setIntersection() {
  const initialSection = checkInitialIntersections();
  switch(initialSection) {
    case 0:
      heroOnScreen = true;
      break;
    case 1:
      storyRowOnScreen = true;
      break;
    case 2:
      projectsOnScreen = true;
      playProjects();
      break;
    case 3:
      teamOnScreen = true;
      break;
  }
  console.log('section',initialSection)
}
setIntersection();

function loadMobile() {
  // Observe hero
  const heroObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {

      // If hero is on screen
      if(entry.isIntersecting) {

        // Check star fade tracker
        if(starsFaded) {

          // Display star canvas
          canvas.style.display = 'block';

          // Fade stars in
          canvas.style.opacity = '1';

          // Update star fade tracker
          starsFaded = false;
        }

        // If background color is not hero color
        if(bgColor !== 0) {

          // Set background color to color 0
          body.style.backgroundColor = `${bgColors[0]}`;
          bgColor = 0;
        }

        // Check hero visibility tracker
        if(!heroOnScreen) {

          // Update hero visibility tracker
          heroOnScreen = true;


          // Check if star bg animated in, call gravity animation
        }

        // If hero not on screen
      } else {

        // Check hero visibility tracker
        if(heroOnScreen) {

          // Update hero visibility tracker
          heroOnScreen = false;

        }
      }
    })
  }, {threshold: 0});

// Observe hero h1
  heroObserver.observe(document.querySelector('.hero-h1'));

  // Observe story row
  const storyRowObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {

      // If story row on screen
      if (entry.isIntersecting) {

        // If background color is not story color
        if(bgColor !== 1) {

          // Set background color to color 1
          body.style.backgroundColor = `${bgColors[1]}`;
          bgColor = 1;
        }

        // Check star fade tracker
        if(!starsFaded) {

          // Fade stars out
          canvas.style.opacity = '0';

          // After faded out listener
          canvas.addEventListener('transitionend', function starsFadedOut() {

            // Remove listener
            canvas.removeEventListener('transitionend', starsFadedOut);

            // Update star fade tracker
            starsFaded = true;

            // Set canvas display
            canvas.style.display = 'none';
          })
        }

        // Check story visibility tracker
        if(!storyRowOnScreen) {

          // Update story visibility tracker
          storyRowOnScreen = true;

          // Check story loop tracker
          if(!storyLooping) {

            // Start story loop
            startStoryLoop();

            // Update story loop tracker
            storyLooping = true;
          }
        }

        // Check story head animated tracker
        if(!storyHeadAnimated && window.innerWidth > 576) {
          document.querySelector('.section-head-side').classList.add('section-head-animated');
          storyHeadAnimated = true;
        }

        // If story not on screen
      } else {

        // Check story visibility tracker
        if(storyRowOnScreen) {

          // Update story visibility tracker
          storyRowOnScreen = false;

          // Check story loop tracker
          if(storyLooping) {

            // End story loop
            endStoryLoop();

            // Update story loop tracker
            storyLooping = false;
          }
        }
      }
    });
  }, {threshold: .25});

// Observe story row
  storyRowObserver.observe(storyRow);

// Observe projects
  const projectRow2Observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {

      // If projects on screen
      if(entry.isIntersecting) {

        // If background color not project color
        if (bgColor !== 2) {

          // Set background color to color 2
          body.style.backgroundColor = `${bgColors[2]}`;
          bgColor = 2;
        }

        // Check star fade tracker
        if (!starsFaded) {

          // Fade out stars
          canvas.style.opacity = '0';

          // After faded out listener
          canvas.addEventListener('transitionend', function starsFadedOut() {

            // Remove listener
            canvas.removeEventListener('transitionend', starsFadedOut);

            // Update star fade tracker
            starsFaded = true;

            // Update canvas display
            canvas.style.display = 'none';
          });
        }
        if(!projectHeadAnimated) {
          document.querySelector('#projects-head').classList.add('section-head-ani');
          projectHeadAnimated = true;
        }

        // Check project visibility tracker
        if (!projectsOnScreen) {
          // Update project visibility tracker
          projectsOnScreen = true;

          if (!projectsAnimating) {
            // Play project animation
            playProjects();
            console.log('projects played')
          }
          // If projects not on screen
        } else {

          // Check project visibility tracker
          if (projectsOnScreen) {

            // Update project visibility tracker
            projectsOnScreen = false;

            // Check project animation tracker
            if (projectsAnimating) {
              // Pause project animation
              pauseProjects();
              console.log('projects paused')
            }
          }
        }
      }
    })
  }, {threshold: 0});

// Observe project row 2
  projectRow2Observer.observe(projectsRow2);

// Team observer
  const teamRowObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {

      // If team on screen
      if(entry.isIntersecting) {

        // If background color not team color
        if(bgColor !== 3) {

          // Set background color to color 3
          body.style.backgroundColor = `${bgColors[3]}`;
          bgColor = 3;
        }

        // Check/update star fade
        if(!starsFaded) {
          canvas.style.opacity = '0';
          canvas.addEventListener('transitionend', function starsFadedOut() {
            canvas.removeEventListener('transitionend', starsFadedOut);
            starsFaded = true;
            canvas.style.display = 'none';
          })
        }

        if(!teamHeadAnimated) {
          document.querySelector('#team-head').classList.add('section-head-ani');
          teamHeadAnimated = true;
        }

        // Check/update team visibility + animation trackers
        if(!teamOnScreen) {
          teamOnScreen = true;
          if(!teamAnimating) {
            playTeam();
            console.log('team playing')
          }
        }

        // If team not on screen
      } else {

        // Check/update team visibility + animation trackers
        if(teamOnScreen) {
          teamOnScreen = false;
          if(teamAnimating) {
            pauseTeam();
            console.log('team paused')
          }
        }
      }
    })
  }, {threshold: .15});

// Observe team row
  teamRowObserver.observe(document.querySelector('.team-row'));


  const footerObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if(entry.isIntersecting) {
        if(!footerOnScreen) {
          footerOnScreen = true;
        }
        if(bgColor !== 3) {
          body.style.backgroundColor = `${bgColors[3]}`;
          bgColor = 3;
        }
        if(!footerAnimated) {
          footer.classList.add('footer-ani');
          footerAnimated = true;
        }
      } else {
        if(footerOnScreen) {
          footerOnScreen = false;
        }
      }
    });
  }, {threshold: .15});
  footerObserver.observe(footer);


  createStarBG();

  buildPhrase1();


  projectsRow3 = document.querySelector('#row-3');
  buildProjects();

  buildEmpCards();

}

function loadPC() {

  window.gsap.registerPlugin(ScrollSmoother, ScrollToPlugin, ScrollTrigger, Observer);
  const smoother = window.ScrollSmoother.create({
    wrapper: '#gsap-wrapper',
    content: '#gsap-content',
    smooth: 1.5,
    effects: true,
    onUpdate: () => {
      if (!scrolling) scrolling = true;
      clearTimeout(scrollStopTimeout);
      scrollStopTimeout = setTimeout(() => {
        scrolling = false;
      }, 75);
    },

  })

  // Observe hero
  const heroObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {

      // If hero is on screen
      if (entry.isIntersecting) {

        // Check star fade tracker
        if (starsFaded) {

          // Display star canvas
          canvas.style.display = 'block';

          // Fade stars in
          canvas.style.opacity = '1';

          // Update star fade tracker
          starsFaded = false;
        }

        // If background color is not hero color
        if (bgColor !== 0) {

          // Set background color to color 0
          body.style.backgroundColor = `${bgColors[0]}`;
          bgColor = 0;
        }
        if (sliderPos !== 0 && !sliderScrolling) {
          changeProgSlider(0);
        }

        // Check hero visibility tracker
        if (!heroOnScreen) {

          // Update hero visibility tracker
          heroOnScreen = true;

          // Check frame loop tracker
          if (!frameLooping && frameTestPass) {

            // Update frame loop tracker
            frameLooping = true;
            requestAnimationFrame(animateFrame)
          }

          // Check if star bg animated in, call gravity animation
        }

        // If hero not on screen
      } else {

        // Check hero visibility tracker
        if (heroOnScreen) {

          // Update hero visibility tracker
          heroOnScreen = false;

          // Update frame loop tracker
          frameLooping = false;
        }
      }
    })
  }, {threshold: 0});

// Observe hero h1
  heroObserver.observe(document.querySelector('.hero-h1'));

  let gsapScrolling = false;

  let gsapPin = '+=500vh';

  if (window.innerWidth < 1200) {
    gsapPin = '+=300vh';
  } else if (window.innerWidth < 1500) {
    gsapPin = '+=400vh';
  }

  window.gsap.utils.toArray('.section').forEach(section => {
    window.ScrollTrigger.create({
      trigger: section,
      start: "center center",
      end: gsapPin,
      pin: true,
      pinSpacing: true,
      markers: true
    });
  });


  for (let section of sections) {
    const sectionObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !gsapScrolling && !sliderScrolling) {
          gsapScrolling = true;
          window.gsap.to(window, {
            duration: .75,
            scrollTo: {y: section},
            ease: 'linear',
            onComplete: () => {
              gsapScrolling = false;
            }
          })
        }
      })
    }, {threshold: .50});
    sectionObserver.observe(section);
  }


// Observe story row
  const storyRowObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {

      // If story row on screen
      if (entry.isIntersecting) {

        // If background color is not story color
        if (bgColor !== 1) {

          // Set background color to color 1
          body.style.backgroundColor = `${bgColors[1]}`;
          bgColor = 1;
        }
        if (sliderPos !== 1 && !sliderScrolling) {
          changeProgSlider(1);
        }

        // Check star fade tracker
        if (!starsFaded) {

          // Fade stars out
          canvas.style.opacity = '0';

          // After faded out listener
          canvas.addEventListener('transitionend', function starsFadedOut() {

            // Remove listener
            canvas.removeEventListener('transitionend', starsFadedOut);

            // Update star fade tracker
            starsFaded = true;

            // Set canvas display
            canvas.style.display = 'none';
          })
        }

        // Check story visibility tracker
        if (!storyRowOnScreen) {

          // Update story visibility tracker
          storyRowOnScreen = true;

          // Check story loop tracker
          if (!storyLooping) {

            // Start story loop
            startStoryLoop();

            // Update story loop tracker
            storyLooping = true;
          }
        }

        // Check story head animated tracker
        if (!storyHeadAnimated) {
          document.querySelector('.section-head-side').classList.add('section-head-animated');
          storyHeadAnimated = true;
        }

        // If story not on screen
      } else {

        // Check story visibility tracker
        if (storyRowOnScreen) {

          // Update story visibility tracker
          storyRowOnScreen = false;

          // Check story loop tracker
          if (storyLooping) {

            // End story loop
            endStoryLoop();

            // Update story loop tracker
            storyLooping = false;
          }
        }
      }
    });
  }, {threshold: .25});

// Observe story row
  storyRowObserver.observe(storyRow);


// Observe projects
  const projectRow2Observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {

      // If projects on screen
      if (entry.isIntersecting) {

        // If background color not project color
        if (bgColor !== 2) {

          // Set background color to color 2
          body.style.backgroundColor = `${bgColors[2]}`;
          bgColor = 2;
        }
        if (sliderPos !== 2 && !sliderScrolling) {
          changeProgSlider(2);
        }

        // Check star fade tracker
        if (!starsFaded) {

          // Fade out stars
          canvas.style.opacity = '0';

          // After faded out listener
          canvas.addEventListener('transitionend', function starsFadedOut() {

            // Remove listener
            canvas.removeEventListener('transitionend', starsFadedOut);

            // Update star fade tracker
            starsFaded = true;

            // Update canvas display
            canvas.style.display = 'none';
          });
        }

        if (!projectHeadAnimated) {
          document.querySelector('#projects-head').classList.add('section-head-ani');
          projectHeadAnimated = true;
        }

        // Check project visibility tracker
        if (!projectsOnScreen) {
          // Update project visibility tracker
          projectsOnScreen = true;

          if (!projectsAnimating) {
            // Play project animation
            playProjects();
            console.log('projects played')
          }
          // If projects not on screen
        } else {

          // Check project visibility tracker
          if (projectsOnScreen) {

            // Update project visibility tracker
            projectsOnScreen = false;

            // Check project animation tracker
            if (projectsAnimating) {
              // Pause project animation
              pauseProjects();
              console.log('projects paused')
            }
          }
        }
      }
    })
  }, {threshold: .05});

// Observe project row 2
  projectRow2Observer.observe(projectsRow2);

  let empCardsPaused = true;


// Team observer
  const teamRowObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {

      // If team on screen
      if (entry.isIntersecting) {

        // If background color not team color
        if (bgColor !== 3) {

          // Set background color to color 3
          body.style.backgroundColor = `${bgColors[3]}`;
          bgColor = 3;
        }
        if (sliderPos !== 3 && !sliderScrolling) {
          changeProgSlider(3);
        }

        // Check/update star fade
        if (!starsFaded) {
          canvas.style.opacity = '0';
          canvas.addEventListener('transitionend', function starsFadedOut() {
            canvas.removeEventListener('transitionend', starsFadedOut);
            starsFaded = true;
            canvas.style.display = 'none';
          })
        }

        if (!teamHeadAnimated) {
          document.querySelector('#team-head').classList.add('section-head-ani');
          teamHeadAnimated = true;
        }

        // Check/update team visibility + animation trackers
        if (!teamOnScreen) {
          teamOnScreen = true;
          if (!teamAnimating) {
            playTeam();
            console.log('team playing')
          }
        }

        // If team not on screen
      } else {

        // Check/update team visibility + animation trackers
        if (teamOnScreen) {
          teamOnScreen = false;
          if (teamAnimating) {
            pauseTeam();
            console.log('team paused')
          }
        }
      }
    })
  }, {threshold: .15});

// Observe team row
  teamRowObserver.observe(document.querySelector('.team-row'));

  const footerObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        if (!footerOnScreen) {
          footerOnScreen = true;
        }
        if (bgColor !== 3) {
          body.style.backgroundColor = `${bgColors[3]}`;
          bgColor = 3;
        }
        if(sliderPos !== 4 && !sliderScrolling) {
          changeProgSlider(4);
        }
        if (!footerAnimated) {
          footer.classList.add('footer-ani');
          footerAnimated = true;
        }
      } else {
        if (footerOnScreen) {
          footerOnScreen = false;
        }
      }
    });
  }, {threshold: .15});
  footerObserver.observe(footer);


  // Set star cache sizes
  setCachedSectionSize()

  //Create star background
  createStarBG();


  //buildPhrase1();



  const slider = document.querySelector('#progress-slider');
  let sliderPos = 0;
  let sliderScrolling = false;

  slider.height = slider.offsetHeight;
  slider.width = slider.offsetWidth;
  const sliderCTX = slider.getContext('2d');
  let sliderHovered = false;
  let circleHover = null;
  let hoverAnimating = false;
  let hoverRadius = [10, 10, 10, 10, 10]

  let radius = 10;
  let hoverMax = 15;
  const circleCount = 5;
  const circleSpace = slider.height / circleCount;
  const centerX = slider.width / 2;

  sliderCTX.fillStyle = '#f1f1f1';
  sliderCTX.strokeStyle = '#f1f1f1';
  sliderCTX.lineWidth = 2;

  let circleOpacity = 0;


  function createProgressSlider() {
    sliderCTX.clearRect(0, 0, slider.width, slider.height);

    for (let i = 0; i < circleCount - 1; i++) {
      const y1 = (i + 0.5) * circleSpace;
      const y2 = (i + 1 + 0.5) * circleSpace;

      const r1 = hoverRadius[i]
      const r2 = hoverRadius[i + 1];

      sliderCTX.beginPath();
      sliderCTX.moveTo(centerX, y1 + r1);
      sliderCTX.lineTo(centerX, y2 - r2);
      sliderCTX.stroke();
    }

    for (let i = 0; i < circleCount; i++) {
      let y = (i + 0.5) * circleSpace;
      sliderCTX.beginPath();
      sliderCTX.arc(centerX, y, hoverRadius[i], 0, Math.PI * 2);
      if (i === sliderPos) {
        sliderCTX.fillStyle = 'rgba(241,241,241,1)';
        sliderCTX.fill();
        sliderCTX.stroke();
      } else {
        sliderCTX.fillStyle = 'transparent';
        sliderCTX.fill();
        sliderCTX.stroke();
      }

    }
  }

  function changeProgSlider(newPos) {
    sliderPos = newPos;
    circleOpacity = 0;

    function animate() {
      sliderCTX.clearRect(0, 0, slider.width, slider.height);

      for (let i = 0; i < circleCount - 1; i++) {
        const y1 = (i + 0.5) * circleSpace;
        const y2 = (i + 1 + 0.5) * circleSpace;

        const r1 = hoverRadius[i]
        const r2 = hoverRadius[i + 1];

        sliderCTX.beginPath();
        sliderCTX.moveTo(centerX, y1 + r1);
        sliderCTX.lineTo(centerX, y2 - r2);
        sliderCTX.stroke();
      }

      for (let i = 0; i < circleCount; i++) {
        let y = (i + 0.5) * circleSpace;
        sliderCTX.beginPath();
        sliderCTX.arc(centerX, y, hoverRadius[i], 0, Math.PI * 2);
        if (i === sliderPos) {
          sliderCTX.fillStyle = `rgba(241,241,241,${circleOpacity})`;
          sliderCTX.fill();
          sliderCTX.stroke();
        } else {
          sliderCTX.fillStyle = 'transparent';
          sliderCTX.fill();
          sliderCTX.stroke();
        }
      }
      circleOpacity = Math.min(circleOpacity + .05, 1);
      if (circleOpacity < 1) {
        requestAnimationFrame(animate)
      }
    }

    animate();

  }

  let sliderMousePos = {x: 0, y: 0}

  slider.addEventListener('mouseenter', () => {
    slider.addEventListener('mousemove', getSliderMousePos);
    slider.addEventListener('click', sliderClick);
    if (!sliderHovered) sliderHovered = true;
    progSliderHover();
  });

  slider.addEventListener('mouseleave', () => {
    slider.removeEventListener('mousemove', getSliderMousePos);
    slider.removeEventListener('click', sliderClick);
    if (sliderHovered) sliderHovered = false;
  })

  function getSliderMousePos(event) {
    const rect = slider.getBoundingClientRect();

    sliderMousePos.x = event.clientX - rect.left;
    sliderMousePos.y = event.clientY - rect.top;
  }

  function progSliderHover() {
    sliderCTX.clearRect(0, 0, slider.width, slider.height);


    for (let i = 0; i < circleCount - 1; i++) {
      const y1 = (i + 0.5) * circleSpace;
      const y2 = (i + 1 + 0.5) * circleSpace;

      const r1 = hoverRadius[i]
      const r2 = hoverRadius[i + 1];

      sliderCTX.beginPath();
      sliderCTX.moveTo(centerX, y1 + r1);
      sliderCTX.lineTo(centerX, y2 - r2);
      sliderCTX.stroke();
    }

    circleHover = null;
    for (let i = 0; i < circleCount; i++) {
      let y = (i + 0.5) * circleSpace;
      let dx = sliderMousePos.x - centerX;
      let dy = sliderMousePos.y - y;
      let dist = Math.sqrt(dx * dx + dy * dy);
      if (dist < hoverMax) {
        circleHover = i;
      }
    }

    for (let i = 0; i < circleCount; i++) {
      if (i === circleHover) {
        hoverRadius[i] += 0.5;
        if (hoverRadius[i] > hoverMax) hoverRadius[i] = hoverMax;
      } else {
        if (hoverRadius[i] > radius) {
          hoverRadius[i] = Math.max(hoverRadius[i] - 0.5, 10);
        }
      }
    }

    for (let i = 0; i < circleCount; i++) {
      let y = (i + 0.5) * circleSpace;
      sliderCTX.beginPath();
      sliderCTX.arc(centerX, y, hoverRadius[i], 0, Math.PI * 2);
      if (i === sliderPos) {
        sliderCTX.fillStyle = 'rgba(241,241,241,1)';
        sliderCTX.fill();
        sliderCTX.stroke();
      } else {
        sliderCTX.fillStyle = 'transparent';
        sliderCTX.fill();
        sliderCTX.stroke();
      }

    }
    hoverAnimating = hoverRadius.filter(radius => radius > 10).length !== 0;
    if (sliderHovered || hoverAnimating) requestAnimationFrame(progSliderHover);
  }

  function sliderClick() {
    for (let i = 0; i < circleCount; i++) {
      let y = (i + 0.5) * circleSpace;
      let dx = sliderMousePos.x - centerX;
      let dy = sliderMousePos.y - y;
      let dist = Math.sqrt(dx * dx + dy * dy);
      if (dist < hoverMax) {
        let scrollTo;
        if(i === 4) {
          scrollTo = body.offsetHeight;
        } else {
          scrollTo = sections[i];
        }
        let dur = Math.max(0.3, Math.min(Math.abs(sliderPos - scrollTo) * 0.5, 2.5));
        gsapScrolling = true;
        sliderScrolling = true;
        window.gsap.to(window, {
          duration: 1,
          scrollTo: {y: scrollTo},
          ease: 'linear',
          onComplete: () => {
            gsapScrolling = false;
            sliderScrolling = false;
          }
        })
        sliderPos = i;
        changeProgSlider(sliderPos);
      }
    }
  }

  document.addEventListener('keypress', (keyEvent) => {
    if(keyEvent.key === 'Tab') {
      keyEvent.preventDefault();
    }
  })


  createProgressSlider();


  buildProjects();
  buildEmpCards();

  getProjectWidth();
  getEmpWidth();


}



/* ------------------- BASE EVENT LISTENERS ------------------- */


let scrollSnapTimeout;
// Scroll function
function consistentScroll() {
/*  clearTimeout(scrollSnapTimeout);
  scrollSnapTimeout = setTimeout(() => {
    let scrollMid = window.scrollY + window.innerHeight / 2;
    let closest, closestDist = Infinity;

    for(let section of sections) {
      const rect = section.getBoundingClientRect();
      let sectionMid = rect.top + window.scrollY + rect.height / 2;
      let dist = Math.abs(scrollMid - sectionMid);
      if(dist < closestDist) {
        closestDist = dist;
        closest = section;
      }
    }
    if(closest) {

    }
  }, 50)*/


  // Check project link canvas state
  if (linkCanvasActive) {

    // Remove canvas
    const linkCanvas = document.getElementById('constellationCanvas');
    linkCanvas.style.transition = 'opacity .25s';
    linkCanvas.addEventListener('transitionend', function linkFadedOut() {
      linkCanvas.removeEventListener('transitionend', linkFadedOut);
      document.body.removeChild(linkCanvas);
      projectHoverEnabled = true;
    })
    linkCanvas.style.opacity = '0';
    // Update tracker
    linkCanvasActive = false;
  }
}


/* ------------------- WHAT WE DO ANI FUNCTIONS ------------------- */


const phrases = [
  "build systems",
  "create websites",
  "explore tech",
  "implement solutions",
  "develop apps"
];

// Define phrase spans
const moveText = document.getElementById('move-text');
const moveText2 = document.getElementById('move-text-2');

let charWidth;

let widths = [];
let phraseLengths = [];
let fontSize;
let charDist;
function setCharWidths() {
  fontSize = window.getComputedStyle(moveText).getPropertyValue('--font-size');
  if (fontSize === '1.6rem') {
    spaceCharSize = 18;
    charDist = 4;
    widths = new Map([["a", 15], ["b", 15], ["c", 13], ["d", 15], ["e", 15], ["f", 8], ["g", 15], ["h", 15], ["i", 6], ["j", 6], ["k", 13], ["l", 6], ["m", 22], ["n", 15], ["o", 15], ["p", 15], ["q", 15], ["r", 9], ["s", 13], ["t", 8], ["u", 15], ["v", 13], ["w", 19], ["x", 13], ["y", 13], ["z", 13], [" ", 0]])
  } else if (fontSize === '1.2rem') {
    charDist = 2;
    spaceCharSize = 13;
    widths = new Map([["a", 11], ["b", 11], ["c", 10], ["d", 11], ["e", 11], ["f", 6], ["g", 11], ["h", 11], ["i", 5], ["j", 5], ["k", 10], ["l", 5], ["m", 16], ["n", 11], ["o", 11], ["p", 11], ["q", 11], ["r", 7], ["s", 10], ["t", 6], ["u", 11], ["v", 10], ["w", 14], ["x", 10], ["y", 10], ["z", 10], [" ", 0]])
  } else if(fontSize === '1rem') {
    charDist = 2;
    spaceCharSize = 8
    widths = new Map([["a",9],["b",9],["c",8],["d",9],["e",9],["f",5],["g",9],["h",9],["i",4],["j",4],["k",8],["l",4],["m",14],["n",9],["o",9],["p",9],["q",9],["r",6],["s",8],["t",5],["u",9],["v",8],["w",12],["x",8],["y",8],["z",8],[" ",0]])

  } else {
    charDist = 2;
    spaceCharSize = 7;
    widths = new Map([["a",8],["b",8],["c",7],["d",8],["e",8],["f",4],["g",8],["h",8],["i",3],["j",3],["k",7],["l",3],["m",11],["n",8],["o",8],["p",8],["q",8],["r",5],["s",7],["t",4],["u",8],["v",7],["w",10],["x",7],["y",7],["z",7],[" ",0]])
  }

  phraseLengths = [];
// Get length of longest phrase
  phrases.forEach(phrase => {
    let phraseLength = 0;
    for(let i = 0; i < phrase.length; i++) {
      const char = phrase[i];
      if(char === ' ') {
        phraseLength += spaceCharSize;
      } else {
        let charWidth = widths.get(char) ?? 0;
        phraseLength += charWidth + charDist;
      }
    }
    phraseLengths.push(phraseLength)
  })

  maxPhraseLength = Math.max(...phraseLengths);
  moveText.style.width = `${maxPhraseLength + charDist}px`;
  moveText2.style.width = `${maxPhraseLength + charDist}px`;
}
let maxPhraseLength = 0;
let spaceCharSize = 0;
setCharWidths();

// Define forUConn span
const forUconn = document.getElementById('forUconn');

// Set character size (needs update)

// Set text color
let color = '#8dc1ff';

// Track which phrase
let currPhrase = 0;
let moveText1Phrase = 0;
let moveText2Phrase = 0;
// Set forUConn styles
forUconn.style.marginLeft = '8px';
forUconn.style.transform = `translateX(${-(phraseLengths[currPhrase] + spaceCharSize)}px)`;


// Build phrase 1
function buildPhrase1() {
  // Set direction
  let direction = 1;
  // Reset innerHTML
  moveText.innerHTML = '';
  // For each character of current phrase
  moveText1Phrase = currPhrase;
  for (let char of phrases[currPhrase]) {
    // Create character span
    let span = document.createElement('span');
    // Add char span class
    span.classList.add('move-char');
    // Set char span styles
    span.style.display = 'inline-block';
    span.style.opacity = '0';
    span.style.position = 'relative';
    span.style.color = `${color}`
    span.style.transition = 'transform .54s cubic-bezier(.6,.2,.25,1), opacity .54s';
    // Check if char is a space
    if(char === ' ') {
      // Set to space code
      span.innerHTML = '&nbsp';
      // Add space class
      span.classList.add('space-char');
      span.style.width = `${spaceCharSize}px`;
      // Set color
      color = '#348fff';
    } else {
      // Set char span text to char
      span.innerText = char;
      charWidth = widths.get(char) ?? 0;
      span.style.width = `${charWidth + charDist}px`;
    }
    // Check direction/set position
    switch(direction) {
      case 1: span.style.transform = 'translate(-50px, -45px)'; break;
      case 2: span.style.transform = 'translate(50px, -45px)'; break;
      case 3: span.style.transform = 'translate(50px, 45px)'; break;
      case 4: span.style.transform = 'translate(-50px, 45px)'; break;
    }
    // Add to moveText
    moveText.appendChild(span);
    // Update direction tracker
    direction = (direction % 4) + 1;
  }
  // Call phrase1In animation after 50ms
  setTimeout(phrase1In, 50)
  // Set color
  color = '#8dc1ff';
  // Update current phrase
  currPhrase = (currPhrase + 1) % phrases.length;
}

// Build phrase 2 function
function buildPhrase2() {
  // Set direction
  let direction = 1;
  // Reset innerHTML
  moveText2.innerHTML = '';
  // For each character of phrase
  moveText2Phrase = currPhrase;
  for (let char of phrases[currPhrase]) {
    // Create char span
    let span = document.createElement('span');
    // Add char span class
    span.classList.add('move-char');
    // Set char span styles
    span.style.display = 'inline-block';
    span.style.opacity = '0';
    span.style.position = 'relative';
    span.style.color = `${color}`
    span.style.transition = 'transform .54s cubic-bezier(.6,.2,.25,1), opacity .54s';
    // Check if char is space
    if(char === ' ') {
      // Set to space code
      span.innerHTML = '&nbsp';
      // Add space class
      span.classList.add('space-char');
      span.style.width = `${spaceCharSize}px`;
      // Set color
      color = '#348fff';
    } else {
      // Set char span text to char
      span.innerText = char;
      charWidth = widths.get(char) ?? 0;
      span.style.width = `${charWidth + charDist}px`;
    }
    // Check direction/set position
    switch(direction) {
      case 1: span.style.transform = 'translate(-50px, -45px)'; break;
      case 2: span.style.transform = 'translate(50px, -45px)'; break;
      case 3: span.style.transform = 'translate(50px, 45px)'; break;
      case 4: span.style.transform = 'translate(-50px, 45px)'; break;
    }
    // Add char span to moveText2
    moveText2.appendChild(span);
    // Update direction
    direction = (direction % 4) + 1;
  }
  // Call phrase2In animation after 150ms
  setTimeout(phrase2In, 150);
  // Set color
  color = '#8dc1ff';
  // Update phrase tracker
  currPhrase = (currPhrase + 1) % phrases.length;
}

// Phrase1 animation
function phrase1In() {
  // Set initial delay
  let delay = 0.08;
  // Call forUConn alignment for moveText
  alignForUConn(moveText);
  // For each char span in moveText
  for(let char of moveText.children) {
    // Set transition delay
    char.style.transitionDelay = `${delay}s`;
    // Move to final position
    char.style.transform = 'none';
    // Fade in
    char.style.opacity = '1';
    // Increment delay
    delay += 0.06;
  }
  // Call phrase1Out animation after phrase1In is over
  setTimeout(phrase1Out, getAnimationDuration(phrases[currPhrase].length));
}

// Phrase2 animation
function phrase2In() {
  // Set initial delay to full time length + .5
  let delay = (0.06 * phrases[currPhrase].length) + .5;
  // Call for UConn alignment for moveText2
  alignForUConn(moveText2);
  // For each char span in moveText2
  for(let char of moveText2.children) {
    // Set transition delay
    char.style.transitionDelay = `${delay}s`;
    // Move to final position
    char.style.transform = 'none';
    // Fade in
    char.style.opacity = '1';
    // Decrement delay
    delay -= 0.06;
  }
  // Call phrase2Out animation after phrase2In is over
  setTimeout(phrase2Out, getAnimationDuration(phrases[currPhrase].length));
}

// Phrase 1 out animation
function phrase1Out() {
  // Set delay to full time length
  let delay = 0.06 * moveText.children.length;
  // Set direction
  let direction = 1;
  // For each char span in moveText
  for (let char of moveText.children) {
    // Set transition delay
    char.style.transitionDelay = `${delay}s`;
    // Check direction/move to out position
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
    // Fade char span out
    char.style.opacity = '0';
    // Update direction
    direction = (direction % 4) + 1;
    // Decrement delay
    delay -= 0.06;
  }
  // Call phrase2 building after 100ms
  setTimeout(buildPhrase2, 100)
}

// Phrase2 out animation
function phrase2Out() {
  // Set initial delay
  let delay = 0.08;
  // Set direction
  let direction = 1;
  // For each char span in moveText2
  for (let char of moveText2.children) {
    // Set transition delay
    char.style.transitionDelay = `${delay}s`;
    // Check direction
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
    // Fade char span out
    char.style.opacity = '0';
    // Update direction
    direction = (direction % 4) + 1;
    // Increment delay
    delay += 0.06;
  }
  // Call phrase1 build after 100ms
  setTimeout(buildPhrase1, 100)
}

// Get duration of phraseIn/Out animation
function getAnimationDuration(numLetters) {
  // Set delay per letter
  const perLetterDelay = 0.06;
  // Set initial delay
  const baseDelay = 0.08;
  // Set duration
  const duration = 0.54;
  // Set buffer
  const buffer = 1.25;
  // Return total duration in seconds
  return (baseDelay + perLetterDelay * (numLetters - 1) + duration + buffer) * 1000;
}

// Align forUConn span
function alignForUConn(wrapper) {
  // Get text width
  let textWidth;
  if(wrapper === moveText) {textWidth = phraseLengths[moveText1Phrase]}
  else {textWidth = phraseLengths[moveText2Phrase]}
  // Set transition
  forUconn.style.transition = 'transform 1.725s cubic-bezier(.5,.1,.3,1)';
  // Set forUConn margin
  forUconn.style.marginLeft = '6px';
  // Move forUConn span
  forUconn.style.transform = `translateX(${-(maxPhraseLength) + textWidth + spaceCharSize}px)`;
}


/* ------------------- STAR ANIMATION FRAME LOOP ------------------- */

/* -- PERFORMANCE TEST -- */

// Set frame test duration
let frameTest = 4000;
let testBuffer = 2000;
let bufferComplete = false;
let frameTestComplete = false;
let frameTestPass = null;
let totalFrames = 0;
// Count rendered frames
let frameCount = 0;
let lastLogTime = 0;
let testStart;
let testMouse = {x: 0, y: 0};
/* -- FRAME LOOP -- */
function performanceTest(now) {
  if(now - lastLogTime >= 1000 && bufferComplete) {
    console.log('frames:', frameCount);
    frameCount = 0;
    lastLogTime = now;
  }

  if(now >= testBuffer && !bufferComplete) {
    bufferComplete = true;
    lastLogTime = now;
    testStart = now;
    frameCount = 0;
    totalFrames = 0;
    console.log('testing');
  }
  testStarPull();
  totalFrames++;
  frameCount++;
  if(now >= frameTest + testStart) {
    frameTestComplete = true;
    body.removeChild(performCanvas);
    const avgFPS = totalFrames / ((now - testStart) / 1000);
    console.log(avgFPS)
    if(avgFPS > 55) {
      frameTestPass = true;
      requestAnimationFrame(animateFrame)
    } else {
      frameTestPass = false;
    }
    console.log('frameTest', frameTestPass)
  }
  testMouse.x = Math.min(testMouse.x + 4, performCanvas.width)
  testMouse.y = Math.min(testMouse.y + 4, performCanvas.height);
  if(!frameTestComplete) requestAnimationFrame(performanceTest);
}

// Set last time
let lastTime = 0;
// Set target frame rate
const frameRate = 1000 / 60;
// Track stars animated in
let bgAnimated = false;
// Track frame looping
let frameLooping = false;
// Call animation frame
function animateFrame(now) {
  // Check framerate sync
    // Set lastTime to now

    // If stars not animated in call star animate in
    // If stars animated in call gravity function
    animateStarPull();

  // If hero on screen or stars not animated in loop animation frame (needs update for initial animation)
  if(heroOnScreen) {
    requestAnimationFrame(animateFrame)
  }
}


/* ------------------- STAR CACHING ------------------- */
const dpr = window.devicePixelRatio;
let spacing = 50;
if(window.innerWidth > 2000) {
  spacing = window.innerWidth / 40;
} else if(window.innerWidth < 500) {
  spacing = window.innerWidth * dpr / 40;
}

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
  4: [(sectionWidth * 2), sectionHeight],
  5: [(sectionWidth * 2), 0]
}

function updateCacheSectionOffsets() {
  sectionWidth = Math.ceil(window.innerWidth / 3);
  sectionHeight = Math.ceil(window.innerHeight / 2);

  cacheSectionOffsets[0] = [0, horizBreak];
  cacheSectionOffsets[1] = [0, 0];
  cacheSectionOffsets[2] = [leftVertBreak, horizBreak];
  cacheSectionOffsets[3] = [leftVertBreak, 0];
  cacheSectionOffsets[4] = [rightVertBreak, horizBreak];
  cacheSectionOffsets[5] = [rightVertBreak, 0];
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
    const cacheCanvas = document.createElement('canvas');
    cacheCanvas.width = sectionWidth;
    cacheCanvas.height = sectionHeight;
    cachedStarSections[code] = cacheCanvas;
  }
}

// Cache each section's stars
function cacheStaticStars() {
  // For each section add all section stars to canvas
  for(let code = 0; code <= 5; code++) {
    // Get section stars/offsets
    const sectionStars = getStarsByCode(code);
    const cacheCTX = cachedStarSections[code].getContext('2d');
    const [offsetX, offsetY] = cacheSectionOffsets[code];

    // Define star shadows
    ctx.shadowColor = 'rgba(241, 241, 241, 0.2)';
    ctx.shadowBlur = 4;
    ctx.shadowOffsetX = 0;
    ctx.shadowOffsetY = 0;

    // Draw star on canvas
    cacheCTX.clearRect(0, 0, sectionWidth, sectionHeight)
    sectionStars.forEach(star => {
      cacheCTX.save();
      cacheCTX.translate(star.x - offsetX, star.y - offsetY);
      cacheCTX.rotate(star.rotation);
      cacheCTX.beginPath();
      cacheCTX.ellipse(0, 0, star.rx, star.ry, 0, 0, Math.PI * 2);
      cacheCTX.fillStyle = 'rgb(77,179,255)';
      cacheCTX.globalAlpha = 0.25;
      cacheCTX.fill();
      cacheCTX.restore();
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

let updateWidth = window.innerWidth;
let updateHeight = window.innerHeight;
// Define canvas/ctx variables
const canvas = document.getElementById('star-canvas');
const ctx = canvas.getContext('2d');
const performCanvas = document.getElementById('star-canvas-perform');
const performCTX = performCanvas.getContext('2d');

document.getElementById('i3-head').style.top = `${ucHeaderRect.height}px`
canvas.style.top = `${ucHeaderRect.height / 2}px`
// Set space between stars

if(window.innerWidth * dpr < 1000) windowWidth *= 1.5;

// Set section breakpoints
let horizBreak = Math.floor(window.innerHeight / 2);
let leftVertBreak = Math.floor(window.innerWidth / 3);
let rightVertBreak = Math.floor((window.innerWidth / 3) * 2);

// Track fade in status
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
function resizeStarBG(prevWidth) {

  const growing = window.innerWidth > prevWidth;
  if(!growing) { resizeSmaller() } else { resizeLarger() }
  function resizeSmaller() {
    canvas.height = window.innerHeight;
    canvas.width = window.innerWidth;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    sectionWidth = Math.ceil(window.innerWidth / 3);
    sectionHeight = Math.ceil(window.innerHeight / 2);
    horizBreak = Math.floor(window.innerHeight / 2);
    leftVertBreak = Math.floor(window.innerWidth / 3);
    rightVertBreak = Math.floor((window.innerWidth / 3) * 2);

    const flatStars = Object.values(allStars).flat();

    for(const key in allStars) allStars[key] = [];

    flatStars.forEach(star => {
      if(
        star.x >= 0 && star.x < window.innerWidth &&
        star.y >= 0 && star.y < window.innerHeight
      ) {
        if(star.x <= leftVertBreak) {
          if(star.y <= horizBreak) { allStars.starsTopLeft.push(star) }
          else { allStars.starsBotLeft.push(star) }
        } else if(star.x > leftVertBreak && star.x <= rightVertBreak) {
          if(star.y <= horizBreak) { allStars.starsTopMid.push(star) }
          else { allStars.starsBotMid.push(star) }
        } else {
          if(star.y <= horizBreak) { allStars.starsTopRight.push(star) }
          else { allStars.starsBotRight.push(star) }
        }

        drawStar(star);
      }
    })

    updateCacheSectionOffsets();
    setCachedSectionSize();
    cacheStaticStars();
    updateStarSpeed();

    updateWidth = window.innerWidth;
    updateHeight = window.innerHeight;
  }

  function resizeLarger() {
    updateStarSpeed();

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    //updateCacheSectionOffsets();

    sectionWidth = Math.ceil(window.innerWidth / 3);
    sectionHeight = Math.ceil(window.innerHeight / 2);
    horizBreak = Math.floor(window.innerHeight / 2);
    leftVertBreak = Math.floor(window.innerWidth / 3);
    rightVertBreak = Math.floor((window.innerWidth / 3) * 2);

    const newCols = Math.floor((window.innerWidth - updateWidth) / spacing);
    const newRows = Math.floor((window.innerHeight - updateHeight) / spacing);

    const newStars = [];
    const existingStars = Object.values(allStars).flat();

    if(newCols <= 0 && newRows <= 0) return;
    for(let i = 0; i < newCols; i++) {
      const x = updateWidth + i * spacing + (Math.random() * 8 - 4);
      for(let y = 0; y < window.innerHeight; y += spacing) {
        const jitterY = y + (Math.random() * 8 - 4);
        const rx = Math.random() * 0.75 + 1.25;
        const ry = rx * (Math.random() * 0.3 + 1.1);
        const rotation = Math.random() * Math.PI * 2;
        newStars.push({
          x,
          y: jitterY,
          originX: x,
          originY: jitterY,
          rx,
          ry,
          rotation,
          alpha: 0.25,
          delay: 0
        });
      }
    }
    for(let i = 0; i < newRows; i++) {
      const y = updateHeight + i * spacing + (Math.random() * 8 - 4);
      for(let x = 0; x < window.innerWidth; x++) {
        const jitterX = x + (Math.random() * 8 - 4);
        const rx = Math.random() * 0.75 + 1.25;
        const ry = rx * (Math.random() * 0.3 + 1.1);
        const rotation = Math.random() * Math.PI * 2;
        newStars.push({
          x: jitterX,
          y,
          originX: jitterX,
          originY: y,
          rx,
          ry,
          rotation,
          alpha: 0.25,
          delay: 0
        });
      }
    }

    updateCacheSectionOffsets();
    setCachedSectionSize();
    updateWidth = window.innerWidth;
    updateHeight = window.innerHeight;

    for(const key in allStars) allStars[key] = [];

    const flatStars = [...existingStars, ...newStars];
    flatStars.forEach(star => {
      if (star.x < leftVertBreak) {
        if (star.y < horizBreak) allStars.starsTopLeft.push(star);
        else allStars.starsBotLeft.push(star);
      } else if (star.x < rightVertBreak) {
        if (star.y < horizBreak) allStars.starsTopMid.push(star);
        else allStars.starsBotMid.push(star);
      } else {
        if (star.y < horizBreak) allStars.starsTopRight.push(star);
        else allStars.starsBotRight.push(star);
      }
    });
    cacheStaticStars();

  }
}


// Set frame number to 0
let frame = 0;

// Create star background
function createStarBG() {
  // Set canvas width/height to window width/height
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  performCanvas.width = window.innerWidth;
  performCanvas.height = window.innerHeight;
  // Set canvas style to viewport height/width
  canvas.style.width = '100vw';
  canvas.style.height = '100vh';
  performCanvas.style.width = '100vw';
  performCanvas.style.height = '100vh';
  // Calculate rows/columns needed depending on screen's resolution
  let rows = Math.floor(window.innerHeight / spacing);
  const cols = Math.floor(window.innerWidth / spacing);


  if(isMobile) {
    canvas.width = canvas.width * 1.25;
    canvas.style.width = '135vw';
  }
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
  if(!isMobile) {
    // Call cache function
    cacheStaticStars();
    // Begin animation frame loop
    requestAnimationFrame(drawStarCanvas);

  } else {
    requestAnimationFrame(drawStarCanvas);
  }

}

function drawStarCanvas() {
  for(const key in allStars) {
    // Get section
    const section = allStars[key];

    // For each star in section
    for (let i = 0; i < section.length; i++) {
      // Get star
      const star = section[i];
      drawStar(star);
      if(!isMobile) testDrawStar(star);
    }
  }
  if(heroOnScreen) {
    canvas.style.opacity = '1';
    canvas.style.transform = 'none';
    canvas.addEventListener('transitionend', (event) => {
      canvas.style.transition = 'opacity .5s ease-out';
    }, {once:true})
  } else {
    starsFaded = true;
    canvas.style.transition = 'opacity .5s ease-out';
    canvas.style.transform = 'none';

  }

  if(!isMobile) {
    requestAnimationFrame(performanceTest);
    setTimeout(() => {
      buildPhrase1();
    }, 750)
  }
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

function updateStarSpeed() {
  const baseWidth = 1920;
  const scale = Math.min(window.innerWidth / baseWidth, 1);
  starGravitateSpeed = window.innerWidth * 0.00002
  starReturnSpeed = window.innerWidth * 0.00001
}

let starGravitateSpeed = 0.12;
let starReturnSpeed = 0.07;

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
    star.x += (mousePos.x - star.x) * starGravitateSpeed;
    star.y += (mousePos.y - star.y) * starGravitateSpeed;
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
      star.x += distXOrigin * starReturnSpeed;
      star.y += distYOrigin * starReturnSpeed;

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


/* ------------------- STAR PERFORMANCE TEST ------------------- */
// Animate star gravitational pull
function testStarPull() {
  // Clear canvas
  performCTX.clearRect(0, 0, performCanvas.width, performCanvas.height);

  // Check active star sections
  const activeSections = testCheckSection();

  // For each section
  for(let code = 0; code <= 5; code++) {
    // If section is active
    if(activeSections.includes(code)) {
      // Set moving variable
      let sectionMoving = false;

      // For each star in section
      getStarsByCode(code).forEach(star => {
        // Set moving to pullStar's stillMoving return value
        const moving = testPull(star);

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
        const moving = testPull(star);

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
      performCTX.drawImage(cachedStarSections[code], Math.round(offsetX), Math.round(offsetY));
    }
  }
}

// Pull star function
function testPull(star) {
  // Calculate distance from mouse
  const distX = testMouse.x - star.originX;
  const distY = testMouse.y - star.originY;
  const dist = (distX * distX) + (distY * distY)

  // Set pull radius
  const pullRadius = 100;

  // Default still moving to false
  let stillMoving = false;

  // If distance is larger than pull radius (hypotenuse without Math.hypot() for optimization
  if(dist < (pullRadius * pullRadius)) {
    // Lerp star closer to mouse
    star.x += (testMouse.x - star.x) * 0.15;
    star.y += (testMouse.y - star.y) * 0.15;

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
  testDrawStar(star);

  // Return if any stars are moving
  return stillMoving;
}

// Check section of star
function testCheckSection() {
  // Check vertical section
  let section = testCheckSectionVert();

  // Active section code array
  let sectionCodes = [];

  // Check horizontal sections with given vertical values, return number codes for active sections
  if(testMouse.x <= leftVertBreak - spacing) {
    section.forEach(vert => sectionCodes.push(vert === 'bottom' ? 0 : 1));

  } else if(testMouse.x > leftVertBreak - spacing && testMouse.x <= leftVertBreak + spacing) {
    section.forEach(vert => {
      if(vert === 'bottom') {sectionCodes.push(0, 2)} else {sectionCodes.push(1, 3)}
    });

  } else if(testMouse.x > leftVertBreak + spacing && testMouse.x <= rightVertBreak - spacing) {
    section.forEach(vert => sectionCodes.push(vert === 'bottom' ? 2 : 3));

  } else if(testMouse.x > rightVertBreak - spacing && testMouse.x <= rightVertBreak + spacing) {
    section.forEach(vert => {
      if(vert === 'bottom') {sectionCodes.push(2, 4)} else {sectionCodes.push(3,5)}
    });

  } else {
    section.forEach(vert => sectionCodes.push(vert === 'bottom' ? 4 : 5));
  }
  return sectionCodes;
}

// Check vertical section
function testCheckSectionVert() {
  if(testMouse.y <= horizBreak - spacing) {return ['top']}
  else if(testMouse.y > horizBreak - spacing && testMouse.y <= horizBreak + spacing) {return  ['bottom','top']}
  else {return ['bottom']}
}

// Basic draw star function
function testDrawStar(star) {
  // Buffer to only draw stars on screen
  const buffer = 25;

  // Check star x/y with buffer
  if(star.x < -buffer || star.x > window.innerWidth + buffer
    || star.y < -buffer || star.y > window.innerHeight + buffer) {
    return
  }
  performCTX.shadowColor = 'rgba(241, 241, 241, 0.2)';
  performCTX.shadowBlur = 4;
  performCTX.shadowOffsetX = 0;
  performCTX.shadowOffsetY = 0;
  // Draw star
  performCTX.save();
  performCTX.translate(star.x, star.y);
  performCTX.rotate(star.rotation);
  performCTX.beginPath();
  performCTX.ellipse(0, 0, star.rx, star.ry, 0, 0, Math.PI * 2);
  performCTX.fillStyle = 'rgb(77,179,255)';
  performCTX.globalAlpha = 0.25;
  performCTX.fill();
  performCTX.restore();
}





/* ------------------- STORY FUNCTIONS ------------------- */



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



/* ------------------- PROJECTS FUNCTIONS ------------------- */

// Initialize project div array
const projectDivs = [];


function resetRows() {
  [...projectsRow1.children, ...projectsRow2.children, ...(isMobile ? [...projectsRow3.children] : [])]
    .forEach(card => card.classList.remove('project-ani'));
  [...teamRow.children].forEach(card => card.classList.remove('employee-ani'));
  startProjectAni();
  startEmpAni();
}


// Initialize link canvas tracker
let linkCanvasActive = false;
function buildProjects() {
  // For each project
  projects.forEach(project => {
    // Create wrapper div / add class / set background to project image
    const wrapper = document.createElement('div');
    wrapper.classList.add('project-wrapper');
    wrapper.style.background = `url('${project.img}') center center / cover no-repeat`;

    // Create title h5 / add class / set innerText to name / append to wrapper
    const title = document.createElement('h5');
    title.innerText = `${project.name}`;
    title.classList.add('project-title');
    wrapper.appendChild(title);

    // Create overlay div / add class / append to wrapper
    const overlay = document.createElement('div');
    overlay.classList.add('project-overlay');
    wrapper.appendChild(overlay);

    // Create absolutely positioned wrapper / add class / append wrapper to absolute wrap / set id to project name
    const wrapperAbsolute = document.createElement('div');
    wrapperAbsolute.classList.add('project-wrapper-abs');
    wrapperAbsolute.appendChild(wrapper);
    wrapperAbsolute.id = project.name;

    // Create wrapper border div / add class / append to absolute wrapper
    const wrapperBorder = document.createElement('div');
    wrapperBorder.classList.add('project-wrapper-border');
    wrapperAbsolute.appendChild(wrapperBorder);

    // Push absolute wrapper to div array
    projectDivs.push(wrapperAbsolute);

  })
  if(!isMobile) {
    for(let i = 0, i2 = projectDivs.length - 1; i < Math.floor(projectDivs.length / 2); i++, i2--) {
      projectDivs[i].style.left = 'calc(-1.5 * var(--project-card-width))';
      projectDivs[i2].style.right = 'calc(-1.5 * var(--project-card-width))';
      projectDivs[i].classList.remove('project-ani');
      projectDivs[i2].classList.remove('project-ani');
      projectsRow1.appendChild(projectDivs[i]);
      projectsRow2.appendChild(projectDivs[i2]);
    }
  } else {
    const length = projectDivs.length;
    const splitArr = [];
    let start = 0;
    for(let i = 0; i < 3; i++) {
      const end = start + Math.ceil((length - start) / (3 - i));
      splitArr.push(projectDivs.slice(start,end));
      start = end;
    }
    splitArr[0].forEach(div => {
      div.style.left = 'calc(-1.5 * var(--project-card-width))';
      projectsRow1.appendChild(div);
    })
    splitArr[1].forEach(div => {
      div.style.right = 'calc(-1.5 * var(--project-card-width))';
      projectsRow2.appendChild(div);
    })
    splitArr[2].forEach(div => {
      div.style.left = 'calc(-1.5 * var(--project-card-width))';
      projectsRow3.appendChild(div);
    })
  }
  setTimeout(startProjectAni, 500)
}



function getProjectWidth() {
  projectCardWidth = parseInt(getComputedStyle(body).getPropertyValue('--project-card-width').slice(0,-2));
}

let projectCardWidth = 352;

// Add first half of project divs to row 1, second half to row 2

// Initialize each row index tracker
let row1Index = 0;
let row2Index = 0;

function waitForScrollEnd(timeout, card) {
  if(waitingForScroll) {
    if(scrolling) {
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        waitForScrollEnd(timeout, card);
      }, 100);
    } else {
      waitingForScroll = false;
      clearTimeout(timeout);
      projectsHover(card);
    }
  }
}
let projectHoverEnabled = true;
let scrollTimeout;
let waitingForScroll = false;
// For each card div in row 1
function setProjectListeners() {
  const delay = getComputedStyle(body).getPropertyValue('--project-ani-del')
  if (!isMobile) {
    for (let card of projectsRow1.children) {
      // Add hover listener / call hover function
      card.addEventListener('mouseenter', () => {
        console.log(scrolling)
        if (scrolling) {
          waitingForScroll = true;
          scrollTimeout = setTimeout(() => {
            waitForScrollEnd(scrollTimeout, card);
          }, 100);
        } else {
          if (projectHoverEnabled) {
            projectsHover(card);
          }
        }
      });
      // Add unhover listener / call unhover function
      card.addEventListener('mouseleave', () => {
        projectsUnHover();
        if (waitingForScroll) {
          waitingForScroll = false;
        }
      });
      // Add animation start listener / update row 1 index / call animation for next card
      card.addEventListener('animationstart', function nextCard() {
        let next = card.nextElementSibling;
        if (!next) next = projectsRow1.firstElementChild;
        next.style.animationDelay = delay;

        animateProjectCardRow1(next)
      })
      // Add animation end listener / remove animation class
      card.addEventListener('animationend', function resetCard() {
        card.classList.remove('project-ani');
      });
    }

    // For each card div in row 2
    for (let card of projectsRow2.children) {
      // Add hover listener / call hover function
      card.addEventListener('mouseenter', function hover() {
        if (scrolling) {
          waitingForScroll = true;
          scrollTimeout = setTimeout(() => {
            waitForScrollEnd(scrollTimeout, card, isMobile);
          }, 100);
        } else {
          if (projectHoverEnabled) {
            projectsHover(card);
          }
        }
      });
      // Add unhover listener / call unhover function
      card.addEventListener('mouseleave', () => {
        projectsUnHover();
        if (waitingForScroll) {
          waitingForScroll = false;
        }
      });
      // Add animation start listener / update row 2 index / call animation for next card
      card.addEventListener('animationstart', function nextCard() {
        let next = card.nextElementSibling;
        if (!next) {
          next = projectsRow2.firstElementChild;
        }
        next.style.animationDelay = delay;
        animateProjectCardRow2(next)
      })


      // Add animation end listener / remove animation class
      card.addEventListener('animationend', function resetCard() {
        card.classList.remove('project-ani');
      });

    }
  } else {
    for (let card of projectsRow1.children) {
      // Add hover listener / call hover function
      card.addEventListener('touchend', (event) => {
        event.stopPropagation();
        projectsHoverMobile(card);
      }, {once:true});
      // Add animation start listener / update row 1 index / call animation for next card
      card.addEventListener('animationstart', function nextCard() {
        let next = card.nextElementSibling;
        if (!next) next = projectsRow1.firstElementChild;
        next.style.animationDelay = delay;

        animateProjectCardRow1(next)
      })
      // Add animation end listener / remove animation class
      card.addEventListener('animationend', function resetCard() {
        card.classList.remove('project-ani');
      });
    }

    // For each card div in row 2
    for (let card of projectsRow2.children) {
      // Add hover listener / call hover function
      card.addEventListener('touchend', function hover(event) {
        event.stopPropagation();
        projectsHoverMobile(card);
      }, {once:true});
      // Add animation start listener / update row 2 index / call animation for next card
      card.addEventListener('animationstart', function nextCard() {
        let next = card.nextElementSibling;
        if (!next) {
          next = projectsRow2.firstElementChild;
        }
        next.style.animationDelay = delay;
        animateProjectCardRow2(next)
      })


      // Add animation end listener / remove animation class
      card.addEventListener('animationend', function resetCard() {
        card.classList.remove('project-ani');
      });
    }
    for(let card of projectsRow3.children) {
      card.addEventListener('touchend', function hover(event) {
        event.stopPropagation();
        projectsHoverMobile(card)
      }, {once:true});
      // Add animation start listener / update row 2 index / call animation for next card
      card.addEventListener('animationstart', function nextCard() {
        let next = card.nextElementSibling;
        if (!next) {
          next = projectsRow3.firstElementChild;
        }
        next.style.animationDelay = delay;
        animateProjectCardRow3(next)
      })


      // Add animation end listener / remove animation class
      card.addEventListener('animationend', function resetCard() {
        card.classList.remove('project-ani');
      });
    }

  }
}

let mobileProjHovers = [];
function projectsHoverMobile(card) {
  pauseProjects();
  mobileProjHovers.push(card);
  card.firstElementChild.classList.add('project-card-hover');
  card.addEventListener('touchend', (event) => {
    event.stopPropagation();
    mobileProjHovers.splice(mobileProjHovers.indexOf(card), 1);
    if(mobileProjHovers.length === 0) playProjects();
    card.addEventListener('touchend', (event) => {
      event.stopPropagation();
      projectsHoverMobile(card);
    }, {once:true})
    card.firstElementChild.classList.remove('project-card-hover');
  }, {once:true})
}


function startProjectAni() {
  const delay = parseInt(getComputedStyle(body).getPropertyValue('--project-ani-del').slice(0, -2));
  const duration = parseInt(getComputedStyle(body).getPropertyValue('--project-ani-dur').slice(0, -2));
  const cards = [
    [...projectsRow1.querySelectorAll('.project-wrapper-abs')],
    [...projectsRow2.querySelectorAll('.project-wrapper-abs')]
  ];
  if(isMobile) cards.push([...projectsRow3.querySelectorAll('.project-wrapper-abs')])
  let chainStart = false;
  console.log(cards)
  const preload = duration;
  if(!projectsStarted) {
    cards[0][0].addEventListener('animationend', () => {
      cards[0][0].classList.remove('project-ani');
    })
    cards[1][0].addEventListener('animationend', () => {
      cards[1][0].classList.remove('project-ani');
    })
    if(isMobile) {
      cards[2][0].addEventListener('animationend', () => {
        cards[2][0].classList.remove('project-ani')
      })
    }
  }

  cards[0].forEach((card, i) => {
    const startTime = i * delay;
    if(startTime < preload) {
      const offset = preload - startTime;
      cards[1][i].style.animationDelay = `-${offset}ms`;
      card.style.animationDelay = `-${offset}ms`;
      animateProjectCardRow1(card);
      animateProjectCardRow2(cards[1][i]);
      if(isMobile) {
        cards[2][i].style.animationDelay = `-${offset}ms`;
        animateProjectCardRow3(cards[2][i]);
      }

    } else if(!chainStart) {
      chainStart = true;
      const initialDelay = delay - (preload % delay);
      card.style.animationDelay = `${initialDelay}ms`;
      cards[1][i].style.animationDelay = `${initialDelay}ms`;
      if(isMobile) cards[2][i].style.animationDelay = `${initialDelay}ms`;
      if(!projectsStarted) {
        card.addEventListener('animationstart', () => {
          let next = card.nextElementSibling;
          if(!next) next = projectsRow2.firstElementChild;
          animateProjectCardRow1(next)
          setTimeout(setProjectListeners, 100);

        }, {once:true})
        cards[1][i].addEventListener('animationstart', () => {
          let next = cards[1][i].nextElementSibling;
          if(!next) next = projectsRow2.firstElementChild;
          animateProjectCardRow2(next)
        }, {once:true})
        if(isMobile) cards[2][i].addEventListener('animationstart', () => {
          let next = cards[2][i].nextElementSibling;
          if(!next) next = projectsRow3.firstElementChild;
          animateProjectCardRow3(next);
        }, {once:true})
      }
      animateProjectCardRow1(card);
      animateProjectCardRow2(cards[1][i]);
      if(isMobile) animateProjectCardRow3(cards[2][i]);
    }
  });
  if(projectsOnScreen) playProjects();
  if(!projectsStarted) projectsStarted = true;
}

// Initialize array of cards on screen
let cardsOnScreen = [];



function pauseProjects() {
  projectsAnimating = false;
  cardsOnScreen = [];
  // For each card in row 1
  for(let card of projectsRow1.children) {
    // Get card rect
    const rect = card.getBoundingClientRect();
    // If rect on screen (25px buffer) add to cardOnScreen
    if(rect.x > 25 && rect.x < window.innerWidth - 25) cardsOnScreen.push(card);
    // Initialize border / wrapper element variables
    const border = card.querySelector('.project-wrapper-border');
    const wrapper = card.querySelector('.project-wrapper');

    // Add border slow to stop / wrapper slow to stop / pause cards
    border.style.transform = 'translateX(30px) translateY(-20px)';
    wrapper.style.transform = 'translateX(50px)';
    card.style.animationPlayState = 'paused';
  }
  // for each card in row 2
  for(let card of projectsRow2.children) {
    // Get card rect
    const rect = card.getBoundingClientRect();
    // If rect on screen (25px buffer) add to cardOnScreen
    if(rect.x > 25 && rect.x < window.innerWidth - 25) cardsOnScreen.push(card);
    // Initialize border / wrapper element variables
    const border = card.querySelector('.project-wrapper-border');
    const wrapper = card.querySelector('.project-wrapper');

    // Add border slow to stop / wrapper slow to stop / pause cards
    border.style.transform = 'translateX(-70px) translateY(-20px)';
    wrapper.style.transform = 'translateX(-50px)';
    card.style.animationPlayState = 'paused';
  }
  if(isMobile) {
    for(let card of projectsRow3.children) {
      // Get card rect
      const rect = card.getBoundingClientRect();
      // If rect on screen (25px buffer) add to cardOnScreen
      if(rect.x > 25 && rect.x < window.innerWidth - 25) cardsOnScreen.push(card);
      // Initialize border / wrapper element variables
      const border = card.querySelector('.project-wrapper-border');
      const wrapper = card.querySelector('.project-wrapper');

      // Add border slow to stop / wrapper slow to stop / pause cards
      border.style.transform = 'translateX(30px) translateY(-20px)';
      wrapper.style.transform = 'translateX(50px)';
      card.style.animationPlayState = 'paused';
    }
  }
}

function playProjects() {
  projectsAnimating = true;
  // For each card in both row1 and row2
  for(let card of [...projectsRow1.children, ...projectsRow2.children]) {
    // Initialize border / wrapper element variables
    const border = card.querySelector('.project-wrapper-border');
    const wrapper = card.querySelector('.project-wrapper');
    // Reset border / wrapper / card position + opacity / play card animation
    border.style.transform = '';
    border.style.opacity = '1';
    wrapper.style.transform = '';
    card.style.opacity = '1';
    card.style.animationPlayState = 'running';
  }
  if(isMobile) {
    for(let card of projectsRow3.children) {
      // Initialize border / wrapper element variables
      const border = card.querySelector('.project-wrapper-border');
      const wrapper = card.querySelector('.project-wrapper');
      // Reset border / wrapper / card position + opacity / play card animation
      border.style.transform = '';
      border.style.opacity = '1';
      wrapper.style.transform = '';
      card.style.opacity = '1';
      card.style.animationPlayState = 'running';
    }
  }
}

// Card hover function
function projectsHover(card) {
  pauseProjects();
  projectHoverEnabled = false;
  // Call card linking function
  linkCards(card);
}

// Projects unHover function
function projectsUnHover() {
  // Check link canvas tracker
  if(linkCanvasActive) {
    // Remove canvas
    const linkCanvas = document.getElementById('constellationCanvas');
    linkCanvas.style.transition = 'opacity .25s';
    linkCanvas.addEventListener('transitionend', function linkFadedOut() {
      linkCanvas.removeEventListener('transitionend', linkFadedOut);
      document.body.removeChild(linkCanvas);
      setTimeout(() => {
        projectHoverEnabled = true;
        linkCanvasActive = false;

      }, 100);
    })
    linkCanvas.style.opacity = '0';
    // Update tracker

  } else {
    projectHoverEnabled = true;
  }
  playProjects();
  // Reset cardsOnscreen
  cardsOnScreen = [];
  // Remove hover class from each hovered + linked card / set opacity to 1
  for(let card of document.querySelectorAll('.project-card-hover')) {
    card.classList.remove('project-card-hover');
    card.style.opacity = '1';
  }
}

// Link cards function
function linkCards(hoveredCard) {
  // Get link loop / possible links
  const linkLoop = getLinkLoop(hoveredCard);

  // Get card variables, complete loop boolean, and tags from linkLoop
  const [card1, card2, card3, complete, tag1, tag2, tag3] = linkLoop;
  // Ensure card1 exists
  const linkedCards = [card1].filter(Boolean);
  // If card2 / card3 exists add to linkedCards
  if(card2) linkedCards.push(card2);
  if(card3) linkedCards.push(card3);

  // Ensure tag1 exists
  const linkedTags = [tag1].filter(Boolean);
  // If tag2 exists add to linkedTags
  if(tag2) linkedTags.push(tag2);
  // Check if tag3 is array / if it exists then push to linkedTags
  if(Array.isArray(tag3)) {linkedTags.push(tag3[0])}
  else if(tag3) {linkedTags.push(tag3)}

  // If there are links call getLinkCenters function with cards, tags, and complete boolean
  if(linkedCards.length > 1) {
    getLinkCenters(linkedCards, linkedTags, complete);
  }

  // Create set of linked cards
  const linkedSet = new Set(linkedCards);

  // Define unlinked array
  const unLinked = [
    ...Array.from(projectsRow1.children),
    ...Array.from(projectsRow2.children)
  ].filter(card => !linkedSet.has(card));

  // Ensure hoveredCard exists in cardsOnScreen / remove from cardsOnScreen
  const hoveredIndex = cardsOnScreen.indexOf(hoveredCard);
  if (hoveredIndex !== -1) cardsOnScreen.splice(hoveredIndex, 1);

  // For each linked card
  linkedCards.forEach(card => {
    // If in row 1 set row1 styles, if row 2 set row2 styles
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
    // Add hover class
    card.firstElementChild.classList.add('project-card-hover');
  })
  // For each unlinked card lower opacity
  unLinked.forEach(card => {
    card.style.opacity = '0.15';
  })
}

// Shuffle cards with tag weights (prioritize less common tags)
function weightedShuffle(cards, targetTag) {
  // Set weighted cards to map of cards
  const weightedCards = cards.map(card => {
    // Get card project
    const project = projects.find(p => p.name === card.id);
    // Check if project has prioritized tag / return card + weight
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

  // Shuffle weighted cards
  weightedCards.sort(() => Math.random() - 0.5);

  // Sort weighted cards by maintaining slight randomization
  weightedCards.sort((a, b) => b.weight - a.weight);

  // Return weighted cards
  return weightedCards.map(entry => entry.card);
}

// Get row of card
function getCardRow(card) {
  return projectsRow1.contains(card) ? 'row1' : 'row2';
}

// Set priority of tags
const tagPriority = [
  'Mobile PWA',
  'Email Marketing',
  'Print Production',
  'UI Design',
  'UX Design',
  'Web Development'
];

// Get link loop function with hoveredCard, false recall if not given parameter
function getLinkLoop(hoveredCard, recall = false) {
  // Get hoveredCard project
  const hoveredProject = projects.find(p => p.name === hoveredCard.id);

  // Get hovered tags
  const hoveredTags = hoveredProject.tags.slice().sort((a, b) => {
    // Get index of tags in tagPriority
    let aIndex = tagPriority.indexOf(a);
    let bIndex = tagPriority.indexOf(b);
    // If not in tagPriority give fake index
    if(aIndex === -1) aIndex = 999;
    if(bIndex === -1) bIndex = 999;
    // Return earliest in priority
    return aIndex - bIndex;
  });

  // Get card project helper
  const getProject = (card) => projects.find(p => p.name === card.id);

  // Get weighted card pool of cardsOnScreen without hoveredCard
  const cardPool = weightedShuffle(cardsOnScreen.filter(card => card !== hoveredCard));

  // Initialize card2 / tag1
  let card2 = null;
  let tag1 = null;

  // For each tag of hoveredTags
  for(let tag of hoveredTags) {
    // Find card2 in cardPool
    card2 = cardPool.find(card => {
      // Get project of card
      const project = getProject(card);
      // Return if includes tag
      return project.tags.includes(tag);
    });
    // If card2 exists set tag1 to tag / break loop
    if(card2) {
      tag1 = tag;
      break;
    }
  }
  // // If card2 doesn't exist return hoveredCard / null cards and tags / false complete
  if(!card2) {
    return [hoveredCard, null, null, false, null, null, null];
  }

  // Get weighted cardPool without card2 + hoveredCard
  const cardPool2 = weightedShuffle(cardPool.filter(card => card !== card2));
  // Get card2 project
  const card2Project = getProject(card2);

  // Initialize card3 / tag2
  let card3 = null;
  let tag2 = null;

  // For each tag in hoveredTags
  for(let tag of hoveredTags) {
    // If tag is same as tag1 continue
    if(tag === tag1) continue;
    // Check if card3 has tag
    card3 = cardPool2.find(card => {
      const project = getProject(card);
      return project.tags.includes(tag) && card2Project.tags.includes(tag);
    });
    // If card3 exists set tag2 to tag / break loop
    if(card3) {
      tag2 = tag;
      break;
    }
  }
  // If card3 doesn't exist check tags again including tag1
  if(!card3) {
    card3 = cardPool2.find(card => {
      const project = getProject(card);
      return project.tags.includes(tag1) && card2Project.tags.includes(tag1);
    });
  }
  // If card3 exists and tag2 does not set tag2 to tag1
  if(card3 && !tag2) {
    tag2 = tag1;
  }
  // If card3 doesn't exist return hoveredCard / card2 / null card3 / false complete loop / tag1 / null tag2 / null tag3
  if(!card3) {
    return [hoveredCard, card2, null, false, tag1, null, null];
  }

  // Get card3 project
  const card3Project = getProject(card3);

  // Get tag from card3 back to card 1 / set to null if can't link to card1
  const backTag = hoveredProject.tags.filter(tag => card3Project.tags.includes(tag)) || null;

  // Set loop path
  const loop = [hoveredCard, card2, card3];

  // Get rows of each card
  const rows = loop.reduce((obj, card) => {
    // Get row
    const row = getCardRow(card);
    // If row exists in object increment row amount / set to 1 otherwise
    if(obj[row]) {obj[row] += 1} else {obj[row] = 1}
    // Return object
    return obj;
  // Initialize empty object
  }, {});

  // Get boolean for too many in 1 row if count of either row in object larger than 2
  const tooManyInRow = Object.values(rows).some(count => count > 2);

  // If tooManyInRow and hasn't recalled yet retry finding loop / set recall to true
  if(tooManyInRow && !recall) {
    return getLinkLoop(hoveredCard, true)
  }

  // Return hoveredCard / card2 / card3 / complete loop boolean / tag1 / tag2 / backTag if exists otherwise null
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

// Get link centers function with linkedCards, linkedTags, complete loop boolean
function getLinkCenters(linkedCards, tags, complete) {
  // If only 1 link return
  if(linkedCards.length === 1) return;

  // Get center helper
  const getCenter = (card) => {
    // Get card rect
    const rect = card.getBoundingClientRect();
    // If in row1 account for pause slowdown / account row2 pause slowdown if row 2
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

  // Initialize centers array
  const centers = [getCenter(linkedCards[0]), getCenter(linkedCards[1])];
  // If more than 2 cards linked push card3 center / if complete loop re-push card1 center
  if(linkedCards.length > 2) {
    centers.push(getCenter(linkedCards[2]));
    if(complete) centers.push(getCenter(linkedCards[0]));
  }
  // Call link animation function with centers, tags, complete loop boolean
  animateLinks(centers, tags, complete);
}

// Link animation function
function animateLinks(centers, tags, complete) {
  // Update link canvas tracker
  linkCanvasActive = true;
  // Create / get canvas
  const canvas = createCanvas();
  // Create ctx
  const ctx = canvas.getContext('2d');

  // Set speed / progress / circle fade
  let speed = 0.025;
  let progress = 0;
  let circleFade = 0.1;

  // Set tag1 text to first tag
  const tag1Text = tags[0];
  // Set font style
  ctx.font = '20px "area-normal", sans-serif';
  // Get width of tag1
  const tag1Width = ctx.measureText(tag1Text).width;

  // Get length of link line
  const lineLength = Math.hypot(
    centers[1].x - centers[0].x,
    centers[1].y - centers[0].y
  );

  // Get tag1 start position / tag1 start progress in line
  const tag1Start = (lineLength / 2) - (tag1Width / 2);
  const tag1StartProg = tag1Start / lineLength;

  // Get midpoints of line
  const midX = (centers[0].x + centers[1].x) / 2;
  const midY = (centers[0].y + centers[1].y) / 2;

  // Draw circle helper
  function drawCircles() {
    // For each center draw circle with circleFade opacity / update circleFade
    centers.forEach(center => {
      ctx.beginPath();
      ctx.arc(center.x, center.y, 6, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(138,205,255, ${circleFade})`;
      ctx.fill();
    });
    circleFade = Math.min(circleFade + .1, 1);
  }

  // Draw tag helper
  function drawTag(start, end, mid, tag, tagStartProg, prog) {
    // Get tagWidth
    const tagWidth = ctx.measureText(tag).width;
    // Get angle of line
    let tagAngle = Math.atan2(
      end.y - start.y,
      end.x - start.x
    );

    // Flip tag if backwards
    if(Math.abs(tagAngle) > Math.PI / 2) {
      tagAngle += Math.PI;
    }

    // Get count of visible letters by progress and tag length
    const visLetterCount = Math.min(
      Math.floor((prog - tagStartProg) * 30),
      tag.length);

    // Set draw color / position / rotation
    ctx.save();
    ctx.fillStyle = '#f1f1f1';
    ctx.translate(mid.x, mid.y);
    ctx.rotate(tagAngle);

    // Set xOffset to negative half of tag width
    let xOffset = -tagWidth / 2;
    // Initialize display text
    let displayText;
    // Check if line is drawing left
    const isLeftward = start.x > end.x;

    // If drawing left
    if (isLeftward) {
      // Reverse text
      displayText = tag.split('').reverse().join('');
      // Set xOffset to positive
      xOffset = tagWidth / 2;
      // For each visible letter
      for (let i = 0; i < visLetterCount; i++) {
        // Get letter
        const letter = displayText[i];
        // Get width of character
        const charWidth = ctx.measureText(letter).width;
        // Decrement offset by charWidth
        xOffset -= charWidth;
        // Draw letter with xOffset, -10 y offset
        ctx.fillText(letter, xOffset, -10);
      }
    // If drawing right
    } else {
      // Set display text to tag
      displayText = tag;

      // For each visible letter draw with positive xOffset / increment offset
      for (let i = 0; i < visLetterCount; i++) {
        const letter = displayText[i];
        const charWidth = ctx.measureText(letter).width;
        ctx.fillText(letter, xOffset, -10);
        xOffset += charWidth;
      }
    }
    ctx.restore();
  }

  // Draw static line helper
  function drawStaticLine(start, end, tagText = null) {
    // Set line styles / position / length
    ctx.strokeStyle = '#8acdff';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(start.x, start.y);
    ctx.lineTo(end.x, end.y);
    ctx.stroke();

    // If tag exists get line middle / call drawTag helper
    if(tagText) {
      const mid = {
        x: (start.x + end.x) / 2,
        y: (start.y + end.y) / 2
      };
      drawTag(start, end, mid, tagText, 0, 1);
    }
  }

  // Draw 1 link function
  function draw1Link() {
    // Clear canvas
    ctx.clearRect(0,0, canvas.width, canvas.height);

    // Get start point / end point
    const start = centers[0];
    const end = centers[1];

    // Interpolate line length
    const aniX = start.x + (end.x - start.x) * progress;
    const aniY = start.y + (end.y - start.y) * progress;

    // Set line style / position / length
    ctx.strokeStyle = '#8acdff';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(start.x, start.y);
    ctx.lineTo(aniX, aniY);
    ctx.stroke();

    // Call drawCircle helper
    drawCircles();

    // If progress larger than or equal to tag1 start progress call drawTag helper
    if(progress >= tag1StartProg) drawTag(start, end, {x: midX,y:midY}, tag1Text, tag1StartProg, progress);

    // Increment progress by speed accounting for odd floating point value
    progress = Math.min(progress + speed, 1);

    // If progress not complete loop draw1Link with frame / otherwise call drawStaticLine helper
    if(progress < 1) {
      requestAnimationFrame(draw1Link);
    } else {
      drawStaticLine(start,end,tag1Text);
    }
  }

  // Draw 2 links function
  function draw2Links() {
    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Get start center / middle center / end center
    const [start, mid, end] = centers;
    // Set tag texts
    const tag1Text = tags[0];
    const tag2Text = tags[1];
    // Get tag widths
    const tag1Width = ctx.measureText(tag1Text).width;
    const tag2Width = ctx.measureText(tag2Text).width;
    // Set local progress
    let localProg = 0;

    // Get length of line 1 / line 2
    const lineLength1 = Math.hypot(
      mid.x - start.x,
      mid.y - start.y
    );
    const lineLength2 = Math.hypot(
      end.x - mid.x,
      end.y - mid.y
    )

    // Get tag1 / tag2 start progress
    const tag1Start = (lineLength1 / 2) - (tag1Width / 2);
    const tag1StartProg = tag1Start / lineLength1;
    const tag2Start = (lineLength2 / 2) - (tag2Width / 2);
    const tag2StartProg = tag2Start / lineLength2;

    // Draw line 1 function
    function drawLine1() {
      // Clear canvas
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      // Interpolate line length
      const aniX = start.x + (mid.x - start.x) * localProg;
      const aniY = start.y + (mid.y - start.y) * localProg;

      // Set line styles / position / length
      ctx.strokeStyle = '#8acdff';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(start.x, start.y);
      ctx.lineTo(aniX, aniY);
      ctx.stroke();

      // Call drawCircle helper
      drawCircles();

      // If localProg larger than or equal to tag1StartProg get middle / call drawTag helper
      if(localProg >= tag1StartProg) {
        const mid1 = {
          x: (start.x + mid.x) / 2,
          y: (start.y + mid.y) / 2
        };
        drawTag(start, mid, mid1, tag1Text, tag1StartProg, localProg);

      }

      // Increment localProg
      localProg = Math.min(localProg + speed, 1);

      // If localProg incomplete loop drawLine1 / else call drawStaticLine helper for line 1 / reset localProg / call drawLine2 function
      if(localProg < 1) {
        requestAnimationFrame(drawLine1);
      } else {
        drawStaticLine(start, mid, tag1Text);
        localProg = 0;
        requestAnimationFrame(drawLine2)
      }
    }

    // Draw line 2 function
    function drawLine2() {
      // Clear canvas / interpolate / set styles, position, length / draw static line1 / draw circles / check tag2 progress + draw
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

      // Increment localProg
      localProg = Math.min(localProg + speed, 1);

      // If localProg incomplete loop drawLine2 / otherwise drawStaticLine for line 2
      if(localProg < 1) {
        requestAnimationFrame(drawLine2);
      } else {
        drawStaticLine(mid,end,tag2Text);
      }
    }
    // Initial line1 call
    drawLine1();
  }

  // Draw loop function
  function drawLoop() {
    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Get start / middle / end / back centers
    const [start, mid, end, back] = centers;
    // Get tag1 / tag2 / tag3
    const [tag1Text, tag2Text, tag3Text] = tags;

    // Get tag widths
    const tag1Width = ctx.measureText(tag1Text).width;
    const tag2Width = ctx.measureText(tag2Text).width;
    const tag3Width = ctx.measureText(tag3Text).width;

    // Set localProg
    let localProg = 0;

    // Get line lengths
    const line1Length = Math.hypot(mid.x - start.x, mid.y - start.y);
    const line2Length = Math.hypot(end.x - mid.x, end.y - mid.y);
    const line3Length = Math.hypot(back.x - end.x, back.y - end.y);

    // Get tag start progress
    const tag1StartProg = ((line1Length / 2) - (tag1Width / 2)) / line1Length;
    const tag2StartProg = ((line2Length / 2) - (tag2Width / 2)) / line2Length;
    const tag3StartProg = ((line3Length / 2) - (tag3Width / 2)) / line3Length;

    // Draw line function
    function drawLine(startPoint, endPoint, tag, tagStartProg, prog) {
      // Interpolate line length
      const aniX = startPoint.x + (endPoint.x - startPoint.x) * prog;
      const aniY = startPoint.y + (endPoint.y - startPoint.y) * prog;

      // Set line styles / position / length
      ctx.strokeStyle = '#8acdff';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(startPoint.x, startPoint.y);
      ctx.lineTo(aniX, aniY);
      ctx.stroke();

      // Get midpoint
      const midPoint = {
        x: (startPoint.x + endPoint.x) / 2,
        y: (startPoint.y + endPoint.y) / 2
      };

      // If prog larger than or equal to tagStartProg call drawTag helper
      if(prog >= tagStartProg) {
        drawTag(startPoint, endPoint, midPoint, tag, tagStartProg, prog);
      }
    }

    // Step 1 function
    function step1() {
      // Clear canvas / draw line1 / draw circles / increment localProg / check localProg / loop step1 or call helpers & step2
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

    // Step 2 function
    function step2() {
      // Clear canvas / draw line1 / draw line2 / draw circles / increment localProg / check localProg / loop step2 or call step 3 * helpers
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

    // Step 3 function
    function step3() {
      // Clear canvas / draw line1 + line2 + line3 / draw circles / increment localProg / check localProg / loop step3 or helper functions
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
    // Initial step1 call
    requestAnimationFrame(step1);
  }

  // Check linked length / call proper draw function
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

// Create canvas function
function createCanvas() {
  // Create canvas / set id / set styles / append to body / return canvas
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


// Project animation functions / set distance / add animation class

function animateProjectCardRow1(card) {
  card.style.setProperty('--project-ani-dist', `${window.innerWidth + projectCardWidth * 2}px`);
  card.classList.add('project-ani');
}
function animateProjectCardRow2(card) {
  card.style.setProperty('--project-ani-dist', `-${window.innerWidth + projectCardWidth * 2}px`);
  card.classList.add('project-ani');
}
function animateProjectCardRow3(card) {
  card.style.setProperty('--project-ani-dist', `${window.innerWidth + projectCardWidth * 2}px`);
  card.classList.add('project-ani');
}



/* ------------------- TEAM FUNCTIONS ------------------- */

function getEmpWidth() {
  empCardWidth = parseInt(getComputedStyle(body).getPropertyValue('--employee-card-width').slice(0,-2));
}

// Initialize card index / card width
let empCardIndex = 0;
let empCardWidth = 288;

function buildEmpCards() {
  // Build employee cards
  employees.forEach((employee, index) => {
    // Create card div / add classes
    const card = document.createElement('div');
    card.classList.add('main-employee-card');
    card.classList.add('d-flex');

    // Create front / add classes
    const front = document.createElement('div');
    front.classList.add('employee-card-front', 'employee-card-face');

    // Create back / add classes
    const back = document.createElement('div');
    back.classList.add('employee-card-back', 'employee-card-face');

    // Create link / set href / add class
    const link = document.createElement('a');
    link.href = `${employee.linkedIn}`;
    link.classList.add('linked-in-wrap');
    // Create icon / set src / set alt / set target / add classes
    const icon = document.createElement('img');
    icon.src = '/img/i3/linked-in.svg';
    icon.alt = 'LinkedIn';
    icon.target = '_blank';
    icon.classList.add('linked-in');
    // Append icon to link / append link to back
    link.appendChild(icon);
    back.appendChild(link);

    // Create textWrap / add class
    const textWrap = document.createElement('div');
    textWrap.classList.add('employee-card-text-wrap');
    // Create name / add class / set text
    const name = document.createElement('h4');
    name.classList.add('employee-name-main');
    name.innerText = `${employee.name}`;
    // Create title / add class / set text
    const title = document.createElement('h6');
    title.classList.add('employee-title-main');
    title.innerText = `${employee.title}`;
    // Create tags / add class / set text
    const tag1 = document.createElement('h6');
    const tag2 = document.createElement('h6');
    tag1.classList.add('employee-tag');
    tag2.classList.add('employee-tag');
    tag1.innerText = employee.tags[0];
    tag2.innerText = employee.tags[1];
    // Create tag wrapper / add class / append tags
    const tagWrapper = document.createElement('div');
    tagWrapper.classList.add('employee-tag-wrapper');
    tagWrapper.appendChild(tag1);
    tagWrapper.appendChild(tag2);

    // Append name, title, tagWrapper to textWrap / append textWrap to front
    textWrap.appendChild(name);
    textWrap.appendChild(title);
    textWrap.appendChild(tagWrapper);
    front.appendChild(textWrap);

    // Set gradient / create gradient / add class / append to front
    card.style.setProperty('--gradient-start', `rgba(${employee.gradient}, .7)`);
    card.style.setProperty('--gradient-end', `rgba(${employee.gradient}, 0)`);
    const gradient = document.createElement('div');
    gradient.classList.add('employee-card-gradient');
    front.appendChild(gradient);

    // Create hover / add class / append to front
    const hover = document.createElement('div');
    hover.classList.add('employee-card-hover');
    front.appendChild(hover);

    // Create img / set src, alt, & loading / add class / append to front
    const img = document.createElement('img');
    img.src = `${employee.img}`;
    img.alt = `${employee.name}`;
    img.classList.add('employee-card-img');
    img.loading = 'lazy';
    front.appendChild(img);

    const border = document.createElement('div');
    border.classList.add('employee-card-border');
    front.appendChild(border);


    // Append front & back to card
    card.appendChild(front);
    card.appendChild(back);

    // Create cardWrap / add class / append card to wrap / set wrap id / append wrap to row
    const cardWrap = document.createElement('div');
    cardWrap.classList.add('employee-card-wrap');
    cardWrap.appendChild(card);
    cardWrap.id = `${employee.id}-card`;
    teamRow.appendChild(cardWrap)

    cardWrap.style.left = 'calc(-1.5 * var(--employee-card-width))';

  });
  setTimeout(startEmpAni, 250);
}

let empChainStart = 0;

function startEmpAni() {
  [...teamRow.children].forEach(card => card.classList.remove('employee-ani'));
  const delay = parseInt(getComputedStyle(body).getPropertyValue('--employee-ani-del').slice(0, -2));
  const duration = parseInt(getComputedStyle(body).getPropertyValue('--employee-ani-dur').slice(0, -2));
  const cards = [...teamRow.querySelectorAll('.employee-card-wrap')];
  let chainStart = false;
  const preload = duration - delay;
  if(!teamStarted) {
    cards[0].addEventListener('animationend', () => {
      cards[0].classList.remove('employee-ani');
    })
  }


  cards.forEach((card, i) => {
    const startTime = i * delay;
    if(startTime < preload) {

      const offset = preload - startTime;
      card.style.animationDelay = `-${offset}ms`;
      animateEmployeeCard(card);
    } else if(!chainStart) {
      chainStart = true;
      const initialDelay = delay - (preload % delay);
      if(!teamStarted) {
        card.addEventListener('animationstart', () => {
          let next = card.nextElementSibling;
          if(!next) next = teamRow.firstElementChild;
          animateEmployeeCard(next);
          setEmpCardListeners();
        }, {once:true});
      }
      card.style.animationDelay = `${initialDelay}ms`;


      animateEmployeeCard(card);
    }
  });
  if(teamOnScreen) playTeam();
  if(!teamStarted) teamStarted = true;
}

// Set card styles function
function setEmpCardListeners() {
  const delay = getComputedStyle(body).getPropertyValue('--employee-ani-del');
  if(!isMobile) {
    for(let card of teamRow.children) {
      card.addEventListener('animationstart', function nextCard() {
        let next = card.nextElementSibling;
        if(!next) next = teamRow.firstElementChild;
        //next.style.animationDelay = delay;
        animateEmployeeCard(next);
      })
      card.addEventListener('animationend', function resetCard() {
        card.classList.remove('employee-ani');
      })
      card.addEventListener('mouseenter', () => {
        cardHover(card);
      });
      card.addEventListener('mouseleave', () => {
        disableHover();
      });
    }
  } else {
    for(let card of teamRow.children) {
      card.addEventListener('animationstart', function nextCard() {
        let next = card.nextElementSibling;
        if(!next) next = teamRow.firstElementChild;
        next.style.animationDelay = delay;
        animateEmployeeCard(next);
      })
      card.addEventListener('animationend', function resetCard() {
        card.classList.remove('employee-ani');
      })
      card.addEventListener('touchend', (event) => {
        event.stopPropagation();
        cardTouchHover(card);
      }, {once:true});
    }
  }
}

let teamMobileHovers = [];
let teamMobileHover = false;

function cardTouchHover(card) {
  teamMobileHovers.push(card);
  pauseTeam();
  card.querySelector('.main-employee-card').style.transform = 'translateX(35px)';
  card.querySelector('.employee-card-border').style.transform = 'none';
  card.querySelector('.linked-in-wrap').style.opacity = '1';
  card.querySelector('.linked-in-wrap').style.pointerEvents = 'all';
  card.querySelector('.linked-in').style.opacity = '1';

  card.addEventListener('touchend', (event) => {
    event.stopPropagation();
    teamMobileHovers.splice(teamMobileHovers.indexOf(card), 1);
    playTeam();

    card.addEventListener('touchend', (event) => {
      event.stopPropagation();
      cardTouchHover(card);
    }, {once:true})
  }, {once:true})

}

function cardHover(hoveredCard) {
  pauseTeam();
  hoveredCard.querySelector('.main-employee-card').style.transform = 'translateX(35px)';
  hoveredCard.querySelector('.employee-card-border').style.transform = 'none';
  hoveredCard.querySelector('.linked-in-wrap').style.opacity = '1';
  hoveredCard.querySelector('.linked-in-wrap').style.pointerEvents = 'all';
  hoveredCard.querySelector('.linked-in').style.opacity = '1';
}

function pauseTeam() {
  teamAnimating = false;
  for (let card of teamRow.children) {
    const rect = card.getBoundingClientRect();
    card.style.animationPlayState = 'paused';
    if (rect.left < window.innerWidth - 25 && rect.right > 10) {
      card.querySelector('.main-employee-card').style.transform = 'translateX(35px) rotateX(-180deg)'
    }
  }
}
function playTeam() {
  teamAnimating = true;
  for(let card of teamRow.children) {
    card.style.animationPlayState = 'running';
    card.querySelector('.main-employee-card').style.transform = 'translateX(0) rotateX(-180deg)';
    card.querySelector('.employee-card-border').style.transform = 'translateX(-20px) translateY(-20px)';
    card.querySelector('.linked-in-wrap').style.opacity = '0';
    card.querySelector('.linked-in-wrap').style.pointerEvents = 'none';
    card.querySelector('.linked-in').style.opacity = '0';
  }
}

function disableHover() {
  playTeam();
}




// Animation function / set distance / add animation class
function animateEmployeeCard(card, start = false) {
  card.style.setProperty('--employee-ani-dist', `${window.innerWidth + empCardWidth + (empCardWidth/2)}px`);
  card.classList.add('employee-ani');
}