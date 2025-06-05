<v-flash-item
    v-for='flash in flashes'
    :key='flash.uid'
    :flash="flash"
    @onRemove="remove($event)"
/>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-flash-item-template"
    >
        <div
            class="flex w-max max-w-[408px] justify-between gap-12 rounded-lg px-5 py-3 max-sm:max-w-80 max-sm:items-center max-sm:gap-2 max-sm:p-3"
            :style="typeStyles[flash.type]['container']"
        >
            <p
                class="flex items-center break-words text-sm"
                :style="typeStyles[flash.type]['message']"
            >
                <span
                    class="icon-toast-done text-2xl ltr:mr-2.5 rtl:ml-2.5"
                    :class="iconClasses[flash.type]"
                    :style="typeStyles[flash.type]['icon']"
                ></span>

                @{{ flash.message }}
            </p>

			<span
                class="icon-cancel max-h-4 max-w-4 cursor-pointer"
                :style="typeStyles[flash.type]['icon']"
                @click="remove"
            ></span>
        </div>
    </script>

    <script type="module">
        app.component('v-flash-item', {
            template: '#v-flash-item-template',

            props: ['flash'],

            data() {
                return {
                    iconClasses: {
                        success: 'icon-toast-done',

                        error: 'icon-toast-error',

                        warning: 'icon-toast-exclamation-mark',

                        info: 'icon-toast-info',
                    },

                    typeStyles: {
                        success: {
                            container: 'background: rgb(var(--color-on-success))',

                            message: 'color: rgb(var(--color-success))',

                            icon: 'color: rgb(var(--color-success))'
                        },

                        error: {
                            container: 'background: rgb(var(--color-on-danger))',

                            message: 'color: rgb(var(--color-danger))',

                            icon: 'color: rgb(var(--color-danger))'
                        },

                        warning: {
                            container: 'background: rgb(var(--color-on-waring))',

                            message: 'color: rgb(var(--color-warning))',

                            icon: 'color: rgb(var(--color-warning))',
                        },

                        info: {
                            container: 'background: rgb(var(--color-on-neutral))',

                            message: 'color: rgb(var(--color-neutral))',

                            icon: 'color: rgb(var(--color-neutral))',
                        },
                    },
                };
            },

            created() {
                var self = this;

                setTimeout(function() {
                    self.remove()
                }, 5000)
            },

            methods: {
                remove() {
                    this.$emit('onRemove', this.flash)
                }
            }
        });
    </script>
@endpushOnce
