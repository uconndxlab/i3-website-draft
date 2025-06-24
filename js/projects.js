import projects from './projectData.js';



const projectDisplay = document.getElementById('project-display');
const popupsWrapper = document.getElementById('popups-wrap');
const body = document.querySelector('body');
window.isSorting = false;
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

const projectIdToNode = {};


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


function selectProjects() {
  return Object.values(projects).filter(project =>
    selectedGroups.includes(project.group) &&
    project.tags.some(tag => selectedTags.includes(tag))
  );
}



function buildAllProjectCards() {
  Object.values(projects).forEach(project => {
    const id = project.name.split(' ').join('').toLowerCase();

    const wrapper = document.createElement('div');
    wrapper.classList.add('project-wrapper');
    wrapper.style.background = `url('${project.img}') center center / cover no-repeat`;
    wrapper.id = id;

    const title = document.createElement('h5');
    title.innerText = `${project.name}`;
    title.classList.add('project-title');
    wrapper.appendChild(title);

    const overlay = document.createElement('div');
    overlay.classList.add('project-overlay');
    wrapper.appendChild(overlay);

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
      popupTag.innerText = `${tag}`;
      popupTag.classList.add('project-popup-tag');
      popupTagWrapper.appendChild(popupTag);
    });
    popupInfoWrapper.appendChild(popupTagWrapper);
    popup.appendChild(popupInfoWrapper);
    const popupImg = document.createElement('img');
    popupImg.src = project.img;
    popupImg.alt = project.title;
    popupImg.loading = "lazy";
    popupImg.classList.add('project-popup-img');
    popup.appendChild(popupImg);
    const popupDesc = document.createElement('p');
    popupDesc.innerText = project.desc;
    popupDesc.classList.add('project-popup-desc');
    popup.appendChild(popupDesc);
    const popupLink = document.createElement('a');
    popupLink.href = project.link;
    popupLink.target = '_blank';
    popupLink.innerText = `View ${project.shortName || project.name}`;
    popupLink.classList.add('project-popup-link');
    popup.appendChild(popupLink);
    const temp = document.createElement('div');
    temp.innerHTML = closeSVG.trim();
    const svg = temp.firstElementChild;
    svg.addEventListener('pointerdown', closePopup);
    popup.appendChild(svg);
    popupsWrapper.appendChild(popup);

    function openPopup() {
      popupsWrapper.style.display = 'block';
      popup.style.display = 'flex';
      body.style.overflow = 'hidden';
      body.style.borderRight = '1rem white solid';
    }
    function closePopup() {
      popupsWrapper.style.display = 'none';
      popup.style.display = 'none';
      body.style.overflow = 'visible';
      body.style.overflowX = 'hidden';
      body.style.borderRight = 'none';
    }

    wrapper.addEventListener('pointerdown', openPopup);

    projectIdToNode[id] = wrapper;
  });
}

function animate(elements, getKey, reorder, oldRects) {
  // Get kept and added projects
  const kept = [], added = [];
  elements.forEach(el => {
    if (oldRects && oldRects.has(getKey(el))) kept.push(el);
    else added.push(el);
  });
  // Get positions of kept
  const positions = new Map();
  kept.forEach(el => positions.set(getKey(el), oldRects.get(getKey(el))));

  // Call given reorder function
  reorder();

  // Set prev transforms for kept cards (set them to current place)
  kept.forEach(el => {
    const key = getKey(el);
    const prev = positions.get(key);
    const now = el.getBoundingClientRect();
    if (!prev) return;
    const dx = prev.left - now.left;
    const dy = prev.top - now.top;
    el.style.transition = 'none';
    el.style.transform = `translate(${dx}px, ${dy}px)`;
    el.style.opacity = '1';
  });

  // Set new cards as hidden
  added.forEach(el => {
    el.style.transition = 'none';
    el.style.opacity = '0';
    el.style.transform = 'scale(.65)';
  });

  // Animate all cards in with delay
  requestAnimationFrame(() => {
    let keptDelay = 0;
    kept.forEach(el => {
      el.style.transition = 'transform 0.7s cubic-bezier(.49,1.43,.58,.93), opacity .25s';
      el.style.transitionDelay = `${keptDelay}ms`;
      el.style.transform = '';
      el.style.opacity = '1';
      keptDelay += 35;
    });
    let addedDelay = 0;
    added.forEach(el => {
      el.style.transition = 'transform 0.7s cubic-bezier(.49,1.43,.58,.93), opacity .25s';
      el.style.transitionDelay = `${addedDelay}ms`;
      el.style.transform = '';
      el.style.opacity = '1';
      addedDelay += 30;
    });
  });
}

// Get gap size
function getGap(size) {
  if (size.endsWith('px')) {
    return parseFloat(size);
  } else if (size.endsWith('rem')) {
    const rem = parseFloat(size);
    const fontSize = parseFloat(getComputedStyle(document.documentElement).fontSize);
    return rem * fontSize;
  }
  return 0;
}
let cardWidth;
let cardHeight;

// Get card size
function getCardSize() {
  const widthInRem = parseFloat(getComputedStyle(body).getPropertyValue('--project-card-width'));
  const heightInRem = parseFloat(getComputedStyle(body).getPropertyValue('--project-card-height'));
  const fontSize = parseFloat(getComputedStyle(document.documentElement).fontSize);
  const width = widthInRem * fontSize;
  const height = heightInRem * fontSize;
  cardWidth = width;
  cardHeight = height;
}

function setInitialHeight() {
  const rect = projectDisplay.getBoundingClientRect();
  const gap = getGap(getComputedStyle(projectDisplay).getPropertyValue('gap') || '0');
  const rowHeight = cardHeight + gap;
  const perRow = Math.max(1, Math.floor(rect.width / (cardWidth + gap)));
  const rowCount = Math.ceil(projects.length / perRow);
  let newHeight = (rowCount * rowHeight) + gap;
  projectDisplay.style.transition = '';
  projectDisplay.style.height = `10px`;
  void projectDisplay.offsetWidth;
  projectDisplay.style.transition = 'height 1.2s cubic-bezier(.49,1.43,.58,.93)';
  projectDisplay.style.overflow = 'hidden';
  projectDisplay.style.height = `${newHeight}px`;
}

// Main sort function
function sortProjects(filteredList) {
  // Get current height/width of project list
  const rect = projectDisplay.getBoundingClientRect();
  let currHeight = rect.height;
  const containerWidth = rect.width;

  // Disable sort buttons until logic complete
  window.isSorting = true;
  document.querySelectorAll('.project-sort-select').forEach(btn => btn.disabled = true);

  // Get old card elements / rects
  const oldCards = Array.from(projectDisplay.children);
  const oldRects = new Map();
  oldCards.forEach(el => oldRects.set(el.id, el.getBoundingClientRect()));

  // Get ids of kept cards and all cards after sort
  const keepIds = filteredList.map(proj => proj.name.split(" ").join("").toLowerCase());
  const allAfter = filteredList
    .map(proj => projectIdToNode[proj.name.split(" ").join("").toLowerCase()])
    .filter(Boolean);

  // Select current cards and cards to remove (ignore ghosts)
  const currentCards = Array.from(projectDisplay.querySelectorAll('.project-wrapper:not(.project-ghost)'));
  const toRemove = currentCards.filter(el => !keepIds.includes(el.id));

  // Temporarily hide removed cards
  toRemove.forEach(el => {
    el.style.display = 'none';
  });

  // Get gap size
  const gap = getGap(getComputedStyle(projectDisplay).getPropertyValue('gap') || '0');

  // Get new height of project list after sort
  const rowHeight = cardHeight + gap;
  const perRow = Math.max(1, Math.floor(containerWidth / (cardWidth + gap)));
  const rowCount = Math.ceil(allAfter.length / perRow);
  let newHeight = (rowCount * rowHeight) + gap;

  // First frame call
  requestAnimationFrame(() => {

    // Unhide removed cards
    toRemove.forEach(el => { el.style.display = ''; });

    // Set project list height
    projectDisplay.style.transition = '';
    projectDisplay.style.height = `${currHeight}px`;
    void projectDisplay.offsetWidth;
    projectDisplay.style.transition = 'height 1.2s cubic-bezier(.49,1.43,.58,.93)';
    projectDisplay.style.overflow = 'hidden';
    projectDisplay.style.height = `${newHeight}px`;

    // Second frame call
    requestAnimationFrame(() => {

      // Initial animate call to reorder DOM
      animate(
        allAfter,
        el => el.id,
        () => {
          allAfter.forEach((el, idx) => {
            if (projectDisplay.children[idx] !== el) {
              projectDisplay.insertBefore(el, projectDisplay.children[idx]);
            }
          });
        },
        oldRects
      );

      // Fade out removed cards
      toRemove.forEach((el, i) => {
        el.style.transition = 'opacity .5s, transform .75s';
        el.style.transitionDelay = `${i * 50}ms`;
        el.style.opacity = '0';
        el.style.transform = 'scale(.65)';
      });

      // Remove cards / reset project list styles / re-enable sort buttons
      setTimeout(() => {
        toRemove.forEach(el => el.parentNode && el.parentNode.removeChild(el));
        projectDisplay.style.transition = '';
        projectDisplay.style.height = '';
        projectDisplay.style.overflow = '';
        window.isSorting = false;
        document.querySelectorAll('.project-sort-select').forEach(btn => btn.disabled = false);

        // Add ghost cards for spacing
        addGhostCards(projectDisplay, '.project-wrapper:not(.project-ghost)');
      }, Math.max(toRemove.length * 100 + 400, 700));
    });
  });
}
function addGhostCards(container, cardSelector) {
  // Remove existing ghosts
  Array.from(container.querySelectorAll('.project-ghost')).forEach(el => el.remove());

  const cardEls = Array.from(container.querySelectorAll(cardSelector));
  if (cardEls.length === 0) return;

  const containerWidth = container.offsetWidth;
  const cardWidth = cardEls[0].offsetWidth + parseFloat(getComputedStyle(cardEls[0]).marginRight || 0);
  if (!cardWidth) return;

  const perRow = Math.floor(containerWidth / cardWidth);
  if (perRow < 1) return;

  const remainder = cardEls.length % perRow;
  if (remainder === 0) return;

  for (let i = 0; i < perRow - remainder; i++) {
    const ghost = document.createElement('div');
    ghost.className = 'project-wrapper project-ghost';
    ghost.style.opacity = '0';
    ghost.style.pointerEvents = 'none';
    ghost.style.transition = 'none';
    ghost.style.background = 'none';
    ghost.style.boxShadow = 'none';
    container.appendChild(ghost);
  }
}
window.toggleTag = function(tag) {
  if(window.isSorting) return;
  if (!Array.isArray(tagSelectors[tag].tag)) {
    if (selectedTags.includes(tagSelectors[tag].tag)) {
      const index = selectedTags.indexOf(tagSelectors[tag].tag);
      selectedTags.splice(index, 1);
      tagSelectors[tag].div.classList.remove('selected');
    } else {
      selectedTags.push(tagSelectors[tag].tag);
      tagSelectors[tag].div.classList.add('selected');
    }
  } else {
    if (selectedTags.includes(tagSelectors[tag].tag[0]) ||
      selectedTags.includes(tagSelectors[tag].tag[1])) {
      tagSelectors[tag].tag.forEach(t => {
        const idx = selectedTags.indexOf(t);
        if (idx !== -1) selectedTags.splice(idx, 1);
      });
      tagSelectors[tag].div.classList.remove('selected');
    } else {
      tagSelectors[tag].tag.forEach(t => selectedTags.push(t));
      tagSelectors[tag].div.classList.add('selected');
    }
  }
  const filtered = selectProjects();
  sortProjects(filtered);
};




const sidebar = document.querySelector('.sort-sidebar-inner');
const sidebarToggle = document.querySelector('.sort-sidebar-toggle')
const sidebarToggleBtn = sidebarToggle.querySelector('.sidebar-toggle-btn');

window.toggleSidebar = function() {
  sidebar.classList.toggle('sidebar-open');
  sidebarToggle.classList.toggle('sidebar-toggle-open');
  sidebarToggleBtn.classList.toggle('sidebar-toggle-btn-rotate');
};

document.addEventListener('DOMContentLoaded', () => {
  getCardSize();

  setInitialHeight();

  buildAllProjectCards();
  const filtered = selectProjects();
  sortProjects(filtered);
});

const closeSVG = '<svg width="50px" height="50px" viewBox="0 0 24 24" class="project-popup-close" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
  '<path d="M19 5L5 19" stroke="#333333" stroke-width="2" stroke-linecap="round"/>\n' +
  '<path d="M5 5L19 19" stroke="#333333" stroke-width="2" stroke-linecap="round"/>\n' +
  '</svg>';

window.addEventListener('resize', () => {
  addGhostCards(projectDisplay, '.project-wrapper:not(.project-ghost)');
  getCardSize();
});