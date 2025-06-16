window.addEventListener('resize', () => {
  resizeTeamCards();
  setCardWidth();
  setCardSpeed();
  row1.forEach(card => {
    card.classList.remove('student-ani');
    card.style.right = `-${cardWidth + 10}px`;
    void card.offsetWidth;
  });
  row2.forEach(card => {
    card.classList.remove('student-ani');
    card.style.left = `-${cardWidth + 10}px`;
    void card.offsetWidth;
  });
  startAni();
});

window.addEventListener('load', () => {
  resizeTeamCards();
  setCardWidth();
  setCardSpeed();
  startAni();

});

document.addEventListener('visibilitychange', () => {
  if(document.hidden) {
    pageHidden = true;
    for(let card of document.querySelectorAll('.student-ani')) {
      card.style.animationPlayState = 'paused';
    }
  } else {
    pageHidden = false;
    for(let card of document.querySelectorAll('.student-ani')) {
      card.style.animationPlayState = 'running';
    }

    row1.forEach(card => {
      card.classList.remove('student-ani');
      card.style.right = `-${cardWidth + 10}px`;
      void card.offsetWidth;
    });
    row2.forEach(card => {
      card.classList.remove('student-ani');
      card.style.left = `-${cardWidth + 10}px`;
      void card.offsetWidth;
    });

    startAni();
  }
});

let pageHidden = false;
let heroOnScreen = false;
let cardsRotating = false;
let initialCardRotate = true;
const heroObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      if(!heroOnScreen) heroOnScreen = true;
      if(initialCardRotate) { setTimeout(() => {rotateCards(); initialCardRotate = false;}, 500) }
      else if(!cardsRotating) rotateCards();
    } else {
      if(heroOnScreen) heroOnScreen = false;
    }
  })
})
heroObserver.observe(document.getElementById('carousel-wrap'));


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
  console.log(`onscreen: ${heroOnScreen}`)
  if(heroOnScreen) {
    setTimeout(rotateCards, 2000);
  } else {
    cardsRotating = false;
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
  if(!cardsRotating) cardsRotating = true;
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

let row1Index = 0;
let row2Index = 0;


const studentRow1 = document.getElementById('students-row-1');
const studentRow2 = document.getElementById('students-row-2')


function setCardWidth() {
  if(window.innerWidth < 768) {cardWidth = 288}
  else if(window.innerWidth < 992) {cardWidth = 288}
  else if(window.innerWidth < 1200) {cardWidth = 288}
  else if(window.innerWidth < 1400) {cardWidth = 256}
  else {cardWidth = 320}
}


let speed;
let delay;



function setCardSpeed() {
  if(window.innerWidth < 568) {speed = window.innerWidth * 21; delay = 3.75}
  else if(window.innerWidth < 768) {speed = window.innerWidth * 16; delay = 3.25}
  else if(window.innerWidth < 992) {speed = window.innerWidth * 13; delay = 2.75}
  else if(window.innerWidth < 1200) {speed = window.innerWidth * 10; delay = 2.5}
  else if(window.innerWidth < 1400) {speed = window.innerWidth * 8.5; delay = 2.35}
  else if(window.innerWidth < 1600) {speed = window.innerWidth * 8; delay = 2.25}
  else {speed = window.innerWidth * 8.5; delay = 2.5}
}


let row1 = [];
let row2 = [];

  let cardWidth = 320;

  let studentsArray1 = [];
  let studentsArray2 = [];

  students.forEach((student, index) => {
    const card = document.createElement('div');
    card.classList.add('team-card-main-student');
    card.classList.add('d-flex');

    const front = document.createElement('div');
    front.classList.add('student-card-front', 'student-card-face');

    const back = document.createElement('div');
    back.classList.add('student-card-back', 'student-card-face');

    const link = document.createElement('a');
    link.href = `${student.linkedIn}`;
    link.classList.add('linked-in-wrap');
    const icon = document.createElement('img');
    icon.src = '/img/i3/linked-in.svg';
    icon.alt = 'LinkedIn';
    icon.target = '_blank';
    icon.classList.add('linked-in');
    link.appendChild(icon);
    back.appendChild(link);

    const textWrap = document.createElement('div');
    textWrap.classList.add('team-card-text-wrap');
    const name = document.createElement('h4');
    name.classList.add('team-name-main');
    name.innerText = `${student.name}`;
    const title = document.createElement('h6');
    title.classList.add('team-title-main');
    title.innerText = `${student.title}`;
    const tag1 = document.createElement('h6');
    const tag2 = document.createElement('h6');
    tag1.classList.add('student-tag');
    tag2.classList.add('student-tag');
    tag1.innerText = student.tags[0];
    tag2.innerText = student.tags[1];
    const tagWrapper = document.createElement('div');
    tagWrapper.classList.add('student-tag-wrapper');
    tagWrapper.appendChild(tag1);
    tagWrapper.appendChild(tag2);

    textWrap.appendChild(name);
    textWrap.appendChild(title);
    textWrap.appendChild(tagWrapper);

    front.appendChild(textWrap);

    card.style.setProperty('--gradient-start', `rgba(${student.gradient}, .7)`);
    card.style.setProperty('--gradient-end', `rgba(${student.gradient}, 0)`);
    const gradient = document.createElement('div');
    gradient.classList.add('team-card-main-gradient');

    front.appendChild(gradient);

    const hover = document.createElement('div');
    hover.classList.add('team-card-main-hover');
    front.appendChild(hover);

    const img = document.createElement('img');
    img.src = `${student.img}`;
    img.alt = `${student.name}`;
    img.classList.add('team-card-main-img');
    img.loading = 'lazy';

    front.appendChild(img);

    const bio = document.createElement('p');
    bio.classList.add('team-card-bio');
    bio.innerText = student.bio;

    back.appendChild(bio);

    card.appendChild(front);
    card.appendChild(back);

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
  card.style.right = `-${cardWidth + 10}px`;
  studentRow1.appendChild(card);
  card.addEventListener('touchstart', () => {
    cardTouchHover(card);
  });
  card.addEventListener('mouseenter', () => {
    cardHover(card);
  });
  card.addEventListener('mouseleave', () => {
    disableHover(card);
  });
  card.addEventListener('animationstart', function nextCard() {
    row1Index = (row1Index + 1) % studentRow1.children.length;
    animateTeamCardRow1(studentRow1.children[row1Index])
  });
  card.addEventListener('animationend', function resetCard() {
    card.classList.remove('student-ani');
  })
});

row2.forEach((card, index) => {
  card.style.left = `-${cardWidth + 10}px`;
  studentRow2.appendChild(card);
  card.addEventListener('touchstart', () => {
    cardTouchHover(card);
  });
  card.addEventListener('mouseenter', () => {
    cardHover(card);
  });
  card.addEventListener('mouseleave', () => {
    disableHover(card);
  });
  card.addEventListener('animationstart', function nextCard() {
    row2Index = (row2Index + 1) % studentRow2.children.length;
    animateTeamCardRow2(studentRow2.children[row2Index])
  });
  card.addEventListener('animationend', function resetCard() {
    card.classList.remove('student-ani');
  })
});


function animateTeamCardRow1(card) {
  card.style.setProperty('--student-ani-dist', `-${window.innerWidth + cardWidth + (cardWidth/2)}px`);
  card.style.setProperty('--student-ani-dur', `${speed}ms`);
  card.style.setProperty('--student-ani-del', `${delay}s`);
  card.classList.add('student-ani')
}
function animateTeamCardRow2(card) {
  card.style.setProperty('--student-ani-dist', `${window.innerWidth + cardWidth + (cardWidth/2)}px`);
  card.style.setProperty('--student-ani-dur', `${speed}ms`);
  card.style.setProperty('--student-ani-del', `${delay}s`);
  card.classList.add('student-ani')
}

function cardTouchHover(card) {
  card.querySelector('.linked-in-wrap').style.opacity = '1';
  card.querySelector('.linked-in-wrap').style.pointerEvents = 'all';
  card.querySelector('.team-card-main-hover').style.opacity = '.5';
  card.querySelector('.linked-in').style.opacity = '1';
  card.querySelector('.team-name-main').style.color = 'dimgray';
  card.querySelector('.team-title-main').style.color = 'dimgray';

  card.addEventListener('touchstart', cardTouchDisableHover)
  function cardTouchDisableHover() {
    card.removeEventListener('touchstart', cardTouchDisableHover)
    card.querySelector('.team-card-main-hover').style.opacity = '0';
    card.querySelector('.linked-in-wrap').style.opacity = '0';
    card.querySelector('.linked-in-wrap').style.pointerEvents = 'none';
    card.querySelector('.linked-in').style.opacity = '0';
    card.querySelector('.team-name-main').style.color = '#f1f1f1';
    card.querySelector('.team-title-main').style.color = '#f1f1f1';
  }

}

function cardHover(hoveredCard) {
  cardsPaused = true;
  for (let card of document.querySelectorAll('.student-ani')) {
    const rect = card.getBoundingClientRect();
    card.style.animationPlayState = 'paused';
    if(rect.left < window.innerWidth - 25 && rect.right > 10) {
      if (card.id.charAt(card.id.length - 1) === '1') {
        if(card.id === hoveredCard.id) {
          card.querySelector('.team-card-main-student').style.transform = 'translateX(-35px)'
          card.querySelector('.linked-in-wrap').style.opacity = '1';
          card.querySelector('.linked-in-wrap').style.pointerEvents = 'all';
          card.querySelector('.linked-in').style.opacity = '1';

        } else {
          card.querySelector('.team-card-main-student').style.transform = 'translateX(-35px) rotateX(-180deg)';
        }
      } else {
        if(card.id === hoveredCard.id) {
          card.querySelector('.team-card-main-student').style.transform = 'translateX(35px)';
          card.querySelector('.linked-in-wrap').style.opacity = '1';
          card.querySelector('.linked-in-wrap').style.pointerEvents = 'all';
          card.querySelector('.linked-in').style.opacity = '1';
        } else {
          card.querySelector('.team-card-main-student').style.transform = 'translateX(35px) rotateX(-180deg)'
        }
      }
    }
  }
}

function disableHover(card) {
  cardsPaused = false;
  for(let card of document.querySelectorAll('.student-ani')) {
    card.style.animationPlayState = 'running';
    card.querySelector('.team-card-main-student').style.transform = 'translateX(0) rotateX(-180deg)';
    card.querySelector('.linked-in-wrap').style.opacity = '0';
    card.querySelector('.linked-in-wrap').style.pointerEvents = 'none';
    card.querySelector('.linked-in').style.opacity = '0';
  }
}

let cardsPaused = false;


function startAni() {
  animateTeamCardRow1(studentRow1.children[row1Index]);
  animateTeamCardRow2(studentRow2.children[row2Index]);
}

const arrowSVG = '<svg class="arrow-btn" width="40" height="40" viewBox="0 0 32 32" fill="none">' +
  '<line x1="9" y1="16" x2="24" y2="16" stroke="#f1f1f1" stroke-width="2" stroke-linecap="round"/>' +
  '<polyline points="17,10 24,16 17,22" stroke="#f1f1f1" stroke-width="2" fill="none" stroke-linecap="round"/>' +
  '</svg>'
const arrowSVGElems = document.querySelectorAll('.arrow-btn-circle');
for(let i = 0; i < arrowSVGElems.length; i++) {
  arrowSVGElems[i].innerHTML = arrowSVG;
}