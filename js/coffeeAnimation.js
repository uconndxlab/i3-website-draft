

document.addEventListener('DOMContentLoaded', () => {
  const fillBtn = document.getElementById('coffee');
  const coffee = document.querySelector('.coffee-track');
  const coffeeInitPos = new WebKitCSSMatrix(getComputedStyle(coffee).transform).f;
  let fillBtnDown = false;

  fillBtn.addEventListener('mousedown', () => {
    drinkSpeed = 0.0055
    fillBtnDown = true;
    requestAnimationFrame(fillCoffee)
  })

  fillBtn.addEventListener('mouseup', () => {
    drinkSpeed = 0.0055
    fillBtnDown = false;
    requestAnimationFrame(drinkCoffee);
  })

  let fillSpeed = 0.0075;
  let maxFill = 10;
  let drinkSpeed = 0.0055;
  function fillCoffee() {
    if(!fillBtnDown) return;
    const matrix = new WebKitCSSMatrix(getComputedStyle(coffee).transform);
    const yTransform = matrix.f;
    const newY = Math.max(yTransform - (yTransform * fillSpeed), maxFill);
    coffee.style.transform = `translateY(${newY}px)`;
    if(fillBtnDown) requestAnimationFrame(fillCoffee)

  }
  function drinkCoffee() {
    if(fillBtnDown) return;
    const matrix = new WebKitCSSMatrix(getComputedStyle(coffee).transform);
    const yTransform = matrix.f;
    const newY = Math.min(yTransform + (yTransform * drinkSpeed), coffeeInitPos);
    coffee.style.transform = `translateY(${newY}px)`;
    drinkSpeed += 0.00075
    if(!fillBtnDown) requestAnimationFrame(drinkCoffee)
  }
})

