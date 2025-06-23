import Alpine from 'alpinejs';

window.Alpine = Alpine;

// สำหรับ Image Slider
Alpine.data('imageSlider', () => ({
    activeSlide: 0,
    totalSlides: 0,
    
    init() {
        this.totalSlides = this.$el.querySelectorAll('.slide').length;
        
        // รับการส่ง event จากปุ่ม thumbnail
        this.$watch('activeSlide', value => {
            this.showSlide(value);
        });
        
        // สามารถรับ event จากภายนอก
        window.addEventListener('setSlide', (event) => {
            this.activeSlide = event.detail;
        });
    },
    
    next() {
        this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
    },
    
    prev() {
        this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
    },
    
    showSlide(index) {
        const slides = this.$el.querySelectorAll('.slide');
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('hidden');
            } else {
                slide.classList.add('hidden');
            }
        });
    }
}));

// สำหรับ Dropdown Menu
Alpine.data('dropdown', () => ({
    open: false,
    
    toggle() {
        this.open = !this.open;
    },
    
    close() {
        this.open = false;
    }
}));

// สำหรับ Modal
Alpine.data('modal', () => ({
    isOpen: false,
    
    open() {
        this.isOpen = true;
        document.body.classList.add('overflow-hidden');
    },
    
    close() {
        this.isOpen = false;
        document.body.classList.remove('overflow-hidden');
    }
}));

// สำหรับ Tab
Alpine.data('tabs', () => ({
    activeTab: 0,
    
    setActiveTab(index) {
        this.activeTab = index;
    }
}));

Alpine.start();