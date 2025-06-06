import { createApp } from 'vue/dist/vue.esm-bundler.js';

import Axios from './plugins/axios';
import Emitter from './plugins/emitter';
import Shop from './plugins/shop';
import VeeValidate from './plugins/vee-validate';
import Flatpickr from './plugins/flatpickr';

import Debounce from './directives/debounce';

import.meta.glob(['../images/**', '../fonts/**']);

/**
 * Applies all globally used Vue plugins and directives to a given app instance
 */
function configureApp(app) {
  [Axios, Emitter, Shop, VeeValidate, Flatpickr].forEach((plugin) => app.use(plugin));
  app.directive('debounce', Debounce);
}

/**
 * These options are reused across all Vue instances, including the main app
 * and dynamically mounted CMS sections.
 */
function sharedAppOptions() {
  return {
    mounted() {
      this.lazyLoadImages();
    },

    methods: {
      lazyLoadImages() {
        const lazyImages = [...document.querySelectorAll('img.lazy')];

        // If IntersectionObserver is not supported, load all images immediately
        if (!('IntersectionObserver' in window)) {
          lazyImages.forEach((img) => (img.src = img.dataset.src));
          return;
        }

        const observer = new IntersectionObserver((entries, obs) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              const img = entry.target;
              img.src = img.dataset.src;
              img.classList.remove('lazy');
              obs.unobserve(img);
            }
          });
        });

        lazyImages.forEach((img) => observer.observe(img));
      },
    },
  };
}

/**
 * Prevents "component already registered" errors by allowing re-registration
 * of components when in visual editor. Useful when Vue apps are re-created
 * dynamically as sections/blocks are added/removed.
 * Component templates may have changed.
 */
function setupDesignModeOverride(app) {
  if (window.Visual?.inDesignMode) {
    const originalComponent = app.component.bind(app);
    app.component = (name, definition) => {
      if (Object.prototype.hasOwnProperty.call(app._context.components, name)) {
        delete app._context.components[name];
      }
      return originalComponent(name, definition);
    };
  }
}

/**
 * Creates the main Vue app instance and sets it on `window.app`
 * so it can be reused for mounting components later.
 */
function createMainApp() {
  const app = createApp(sharedAppOptions());

  configureApp(app);
  setupDesignModeOverride(app);

  window.app = app;

  return app;
}

/**
 * Creates a Vue app instance for a specific DOM element (section).
 * with all plugins/components already configured.
 */
function mountComponent(el) {
  const targetEl = el.cloneNode(false);

  const localApp = createApp({
    template: el.innerHTML,
    ...sharedAppOptions(),
  });

  configureApp(localApp);

  // Register components already available in main app,
  // skipping those already included by VeeValidate plugin
  Object.entries(window.app._context.components).forEach(([name, component]) => {
    if (!['VErrorMessage', 'VForm', 'VField'].includes(name)) {
      localApp.component(name, component);
    }
  });

  localApp.mount(targetEl);
  el.replaceWith(targetEl);
}

/**
 * Determines if a section contains Vue components (e.g. <v-[name]> tags).
 * so we can avoid mounting Vue unnecessarily.
 */
function shouldMountVue(section) {
  if (!section) return false;

  // Fast check using regex on HTML string
  const fastCheck = /<v-[a-z0-9-]+\b/i.test(section.innerHTML);
  if (!fastCheck) return false;

  // More accurate check using actual DOM element tags
  return Array.from(section.querySelectorAll('*')).some((el) => el.tagName.toLowerCase().startsWith('v-'));
}

/**
 * In the Visual Editor, each section is independent.
 * When editing, the backend can re-render a section's HTML and re-insert it into the DOM.
 * These reinserted DOM elements are disconnected from the main Vue app instance,
 * meaning they won’t be reactive or interactive unless re-mounted manually.
 *
 * This event listener listens for section updates and mounts a fresh Vue app
 * for the updated section using the same plugin setup and shared options.
 *
 * Each section is treated as a fully self-contained Vue app instance.
 */
document.addEventListener('visual:section:load', (event) => {
  const el = document.querySelector(`[data-section-id='${event.detail.section.id}']`);

  if (shouldMountVue(el)) {
    // Add little delay to ensure new scripts (vue templates) are executed before mounting
    // The delay works, but we should refactorize to make sur new scripts are executed
    setTimeout(() => mountComponent(el), 50);
  }
});

/**
 * When the user changes theme settings like font, colors..
 * The whole live preview html is replaced with new html from the backend
 * meaning there is no more vue app instance
 * so we remount the main vue again
 */
document.addEventListener('visual:page:load', () => {
  mountComponent(document.querySelector('#app'));
});

const app = createMainApp();

window.setupApp = () => {
  if (window.Visual?.inDesignMode) {
    app.config.compilerOptions.comments = true;
  }

  app.mount('#app');
};
