@props(['title', 'src', 'navigationLink', 'categories' => []])

<v-categories-carousel
    src="{{ $src }}"
    title="{{ $title }}"
    navigation-link="{{ $navigationLink ?? '' }}"
    :selected-categories="@js($categories)"
>
    <x-shop::shimmer.categories.carousel :count="8" :navigation-link="$navigationLink ?? false" />
</v-categories-carousel>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-categories-carousel-template"
    >
        <div
            class="container py-8 max-lg:px-8  max-md:py-6 max-md:!px-0  max-sm:py-4"
            v-if="! isLoading && categories?.length"
        >
            <div class="relative">
                <div
                    ref="swiperContainer"
                    class="scrollbar-hide flex gap-10 overflow-auto scroll-smooth max-lg:gap-4"
                >
                    <div
                        class="grid min-w-[120px] max-w-[120px] grid-cols-1 justify-items-center gap-4 font-medium max-md:min-w-20 max-md:max-w-20 max-md:gap-2.5 max-md:first:ml-4 max-sm:min-w-[60px] max-sm:max-w-[60px] max-sm:gap-1.5"
                        v-for="category in categories"
                    >
                        <a
                            :href="categoryUrl(category)"
                            class="h-[110px] w-[110px] rounded-full bg-surface max-md:h-20 max-md:w-20 max-sm:h-[60px] max-sm:w-[60px]"
                            :aria-label="category.name"
                        >
                            <x-shop::media.images.lazy
                                ::src="category.logo?.large_image_url || category.banner?.small_image_url || '{{ bagisto_asset('images/small-product-placeholder.webp') }}'"
                                width="110"
                                height="110"
                                class="w-full rounded-full max-sm:h-[60px] max-sm:w-[60px] object-cover object-center"
                                ::alt="category.name"
                            />
                        </a>

                        <a
                            :href="categoryUrl(category)"
                            class=""
                        >
                            <p
                                class="text-center text-lg text-on-background max-md:text-base max-md:font-normal max-sm:text-sm"
                                v-text="category.name"
                            >
                            </p>
                        </a>
                    </div>
                </div>

                <span
                    class="icon-arrow-left-stylish absolute -left-10 top-9 flex h-[50px] w-[50px] cursor-pointer items-center justify-center rounded-full border border-on-surface/80 bg-surface text-2xl transition hover:bg-on-surface hover:text-surface max-lg:-left-7 max-md:hidden"
                    role="button"
                    aria-label="@lang('shop::components.carousel.previous')"
                    tabindex="0"
                    @click="swipeLeft"
                >
                </span>

                <span
                    class="icon-arrow-right-stylish absolute -right-6 top-9 flex h-[50px] w-[50px] cursor-pointer items-center justify-center rounded-full border border-on-surface/80 bg-surface text-2xl transition hover:bg-on-surface hover:text-background max-lg:-right-7 max-md:hidden"
                    role="button"
                    aria-label="@lang('shop::components.carousel.next')"
                    tabindex="0"
                    @click="swipeRight"
                >
                </span>
            </div>
        </div>

        <!-- Category Carousel Shimmer -->
        <template v-if="isLoading">
            <x-shop::shimmer.categories.carousel
                :count="8"
                :navigation-link="$navigationLink ?? false"
            />
        </template>
    </script>

    <script type="module">
        app.component('v-categories-carousel', {
            template: '#v-categories-carousel-template',

            props: [
                'src',
                'title',
                'navigationLink',
                'selectedCategories'
            ],

            data() {
                return {
                    isLoading: true,

                    categories: [],

                    offset: 323,
                };
            },

            mounted() {
                if (this.selectedCategories.length > 0) {
                    this.categories = this.selectedCategories;
                    this.isLoading = false;
                } else {
                    this.getCategories();
                }
            },

            methods: {
                categoryUrl(category) {
                    const url = new URL('{{ url('') }}');
                    url.pathname = category.slug;
                    return url.href;
                },

                getCategories() {
                    this.$axios.get(this.src)
                        .then(response => {
                            this.isLoading = false;

                            this.categories = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                },

                swipeLeft() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft -= this.offset;
                },

                swipeRight() {
                    const container = this.$refs.swiperContainer;

                    container.scrollLeft += this.offset;
                },
            },
        });
    </script>
@endPushOnce
