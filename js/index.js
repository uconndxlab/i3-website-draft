// Import dynamic data
import projects from './projectData.js';
import employees from './employeeData.js';

console.log('window', window.gsap)

/* ------------------- ESSENTIAL ELEMENT VARIABLE INITIALIZATION ------------------- */

// Define body element
const body = document.querySelector('body');

const consistentOverlay = document.querySelector('.consistent-overlay');
const storyContainer = document.querySelector('.story-container');

// Define UConn header rect
const ucHeaderRect = document.getElementById('uc-header').getBoundingClientRect();

// Define list of sections / section content
const sections = document.querySelectorAll('.section');
const sectionConts = document.querySelectorAll('.section-content');

// Define 'what we do' row
const whatWeDoRow = document.querySelector('#what-we-do-row');

// Define project rows
const projectRowWrap = document.querySelector('.project-row-wrapper');
const projectsRow1 = document.querySelector('#row-1');
const projectsRow2 = document.querySelector('#row-2');
let projectsRow3;

// Define team columns
const teamColWrap = document.querySelector('.team-col-wrapper-fixed');
const teamColLeft = document.getElementById('col-left');
const teamColRight = document.getElementById('col-right');

const footer = document.querySelector('footer');


/* ------------------- TRACKER INITIALIZATION ------------------- */

// Initialize slider position tracker
let sliderPos = 0;

// Initialize scrolling boolean / scroll timeout trackers
let scrolling = false;
let scrollStopTimeout;
let gsapScrolling = false;
let sliderScrolling = false;

// Track if starBG is faded
let starsFaded = false;

// Initialize sectionOnScreen trackers
let heroOnScreen = false;
let forUniOnScreen = false;
let byUniOnScreen = false;
let footerOnScreen = false;

// Initialize animationOnScreen trackers
let projectsOnScreen = true;
let teamAniOnScreen = false;

// Initialize active animation trackers / animation update trackers
let forUniLooping = false;

let projectsAnimating = false;
let updateProjects = true;

let teamAnimating = false;
let updateTeam = false;

let footerAnimated = false;




// TEMPORARY BACKGROUND COLOR EFFECT ON MOBILE ONLY, WILL BE CHANGED TO USE OVERLAY
let bgColor = 0;

// Define background colors
const bgColors = [
  'rgb(38,38,38)',
  'rgba(10,22,38,.25)',
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

window.addEventListener('resize', () => {
  // Call star background resize
  resizeStarBG(windowWidth);

  windowWidth = window.innerWidth;
  getProjectWidth();
  getTeamCardSize();

});



// Initialize mouse position variable
const mousePos = {x: 0, y: 0};

// Get mouse position on mouse move
window.addEventListener('mousemove', (event) => {
  mousePos.x = event.clientX
  mousePos.y = event.clientY - (ucHeaderRect.height / 2);
});

// Pause animations when unfocused
document.addEventListener('visibilitychange', () => {
  if(document.hidden) {

    if(teamAnimating) pauseTeam();
    if(projectsAnimating) pauseProjects();
    if(forUniLooping) {
      endForUniLoop();
      forUniLooping = false;
    }
  // Play animated elements when refocused
  } else {
    if(teamAniOnScreen) playTeam();
    if(projectsOnScreen) playProjects();
    if(forUniOnScreen) {
      startForUniLoop();
      forUniLooping = true;
    }
  }
});

// Scroll listener (REPLACED WITH GSAP ON PC, WILL BE USED FOR MOBILE)
window.addEventListener('scroll', (event) => {

});


/* ------------------- INITIAL LOAD FUNCTIONS ------------------- */
// LOAD FUNCTIONS WILL BE ADJUSTED TO ADAPT TO SCREEN BREAKPOINT POST-LARAVEL IMPLEMENTATION
// MOBILE LOAD NEEDS ADJUSTMENT

// Mobile load
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
/*
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
        if(!forUniOnScreen) {

          // Update story visibility tracker
          forUniOnScreen = true;

          // Check story loop tracker
          if(!forUniLooping) {

            // Start story loop
            startForUniLoop();

            // Update story loop tracker
            forUniLooping = true;
          }
        }

        // Check story head animated tracker


        // If story not on screen
      } else {

        // Check story visibility tracker
        if(forUniOnScreen) {

          // Update story visibility tracker
          forUniOnScreen = false;

          // Check story loop tracker
          if(forUniLooping) {

            // End story loop
            endForUniLoop();

            // Update story loop tracker
            forUniLooping = false;
          }
        }
      }
    });
  }, {threshold: .25});

// Observe story row
  storyRowObserver.observe(storyContainer);
*/

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

        // Check project visibility tracker
        if (!projectsOnScreen) {
          // Update project visibility tracker
          projectsOnScreen = true;

          if (!projectsAnimating) {
            // Play project animation
            //playProjects();
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



        // Check/update team visibility + animation trackers
        if(!byUniOnScreen) {
          byUniOnScreen = true;
          if(!teamAnimating) {
            //playTeam();
            console.log('team playing')
          }
        }

        // If team not on screen
      } else {

        // Check/update team visibility + animation trackers
        if(byUniOnScreen) {
          byUniOnScreen = false;
          if(teamAnimating) {
            //pauseTeam();
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


}


// PC LOAD
function loadPC() {


  // Register GSAP plugins
  window.gsap.registerPlugin(ScrollSmoother, ScrollToPlugin, ScrollTrigger, Observer);
  const smoother = window.ScrollSmoother.create({
    wrapper: '#gsap-wrapper',
    content: '#gsap-content',
    smooth: 1.5,
    effects: true,
    onUpdate: () => {
      // Track scrolling / play animations on scroll if on screen
      if (!scrolling) scrolling = true;
      if(projectsOnScreen) {
        playProjects();
      } else {
        pauseProjects();
      }
      if(teamAniOnScreen) {
        playTeam();
      } else {
        pauseTeam();
      }
      // Stop animations after scroll end (short timeout buffer)
      clearTimeout(scrollStopTimeout);
      scrollStopTimeout = setTimeout(() => {
        if(heroOnScreen) {
          playProjects();
        } else {
          pauseProjects();
        }
        pauseTeam();
        scrolling = false;
      }, 100);
    }

  })

  // Set GSAP pin sizes
  let gsapPin = '+=500vh';

  if (window.innerWidth < 1200) {
    gsapPin = '+=300vh';
  } else if (window.innerWidth < 1500) {
    gsapPin = '+=400vh';
  }

  // Set each section as a GSAP pin
  window.gsap.utils.toArray('.section').forEach(section => {
    window.ScrollTrigger.create({
      trigger: section,
      start: "center center",
      end: gsapPin,
      pin: true,
      pinSpacing: true,
      markers: false
    });
  });


  // Observe section content
  for (let section of sectionConts) {
    const sectionObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          if(section === sectionConts[0]) {
            heroObserve();
            if(sliderPos !== 0) changeProgSlider(0);
          } else if(section === sectionConts[1]) {
            if(sliderPos !== 1) changeProgSlider(1);
            if(heroOnScreen) heroOnScreen = false;
            whatWeDoObserve();
          } else if(section === sectionConts[2]) {
            if(sliderPos !== 2) changeProgSlider(2)
            forUniObserve();
          } else if(section === sectionConts[3]) {
            if(sliderPos !== 3) changeProgSlider(3)
            teamObserve();
          }


          // GSAP scroll to section upon enter
          if(!sliderScrolling) {
            gsapScrolling = true;

            window.gsap.to(window, {
              duration: 1,
              scrollTo: {y: section},
              ease: 'power2.inOut',
              onComplete: () => {
                gsapScrolling = false;
              }
            })
          }
        }
      })
    }, {threshold: .15});
    sectionObserver.observe(section);
  }

  // Move project row with scroll
  window.gsap.fromTo(projectRowWrap,
    {yPercent: 50, opacity: 1, rotate: -15},
    {
      yPercent: -45,
      rotate: -15,
      opacity: 0.2,
      ease: 'none',
      scrollTrigger: {
        trigger: sections[0],
        start: 'bottom bottom',
        endTrigger: sections[1],
        end: 'top top',
        scrub: true,
      }

    }
  )

  // FWOOP "What We Do" content
  window.gsap.fromTo(whatWeDoRow,
    {yPercent: 50},
    {
      yPercent: -60,
      ease: 'power3.in',
      scrollTrigger: {
        trigger: sections[0],
        start: 'bottom bottom',
        endTrigger: sections[1],
        end: 'bottom bottom',
        scrub: true
      }
    }
    );


  function heroObserve() {

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
    consistentOverlay.style.opacity = '0';

    // Check slider position / call slider change
    if (sliderPos !== 0 && !sliderScrolling) {
      changeProgSlider(0);
    }

    // Check hero visibility tracker
    if (!heroOnScreen) {

      // Update hero visibility tracker
      heroOnScreen = true;
    }
    // Check frame loop tracker
    if (!frameLooping && frameTestPass) {

      // Update frame loop tracker
      frameLooping = true;
      requestAnimationFrame(animateFrame)
    }

      // Check if star bg animated in, call gravity animation
    if(!projectsOnScreen) projectsOnScreen = true;
    playProjects();

  }

  function whatWeDoObserve() {
    if (!starsFaded) {

      // Fade stars out
      canvas.style.opacity = '0';

      // After faded out listener
      canvas.addEventListener('transitionend', function starsFadedOut() {

        // Remove listener
        canvas.removeEventListener('transitionend', starsFadedOut);

        // Update star fade tracker
        starsFaded = true;

        if(frameLooping) frameLooping = false;

        // Set canvas display
        canvas.style.display = 'none';
      })
    }

    // Change overlay color / opacity
    consistentOverlay.style.backgroundColor = 'rgb(38,38,38)';
    consistentOverlay.style.opacity = '.8';

    // Check teamAni visibility / fade out
    if(teamAniOnScreen) {
      teamAniOnScreen = false;
      teamColWrap.style.opacity = '0';
    }

  }

  function forUniObserve() {


    // Check star fade tracker
    if (!starsFaded) {

      // Fade stars out
      canvas.style.opacity = '0';

      // After faded out listener
      canvas.addEventListener('transitionend', function starsFadedOut() {

        // Remove listener
        canvas.removeEventListener('transitionend', starsFadedOut);

        if(frameLooping) frameLooping = false;


        // Update star fade tracker
        starsFaded = true;

        // Set canvas display
        canvas.style.display = 'none';
      })
    }

    // Check if scrolling up from byUni
    if(byUniOnScreen) {
      byUniOnScreen = false;
      projectsOnScreen = true;

      // Fade / FWOOP project rows down
      projectRowWrap.style.transition = 'transform .75s ease-in, opacity 1s';
      projectRowWrap.style.opacity = '.2';
      projectRowWrap.style.transform = 'translateY(-45%) rotate(-15deg)';
      projectRowWrap.addEventListener('transitionend', () => {
        playProjects();
        projectRowWrap.style.transition = ''
      }, {once:true});

      // Peek team columns at bottom of section
      teamColWrap.style.transform = 'translateY(85%)'

      // Change overlay color / ensure visibility
      consistentOverlay.style.opacity = '.8';
      consistentOverlay.style.backgroundColor = '#0A1626'
    }

    // Check story visibility tracker
    if (!forUniOnScreen) {

      // Update story visibility tracker
      forUniOnScreen = true;

      // Check story loop tracker
      if (!forUniLooping) {

        // Start story loop
        startForUniLoop();

        // Update story loop tracker
        forUniLooping = true;
      }
    }

    // Ensure projects playing
    if(!projectsOnScreen) projectsOnScreen = true;
    playProjects();
    
    // Ensure teamAni playing + visible
    if(!teamAniOnScreen) {
      teamAniOnScreen = true;
      teamColWrap.style.opacity = '1';
    }
    playTeam();

    // Change overlay color / ensure visiblity
    consistentOverlay.style.backgroundColor = '#0A1626';
    consistentOverlay.style.opacity = '.8';



  }

  function teamObserve() {
    if(!byUniOnScreen) byUniOnScreen = true;
    if(!teamAniOnScreen) teamAniOnScreen = true;

    // FWOOP team columns down / up from footer + ensure visibility
    teamColWrap.style.transform = 'translateY(-50%)';
    teamColWrap.style.opacity = '1';
    playTeam();

    // FWOOP project rows up / fade
    projectRowWrap.style.transition = 'transform .75s ease-in, opacity 1s';
    projectRowWrap.style.opacity = '0';
    projectRowWrap.style.transform = 'translateY(-125%)';
    projectRowWrap.addEventListener('transitionend', () => {
      pauseProjects();
      projectRowWrap.style.transition = ''
    }, {once:true})

    // Change overlay color / ensure visibility
    consistentOverlay.style.backgroundColor = '#180028'
    consistentOverlay.style.opacity = '.8';
  }

  // Dedicated footer observer
  const footerObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        if (!footerOnScreen) {
          footerOnScreen = true;
        }

        if(projectsOnScreen) {
          projectRowWrap.style.opacity = '0';
          projectsOnScreen = false;
        }

        if(sliderPos !== 4 && !sliderScrolling) {
          changeProgSlider(4);
        }

        // Animate footer up if not yet
        if (!footerAnimated) {
          footer.classList.add('footer-ani');
          footerAnimated = true;
        }

        // FWOOP team animation out
        if(teamAniOnScreen) teamAniOnScreen = false;
        if(byUniOnScreen) {
          byUniOnScreen = false;
          teamColWrap.style.transform = 'translateY(-100%)';
          teamColWrap.style.opacity = '0';
        }
        pauseTeam();

        // Fade overlay
        consistentOverlay.style.opacity = '0';
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


  playProjects();


  // SLIDER ELEMENT / TRACKER / VARIABLE INITIALIZATION
  const slider = document.querySelector('#progress-slider');
  let sliderScrolling = false;

  // Set slider canvas height
  slider.height = slider.offsetHeight;
  slider.width = slider.offsetWidth;

  // Get CTX
  const sliderCTX = slider.getContext('2d');

  // Track hover boolean / current hovered circle / hover animating
  let sliderHovered = false;
  let circleHover = null;
  let hoverAnimating = false;

  // Track radii of circles
  let hoverRadius = [10, 10, 10, 10, 10]

  // Set circle default / hovered radii
  let radius = 10;
  let hoverMax = 15;

  // Set circle count / space / center position
  const circleCount = 5;
  const circleSpace = slider.height / circleCount;
  const centerX = slider.width / 2;

  // Set CTX styles
  sliderCTX.fillStyle = '#f1f1f1';
  sliderCTX.strokeStyle = '#f1f1f1';
  sliderCTX.lineWidth = 2;

  // Track circle opacity
  let circleOpacity = 0;

  // CREATE SLIDER
  function createProgressSlider() {
    sliderCTX.clearRect(0, 0, slider.width, slider.height);

    // Draw lines between circles
    for (let i = 0; i < circleCount - 1; i++) {
      // Get top / bottom of each circle
      const y1 = (i + 0.5) * circleSpace;
      const y2 = (i + 1 + 0.5) * circleSpace;

      // Get radius of each circle
      const r1 = hoverRadius[i]
      const r2 = hoverRadius[i + 1];

      // Draw line between circles
      sliderCTX.beginPath();
      sliderCTX.moveTo(centerX, y1 + r1);
      sliderCTX.lineTo(centerX, y2 - r2);
      sliderCTX.stroke();
    }

    // Draw circles
    for (let i = 0; i < circleCount; i++) {
      // Get y position
      let y = (i + 0.5) * circleSpace;

      // Draw circle with radius
      sliderCTX.beginPath();
      sliderCTX.arc(centerX, y, hoverRadius[i], 0, Math.PI * 2);
      // Set fill based on sliderPos
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

  // CHANGE SLIDER POSITION
  function changeProgSlider(newPos) {
    // Set sliderPos / reset circle opacity
    sliderPos = newPos;
    circleOpacity = 0;

    // Animate function
    function animate() {
      sliderCTX.clearRect(0, 0, slider.width, slider.height);

      // Draw lines
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

      // Draw circles
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
      // Update circle opacity
      circleOpacity = Math.min(circleOpacity + .05, 1);

      // Continue animating until circle filled
      if (circleOpacity < 1) {
        requestAnimationFrame(animate)
      }
    }

    // Call animate
    animate();

  }

  // Initialize slider specific mouse position
  let sliderMousePos = {x: 0, y: 0}

  // Add slider hover listeners / update sliderHover tracker / call sliderHover function
  slider.addEventListener('mouseenter', () => {
    slider.addEventListener('mousemove', getSliderMousePos);
    slider.addEventListener('click', sliderClick);
    if (!sliderHovered) sliderHovered = true;
    progSliderHover();
  });

  // Remove slider hover listeners / reset mouse position
  slider.addEventListener('mouseleave', () => {
    slider.removeEventListener('mousemove', getSliderMousePos);
    sliderMousePos.x = 0;
    sliderMousePos.y = 0;
    slider.removeEventListener('click', sliderClick);

  })

  // GET SLIDER MOUSE POS
  function getSliderMousePos(event) {
    const rect = slider.getBoundingClientRect();

    sliderMousePos.x = event.clientX - rect.left;
    sliderMousePos.y = event.clientY - rect.top;
  }

  // SLIDER HOVER FUNCTION
  function progSliderHover() {
    sliderCTX.clearRect(0, 0, slider.width, slider.height);

    // Draw lines
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

    // Reset circle hover
    circleHover = null;

    // Check if mouse over circle
    for (let i = 0; i < circleCount; i++) {
      // Get circle y
      let y = (i + 0.5) * circleSpace;

      // Get distance from circle to mouse
      let dx = sliderMousePos.x - centerX;
      let dy = sliderMousePos.y - y;
      let dist = Math.sqrt(dx * dx + dy * dy);
      // If distance under max radius set circleHover to current circle
      if (dist < hoverMax) {
        circleHover = i;
      }
    }

    // Set circle radii
    for (let i = 0; i < circleCount; i++) {
      // If circle hovered grow radius
      if (i === circleHover) {
        hoverRadius[i] += 0.075;
        if (hoverRadius[i] > hoverMax) hoverRadius[i] = hoverMax;
      } else {
        // If not hovered and circle radius larger than default shrink radius
        if (hoverRadius[i] > radius) {
          hoverRadius[i] = Math.max(hoverRadius[i] - 0.075, 10);
        }
      }
    }

    // Draw circles
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
    // Check if any circles larger than default radius
    hoverAnimating = hoverRadius.filter(radius => radius > 10).length !== 0;

    // If currently hovered or any circles still shrinking loop frame
    if (sliderHovered || hoverAnimating) requestAnimationFrame(progSliderHover);
  }

  // SLIDER CLICK FUNCTION
  function sliderClick() {
    // Check mouse position for over circle
    for (let i = 0; i < circleCount; i++) {
      let y = (i + 0.5) * circleSpace;
      let dx = sliderMousePos.x - centerX;
      let dy = sliderMousePos.y - y;
      let dist = Math.sqrt(dx * dx + dy * dy);
      if (dist < hoverMax) {
        let scrollTo;
        // If section is 4 (footer) scroll to end of page otherwise scroll to section
        if(i === 4) {
          scrollTo = body.offsetHeight;
        } else {
          scrollTo = sections[i];
        }

        // Update scroll trackers
        gsapScrolling = true;
        sliderScrolling = true;

        // Call corresponding observe functions
        switch(i) {
          case 0:
            heroObserve();
            break;
          case 1:
            whatWeDoObserve();
            break;
          case 2:
            forUniObserve();
        }


        window.gsap.to(window, {
          duration: 1,
          scrollTo: {y: scrollTo},
          ease: 'linear',
          onComplete: () => {
            gsapScrolling = false;
            sliderScrolling = false;
            if(projectsOnScreen) playProjects();
            if(teamAniOnScreen) playTeam();
          }
        })

        // Set sliderPos / call change function
        changeProgSlider(sliderPos);
      }
    }
  }

  // INCOMPLETE KEYBOARD ACCESSIBILITY
/*  window.addEventListener('keydown', (keyEvent) => {
    if(keyEvent.key === 'Tab'){
      console.log('tab')
      keyboardNavigate();
    }
  })*/


  // Call slider creation
  createProgressSlider();


  // Get project / team card sizes
  getProjectWidth();
  getTeamCardSize();


}





/*
function keyboardNavigate() {
  console.log('keyboard')
  keyboardNavigating = true;
  pauseProjects();
  pauseTeam();

  [...projectsRow1.children].forEach(project => {
    project.firstElementChild.addEventListener('focus', (event) => {
      project.firstElementChild.classList.add('project-card-hover');
      project.firstElementChild.style.transform = 'translateX(50px) scale(1.1)';
      const border = project.querySelector('.project-wrapper-border');
      border.style.transform = 'translateX(50px) translateY(0)';
      border.style.opacity = '0';
    });

  })

}
*/


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


// Define forUConn span
const forUconn = document.getElementById('forUconn');




// Initialize dynamic variables
let charWidth;
let widths = [];
let phraseLengths = [];
let fontSize;
let charDist;
let maxPhraseLength = 0;
let spaceCharSize = 0;

// Track which phrase
let currPhrase = 0;
let moveText1Phrase = 0;
let moveText2Phrase = 0;

// Set text color
let color = '#8dc1ff';

// Set forUConn styles
forUconn.style.marginLeft = '8px';
forUconn.style.transform = `translateX(${-(phraseLengths[currPhrase] + spaceCharSize)}px)`;


setCharWidths();
// Get character widths / phrase lengths
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

  // Reset phrase lengths
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

  // moveText1 + 2 to largest phrase width
  maxPhraseLength = Math.max(...phraseLengths);
  moveText.style.width = `${maxPhraseLength + charDist}px`;
  moveText2.style.width = `${maxPhraseLength + charDist}px`;
}



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
  // Reset frame count after 1 second
  if(now - lastLogTime >= 1000 && bufferComplete) {
    console.log('frames:', frameCount);
    frameCount = 0;
    lastLogTime = now;
  }

  // If past buffer start tracking frames
  if(now >= testBuffer && !bufferComplete) {
    bufferComplete = true;
    lastLogTime = now;
    testStart = now;
    frameCount = 0;
    totalFrames = 0;
    console.log('testing');
  }

  // Call test star interaction function
  testStarPull();

  // Increment frameCount / totalFrames
  totalFrames++;
  frameCount++;

  // If frame test over
  if(now >= frameTest + testStart) {
    frameTestComplete = true;
    // Remove test canvas
    body.removeChild(performCanvas);
    // Get average FPS
    const avgFPS = totalFrames / ((now - testStart) / 1000);
    console.log(avgFPS)
    // If average FPS larger than 50 test has passed
    if(avgFPS > 50) {
      frameTestPass = true;
      requestAnimationFrame(animateFrame)
    } else {
      frameTestPass = false;
    }
    console.log('frameTest', frameTestPass)
  }
  // Update test mouse position
  testMouse.x = Math.min(testMouse.x + 4, performCanvas.width)
  testMouse.y = Math.min(testMouse.y + 4, performCanvas.height);

  // Loop frame if not complete
  if(!frameTestComplete) requestAnimationFrame(performanceTest);
}


// Track frame looping
let frameLooping = false;
// Call animation frame
function animateFrame(now) {

    animateStarPull();

  // If hero on screen loop frame
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

// Resize star background (NEED TO ADJUST GROWING RESIZE)
function resizeStarBG(prevWidth) {

  const growing = window.innerWidth > prevWidth;
  if(!growing) { resizeSmaller() } else { resizeLarger() }
  function resizeSmaller() {
    canvas.height = window.innerHeight;
    canvas.width = window.innerWidth;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Update section sizes
    sectionWidth = Math.ceil(window.innerWidth / 3);
    sectionHeight = Math.ceil(window.innerHeight / 2);
    horizBreak = Math.floor(window.innerHeight / 2);
    leftVertBreak = Math.floor(window.innerWidth / 3);
    rightVertBreak = Math.floor((window.innerWidth / 3) * 2);

    // Get flat array of all stars
    const flatStars = Object.values(allStars).flat();

    // Reset all stars
    for(const key in allStars) allStars[key] = [];

    // Check stars in window / star section position
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

        // Draw star
        drawStar(star);
      }
    })

    // Update cache offsets / section size / cache updated stars / update speed
    updateCacheSectionOffsets();
    setCachedSectionSize();
    cacheStaticStars();
    updateStarSpeed();

    updateWidth = window.innerWidth;
    updateHeight = window.innerHeight;
  }

  // A LITTLE BUGGY (NEEDS TO PULL STARS FROM A TOTAL SCREEN SIZE STAR ARRAY RATHER THAN CREATE DYNAMICALLY)
  function resizeLarger() {
    updateStarSpeed();

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

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
  const cols = Math.floor(window.innerWidth / spacing) + 1;


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





/* ------------------- FOR THE UNIVERSITY ANIMATION ------------------- */



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
const statTextWrapper = document.querySelector('.for-uni-stat')
const statHead = document.querySelector('#stat-head');
const statSpan = document.querySelector('#stat-span');

// Defining animation variables
let animationLooping = false;
let statNum = 1;
let spinCount = 0
let statTimeout = null;

function startForUniLoop() {
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

function endForUniLoop() {
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



/* ------------------- PROJECTS ANIMATION  ------------------- */

// Initialize project card width variable
let projectCardWidth = 352;

// Get width from css variable
function getProjectWidth() {
  projectCardWidth = parseInt(getComputedStyle(body).getPropertyValue('--project-card-width').slice(0,-2));
}
getProjectWidth();


// Get middle of project array
const projMid = Math.ceil(projects.length / 2);

// Split into 2 arrays
const row1Projects = projects.slice(0, projMid);
const row2Projects = projects.slice(projMid)

// Set desired visible cards on screen / buffer offscreen / total cards to render
let visibleCount = 6;
let buffer = 4;
let totalRendered = visibleCount + buffer;

// Set speed / initial offsets / starting indexes / gap
let speed = 1.25;
let offset1 = 0;
let offset2 = 0;
let startIndex1 = 0;
let startIndex2 = 0;
let projGap = projectCardWidth * .25
// Initialize div arrays
let cardDivs1 = [];
let cardDivs2 = [];


// JAVASCRIPT ELEMENT CREATION
function buildProjects(start1 = 0, start2 = 0) {
  projectsRow1.innerHTML = '';
  projectsRow2.innerHTML = '';
  cardDivs1 = [];
  cardDivs2 = [];

  for (let i = 0; i < totalRendered; i++) {
    let idx1 = (start1 + i) % row1Projects.length;
    let idx2 = (start2 - i + row2Projects.length) % row2Projects.length;

    let card1Wrap = document.createElement('div');
    card1Wrap.className = 'project-wrapper-abs';
    let card1 = document.createElement('div');
    card1.className = 'project-wrapper';
    card1.style.background = `url('${row1Projects[idx1].img}') center center / cover no-repeat`;
    card1Wrap.id = row1Projects[idx1].name;
    card1Wrap.appendChild(card1);
    const card1Border = document.createElement('div');
    card1Border.className = 'project-wrapper-border';
    card1.appendChild(card1Border);
    projectsRow1.appendChild(card1Wrap);
    cardDivs1.push(card1Wrap)

    let card2Wrap = document.createElement('div');
    card2Wrap.className = 'project-wrapper-abs';
    let card2 = document.createElement('div');
    card2.className = 'project-wrapper';
    card2.style.background = `url('${row2Projects[idx2].img}') center center / cover no-repeat`;
    card2Wrap.id = row2Projects[idx2].name;
    const card2Border = document.createElement('div');
    card2Border.className = 'project-wrapper-border';
    card2.appendChild(card2Border);
    card2Wrap.appendChild(card2)
    projectsRow2.appendChild(card2Wrap);
    cardDivs2.push(card2Wrap);
  }
}

buildProjects();

// Animate projects function
// (ASSUMES PROJECT ELEMENTS CREATED ACCORDING TO TOTAL RENDERED VIA LARAVEL)
function animateProjects() {
  // Return if projects don't need to update
  if(!updateProjects) {
    projectsAnimating = false;
    return;
  }
  // Set animating tracker to true
  projectsAnimating = true;

  // Increment / decrement offsets by speed
  offset1 -= speed;
  offset2 += speed;

  // For each div set transform based on offset + index
  for (let i = 0; i < totalRendered; i++) {
    cardDivs1[i].style.transform = `translateX(${(i * (projectCardWidth + projGap)) + offset1}px)`;
    cardDivs2[i].style.transform = `translateX(${(i * (projectCardWidth + projGap)) + offset2}px)`;
  }

  // If offset 1 smaller than project width
  if (offset1 <= -projectCardWidth) {
    // Increment offset by card width + gap
    offset1 += projectCardWidth + projGap;
    // Increment index / loop to start
    startIndex1 = (startIndex1 + 1) % row1Projects.length;

    // Recycle first card in div array
    let recycled = cardDivs1.shift();
    // Set new index to next card in array after total rendered
    let newIdx = (startIndex1 + totalRendered - 1) % row1Projects.length;
    // Update background of card
    recycled.style.background = `url('${row1Projects[newIdx].img}') center center / cover no-repeat`;
    // Push recycled card to end of div array
    cardDivs1.push(recycled);
  }

  // If offset2 larger than width recycle card
  if (offset2 >= projectCardWidth) {
    offset2 -= projectCardWidth + projGap;
    startIndex2 = (startIndex2 - 1 + row2Projects.length) % row2Projects.length;

    let recycled = cardDivs2.pop();
    let newIdx = startIndex2;
    recycled.style.background = `url('${row2Projects[newIdx].img}') center center / cover no-repeat`;
    cardDivs2.unshift(recycled);
  }
  // Loop frame animation
  requestAnimationFrame(animateProjects);
}
// Initialize animation to place projects
animateProjects()


// Play projects if not playing
function playProjects() {
  if(!updateProjects) {
    updateProjects = true;
    if(!projectsAnimating) animateProjects();
  }
}
// Pause projects
function pauseProjects() {
  updateProjects = false;
}



/* ------------------- TEAM ANIMATION ------------------- */

// Initialize card size variables

let teamCardWidth = 288;
let teamCardHeight = 384;

// Get card sizes from css variables
function getTeamCardSize() {
  teamCardWidth = parseInt(getComputedStyle(body).getPropertyValue('--employee-card-width').slice(0, -2));
  teamCardHeight = parseInt(getComputedStyle(body).getPropertyValue('--employee-card-height').slice(0, -2));
}
getTeamCardSize();

// Set visible count / buffer / total to render / speed / indexes / div arrays / gap
let teamVisCount = 3;
let teamBuffer = 2;
let teamTotalRender = teamVisCount + teamBuffer;
let teamSpeed = 2;

let startIdxL = 0;
let startIdxR = 0;
let teamDivsLeft = [];
let teamDivsRight = [];
const teamGap = teamCardHeight * 0.2;

// Split employee array
const teamMid = Math.ceil(employees.length / 2);
const teamLeftObjects = employees.slice(0, teamMid);
const teamRightObjects = employees.slice(teamMid)

// JAVASCRIPT ELEMENT CREATION
function buildTeam(start = 0) {
  teamDivsRight = []
  teamDivsLeft = [];

  for (let i = 0; i < teamTotalRender; i++) {
    let indexL = (start + i) % teamLeftObjects.length;
    let indexR = (start + i) % teamRightObjects.length

    // Left card (default rotated 180deg due to default image rotation to accommodate 3d perspective cards on team page)
    const cardLWrap = document.createElement('div');
    cardLWrap.classList.add('employee-card-wrap');
    cardLWrap.id = `${teamLeftObjects[indexL].id}-card`;

    const cardL = document.createElement('div');
    cardL.classList.add('main-employee-card');
    cardL.style.background = `url(${teamLeftObjects[indexL].img}) center center / cover no-repeat`
    cardLWrap.appendChild(cardL)

    const cardLBorder = document.createElement('div');
    cardLBorder.className = 'employee-card-border';
    cardLWrap.appendChild(cardLBorder);
    teamColLeft.appendChild(cardLWrap);
    teamDivsLeft.push(cardLWrap);

    // Right card (No rotation due to whole column being rotated)
    const cardRWrap = document.createElement('div');
    cardRWrap.classList.add('employee-card-wrap');
    cardRWrap.id = `${teamRightObjects[indexR].id}-card`;

    const cardR = document.createElement('div');
    cardR.classList.add('main-employee-card');
    cardR.style.background = `url(${teamRightObjects[indexR].img}) center center / cover no-repeat`;
    cardR.style.rotate = 'none';
    cardRWrap.appendChild(cardR)
    const cardRBorder = document.createElement('div');
    cardRBorder.className = 'employee-card-border';
    // Opposite border offset due to column rotation
    cardRBorder.style.transform = 'translateX(20px) translateY(20px)'
    cardRWrap.appendChild(cardRBorder);
    teamColRight.appendChild(cardRWrap);
    teamDivsRight.push(cardRWrap);

  }
}
buildTeam();





// Center cards in wrapper
let teamOffset = -1;

// Animate team function
// ASSUMES TEAM CARDS CREATED ACCORDING TO TOTAL TO RENDER VIA LARAVEL
function animateTeam() {
  // Return if animation doesn't need update
  if (!updateTeam) {
    teamAnimating = false;
    return;
  }
  // Set animating to true
  teamAnimating = true;
  // Increment offset by speed
  teamOffset += teamSpeed;

  // Set transform for each rendered card on left and right
  for (let i = 0; i < teamTotalRender; i++) {
    let y = (i * (teamCardHeight + teamGap)) + teamOffset;
    teamDivsLeft[i].style.transform  = `translateX(-50%) translateY(${y}px)`;
    teamDivsRight[i].style.transform = `translateX(-50%) translateY(${y}px)`;
  }

  // Begin fading cards out if cycle 90* complete
  if(teamOffset >= -(teamCardHeight + teamGap) * .1) {
    teamDivsLeft[teamDivsLeft.length - 1].style.opacity = '0';
    teamDivsRight[teamDivsRight.length - 1].style.opacity = '0';
  }

  // If offset larger than 0
  if (teamOffset >= 0) {
    // Decrement offset by card height + gap
    teamOffset -= teamCardHeight + teamGap;

    // Update each index
    startIdxL = (startIdxL - 1 + teamLeftObjects.length) % teamLeftObjects.length;
    startIdxR = (startIdxR - 1 + teamRightObjects.length) % teamRightObjects.length;

    // Get recycled cards from end of arrays
    let recycledL = teamDivsLeft.pop();
    let recycledR = teamDivsRight.pop();

    // Update recycled card backgrounds
    recycledL.firstElementChild.style.background =
      `url(${teamLeftObjects[startIdxL].img}) center center / cover no-repeat`;
    recycledR.firstElementChild.style.background =
      `url(${teamRightObjects[startIdxR].img}) center center / cover no-repeat`;

    // Set recycled cards opacity to 0 before unshift
    recycledL.style.opacity = '0';
    recycledR.style.opacity = '0';

    // Unshift recycled cards to beginning of div arrays
    teamDivsLeft.unshift(recycledL);
    teamDivsRight.unshift(recycledR);

    // Force reflow so DOM recognizes opacity
    void recycledL.offsetWidth;
    void recycledR.offsetWidth;

    // Set opacity to transition
    recycledL.style.opacity = '1';
    recycledR.style.opacity = '1';
  }

  // Loop animation
  requestAnimationFrame(animateTeam);
}

// Play team animation
function playTeam() {
  if(!updateTeam) {
    updateTeam = true;
    if(!teamAnimating) animateTeam();
  }
}

// Pause team animation
function pauseTeam() {
  updateTeam = false;
}