window.addEventListener('resize', resizeTeamCards);
window.addEventListener('load', () => {
  resizeTeamCards();
  rotateCards();
})

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

const students = [
  {
    name: 'Emma Adams',
    id: 'emma-adams',
    title: 'Student Web Developer',
    img: 'img/i3/people/adams.jpg'
  },
  {
    name: 'Lauren Busavage',
    id: 'lauren-busav',
    title: 'Student Web Developer',
    img: 'img/i3/people/busavage.png'
  },
  {
    name: 'Kelis Clarke',
    id: 'kelis-clarke',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg'
  },
  {
    name: 'Ryan Cohutt',
    id: 'ryan-cohutt',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg'
  },
  {
    name: 'Maggie Danielewicz',
    id: 'maggie-daniel',
    title: 'Student Web Developer',
    img: 'img/i3/people/danielewicz.jpg'
  },
  {
    name: 'Luna Gonzalez',
    id: 'luna-gonzal',
    title: 'Student Illustrator',
    img: 'img/i3/people/luna.jpg'
  },
  {
    name: 'Aaron Mark',
    id: 'aaron-mark',
    title: 'Student Web Developer',
    img: 'img/i3/people/jonathan.jpg'
  },
  {
    name: 'Jack Medrek',
    id: 'jack-medrek',
    title: 'Student Software Developer',
    img: 'img/i3/people/medrek.jpg'
  },
  {
    name: 'Kailey Moore',
    id: 'kailey-moore',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/moore.jpg'
  },
  {
    name: 'William Shostak',
    id: 'william-shostak',
    title: 'Student Software Developer',
    img: 'img/i3/people/shostak.jpg'
  },
  {
    name: 'Emelia Salmon',
    id: 'emelia-salmon',
    title: 'Student UI/UX Designer',
    img: 'img/i3/people/jonathan.jpg'
  }
]

const studentRow1 = document.getElementById('students-row-1');
const studentRow2 = document.getElementById('students-row-2');

students.forEach((student, index) => {
  const card = document.createElement('div');
  card.classList.add('team-card-main-student');
  card.classList.add('d-flex');
  card.id = student.id;

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

  const gradient = document.createElement('div');
  gradient.classList.add('team-card-main-gradient');

  card.appendChild(gradient);

  const img = document.createElement('img');
  img.src = `${student.img}`;
  img.alt = `${student.name}`;
  img.classList.add('team-card-main-img');

  card.appendChild(img);

  if(index < students.length / 2) {
    studentRow1.appendChild(card);
  } else {
    studentRow2.appendChild(card);
  }
})
