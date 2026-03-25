import gsap from 'gsap';
import Draggable from 'gsap/Draggable';

gsap.registerPlugin(Draggable);

class CustomSlider {
    constructor(container, options = {}) {
        this.container = container;
        this.track = container.querySelector('[data-slider-track]') 
            || container.querySelector('.nail-artists__list')
            || container.querySelector(':scope > ul, :scope > .slider__track');
        this.slides = Array.from(container.querySelectorAll('[data-slider-slide]:not(.clone)')) 
            || Array.from(this.track?.querySelectorAll('.nail-artists__slide:not(.clone)')) 
            || Array.from(this.track?.querySelectorAll(':scope > li, :scope > .slider__slide:not(.clone)') || []);
        this.controls = container.querySelector('[data-slider-controls]') 
            || container.parentElement.querySelector('.nail-artists__controls');
        this.prevBtn = this.controls?.querySelector('[data-slider-prev]') 
            || this.controls?.querySelector('.nail-artists__arrow--prev');
        this.nextBtn = this.controls?.querySelector('[data-slider-next]') 
            || this.controls?.querySelector('.nail-artists__arrow--next');

        
        this.options = {
            breakpoints: {},
            duration: 0.4,
            ease: 'power2.out',
            clonesCount: 3,
            loop: true,
            centerSlides: false,
            onSlideChange: null,
            ...options
        };
        
        this.index = 0;
        this.allowShift = true;
        this.slideWidth = 0;
        this.gap = 15;
        this.loop = true;
        this.centerSlides = false;
        this.isOverflowing = false;
        this.eventsBound = false;
        this.isDragging = false;
        this.slidesLength = this.slides.length;
        this.posX1 = 0;
        this.posX2 = 0;
        this.posInitial = 0;
        this.posFinal = 0;
        this.clonesCount = this.options.clonesCount;
        
        this.triggerCallback = this.triggerCallback.bind(this);
        
        this.init();
    }
    
    init() {
        if (!this.track || this.slidesLength === 0) return;
        
        if (this.container.dataset.initialized) return;
        this.container.dataset.initialized = 'true';
        
        this.updateBreakpoint();
        this.updateDimensions();
        
        window.addEventListener('resize', () => {
            clearTimeout(this.resizeTimer);
            this.resizeTimer = setTimeout(() => this.handleResize(), 100);
        });
        
        this.isOverflowing = !this.checkOverflow();
        
        if (this.slidesLength <= 1) {
            if (this.controls) this.controls.style.display = 'none';
            return;
        }
        
        if (!this.isOverflowing && !this.loop) {
            if (this.controls) this.controls.style.display = 'none';
            return;
        }
        
        if (this.controls) {
            this.controls.style.display = '';
        }
        
        if (this.loop) {
            this.cloneSlides();
            this.setInitialPosition();
        }
        
        this.bindEvents();
    }
    
    getActiveBreakpoint() {
        const width = window.innerWidth;
        const breakpoints = Object.keys(this.options.breakpoints)
            .map(Number)
            .sort((a, b) => b - a);
        
        for (const bp of breakpoints) {
            if (width >= bp) return bp;
        }
        return breakpoints[breakpoints.length - 1];
    }
    
    updateBreakpoint() {
        const bp = this.getActiveBreakpoint();
        const config = this.options.breakpoints[bp] || {};
        this.loop = config.loop !== false;
        this.centerSlides = config.centerSlides || false;
    }
    
    updateDimensions() {
        this.containerWidth = this.container.offsetWidth;
        
        const slideStyle = getComputedStyle(this.slides[0]);
        this.slideWidth = parseFloat(slideStyle.width) || 271;
        
        this.gap = parseFloat(getComputedStyle(this.track).gap) || 15;
        
        this.slideSize = this.slideWidth + this.gap;
    }
    
    checkOverflow() {
        const totalSlidesWidth = (this.slidesLength * this.slideWidth) + ((this.slidesLength - 1) * this.gap);
        return totalSlidesWidth <= this.containerWidth;
    }
    
    getSlideOffset(index) {
        const baseOffset = -(index * this.slideSize);
        
        if (this.centerSlides) {
            const centerOffset = (this.containerWidth / 2) - (this.slideWidth / 2);
            return baseOffset + centerOffset;
        }
        
        return baseOffset;
    }
    
    cloneSlides() {
        this.track.querySelectorAll('.clone').forEach(el => el.remove());
        
        const clonesBefore = [];
        const clonesAfter = [];
        
        for (let i = 0; i < this.clonesCount; i++) {
            const slideIndex = this.slidesLength - 1 - i;
            const clone = this.slides[slideIndex % this.slidesLength].cloneNode(true);
            clone.classList.add('clone');
            clonesBefore.push(clone);
        }
        
        for (let i = 0; i < this.clonesCount; i++) {
            const clone = this.slides[i % this.slidesLength].cloneNode(true);
            clone.classList.add('clone');
            clonesAfter.push(clone);
        }
        
        clonesBefore.forEach(clone => this.track.prepend(clone));
        clonesAfter.forEach(clone => this.track.appendChild(clone));
        
        this.allSlides = Array.from(this.track.querySelectorAll('[data-slider-slide]')) 
            || Array.from(this.track.querySelectorAll('.nail-artists__slide')) 
            || Array.from(this.track.children);
        
        this.triggerCallback();
    }
    
    setInitialPosition() {
        this.updateDimensions();
        
        let startIndex = 0;
        
        if (this.centerSlides) {
            startIndex = Math.floor(this.slidesLength / 2);
        }
        
        this.index = this.loop ? startIndex + this.clonesCount : startIndex;
        const offset = this.getSlideOffset(this.index);
        
        gsap.set(this.track, { x: offset });
    }
    
    shiftSlide(dir, action) {
        if (!this.allowShift) return;
        
        this.updateDimensions();
        
        if (!action) {
            this.posInitial = gsap.getProperty(this.track, 'x');
        }
        
        const newX = this.posInitial + (-dir * this.slideSize);
        
        this.allowShift = false;
        
        gsap.to(this.track, {
            x: newX,
            duration: this.options.duration,
            ease: this.options.ease,
            onComplete: () => {
                this.checkIndex(dir);
                this.triggerCallback();
            }
        });
        
        this.index += dir;
    }
    
    checkIndex(dir) {
        this.allowShift = true;
        
        if (this.loop && this.index < this.clonesCount) {
            this.index = this.slidesLength + this.index;
            const offset = this.getSlideOffset(this.index);
            gsap.set(this.track, { x: offset });
        }
        
        if (this.loop && this.index >= this.slidesLength + this.clonesCount) {
            this.index = this.index - this.slidesLength;
            const offset = this.getSlideOffset(this.index);
            gsap.set(this.track, { x: offset });
        }
    }
    
    triggerCallback() {
        if (typeof this.options.onSlideChange === 'function') {
            this.options.onSlideChange({
                index: this.index - this.clonesCount,
                realIndex: ((this.index - this.clonesCount) % this.slidesLength + this.slidesLength) % this.slidesLength,
                track: this.track,
                slides: this.slides
            });
        }
    }
    
    goToNext() {
        if (!this.isOverflowing && !this.loop) return;
        
        if (!this.loop && this.index >= this.slidesLength - 1) return;
        
        this.shiftSlide(1);
    }
    
    goToPrev() {
        if (!this.isOverflowing && !this.loop) return;
        
        if (!this.loop && this.index <= 0) return;
        
        this.shiftSlide(-1);
    }
    
    handleResize() {
        const realIndex = this.loop 
            ? ((this.index - this.clonesCount) % this.slidesLength + this.slidesLength) % this.slidesLength
            : Math.max(0, Math.min(this.index, this.slidesLength - 1));
        
        const wasLoop = this.loop;
        this.updateBreakpoint();
        this.updateDimensions();
        
        const wasOverflowing = this.isOverflowing;
        this.isOverflowing = !this.checkOverflow();
        
        if (this.controls) {
            this.controls.style.display = (!this.isOverflowing && !this.loop) ? 'none' : '';
        }
        
        if (!this.isOverflowing && !this.loop) {
            gsap.set(this.track, { x: 0 });
            this.track.querySelectorAll('.clone').forEach(el => el.remove());
            return;
        }
        
        if (wasLoop && !this.loop) {
            this.track.querySelectorAll('.clone').forEach(el => el.remove());
            this.index = realIndex;
            gsap.set(this.track, { x: this.getSlideOffset(this.index) });
            return;
        }
        
        if (!wasLoop && this.loop) {
            this.cloneSlides();
            this.index = realIndex + this.clonesCount;
            gsap.set(this.track, { x: this.getSlideOffset(this.index) });
            return;
        }
        
        if (!wasOverflowing && this.loop) {
            this.cloneSlides();
            this.index = realIndex + this.clonesCount;
            gsap.set(this.track, { x: this.getSlideOffset(this.index) });
            return;
        }
        
        if (!wasOverflowing) {
            if (this.loop) {
                this.cloneSlides();
                this.setInitialPosition();
            }
            this.bindEvents();
            return;
        }
        
        if (this.loop) {
            this.cloneSlides();
            this.index = realIndex + this.clonesCount;
            gsap.set(this.track, { x: this.getSlideOffset(this.index) });
        }
    }
    
    bindEvents() {
        if (this.eventsBound) return;
        this.eventsBound = true;
        
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.goToPrev());
        }
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.goToNext());
        }
        
        this.track.addEventListener('dragstart', e => e.preventDefault());
        
        const self = this;
        
        this.track.addEventListener('mousedown', dragStart);
        this.track.addEventListener('touchstart', dragStart, { passive: true });
        this.track.addEventListener('touchend', dragEnd);
        this.track.addEventListener('touchmove', dragAction, { passive: false });
        this.track.addEventListener('mouseleave', dragEnd);
        
        function dragStart(e) {
            if (!self.isOverflowing && !self.loop) return;
            
            e = e || window.event;
            self.isDragging = true;
            self.posInitial = gsap.getProperty(self.track, 'x');
            
            if (e.type === 'touchstart') {
                self.posX1 = e.touches[0].clientX;
            } else {
                self.posX1 = e.clientX;
                document.onmouseup = dragEnd;
                document.onmousemove = dragAction;
            }
        }
        
        function dragAction(e) {
            if (!self.isOverflowing && !self.loop) return;
            
            e = e || window.event;
            e.preventDefault();
            
            if (e.type === 'touchmove') {
                self.posX2 = self.posX1 - e.touches[0].clientX;
                self.posX1 = e.touches[0].clientX;
            } else {
                self.posX2 = self.posX1 - e.clientX;
                self.posX1 = e.clientX;
            }
            
            const currentX = gsap.getProperty(self.track, 'x');
            gsap.set(self.track, { x: currentX - self.posX2 });
        }
        
        function dragEnd(e) {
            if (!self.isDragging) return;
            if (!self.isOverflowing && !self.loop) return;
            
            self.isDragging = false;
            self.posFinal = gsap.getProperty(self.track, 'x');
            const threshold = self.slideWidth / 4;
            
            if (self.posFinal - self.posInitial < -threshold) {
                self.shiftSlide(1, 'drag');
            } else if (self.posFinal - self.posInitial > threshold) {
                self.shiftSlide(-1, 'drag');
            } else {
                gsap.to(self.track, {
                    x: self.posInitial,
                    duration: self.options.duration,
                    ease: self.options.ease,
                    onComplete: () => self.triggerCallback()
                });
            }
            
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }
}

function createSlider(selector, options = {}) {
    const elements = typeof selector === 'string' 
        ? document.querySelectorAll(selector) 
        : [selector];
    
    const instances = [];
    
    elements.forEach(el => {
        if (el.dataset.initialized) return;
        instances.push(new CustomSlider(el, options));
    });
    
    return instances.length === 1 ? instances[0] : instances;
}

window.CustomSlider = createSlider;

export default CustomSlider;
