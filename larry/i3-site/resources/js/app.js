import '../sass/app.scss';
import * as bootstrap from 'bootstrap'; // if you want JavaScript features like dropdowns

import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init();




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