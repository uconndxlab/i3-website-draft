/**
 * StarParticles - A lightweight, customizable particle system for background effects
 * Uses Canvas API for smooth performance and GSAP for enhanced animations
 */
class StarParticles {
    constructor(options = {}) {
        // Container and canvas setup
        this.selector = options.selector || '.star-particles';
        this.container = document.querySelector(this.selector);
        
        if (!this.container) {
            console.error(`StarParticles: Container with selector "${this.selector}" not found`);
            return;
        }

        // Particle configuration
        this.particleCount = options.particleCount || 100;
        this.particleColor = options.particleColor || '#ffffff';
        this.particleSize = {
            min: options.minSize || 1,
            max: options.maxSize || 3
        };
        this.particleOpacity = {
            min: options.minOpacity || 0.3,
            max: options.maxOpacity || 1
        };
        
        // Movement configuration
        this.speed = {
            min: options.minSpeed || 0.1,
            max: options.maxSpeed || 0.5
        };
        this.direction = options.direction || 'random'; // 'random', 'up', 'down', 'left', 'right', or degrees
        
        // Visual effects
        this.twinkle = options.twinkle !== false; // Enable twinkling by default
        this.connections = options.connections || false; // Draw lines between nearby particles
        this.connectionDistance = options.connectionDistance || 100;
        this.connectionOpacity = options.connectionOpacity || 0.2;
        
        // Animation options
        this.mousePush = options.mousePush !== false; // Particles move away from mouse
        this.pushRadius = options.pushRadius || 80;
        this.pushForce = options.pushForce || 2;
        
        // Performance
        this.fps = options.fps || 60;
        this.retina = options.retina !== false; // Support high DPI displays
        
        // Accessibility
        this.respectMotionPreference = options.respectMotionPreference !== false; // Respect prefers-reduced-motion by default
        this.reducedMotionFallback = options.reducedMotionFallback || 'static'; // 'static', 'minimal', 'off'
        
        // Internal properties
        this.canvas = null;
        this.ctx = null;
        this.particles = [];
        this.animationId = null;
        this.mouse = { x: 0, y: 0 };
        this.width = 0;
        this.height = 0;
        this.pixelRatio = 1;
        this.prefersReducedMotion = false;
        
        this.init();
    }

    init() {
        this.checkMotionPreference();
        this.createCanvas();
        this.setupEventListeners();
        this.createParticles();
        
        // Only start animation if motion is allowed or fallback permits it
        if (!this.prefersReducedMotion || this.reducedMotionFallback !== 'off') {
            this.animate();
        }
    }

    checkMotionPreference() {
        if (!this.respectMotionPreference) {
            this.prefersReducedMotion = false;
            return;
        }

        // Check for prefers-reduced-motion
        const mediaQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
        this.prefersReducedMotion = mediaQuery.matches;

        // Listen for changes to the preference
        mediaQuery.addEventListener('change', (e) => {
            this.prefersReducedMotion = e.matches;
            this.handleMotionPreferenceChange();
        });
    }

    handleMotionPreferenceChange() {
        if (this.prefersReducedMotion) {
            // User prefers reduced motion
            switch (this.reducedMotionFallback) {
                case 'off':
                    this.stop();
                    this.ctx.clearRect(0, 0, this.width, this.height);
                    break;
                case 'static':
                    this.stop();
                    this.drawStaticParticles();
                    break;
                case 'minimal':
                    // Keep animation but reduce effects
                    this.applyMinimalMotion();
                    if (!this.animationId) this.animate();
                    break;
            }
        } else {
            // User is okay with motion, restore full animation
            this.restoreFullMotion();
            if (!this.animationId) this.animate();
        }
    }

    createCanvas() {
        // Create canvas element
        this.canvas = document.createElement('canvas');
        this.canvas.style.position = 'absolute';
        this.canvas.style.top = '0';
        this.canvas.style.left = '0';
        this.canvas.style.width = '100%';
        this.canvas.style.height = '100%';
        this.canvas.style.pointerEvents = 'none';
        this.canvas.style.zIndex = '0';
        
        // Ensure container is positioned
        const containerStyle = window.getComputedStyle(this.container);
        if (containerStyle.position === 'static') {
            this.container.style.position = 'relative';
        }
        
        this.container.appendChild(this.canvas);
        this.ctx = this.canvas.getContext('2d');
        
        this.handleResize();
    }

    handleResize() {
        const rect = this.container.getBoundingClientRect();
        this.width = rect.width;
        this.height = rect.height;
        
        // Handle retina displays
        if (this.retina) {
            this.pixelRatio = window.devicePixelRatio || 1;
            this.canvas.width = this.width * this.pixelRatio;
            this.canvas.height = this.height * this.pixelRatio;
            this.canvas.style.width = this.width + 'px';
            this.canvas.style.height = this.height + 'px';
            this.ctx.scale(this.pixelRatio, this.pixelRatio);
        } else {
            this.canvas.width = this.width;
            this.canvas.height = this.height;
        }
    }

    setupEventListeners() {
        // Handle window resize
        window.addEventListener('resize', () => {
            this.handleResize();
        });

        // Handle mouse movement for push effect
        if (this.mousePush) {
            this.container.addEventListener('mousemove', (e) => {
                const rect = this.container.getBoundingClientRect();
                this.mouse.x = e.clientX - rect.left;
                this.mouse.y = e.clientY - rect.top;
            });

            this.container.addEventListener('mouseleave', () => {
                this.mouse.x = -1000;
                this.mouse.y = -1000;
            });
        }
    }

    createParticles() {
        this.particles = [];
        
        for (let i = 0; i < this.particleCount; i++) {
            this.particles.push(this.createParticle());
        }
    }

    createParticle() {
        const particle = {
            x: Math.random() * this.width,
            y: Math.random() * this.height,
            size: this.randomBetween(this.particleSize.min, this.particleSize.max),
            opacity: this.randomBetween(this.particleOpacity.min, this.particleOpacity.max),
            baseOpacity: 0, // Will be set below
            speed: this.randomBetween(this.speed.min, this.speed.max),
            vx: 0, // velocity x
            vy: 0, // velocity y
            twinkleOffset: Math.random() * Math.PI * 2, // For twinkling effect
            originalX: 0, // For mouse push effect
            originalY: 0
        };

        particle.baseOpacity = particle.opacity;
        particle.originalX = particle.x;
        particle.originalY = particle.y;

        // Set velocity based on direction
        this.setParticleDirection(particle);

        return particle;
    }

    setParticleDirection(particle) {
        let angle;
        
        switch (this.direction) {
            case 'up':
                angle = -Math.PI / 2;
                break;
            case 'down':
                angle = Math.PI / 2;
                break;
            case 'left':
                angle = Math.PI;
                break;
            case 'right':
                angle = 0;
                break;
            case 'random':
                angle = Math.random() * Math.PI * 2;
                break;
            default:
                // Assume it's a degree value
                angle = (parseFloat(this.direction) || 0) * Math.PI / 180;
        }

        particle.vx = Math.cos(angle) * particle.speed;
        particle.vy = Math.sin(angle) * particle.speed;
    }

    updateParticles() {
        this.particles.forEach(particle => {
            // Skip movement if reduced motion is preferred and we're in static mode
            if (this.prefersReducedMotion && this.reducedMotionFallback === 'static') {
                return;
            }

            // Update position
            particle.x += particle.vx;
            particle.y += particle.vy;

            // Handle mouse push effect (disabled in reduced motion)
            if (this.mousePush && (!this.prefersReducedMotion || this.reducedMotionFallback === 'minimal')) {
                const dx = particle.x - this.mouse.x;
                const dy = particle.y - this.mouse.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < this.pushRadius) {
                    const force = (this.pushRadius - distance) / this.pushRadius;
                    const pushX = (dx / distance) * force * this.pushForce;
                    const pushY = (dy / distance) * force * this.pushForce;
                    
                    particle.x += pushX;
                    particle.y += pushY;
                }
            }

            // Handle twinkling effect (disabled or reduced in reduced motion)
            if (this.twinkle) {
                if (this.prefersReducedMotion && this.reducedMotionFallback === 'minimal') {
                    // Very subtle twinkling for minimal motion
                    particle.opacity = particle.baseOpacity + 
                        Math.sin(Date.now() * 0.001 + particle.twinkleOffset) * 0.1;
                } else if (!this.prefersReducedMotion) {
                    // Full twinkling effect
                    particle.opacity = particle.baseOpacity + 
                        Math.sin(Date.now() * 0.003 + particle.twinkleOffset) * 0.3;
                }
                particle.opacity = Math.max(0.1, Math.min(1, particle.opacity));
            }

            // Wrap around screen edges
            if (particle.x < -10) particle.x = this.width + 10;
            if (particle.x > this.width + 10) particle.x = -10;
            if (particle.y < -10) particle.y = this.height + 10;
            if (particle.y > this.height + 10) particle.y = -10;
        });
    }

    drawParticles() {
        this.ctx.clearRect(0, 0, this.width, this.height);

        // Draw connections first (so they appear behind particles)
        if (this.connections) {
            this.drawConnections();
        }

        // Draw particles
        this.particles.forEach(particle => {
            this.ctx.save();
            this.ctx.globalAlpha = particle.opacity;
            this.ctx.fillStyle = this.particleColor;
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            this.ctx.fill();
            this.ctx.restore();
        });
    }

    drawConnections() {
        this.ctx.save();
        this.ctx.strokeStyle = this.particleColor;
        this.ctx.globalAlpha = this.connectionOpacity;
        this.ctx.lineWidth = 1;

        for (let i = 0; i < this.particles.length; i++) {
            for (let j = i + 1; j < this.particles.length; j++) {
                const dx = this.particles[i].x - this.particles[j].x;
                const dy = this.particles[i].y - this.particles[j].y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < this.connectionDistance) {
                    const opacity = 1 - (distance / this.connectionDistance);
                    this.ctx.globalAlpha = opacity * this.connectionOpacity;
                    this.ctx.beginPath();
                    this.ctx.moveTo(this.particles[i].x, this.particles[i].y);
                    this.ctx.lineTo(this.particles[j].x, this.particles[j].y);
                    this.ctx.stroke();
                }
            }
        }
        this.ctx.restore();
    }

    animate() {
        this.updateParticles();
        this.drawParticles();
        
        this.animationId = requestAnimationFrame(() => this.animate());
    }

    // Motion preference methods
    drawStaticParticles() {
        this.ctx.clearRect(0, 0, this.width, this.height);

        // Draw connections first (if enabled)
        if (this.connections) {
            this.drawConnections();
        }

        // Draw particles in static positions
        this.particles.forEach(particle => {
            this.ctx.save();
            this.ctx.globalAlpha = particle.baseOpacity;
            this.ctx.fillStyle = this.particleColor;
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            this.ctx.fill();
            this.ctx.restore();
        });
    }

    applyMinimalMotion() {
        // Reduce speed dramatically for minimal motion
        this.particles.forEach(particle => {
            particle.vx *= 0.1; // Reduce to 10% of original speed
            particle.vy *= 0.1;
        });
    }

    restoreFullMotion() {
        // Restore original motion settings
        this.particles.forEach(particle => {
            this.setParticleDirection(particle);
        });
    }

    // Utility methods
    randomBetween(min, max) {
        return Math.random() * (max - min) + min;
    }

    // Control methods
    start() {
        if (!this.animationId) {
            this.animate();
        }
    }

    stop() {
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
            this.animationId = null;
        }
    }

    // Dynamic configuration methods
    setParticleCount(count) {
        this.particleCount = count;
        this.createParticles();
    }

    setDirection(direction) {
        this.direction = direction;
        this.particles.forEach(particle => {
            this.setParticleDirection(particle);
        });
    }

    setSpeed(min, max) {
        this.speed.min = min;
        this.speed.max = max || min;
        this.particles.forEach(particle => {
            particle.speed = this.randomBetween(this.speed.min, this.speed.max);
            this.setParticleDirection(particle);
        });
    }

    setColor(color) {
        this.particleColor = color;
    }

    toggleConnections() {
        this.connections = !this.connections;
    }

    toggleTwinkle() {
        this.twinkle = !this.twinkle;
        if (!this.twinkle) {
            // Reset opacity to base values
            this.particles.forEach(particle => {
                particle.opacity = particle.baseOpacity;
            });
        }
    }

    // Cleanup
    destroy() {
        this.stop();
        if (this.canvas && this.canvas.parentNode) {
            this.canvas.parentNode.removeChild(this.canvas);
        }
        // Remove event listeners
        window.removeEventListener('resize', this.handleResize);
    }
}

// Factory function for easy initialization
function createStarParticles(options) {
    return new StarParticles(options);
}

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = StarParticles;
}

// Global access
window.StarParticles = StarParticles;
window.createStarParticles = createStarParticles;
