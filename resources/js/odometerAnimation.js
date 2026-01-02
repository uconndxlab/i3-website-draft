import Odometer from 'odometer';
import 'odometer/themes/odometer-theme-default.css';

document.addEventListener('DOMContentLoaded', function() {
    // Odometer animation
    function animateOdometers() {
        document.querySelectorAll('.odometer').forEach(function(el) {
            if (el.dataset.animated) return;
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                el.dataset.animated = true;
                if (el.dataset.infinity) {
                    el.innerHTML = '∞';
                } else {
                    // Initialize Odometer
                    const od = new Odometer({
                        el: el,
                        value: 0,
                        format: '',
                        theme: 'default'
                    });
                    
                    setTimeout(() => {
                        od.update(el.dataset.odometerFinal);
                    }, 300);
                }
            }
        });
    }
    
    window.addEventListener('scroll', animateOdometers);
    animateOdometers();
});
