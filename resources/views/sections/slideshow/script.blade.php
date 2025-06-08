<script type="module">
    app.component("v-slideshow", {
        template: '#v-slideshow-template',

        data() {
            return {
                sliderId: '{{ $section->id }}',
                isDragging: false,
                startPos: 0,
                currentTranslate: 0,
                prevTranslate: 0,
                animationID: 0,
                currentIndex: 0,
                slider: '',
                slides: [],
                autoPlayInterval: null,
                direction: 'ltr',
                startFrom: 1,
            };
        },

        mounted() {
            this.slider = this.$refs.sliderContainer;

            this.slides = this.$el.querySelectorAll('.slide');

            this.init();

            this.play();

            @visual_design_mode
            const activeSlideIndex = sessionStorage.getItem(`section:${this.sliderId}:current-slide`);
            if (activeSlideIndex) {
                this.currentIndex = Number(activeSlideIndex);
                this.setPositionByIndex();
                this.stop();
            }

            document.addEventListener('visual:block:select', (event) => {
                const index = Array.from(this.slides).findIndex(node => node.dataset.slideId === event.detail.blockId);
                console.log(index);
                this.currentIndex = index;
                this.setPositionByIndex();
                this.stop();
            });

            document.addEventListener('visual:block:deselect', (event) => {
                this.play();
            });

            document.addEventListener('visual:section:unload', (event) => {
                if (event.detail.section.type !== 'visual-velocity::slideshow') {
                    return;
                }

                if (event.detail.block) {
                    const slideIndex = Array.from(this.slides).findIndex(node => node.dataset.slideId === event.detail.block.id);
                    if (slideIndex !== -1) {
                        sessionStorage.setItem(`section:${this.sliderId}:current-slide`, slideIndex);
                    }
                }
            });

            document.addEventListener('visual:section:deselect', (event) => {
                sessionStorage.removeItem(`section:${this.sliderId}:current-slide`);
                this.play();
            });
            @end_visual_design_mode
        },

        methods: {
            init() {
                this.direction = document.dir;

                if (this.direction == 'rtl') {
                    this.startFrom = -1;
                }

                this.slides.forEach((slide, index) => {
                    slide.querySelector('img')?.addEventListener('dragstart', (e) => e.preventDefault());

                    slide.addEventListener('mousedown', this.handleDragStart);

                    slide.addEventListener('touchstart', this.handleDragStart);

                    slide.addEventListener('mouseup', this.handleDragEnd);

                    slide.addEventListener('mouseleave', this.handleDragEnd);

                    slide.addEventListener('touchend', this.handleDragEnd);

                    slide.addEventListener('mousemove', this.handleDrag);

                    slide.addEventListener('touchmove', this.handleDrag, {
                        passive: true
                    });
                });

                window.addEventListener('resize', this.setPositionByIndex);
            },

            handleDragStart(event) {
                this.startPos = event.type === 'mousedown' ? event.clientX : event.touches[0].clientX;

                this.isDragging = true;

                this.animationID = requestAnimationFrame(this.animation);
            },

            handleDrag(event) {
                if (!this.isDragging) {
                    return;
                }

                const currentPosition = event.type === 'mousemove' ? event.clientX : event.touches[0].clientX;

                this.currentTranslate = this.prevTranslate + currentPosition - this.startPos;
            },

            handleDragEnd(event) {
                this.stop();

                cancelAnimationFrame(this.animationID);

                this.isDragging = false;

                const movedBy = this.currentTranslate - this.prevTranslate;

                if (this.direction == 'ltr') {
                    if (
                        movedBy < -100 &&
                        this.currentIndex < this.slides.length - 1
                    ) {
                        this.currentIndex += 1;
                    }

                    if (
                        movedBy > 100 &&
                        this.currentIndex > 0
                    ) {
                        this.currentIndex -= 1;
                    }
                } else {
                    if (
                        movedBy > 100 &&
                        this.currentIndex < this.slides.length - 1
                    ) {
                        if (Math.abs(this.currentIndex) != this.slides.length - 1) {
                            this.currentIndex -= 1;
                        }
                    }

                    if (
                        movedBy < -100 &&
                        this.currentIndex < 0
                    ) {
                        this.currentIndex += 1;
                    }
                }

                this.setPositionByIndex();

                this.play();
            },

            animation() {
                this.setSliderPosition();

                if (this.isDragging) {
                    requestAnimationFrame(this.animation);
                }
            },

            setPositionByIndex() {
                this.currentTranslate = this.currentIndex * -window.innerWidth;

                this.prevTranslate = this.currentTranslate;

                this.setSliderPosition();
            },

            setSliderPosition() {
                if (this.slider) {
                    this.slider.style.transform = `translateX(${this.currentTranslate}px)`;
                }
            },

            visitLink(link) {
                if (link) {
                    window.location.href = link;
                }
            },

            navigate(type) {
                this.stop();

                if (this.direction === 'rtl') {
                    type === 'next' ? this.prev() : this.next();
                } else {
                    type === 'next' ? this.next() : this.prev();
                }

                this.setPositionByIndex();

                this.play();
            },

            next() {
                this.currentIndex = (this.currentIndex + this.startFrom) % this.slides.length;
            },

            prev() {
                this.currentIndex = this.direction == 'ltr' ?
                    this.currentIndex > 0 ? this.currentIndex - 1 : 0 :
                    this.currentIndex < 0 ? this.currentIndex + 1 : 0;
            },

            navigateByPagination(index) {
                this.direction == 'rtl' ? index = -index : '';

                this.stop();

                this.currentIndex = index;

                this.setPositionByIndex();

                this.play();
            },

            play() {
                this.stop();

                this.autoPlayInterval = setInterval(() => {
                    this.currentIndex = (this.currentIndex + this.startFrom) % this.slides.length;

                    this.setPositionByIndex();
                }, 5000);
            },

            stop() {
                clearInterval(this.autoPlayInterval);
            }
        },
    });
</script>
