export function startPhraseAnimator({ phrases, selector }) {
  const container = document.querySelector(selector);
  if (!container) {
    console.warn(`PhraseAnimator: No element found for selector "${selector}"`);
    return;
  }

  let phraseIndex = 0;

  const animatePhrase = (phrase) => {
    // Step 1: Measure width
    const temp = document.createElement("div");
    temp.style.position = "absolute";
    temp.style.visibility = "hidden";
    temp.style.whiteSpace = "nowrap";
    temp.style.font = getComputedStyle(container).font;
    temp.style.fontWeight = getComputedStyle(container).fontWeight;

    const parts = phrase.split(" ");
    parts.forEach((word, i) => {
      [...word].forEach(char => {
        const span = document.createElement("span");
        span.className = `phrase-animator-word-${i}`;
        span.textContent = char;
        temp.appendChild(span);
      });
      temp.appendChild(document.createTextNode(" "));
    });

    document.body.appendChild(temp);
    const targetWidth = temp.offsetWidth;
    document.body.removeChild(temp);

    // Step 2: Inject letters
    container.innerHTML = "";
    const letterElements = [];

    parts.forEach((word, i) => {
      [...word].forEach(char => {
        const span = document.createElement("span");
        span.className = `phrase-animator-letter phrase-animator-word-${i}`;
        span.textContent = char;
        container.appendChild(span);
        letterElements.push(span);
      });
      const space = document.createElement("span");
      space.className = "phrase-animator-letter";
      space.innerHTML = "&nbsp;";
      container.appendChild(space);
      letterElements.push(space);
    });

    // Step 3: Animate width + letters in parallel
    gsap.to(container, {
      width: targetWidth,
      duration: 1.1,
      ease: "power2.inOut"
    });

    gsap.fromTo(letterElements, {
      opacity: 0,
      x: () => gsap.utils.random(-100, 100),
      y: () => gsap.utils.random(-60, 60),
      scale: 0.3
    }, {
      opacity: 1,
      x: 0,
      y: 0,
      scale: 1,
      duration: 0.8,
      ease: "power2.out",
      stagger: 0.05
    });

    // Step 4: Animate out
    setTimeout(() => {
      gsap.to(letterElements, {
        opacity: 0,
        x: () => gsap.utils.random(-100, 100),
        y: () => gsap.utils.random(-60, 60),
        scale: 0.3,
        duration: 0.6,
        ease: "power2.in",
        stagger: 0.03,
        onComplete: () => {
          phraseIndex = (phraseIndex + 1) % phrases.length;
          animatePhrase(phrases[phraseIndex]);
        }
      });
    }, 2500);
  };

  animatePhrase(phrases[phraseIndex]);
}

window.startPhraseAnimator = startPhraseAnimator;