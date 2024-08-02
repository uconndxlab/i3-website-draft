/*background color change*/
$(window).scroll(function() {
  
  // selectors
  var $window = $(window),
      $body = $('.about'),
      $panel = $('.panel');
  
  // Change 50% earlier than scroll position so color is there when you arrive.
  var scroll = $window.scrollTop() + ($window.height() / 2);
 
  $panel.each(function () {
    var $this = $(this);
    
    // if position is within range of this panel.
    // So position of (position of top of div <= scroll position) && (position of bottom of div > scroll position).
    if ($this.position().top <= scroll && $this.position().top + $this.height() > scroll) {
          
      // Remove all classes on body with color-
      $body.removeClass(function (index, css) {
        return (css.match (/(^|\s)color-\S+/g) || []).join(' ');
      });
       
      // Add class of currently active div
      $body.addClass($(this).data('color'));
    }
  });    
  
}).scroll();

/*typewriter*/
var TxtType = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

TxtType.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
  this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
  this.txt = fullTxt.substring(0, this.txt.length + 1);
  }
  
  var splitWord = this.txt.split(" ");
  if (splitWord[1] !== undefined){
    this.el.innerHTML = '<span style="color:var(--accent-2)">'+splitWord[0]+'</span> <span style="color:var(--accent-3)">'+splitWord[1]+'</span>';
  }
  else{
    this.el.innerHTML = '<span style="color:var(--accent-2)">'+splitWord[0]+'</span>';
  }


  var that = this;
  var delta = 200 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
  delta = this.period;
  this.isDeleting = true;
  } 
  else if (this.isDeleting && this.txt === '') {
  this.isDeleting = false;
  this.loopNum++;
  delta = 500;
  }

  setTimeout(function() {
  that.tick();
  }, delta);
};

window.onload = function() {
  var elements = document.getElementsByClassName('typewrite');
  for (var i=0; i<elements.length; i++) {
      var toRotate = elements[i].getAttribute('data-type');
      var period = elements[i].getAttribute('data-period');
      if (toRotate) {
        new TxtType(elements[i], JSON.parse(toRotate), period);
      }
  }
};

/*rotate circle*/
var elem = document.getElementsByClassName('circle');

window.addEventListener('scroll', function() {
	var value = window.scrollY * 0.25;
  for (var i=0; i<elem.length;i++){
    elem[i].style.transform = `translatex(-50%) translatey(-50%) rotate(${value}deg)`; 
  }
});

/**
 * AOS v2 Initialization
 * @url https://github.com/michalsnik/aos/tree/v2#init-aos
 */
AOS.init({
  duration: 1000,
  disable: Boolean(window.innerWidth < 1024),
  delay: 200,
  once: true
});