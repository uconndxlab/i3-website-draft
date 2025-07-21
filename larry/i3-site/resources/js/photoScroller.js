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
        this.imageFit = options.imageFit || 'cover'; // 'cover', 'contain', 'fit-width', or any CSS object-fit value
        this.constrainHeight = options.constrainHeight !== false; // whether to set a specific height on images
        this.imageClass = options.imageClass || 'photo-scroller-image'; // class name for img elements
        this.wrapperClass = options.wrapperClass || 'photo-scroller-wrapper'; // class name for img wrapper elements
        this.imageRowClass = options.imageRowClass || 'photo-scroller-row'; // class name for row elements
        this.reverseDirection = options.reverseDirection || false; // reverse the scrolling direction
        
        // Image rotation properties
        this.imageRotationThreshold = 45; // degrees - when to start rotating images
        this.imageRotation = 0; // current image rotation
        
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
            // transform: `rotate(${this.direction}deg)`,
            width: '200vw', // Make container full viewport width
            transform: `translateX(-50vw) rotate(${this.direction}deg)` // Center and rotate
        });
        
        // Calculate initial image rotation
        this.imageRotation = this.calculateImageRotation();
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
        row.className = `${this.imageRowClass} photo-scroller-row-${index}`;
        
        // Calculate top position accounting for previous rows and their gaps
        const topPosition = index * this.rowGap;
        
        gsap.set(row, {
            position: 'relative',
            top: index === 0 ? 0 : `${topPosition}px`,
            left: 0,
            width: '100%', // Full width of the already full-width container
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center', // Center the content within the row
            gap: `${this.gap}px`,
            whiteSpace: 'nowrap',
            zIndex: 10 + index, // Ensure rows are visible above original images
            marginBottom: index < this.rows - 1 ? `${this.rowGap}px` : '0' // Add margin except for last row
        });

        return row;
    }

    styleImageWrapper(wrapper) {
        const img = wrapper.querySelector('img');
        
        // Calculate dimensions based on aspect ratio and constraints
        // Use maxImageWidth to derive a reasonable default row height
        const defaultRowHeight = this.aspectRatio ? this.maxImageWidth / this.aspectRatio : 200;
        let imageWidth, imageHeight;
        
        if (this.imageFit === 'fit-width') {
            // Fit to width: use maxImageWidth and let height be natural
            const naturalAspectRatio = img.naturalWidth / img.naturalHeight;
            imageWidth = Math.min(this.maxImageWidth, img.naturalWidth);
            imageHeight = imageWidth / naturalAspectRatio;
        } else if (this.aspectRatio) {
            // When images are rotated 90°, we need to account for visual aspect ratio
            let effectiveAspectRatio = this.aspectRatio;
            if (Math.abs(this.imageRotation) === 90) {
                // Flip aspect ratio for 90° rotation since width becomes height visually
                effectiveAspectRatio = 1 / this.aspectRatio;
            }
            
            // Calculate width from height and effective aspect ratio
            const calculatedWidth = defaultRowHeight * effectiveAspectRatio;
            imageWidth = Math.min(calculatedWidth, this.maxImageWidth);
            imageHeight = imageWidth / effectiveAspectRatio;
        } else {
            // Use natural image dimensions up to maxImageWidth
            const naturalAspectRatio = img.naturalWidth / img.naturalHeight;
            if (img.naturalWidth > this.maxImageWidth) {
                imageWidth = this.maxImageWidth;
                imageHeight = this.maxImageWidth / naturalAspectRatio;
            } else {
                imageWidth = img.naturalWidth;
                imageHeight = img.naturalHeight;
            }
            // Scale down if height exceeds reasonable default
            if (imageHeight > defaultRowHeight) {
                imageHeight = defaultRowHeight;
                imageWidth = defaultRowHeight * naturalAspectRatio;
            }
        }
        
        // Calculate wrapper dimensions to account for rotation
        let wrapperWidth = imageWidth;
        let wrapperHeight = this.constrainHeight ? imageHeight : 'auto';
        
        // When images are rotated 90 degrees, swap width and height for wrapper
        if (Math.abs(this.imageRotation) === 90) {
            wrapperWidth = this.constrainHeight ? imageHeight : 'auto';
            wrapperHeight = imageWidth;
        }
        
        const wrapperStyles = {
            width: `${wrapperWidth}px`,
            flexShrink: 0,
            display: 'inline-flex',
            alignItems: 'center',
            justifyContent: 'center',
            position: 'relative',
            overflow: 'visible' // Changed to visible so rotated content isn't clipped
        };

        // Only set wrapper height if we're constraining height
        if (this.constrainHeight && wrapperHeight !== 'auto') {
            wrapperStyles.height = `${wrapperHeight}px`;
        }

        const imageStyles = {
            width: `${imageWidth}px`,
            objectFit: this.imageFit,
            display: 'block',
            transform: `rotate(${this.imageRotation}deg)`,
            transformOrigin: 'center center'
        };

        // Only set height if constrainHeight is true
        if (this.constrainHeight) {
            imageStyles.height = `${imageHeight}px`;
        }

        gsap.set(wrapper, wrapperStyles);
        gsap.set(img, imageStyles);
    }

    styleImage(img) {
        // Calculate dimensions based on aspect ratio and constraints
        // Use maxImageWidth to derive a reasonable default row height
        const defaultRowHeight = this.aspectRatio ? this.maxImageWidth / this.aspectRatio : 200;
        let imageWidth, imageHeight;
        
        if (this.imageFit === 'fit-width') {
            // Fit to width: use maxImageWidth and let height be natural
            const naturalAspectRatio = img.naturalWidth / img.naturalHeight;
            imageWidth = Math.min(this.maxImageWidth, img.naturalWidth);
            imageHeight = imageWidth / naturalAspectRatio;
        } else if (this.aspectRatio) {
            // When images are rotated 90°, we need to account for visual aspect ratio
            let effectiveAspectRatio = this.aspectRatio;
            if (Math.abs(this.imageRotation) === 90) {
                // Flip aspect ratio for 90° rotation since width becomes height visually
                effectiveAspectRatio = 1 / this.aspectRatio;
            }
            
            // Calculate width from height and effective aspect ratio
            const calculatedWidth = defaultRowHeight * effectiveAspectRatio;
            imageWidth = Math.min(calculatedWidth, this.maxImageWidth);
            imageHeight = imageWidth / effectiveAspectRatio;
        } else {
            // Use natural image dimensions up to maxImageWidth
            const naturalAspectRatio = img.naturalWidth / img.naturalHeight;
            if (img.naturalWidth > this.maxImageWidth) {
                imageWidth = this.maxImageWidth;
                imageHeight = this.maxImageWidth / naturalAspectRatio;
            } else {
                imageWidth = img.naturalWidth;
                imageHeight = img.naturalHeight;
            }
            // Scale down if height exceeds reasonable default
            if (imageHeight > defaultRowHeight) {
                imageHeight = defaultRowHeight;
                imageWidth = defaultRowHeight * naturalAspectRatio;
            }
        }

        const styles = {
            width: `${imageWidth}px`,
            objectFit: this.imageFit === 'fit-width' ? 'none' : this.imageFit,
            flexShrink: 0,
            display: 'inline-block',
            transform: `rotate(${this.imageRotation}deg)`,
            transformOrigin: 'center center'
        };

        // Only set height if constrainHeight is true
        if (this.constrainHeight) {
            styles.height = `${imageHeight}px`;
        }

        gsap.set(img, styles);
    }

    /**
     * Calculate the rotation to apply to individual images based on container direction
     */
    calculateImageRotation() {
        const absDirection = Math.abs(this.direction % 360);
        const normalizedDirection = absDirection > 180 ? 360 - absDirection : absDirection;
        
        if (normalizedDirection > this.imageRotationThreshold) {
            // Rotate images to be closer to upright
            // For angles > 45°, rotate by -90° to make images more vertical
            if (this.direction > this.imageRotationThreshold) {
                return -90;
            } else if (this.direction < -this.imageRotationThreshold) {
                return 90;
            }
        }
        return 0;
    }

    start() {
        this.stop(); // Stop any existing animations

        this.rowElements.forEach((row, index) => {
            let direction = index % 2 === 0 ? 1 : -1; // Alternate direction
            
            // Apply reverse direction if enabled
            if (this.reverseDirection) {
                direction *= -1;
            }
            
            // For seamless scrolling, we need to calculate the width of one set of images
            const wrappers = row.querySelectorAll(`.${this.wrapperClass}`);
            const originalSetWidth = Array.from(wrappers).slice(0, wrappers.length / 3).reduce((total, wrapper) => {
                return total + wrapper.offsetWidth + this.gap;
            }, 0);
            
            // Set initial position to ensure row is filled from the start
            // For right-moving rows, start at -originalSetWidth so the second set is visible
            // For left-moving rows, start at -originalSetWidth so the second set is visible
            const startX = -originalSetWidth;
            gsap.set(row, { x: startX });

            // Create seamless looping animation
            const distance = originalSetWidth;
            const duration = distance / this.speed;
            
            const animation = gsap.to(row, {
                x: direction === 1 ? -originalSetWidth * 2 : 0,
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
        const images = row.querySelectorAll('img');
        let totalWidth = 0;
        
        images.forEach((img, index) => {
            totalWidth += img.offsetWidth;
            if (index < images.length - 1) {
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

    setReverseDirection(reverse) {
        this.reverseDirection = reverse;
        if (this.animations.length > 0) {
            this.start(); // Restart with new direction
        }
    }

    toggleScrollDirection() {
        this.reverseDirection = !this.reverseDirection;
        if (this.animations.length > 0) {
            this.start(); // Restart with new direction
        }
    }

    setDirection(newDirection) {
        this.direction = newDirection;
        
        // Calculate new image rotation
        const newImageRotation = this.calculateImageRotation();
        
        // Update container rotation
        gsap.set(this.container, {
            transform: `rotate(${this.direction}deg)`
        });
        
        // Update image rotation if it changed
        if (newImageRotation !== this.imageRotation) {
            this.imageRotation = newImageRotation;
            
            // Apply new rotation to all images and recalculate wrapper dimensions
            this.rowElements.forEach(row => {
                const wrappers = row.querySelectorAll(`.${this.wrapperClass}`);
                wrappers.forEach(wrapper => {
                    this.styleImageWrapper(wrapper);
                });
            });
        }
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