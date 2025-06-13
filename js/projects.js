import projects from './projectData.js';


window.addEventListener('load', () => {

})

document.addEventListener('DOMContentLoaded', () => {
  selectedProjects = [];
  displayedProjects = [];
  projectDisplay.innerHTML = '';
  buildProjects(selectProjects());
})






const groupSelectors = {
  dxg: {
    group: 'dxg',
    div: document.getElementById('dxg')
  },
  cubedLabs: {
    group: 'cubedLabs',
    div: document.getElementById('cubedLabs')
  }
}

const tagSelectors = {
  webDev: {
    tag: 'Web Development',
    div: document.getElementById('webDev'),
  },

  mobilePWA: {
    tag: 'Mobile PWA',
    div: document.getElementById('mobilePWA')
  },
  uxDesign: {
    tag: 'UX Design',
    div: document.getElementById('ux')
  },
  uiDesign: {
    tag: 'UI Design',
    div: document.getElementById('ui')
  },
  illustration_poster: {
    tag: ['Illustration', 'Poster Design'],
    div: document.getElementById('illustration')
  },
  emailMarketing_notif: {
    tag: ['Email Marketing', 'Email Notifications'],
    div: document.getElementById('emails')
  },
  printProduction_work: {
    tag: ['Print Production', 'Printwork'],
    div: document.getElementById('print')
  }
}


function toggleTag(tag) {
  if(!Array.isArray(tagSelectors[tag].tag)) {
    if(selectedTags.includes(tagSelectors[tag].tag)) {
      const index = selectedTags.indexOf(tagSelectors[tag].tag);
      selectedTags.splice(index, 1);
      tagSelectors[tag].div.classList.remove('selected');
    } else {
      selectedTags.push(tagSelectors[tag].tag);
      tagSelectors[tag].div.classList.add('selected');
    }
  } else {
    if(selectedTags.includes(tagSelectors[tag].tag[0] ||
    selectedTags.includes(tagSelectors[tag].tag[1]))) {
      const index0 = selectedTags.indexOf(tagSelectors[tag].tag[0]);
      selectedTags.splice(index0, 1);
      const index1 = selectedTags.indexOf(tagSelectors[tag].tag[1]);
      selectedTags.splice(index1, 1);
      tagSelectors[tag].div.classList.remove('selected');
    } else {
      selectedTags.push(tagSelectors[tag].tag[0]);
      selectedTags.push(tagSelectors[tag].tag[1]);
      tagSelectors[tag].div.classList.add('selected');
    }
  }
  buildProjects(selectProjects(), true);
  console.log(selectedTags)
}

function toggleGroup(group) {
  if(selectedGroups.includes(groupSelectors[group].group)) {
    const index = selectedGroups.indexOf(groupSelectors[group].group);
    selectedGroups.splice(index, 1);
    groupSelectors[group].div.classList.remove('selected');
  } else {
    selectedGroups.push(groupSelectors[group].group);
    groupSelectors[group].div.classList.add('selected');
  }
  console.log(selectedGroups)
  selectProjects();
}

let selectedGroups = [
  'dxg',
  'cubedLabs'
];
let selectedTags = [
  'Web Development',
  'Mobile PWA',
  'UX Design',
  'UI Design',
  'Illustration',
  'Poster Design',
  'Email Marketing',
  'Email Notifications',
  'Print Production',
  'Printwork'
];

let selectedProjects = []
let displayedProjects = [];

function selectProjects() {
  displayedProjects = [];
  selectedProjects = [];
  for(let key in projects) {
      selectedTags.forEach(tag => {
        if(projects[key].tags.includes(tag) && !selectedProjects.includes(projects[key])) {
          selectedGroups.forEach(group => {
            if(projects[key].group === group && !selectedProjects.includes(projects[key])) {
              selectedProjects.push(projects[key])
            }
          })
        }
      })

  }
  return selectedProjects;
}
const projectDisplay = document.getElementById('project-display')

function buildProjectPopups() {
  const popupWrapper = document.createElement('div');
  popupWrapper.classList.add('project-popups-wrapper');
}

const closeSVG = '<svg width="50px" height="50px" viewBox="0 0 24 24" class="project-popup-close" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
  '<path d="M19 5L5 19" stroke="#333333" stroke-width="2" stroke-linecap="round"/>\n' +
  '<path d="M5 5L19 19" stroke="#333333" stroke-width="2" stroke-linecap="round"/>\n' +
  '</svg>';

const popupsWrapper = document.getElementById('popups-wrap');
const body = document.querySelector('body');

function buildProjects(projectList, sorting = false) {
  displayedProjects = [];

  if(projectList.length === 0) {
    emptyProjectList();
    return;
  }

  console.log('building')
  projectList.forEach(project => {
    const popup = document.createElement('div');
    popup.classList.add('project-popup');

    const popupInfoWrapper = document.createElement('div');
    popupInfoWrapper.classList.add('project-popup-info-wrap');


    const popupTitle = document.createElement('h5');
    popupTitle.innerText = project.longName || project.name;
    popupTitle.classList.add('project-popup-title');
    popupInfoWrapper.appendChild(popupTitle);

    const popupTagWrapper = document.createElement('div');
    popupTagWrapper.classList.add('project-popup-tag-wrapper');

    project.tags.forEach(tag => {
      const popupTag = document.createElement('span');
      popupTag.innerText = tag;
      popupTag.classList.add('project-popup-tag');
      popupTagWrapper.appendChild(popupTag);
    });
    popupInfoWrapper.appendChild(popupTagWrapper);
    popup.appendChild(popupInfoWrapper);

    const popupImg = document.createElement('img');
    popupImg.src = project.img;
    popupImg.alt = project.title
    popupImg.loading = "lazy";
    popupImg.classList.add('project-popup-img')
    popup.appendChild(popupImg);


    const popupDesc = document.createElement('p');
    popupDesc.innerText = project.desc;
    popupDesc.classList.add('project-popup-desc');
    popup.appendChild(popupDesc);

    const popupLink = document.createElement('a');
    popupLink.href = project.link;
    popupLink.target = '_blank';
    popupLink.innerText = `View ${project.shortName || project.name}`;
    popupLink.classList.add('project-popup-link')
    popup.appendChild(popupLink);

    const temp = document.createElement('div');
    temp.innerHTML = closeSVG.trim();
    const svg = temp.firstElementChild;
    svg.addEventListener('pointerdown', closePopup);


    popup.appendChild(svg);

    popupsWrapper.appendChild(popup);

    const wrapper = document.createElement('div');
    wrapper.classList.add('project-wrapper');
    wrapper.style.background = `url('${project.img}') center center / cover no-repeat`;
    wrapper.id = project.name.split(" ").join("").toLowerCase();

    const title = document.createElement('h5');
    title.innerText = `${project.name}`;
    title.classList.add('project-title');
    wrapper.appendChild(title);

    const overlay = document.createElement('div');
    overlay.classList.add('project-overlay');
    wrapper.appendChild(overlay);

    wrapper.addEventListener('pointerdown', openPopup)

    function openPopup() {
      popupsWrapper.style.display = 'block'
      popup.style.display = 'flex';
      body.style.overflow = 'hidden'
      body.style.borderRight = '1rem white solid'
    }

    function closePopup() {
      popupsWrapper.style.display = 'none';
      popup.style.display = 'none';
      body.style.overflow = 'visible';
      body.style.overflowX = 'hidden';
      body.style.borderRight = 'none';
    }

    displayedProjects.push(wrapper);
  })
  if(sorting && projectDisplay.firstElementChild) {
    console.log('resetting')
    resetProjectList()
  } else {
    console.log(displayedProjects)
    displayProjects();

  }
}

function displayProjects() {
  projectDisplay.style.height = `300px`;
  projectDisplay.style.transition = `height ${displayedProjects.length * .2}s linear`;

  projectDisplay.style.overflow = 'hidden';
  projectDisplay.addEventListener('transitionend', function growList(event) {
    if(event.propertyName === 'height') {
      projectDisplay.style.height = 'fit-content';
      projectDisplay.style.overflow = '';
      projectDisplay.removeEventListener('transitionend', growList);
    }
  })
  projectDisplay.innerHTML = '';
  console.log('displaying' + displayedProjects)
  let delay = 0;
    displayedProjects.forEach(project => {
      project.style.transition = 'none';
      project.style.opacity = '0';
      project.style.transform = 'scale(.65)';
      project.style.transition = 'opacity .25s ease-in-out, transform .5s ease-in-out';
      project.style.transitionDelay = `${delay}s`;
      projectDisplay.appendChild(project);
      delay += .2;
    });
  const newHeight = projectDisplay.scrollHeight;
  requestAnimationFrame(() => {
    projectDisplay.style.height = `${newHeight}px`;
  })
  console.log(newHeight)
  displayedProjects.forEach(project => {
    requestAnimationFrame(() => {
      project.offsetWidth;
      project.style.opacity = '1';
      project.style.transform = 'none'
    });
  })
}

function resetProjectList() {
  let visibleProjects = 0;
  let delay = 0;
  for(let child of projectDisplay.children) {
    if(window.getComputedStyle(child).opacity === '1') visibleProjects++;
  }
  projectDisplay.style.height = `${projectDisplay.offsetHeight}px`;
  projectDisplay.style.transition = `height ${visibleProjects * .1}s ease-in`;


  if(!projectDisplay.firstElementChild) {
    displayProjects();
    return;
  }
  projectDisplay.offsetHeight;
  if(getComputedStyle(projectDisplay).height === '300px') {
    console.log('no transition needed');
    setTimeout(displayProjects, ((.1 * projectDisplay.children.length) + .25) * 1000)
  } else {
    projectDisplay.style.height = '300px';
    projectDisplay.style.overflow = 'hidden';
    projectDisplay.addEventListener('transitionend', function newDisplay(event) {
      if(event.propertyName === 'height') {
        console.log('transitionend')
        projectDisplay.style.height = 'fit-content';
        projectDisplay.style.overflow = '';
        projectDisplay.removeEventListener('transitionend', newDisplay);
        displayProjects()
      }
    })
  }
  for(let i = projectDisplay.children.length - 1; i >= 0; i--) {
      if(getComputedStyle(projectDisplay.children[i]).opacity === '1') {
        delay += .1;
      }
      projectDisplay.children[i].style.transition = 'opacity .25s ease-in-out, transform .25s ease-in-out';
      projectDisplay.children[i].style.transitionDelay = `${delay}s`
      projectDisplay.children[i].style.opacity = '0';
      projectDisplay.children[i].style.transform = 'scale(0)';

  }
}

let lastRenderToken = 0;

function emptyProjectList() {
  let delay = 0;
  console.log('emptying')
  // Only animate out if there are children
  if (projectDisplay.children.length === 0) {
    projectDisplay.innerHTML = '';
    return;
  }
  for(let i = projectDisplay.children.length - 1; i >= 0; i--) {
    if (getComputedStyle(projectDisplay.children[i]).opacity === '1') {
      delay += .1;
    }
    projectDisplay.children[i].style.transition = 'opacity .25s ease-in-out, transform .25s ease-in-out';
    projectDisplay.children[i].style.transitionDelay = `${delay}s`;
    projectDisplay.children[i].style.opacity = '0';
    projectDisplay.children[i].style.transform = 'scale(0)';
  }
  // After animation is done, clear the DOM
  setTimeout(() => {
    projectDisplay.innerHTML = '';
  }, (delay + .25) * 1000);
}


function sortProjects() {
  let delay = 0;
  let newSelectedProjects = [selectProjects()];
  selectedProjects.forEach(project => {
    if(!newSelectedProjects.includes(project)) {
      const div = document.getElementById(`${project.name.split(' ').join('').toLowerCase()}`);
      console.log(div)
      div.style.transition = 'opacity .5s ease-in-out, transform .5s ease-in-out';
      div.style.transitionDelay = `${delay}s`;
      div.style.opacity = '0';
      div.style.transform = 'scale(0)';

      div.addEventListener('transitionend', removeProject);
      delay += .2;
    }
    function removeProject() {
      setTimeout(() => {
        projectDisplay.removeChild(document.getElementById(`${project.name.split(' ').join('').toLowerCase()}`));
      }, 500)
    }
  })
}

const toggler = document.querySelector('.project-view-toggler');
const togglerCircle = document.querySelector('.toggler-circle');
const sortWrap = document.querySelector('.project-sort-wrap');


//toggler.addEventListener('pointerdown', toggleSort)


let sort = false;

function toggleSort() {
  if(!sort) {
    sort = true;
    togglerCircle.style.transform = 'translateX(185%)';
    //togglerCircle.style.fill = '#0236da';
    toggler.style.background = '#0236da';
    setTimeout(() => {toggler.classList.replace('toggler-hover-unselect', 'toggler-hover-selected');}, 1000);
    sortWrap.classList.toggle('expand');
  } else {
    sort = false;
    togglerCircle.style.transform = 'translateX(0)';
    //togglerCircle.style.fill = 'grey';
    toggler.style.background = 'none';
    setTimeout(() => {toggler.classList.replace('toggler-hover-selected', 'toggler-hover-unselect');}, 1000);
    sortWrap.classList.toggle('expand');
  }
}

const arrowSVG = '<svg class="arrow-btn" width="40" height="40" viewBox="0 0 32 32" fill="none">' +
  '<line x1="9" y1="16" x2="24" y2="16" stroke="#f1f1f1" stroke-width="2" stroke-linecap="round"/>' +
  '<polyline points="17,10 24,16 17,22" stroke="#f1f1f1" stroke-width="2" fill="none" stroke-linecap="round"/>' +
  '</svg>'
const arrowSVGElems = document.querySelectorAll('.arrow-btn-circle');
/*for(let i = 0; i < arrowSVGElems.length; i++) {
  arrowSVGElems[i].innerHTML = arrowSVG;
}*/

const sidebar = document.querySelector('.sort-sidebar-inner');
const sidebarToggle = document.querySelector('.sort-sidebar-toggle')
const sidebarToggleBtn = sidebarToggle.querySelector('.sidebar-toggle-btn');
function toggleSidebar() {
  sidebar.classList.toggle('sidebar-open');
  sidebarToggle.classList.toggle('sidebar-toggle-open');
  sidebarToggleBtn.classList.toggle('sidebar-toggle-btn-rotate');
}

function calcTogglePos() {
  const rect = sidebarToggle.getBoundingClientRect();
  const newPos = window.innerWidth - 50;
  const dist = newPos - rect.right;
  sidebarToggle.style.transform = `translateX(${dist}px) translateY(8rem)`;
}


window.toggleSidebar = toggleSidebar;
window.toggleTag = toggleTag;