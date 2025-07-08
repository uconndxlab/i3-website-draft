/**
 * PhotoScroller - A GSAP-powered image scroller that organizes images into rows
 * and animates them in alternating directions
 */
class PhotoScroller {
    constructor(options = {}) {
        this.selector = options.selector || '.photo-scroller';
        this.rows = options.rows || 3;
        this.direction = options.direction || 0; // degrees
        this.speed = options.speed || 50; // pixels per second
        this.gap = options.gap || 20; // gap between images in pixels
        this.rowGap = options.rowGap || 10; // gap between rows in pixels
        this.autoStart = options.autoStart !== false;
        this.maxImageWidth = options.maxImageWidth || 300; // max width in pixels
        this.aspectRatio = options.aspectRatio || null; // e.g., 16/9, 4/3, 1 (square)
        this.imageClass = options.imageClass || 'photo-scroller-image'; // class name for img elements
        this.wrapperClass = options.wrapperClass || 'photo-scroller-wrapper'; // class name for img wrapper elements
        
        this.container = null;
        this.images = [];
        this.rowElements = [];
        this.animations = [];
        
        this.init();
    }

    init() {
        this.container = document.querySelector(this.selector);
        if (!this.container) {
            console.error(`PhotoScroller: Container with selector "${this.selector}" not found`);
            return;
        }

        this.images = Array.from(this.container.querySelectorAll('img'));
        if (this.images.length === 0) {
            console.warn('PhotoScroller: No images found in container');
            return;
        }

        this.setupContainer();
        this.organizeIntoRows();
        
        if (this.autoStart) {
            this.start();
        }
    }

    setupContainer() {
        // Set container styles for proper positioning
        gsap.set(this.container, {
            position: 'relative',
            // overflow: 'hidden',
            height: '400px', // Set a default height so rows are visible
            transform: `rotate(${this.direction}deg)`
        });
    }

    organizeIntoRows() {
        // Clear existing row elements
        this.rowElements.forEach(row => row.remove());
        this.rowElements = [];

        // Calculate images per row
        const imagesPerRow = Math.ceil(this.images.length / this.rows);
        
        // Create rows and distribute images
        for (let i = 0; i < this.rows; i++) {
            const row = this.createRow(i);
            const startIndex = i * imagesPerRow;
            const endIndex = Math.min(startIndex + imagesPerRow, this.images.length);
            
            // Add images to this row multiple times for seamless scrolling
            const imagesToAdd = [];
            for (let j = startIndex; j < endIndex; j++) {
                if (this.images[j]) {
                    imagesToAdd.push(this.images[j]);
                }
            }
            
            // Duplicate images to ensure seamless scrolling
            for (let repeat = 0; repeat < 3; repeat++) {
                imagesToAdd.forEach(img => {
                    const clonedImg = img.cloneNode(true);
                    clonedImg.className = this.imageClass; // Apply the configurable class
                    
                    // Create wrapper div for the image
                    const wrapper = document.createElement('div');
                    wrapper.className = this.wrapperClass;
                    wrapper.appendChild(clonedImg);
                    
                    this.styleImageWrapper(wrapper);
                    row.appendChild(wrapper);
                });
            }

            this.container.appendChild(row);
            this.rowElements.push(row);
        }

        // Hide original images but keep them in DOM
        this.images.forEach(img => {
            gsap.set(img, { 
                position: 'absolute',
                visibility: 'hidden',
                pointerEvents: 'none'
            });
        });
    }

    createRow(index) {
        const row = document.createElement('div');
        row.className = `photo-scroller-row row-${index}`;
        
        // Calculate row height accounting for gaps between rows
        const totalGapHeight = (this.rows - 1) * this.rowGap;
        const availableHeight = 100; // percentage
        const rowHeight = (availableHeight - (totalGapHeight / 4)) / this.rows; // Convert gap to percentage approximation
        
        // Calculate top position accounting for previous rows and their gaps
        const topPosition = index * (rowHeight + (this.rowGap / 4));
        
        gsap.set(row, {
            position: 'absolute',
            top: `${topPosition}%`,
            left: 0,
            height: `${rowHeight}%`,
            width: '100%',
            display: 'flex',
            alignItems: 'center',
            gap: `${this.gap}px`,
            whiteSpace: 'nowrap',
            zIndex: 10 + index, // Ensure rows are visible above original images
            marginBottom: index < this.rows - 1 ? `${this.rowGap}px` : '0' // Add margin except for last row
        });

        return row;
    }

    styleImageWrapper(wrapper) {
        const img = wrapper.querySelector('img');
        
        const wrapperStyles = {
            height: '100%',
            maxWidth: `${this.maxImageWidth}px`,
            flexShrink: 0,
            display: 'inline-block',
            position: 'relative' // Important for pseudo-elements
        };

        const imageStyles = {
            width: '100%',
            height: '100%',
            objectFit: 'cover',
            display: 'block'
        };

        // Apply aspect ratio if specified
        if (this.aspectRatio) {
            const containerHeight = this.container.offsetHeight / this.rows;
            const calculatedWidth = containerHeight * this.aspectRatio;
            wrapperStyles.width = `${Math.min(calculatedWidth, this.maxImageWidth)}px`;
            wrapperStyles.height = `${Math.min(calculatedWidth / this.aspectRatio, containerHeight)}px`;
        } else {
            wrapperStyles.width = 'auto';
        }

        gsap.set(wrapper, wrapperStyles);
        gsap.set(img, imageStyles);
    }

    styleImage(img) {
        const styles = {
            height: '100%',
            maxWidth: `${this.maxImageWidth}px`,
            objectFit: 'cover',
            flexShrink: 0,
            display: 'inline-block'
        };

        // Apply aspect ratio if specified
        if (this.aspectRatio) {
            const containerHeight = this.container.offsetHeight / this.rows;
            const calculatedWidth = containerHeight * this.aspectRatio;
            styles.width = `${Math.min(calculatedWidth, this.maxImageWidth)}px`;
            styles.height = `${Math.min(calculatedWidth / this.aspectRatio, containerHeight)}px`;
        } else {
            styles.width = 'auto';
        }

        gsap.set(img, styles);
    }

    start() {
        this.stop(); // Stop any existing animations

        this.rowElements.forEach((row, index) => {
            const direction = index % 2 === 0 ? 1 : -1; // Alternate direction
            
            // For seamless scrolling, we need to calculate the width of one set of images
            const wrappers = row.querySelectorAll(`.${this.wrapperClass}`);
            const originalSetWidth = Array.from(wrappers).slice(0, wrappers.length / 3).reduce((total, wrapper) => {
                return total + wrapper.offsetWidth + this.gap;
            }, 0);
            
            // Set initial position for seamless loop
            const startX = direction === 1 ? 0 : -originalSetWidth;
            gsap.set(row, { x: startX });

            // Create seamless looping animation
            const distance = originalSetWidth;
            const duration = distance / this.speed;
            
            const animation = gsap.to(row, {
                x: direction === 1 ? -originalSetWidth : 0,
                duration: duration,
                ease: 'none',
                repeat: -1,
                repeatDelay: 0
            });

            this.animations.push(animation);
        });
    }

    stop() {
        this.animations.forEach(animation => animation.kill());
        this.animations = [];
    }

    pause() {
        this.animations.forEach(animation => animation.pause());
    }

    resume() {
        this.animations.forEach(animation => animation.resume());
    }

    calculateRowWidth(row) {
        const wrappers = row.querySelectorAll(`.${this.wrapperClass}`);
        let totalWidth = 0;
        
        wrappers.forEach((wrapper, index) => {
            totalWidth += wrapper.offsetWidth;
            if (index < wrappers.length - 1) {
                totalWidth += this.gap;
            }
        });
        
        return totalWidth;
    }

    setSpeed(newSpeed) {
        this.speed = newSpeed;
        if (this.animations.length > 0) {
            this.start(); // Restart with new speed
        }
    }

    setDirection(newDirection) {
        this.direction = newDirection;
        gsap.set(this.container, {
            transform: `rotate(${this.direction}deg)`
        });
    }

    destroy() {
        this.stop();
        
        // Show original images
        this.images.forEach(img => {
            gsap.set(img, { 
                position: '',
                visibility: 'visible',
                pointerEvents: 'auto'
            });
        });
        
        // Remove row elements
        this.rowElements.forEach(row => row.remove());
        this.rowElements = [];
        
        // Reset container
        gsap.set(this.container, {
            position: '',
            overflow: '',
            transform: ''
        });
    }
}

// Factory function for easy initialization
function createPhotoScroller(options) {
    return new PhotoScroller(options);
}

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PhotoScroller;
}

// Global access
window.PhotoScroller = PhotoScroller;
window.createPhotoScroller = createPhotoScroller;