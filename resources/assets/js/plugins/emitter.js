import mitt from 'mitt';

const emitter = mitt();

export default {
  install: (app, options) => {
    app.config.globalProperties.$emitter = emitter;
  },
};
