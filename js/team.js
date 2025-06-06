window.addEventListener('resize', () => {
  resizeTeamCards();
  row1CurrIndex = 0;
  row2CurrIndex = 0;
  row1Delay = 0;
  row2Delay = 0;
  clearCardTimeouts();
  row1TimeoutData = [];
  row2TimeoutData = [];
  setCardWidth();
  setCardSpeed();
  row1.forEach(card => {
    card.classList.remove('student-ani');
    card.style.right = `-${cardWidth}px`;
    void card.offsetWidth;
  });
  row2.forEach(card => {
    card.classList.remove('student-ani');
    card.style.left = `-${cardWidth}px`;
    void card.offsetWidth;
  });
  startAni();
});

window.addEventListener('load', () => {
  setCardWidth();
  setCardSpeed();
  resizeTeamCards();
  rotateCards();
  startAni();
});

document.addEventListener('visibilitychange', () => {
  if(document.hidden) {
    pageHidden = true;
    clearCardTimeouts();
    for(let card of document.querySelectorAll('.student-ani')) {
      card.style.animationPlayState = 'paused';
    }
  } else {
    pageHidden = false;
    for(let card of document.querySelectorAll('.student-ani')) {
      card.style.animationPlayState = 'running';
    }

    row1CurrIndex = 0;
    row2CurrIndex = 0;
    row1Delay = 0;
    row2Delay = 0;
    row1TimeoutData = [];
    row2TimeoutData = [];

    row1.forEach(card => {
      card.classList.remove('student-ani');
      card.style.right = `-${cardWidth}px`;
      void card.offsetWidth;
    });
    row2.forEach(card => {
      card.classList.remove('student-ani');
      card.style.left = `-${cardWidth}px`;
      void card.offsetWidth;
    });

    // Now start again
    startAni();
  }
});

let pageHidden = false;



const team = [
  {
    name: 'Joel Salisbury',
    title: 'Director of i3',
    img: 'img/i3/people/salisbury-narrow.jpg'
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
    img: 'img/i3/people/vert-narrow.jpg'
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
let leftRem = '-20rem';
let rightRem = '20rem';

cards[0].wrapper.addEventListener('animationend', () => {
  cards.forEach(card => {
    if(card.wrapper.classList.contains('left2center-arc')) {
      card.wrapper.classList.remove('left2center-arc');
      card.wrapper.style.transform = 'translateX(0rem) scale(1)';
    }
    else if(card.wrapper.classList.contains('center2right-arc')) {
      card.wrapper.classList.remove('center2right-arc');
      card.wrapper.style.transform = `translateX(${rightRem}) scale(0.6)`;
    }
    else if(card.wrapper.classList.contains('right2left-arc')) {
      card.wrapper.classList.remove('right2left-arc')
      card.wrapper.style.transform = `translateX(${leftRem}) scale(0.6)`;
    }
  })
  randomTeam();
  setTimeout(rotateCards, 2000)
/*  if(sections.team.isOnScreen) {
    setTimeout(rotateCards, 2000)
  } else {
    cards.forEach(card => {
      if(card.position === 'left') { card.wrapper.style.transform = `translateX(${leftRem}) scale(0.6)` }
      else if(card.position === 'center') { card.wrapper.style.transform = `translateX(0) scale(1)` }
      else if(card.position === 'right') { card.wrapper.style.transform = `translateX(${rightRem}) scale(0.6)`}
    })
  }*/
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
  if(window.innerWidth <= 576) {
    leftRem = '-10rem';
    rightRem = '10rem';
  } else if(window.innerWidth <= 768) {
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

const students = [
  {
    name: 'Emma Adams',
    id: 'emma-adams',
    title: 'Student Web Developer',
    img: 'img/i3/people/adams.jpg',
    gradient: '7, 46, 51',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Lauren Busavage',
    id: 'lauren-busav',
    title: 'Student Web Developer',
    img: 'img/i3/people/busavage.png',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Kelis Clarke',
    id: 'kelis-clarke',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Ryan Cohutt',
    id: 'ryan-cohutt',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Maggie Danielewicz',
    id: 'maggie-daniel',
    title: 'Student Web Developer',
    img: 'img/i3/people/danielewicz.jpg',
    gradient: '30, 50, 30',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Luna Gonzalez',
    id: 'luna-gonzal',
    title: 'Student Illustrator',
    img: 'img/i3/people/luna.jpg',
    gradient: '30, 50, 30',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Aaron Mark',
    id: 'aaron-mark',
    title: 'Student Web Developer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Jack Medrek',
    id: 'jack-medrek',
    title: 'Student Software Developer',
    img: 'img/i3/people/medrek.jpg',
    gradient: '1, 7, 41',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Kailey Moore',
    id: 'kailey-moore',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/moore.jpg',
    gradient: '38, 0, 76',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'William Shostak',
    id: 'william-shostak',
    title: 'Student Software Developer',
    img: 'img/i3/people/shostak.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Emelia Salmon',
    id: 'emelia-salmon',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/'
  },
  {
    name: 'Victoria Brey',
    id: 'victoria-brey',
    title: 'Student Web Developer',
    img: 'img/i3/people/jonathan.jpg',
    gradient: '0, 0, 0',
    linkedIn: 'https://linkedin.com/'
  }
]



function clearCardTimeouts() {
  row1Timeouts.forEach(t => clearTimeout(t));
  row1Timeouts = [];
  row2Timeouts.forEach(t => clearTimeout(t))
  row2Timeouts = [];
}

const studentRow1 = document.getElementById('students-row-1');
const studentRow2 = document.getElementById('students-row-2')
/*
function calcStudentRow(cardWidth) {
  const minGap = 25;
  const rowWidth = window.innerWidth;
  const minPeek = cardWidth / 2;
  let cardsOnScreen = Math.floor((rowWidth - 2 * minPeek + minGap) / (cardWidth + minGap));
  cardsOnScreen = Math.max(1, cardsOnScreen);
  cardsOnScreen = Math.min(cardsOnScreen, students.length);
  const gapNum = cardsOnScreen - 1;
  const totalCardWidth = cardsOnScreen * cardWidth;
  let gap = (rowWidth - 2 * minPeek - totalCardWidth) / gapNum;
  if(gap < 25) gap = 25;
  const
}*/

function setCardWidth() {
  if(window.innerWidth < 768) {cardWidth = 288}
  else if(window.innerWidth < 992) {cardWidth = 288}
  else if(window.innerWidth < 1200) {cardWidth = 288}
  else if(window.innerWidth < 1400) {cardWidth = 256}
  else {cardWidth = 320}
}

let row1CurrIndex = 0;
let row2CurrIndex = 0;
let row1NextTimeout = 0;
let row2NextTimeout = 0;
let row1TimeoutData = [];
let row2TimeoutData = [];
let row1Pause = null;
let row2Pause = null;
let row1Timeouts = [];
let row2Timeouts = [];
let speed;
let delay;

function getTimeoutState(timeoutData, currIndex, delay) {
  const now = Date.now();
  const next = timeoutData.find(data => data.index >= currIndex && data.scheduled > now);
  let nextIndex;
  let nextTimeout;
  if(next) { nextIndex = next.index; nextTimeout = Math.max(0, next.scheduled - now) }
  else {nextIndex = 0; nextTimeout = delay;
}
  return {
    nextIndex,
    nextTimeout
  }
}

function setCardSpeed() {
  if(window.innerWidth < 568) {speed = window.innerWidth * 20; delay = (speed / 200 * 100)}
  else if(window.innerWidth < 768) {speed = window.innerWidth * 15; delay = (speed / 250) * 100}
  else if(window.innerWidth < 992) {speed = window.innerWidth * 12; delay = (speed / 375) * 100}
  else if(window.innerWidth < 1200) {speed = window.innerWidth * 9; delay = (speed / 425) * 100}
  else if(window.innerWidth < 1400) {speed = window.innerWidth * 8; delay = (speed / 450) * 100}
  else if(window.innerWidth < 1600) {speed = window.innerWidth * 7; delay = (speed / 500) * 100}
  else {speed = window.innerWidth * 6.5; delay = (speed / 550) * 100}
}
setCardSpeed();

let baseSpeed = .05;

let row1 = [];
let row2 = [];

  let cardWidth = 320;

  let studentsArray1 = [];
  let studentsArray2 = [];

  students.forEach((student, index) => {
    const card = document.createElement('div');
    card.classList.add('team-card-main-student');
    card.classList.add('d-flex');

    const link = document.createElement('a');
    link.href = `${student.linkedIn}`;
    link.classList.add('linked-in-wrap');
    const icon = document.createElement('img');
    icon.src = '/img/i3/linked-in.svg';
    icon.alt = 'LinkedIn';
    icon.target = '_blank';
    icon.classList.add('linked-in');
    link.appendChild(icon);
    card.appendChild(link);

    const textWrap = document.createElement('div');
    textWrap.classList.add('team-card-text-wrap');
    const name = document.createElement('h4');
    name.classList.add('team-name-main');
    name.innerText = `${student.name}`;
    const title = document.createElement('h6');
    title.classList.add('team-title-main');
    title.innerText = `${student.title}`;
    textWrap.appendChild(name);
    textWrap.appendChild(title);

    card.appendChild(textWrap);

    card.style.setProperty('--gradient-start', `rgba(${student.gradient}, .7)`);
    card.style.setProperty('--gradient-end', `rgba(${student.gradient}, 0)`);
    const gradient = document.createElement('div');
    gradient.classList.add('team-card-main-gradient');

    card.appendChild(gradient);

    const img = document.createElement('img');
    img.src = `${student.img}`;
    img.alt = `${student.name}`;
    img.classList.add('team-card-main-img');
    img.loading = 'lazy';

    card.appendChild(img);

    const cardWrap = document.createElement('div');
    cardWrap.classList.add('team-card-main-student-wrap');
    cardWrap.appendChild(card);

    const row2CardWrap = cardWrap.cloneNode(true);
    cardWrap.id = `${student.id}-row-1`;
    row2CardWrap.id = `${student.id}-row-2`;

    if(index < students.length / 2) {
      studentsArray1.push([cardWrap, row2CardWrap])
    } else {
      studentsArray2.push([cardWrap, row2CardWrap])
    }
  })

row1 = [
  ...studentsArray1.map(pair => pair[0]),
  ...studentsArray2.map(pair => pair[0])
]

row2 = [
  ...studentsArray2.map(pair => pair[1]),
  ...studentsArray1.map(pair => pair[1])
]


row1.forEach((card, index) => {
  card.style.right = `-${cardWidth}px`;
  studentRow1.appendChild(card);
  card.addEventListener('mouseenter', () => {
    cardHover(card);
    pauseCards();
  });
  card.addEventListener('mouseleave', () => {
    disableHover(card);
    playCards();
  });
});

row2.forEach((card, index) => {
  card.style.left = `-${cardWidth}px`;
  studentRow2.appendChild(card);
  card.addEventListener('mouseenter', () => {
    cardHover(card);
    pauseCards();
  });
  card.addEventListener('mouseleave', () => {
    disableHover(card);
    playCards();
  });
});

function cardHover(card) {
  card.querySelector('.linked-in-wrap').style.opacity = '1';
  card.querySelector('.linked-in').style.opacity = '1';
  card.querySelector('.team-name-main').style.color = 'dimgray';
  card.querySelector('.team-title-main').style.color = 'dimgray';
}

function disableHover(card) {
  card.querySelector('.linked-in-wrap').style.opacity = '0';
  card.querySelector('.linked-in').style.opacity = '0';
  card.querySelector('.team-name-main').style.color = '#f1f1f1';
  card.querySelector('.team-title-main').style.color = '#f1f1f1';
}

let cardsPaused = false;

let row1PausedIndex = null
let row2PausedIndex = null;
let row1PausedTime = null;
let row2PausedTime = null;

function pauseCards() {
  cardsPaused = true;
  for(let card of document.querySelectorAll('.student-ani')) {
    const rect = card.getBoundingClientRect();
    card.style.animationPlayState = 'paused';

    if(card.id.charAt(card.id.length - 1) === '1') {
      card.querySelector('.team-card-main-student').style.transform = 'translateX(-35px)';
    }
    else {
      card.querySelector('.team-card-main-student').style.transform = 'translateX(35px)'
    }

  }
  const row1State = getTimeoutState(row1TimeoutData, row1CurrIndex, delay);
  const row2State = getTimeoutState(row2TimeoutData, row2CurrIndex, delay);
  row1PausedIndex = row1State.nextIndex;
  row1PausedTime = row1State.nextTimeout;

  row2PausedIndex = row2State.nextIndex;
  row2PausedTime = row2State.nextTimeout;

  clearCardTimeouts();
}

function playCards() {
  cardsPaused = false;
  for(let card of document.querySelectorAll('.student-ani')) {
    card.style.animationPlayState = 'running';
    card.querySelector('.team-card-main-student').style.transform = 'translateX(0)';
  }

  if(row1PausedIndex != null) {
    row1Ani(row1PausedIndex, row1PausedTime);
    row1PausedIndex = null;
    row1PausedTime = null;
  }
  if(row2PausedIndex != null) {
    row2Ani(row2PausedIndex, row2PausedTime);
    row2PausedIndex = null;
    row2PausedTime = null;
  }
}

let row1Delay = 0;
let row2Delay = 0;
let row1LastCardStart = false;

function row1Ani(fromIndex = 0, initialDelay = 0) {
  let delayToNext = initialDelay;
  row1TimeoutData = [];
  for(let i = fromIndex; i < row1.length; i++) {
    let scheduled = Date.now() + delayToNext;
    row1TimeoutData.push({index: i, scheduled});
    let t = setTimeout(() => {
      if(pageHidden || cardsPaused) return;

      row1[i].style.setProperty('--student-ani-dist', `-${window.innerWidth + cardWidth}px`);
      row1[i].style.setProperty('--student-ani-dur', `${speed}ms`);
      row1[i].classList.add('student-ani');
      row1[i].addEventListener('animationend', function row1AniEnd() {
        row1[i].removeEventListener('animationend', row1AniEnd);
        row1[i].classList.remove('student-ani');
      });

      row1CurrIndex = i + 1;
      if(i === row1.length - 1) {
        row1CurrIndex = 0;
        row1Ani();
      }

    }, delayToNext);
    row1Timeouts.push(t);
    delayToNext += delay;
  }
}

function row2Ani(fromIndex = 0, initialDelay = 0) {
  let delayToNext = initialDelay;
  row2TimeoutData = [];
  for(let i = fromIndex; i < row2.length; i++) {
    let scheduled = Date.now() + delayToNext;
    row2TimeoutData.push({index: i, scheduled});
    let t = setTimeout(() => {
      if(pageHidden || cardsPaused) return;
      row2[i].style.setProperty('--student-ani-dist', `${window.innerWidth + cardWidth}px`);
      row2[i].style.setProperty('--student-ani-dur', `${speed}ms`);
      row2[i].classList.add('student-ani');
      row2[i].addEventListener('animationend', function row1AniEnd() {
        row2[i].removeEventListener('animationend', row1AniEnd);
        row2[i].classList.remove('student-ani');
      });
      row2CurrIndex = i + 1;
      if(i === row2.length - 1) {
        row2CurrIndex = 0;
        row2Ani();
      }

    }, delayToNext);
    row2Timeouts.push(t);
    delayToNext += delay;
  }
}
/*
function startAni() {
  for(let i = 0; i < students.length - 1; i++) {
    row1[i].style.setProperty('--student-ani-dist', `${window.innerWidth + cardWidth}px`);
    row1[i].style.setProperty('--student-ani-dur', `${window.innerWidth + cardWidth * 10}ms`);
    row2[i].style.setProperty('--student-ani-dist', `${window.innerWidth + cardWidth}px`);
    row2[i].style.setProperty('--student-ani-dur', `${window.innerWidth + cardWidth * 10}ms`);
    if(i === students.length - 1) restartAni();
    setTimeout(() => {

    })
  }
}*/

function startAni() {
  row1Ani();
  row2Ani()
}

function restartRow1() {
  clearCardTimeouts();
  row1Delay = 0;
  if(pageHidden) return;
  row1.forEach((card, index) => {
    let t = setTimeout(() => {
      if(pageHidden) return;
      card.classList.add('student-ani');
      card.addEventListener('animationend', row1AniEnd)
      if(index === row1.length - 1) restartRow1();
    }, row1Delay)
    row1Timeouts.push(t);
    row1Delay += delay;
    function row1AniEnd() {
      card.removeEventListener('animationend', row1AniEnd);
      card.classList.remove('student-ani');
    }
  })
}

function restartRow2() {
  clearCardTimeouts();
  row2Delay = 0;
  if(pageHidden) return;
  row2.forEach((card, index) => {
    let t = setTimeout(() => {
      if(pageHidden) return;
      card.classList.add('student-ani');
      card.addEventListener('animationend', row2AniEnd);
      if(index === row1.length - 1) restartRow2();
    }, row2Delay);
    row2Timeouts.push(t);
    function row2AniEnd() {
      card.removeEventListener('animationend', row2AniEnd);
      card.classList.remove('student-ani');
    }
    row2Delay += delay;
  })
}


 /* function studentAni() {
    setCardWidth();
    const row1 = students.filter(student => student.initRow === 1);
    const row2 = students.filter(student => student.initRow === 2);

    const visibleCards = Math.floor((window.innerWidth - cardWidth) / cardWidth) + 1
    const totalCardsOnScreen = visibleCards + 1;
    const totalCardsWidth = totalCardsOnScreen * cardWidth;
    const minGap = 35;
    let gap = Math.max(25, cardWidth * 0.18);
    const baseTime = 3;
    const speed = cardWidth / baseTime;
    const delay = (cardWidth + gap) / speed;
    const distance = window.innerWidth + cardWidth;
    const duration = distance / speed;
    const cardsPerRow = row1.length;


    [row1, row2].forEach(row => {
      row.forEach((student, index) => {
        const cardDelay = index * delay;

        const card = document.getElementById(student.id);
        if(student.currRow === 1) {
          student.dist = -distance;
        } else {
          student.dist = distance;
        }
        card.style.setProperty('--student-ani-dist', `${student.dist}px`);
        card.style.setProperty('--student-ani-dur', `${duration}s`);
        card.style.setProperty('--student-ani-delay', `${cardDelay}s`);
        card.classList.remove('student-ani');
        void card.offsetWidth;
        card.classList.add('student-ani');

        card.addEventListener('animationend', changeRow);
        function changeRow() {
          card.style.setProperty('--student-ani-delay', '0s');
          card.removeEventListener('animationend', changeRow);
          if(student.currRow === student.initRow) {
            card.classList.replace('student-ani', 'student-ani-return');
            if(student.currRow === 1) {
              card.style.top = '55%';
              student.currRow = 2;
            } else {
              card.style.top = '0%';
              student.currRow = 1;
            }
          } else {
            card.classList.replace('student-ani-return', 'student-ani');
            if(student.currRow === student.initRow) {
              if(student.currRow === 1) {
                card.style.top = '55%';
                student.currRow = 2;
              } else {
                card.style.top = '0%';
                student.currRow = 1;
              }
            }
          }
          card.addEventListener('animationend', changeRow);
        }

      })
    })
  }



  function addStudentAni(student) {
    const card = document.getElementById(student.id);
    const rect = card.getBoundingClientRect();
    if(student.currRow === 1) {
      student.dist = -(window.innerWidth + cardWidth)
    } else {
      student.dist = window.innerWidth + cardWidth
    }
    card.style.setProperty('--student-ani-dist', `${student.dist}px`);
    card.style.setProperty('--student-ani-dur', `${Math.abs((window.innerWidth + cardWidth)* 6.25)}ms`);
    card.classList.add('student-ani');
    card.addEventListener('animationend', changeRow)
    function changeRow() {
      card.removeEventListener('animationend', changeRow);
      if(student.currRow === student.initRow) {
        card.classList.replace('student-ani', 'student-ani-return');
        if(student.currRow === 1) {
          card.style.top = '55%';
          student.currRow = 2;
        } else {
          card.style.top = '0%';
          student.currRow = 1;
        }
      } else {
        card.classList.replace('student-ani-return', 'student-ani');
        if(student.currRow === 1) {
          card.style.top = '55%';
          student.currRow = 2;
        } else {
          card.style.top = '0%';
          student.currRow = 1;
        }
      }
      card.addEventListener('animationend', changeRow)
    }
  }
//studentAni()*/