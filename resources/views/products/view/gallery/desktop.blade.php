<!-- For large screens greater than 1180px. -->
<div class="sticky top-20 flex h-max gap-8 max-1180:hidden">
    <!-- Product Image and Videos Slider -->
    <div class="flex-24 h-509 flex min-w-[100px] max-w-[100px] flex-wrap place-content-start justify-center gap-2.5 overflow-y-auto overflow-x-hidden">
        <!-- Arrow Up -->
        <span
            v-if="lengthOfMedia"
            class="icon-arrow-up cursor-pointer text-2xl"
            role="button"
            aria-label="@lang('shop::app.components.products.carousel.previous')"
            tabindex="0"
            @click="swipeDown"
        >
        </span>

        <!-- Swiper Container -->
        <div ref="swiperContainer" class="scrollbar-hide flex max-h-[540px] flex-col gap-2.5 overflow-auto scroll-smooth [&>*]:flex-[0]">
            <template v-for="(media, index) in [...media.images, ...media.videos]">
                <video
                    v-if="media.type == 'videos'"
                    :class="`transparent max-h-[100px] min-w-[100px] cursor-pointer rounded-xl border ${isActiveMedia(index) ? 'pointer-events-none border-navyBlue' : 'border-white'}`"
                    alt="{{ $product->name }}"
                    tabindex="0"
                    @click="change(media, index)"
                >
                    <source :src="media.video_url" type="video/mp4" />
                </video>

                <img
                    v-else
                    :class="`transparent max-h-[100px] min-w-[100px] cursor-pointer rounded-xl border ${isActiveMedia(index) ? 'pointer-events-none border border-navyBlue' : 'border-white'}`"
                    :src="media.small_image_url"
                    alt="{{ $product->name }}"
                    width="100"
                    height="100"
                    tabindex="0"
                    @click="change(media, index)"
                />
            </template>
        </div>

        <!-- Arrow Down -->
        <span
            v-if= "lengthOfMedia"
            class="icon-arrow-down cursor-pointer text-2xl"
            role="button"
            aria-label="@lang('shop::app.components.products.carousel.previous')"
            tabindex="0"
            @click="swipeTop"
        >
        </span>
    </div>

    <!-- Product Base Image and Video with Shimmer-->
    <div v-show="isMediaLoading" class="max-h-[610px] max-w-[560px]">
        <div class="shimmer min-h-[607px] min-w-[560px] rounded-xl bg-surface-alt"></div>
    </div>

    <div v-show="! isMediaLoading" class="max-h-[610px] max-w-[560px]">
        <img
            v-if="baseFile.type == 'image'"
            class="min-w-[450px] cursor-pointer rounded-xl"
            :src="baseFile.path"
            alt="{{ $product->name }}"
            width="560"
            height="610"
            tabindex="0"
            @load="onMediaLoad()"
            fetchpriority="high"
            @click="isImageZooming = !isImageZooming"
        />

        <div
            v-if="baseFile.type == 'video'"
            class="min-w-[450px] cursor-pointer rounded-xl"
            tabindex="0"
        >
            <video
                controls
                width="475"
                alt="{{ $product->name }}"
                @loadeddata="onMediaLoad()"
                :key="baseFile.path"
                @click="isImageZooming = !isImageZooming"
            >
                <source :src="baseFile.path" type="video/mp4" />
            </video>
        </div>
    </div>
</div>
