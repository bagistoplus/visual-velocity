/** @type {import('tailwindcss').Config} */
export default {
  content: [
    'resources/views/**/*',
    'vendor/bagisto/bagisto/packages/Webkul/Shop/src/Resources/**/*.blade.php',
    'vendor/bagisto/bagisto/packages/Webkul/Shop/src/Resources/**/*.js',
  ],
  safelist: [{ pattern: /icon-/ }],
  theme: {
    container: {
      center: true,
      padding: '90px',
      screens: {
        '2xl': '1440px',
      },
    },

    screens: {
      sm: '525px',
      md: '768px',
      lg: '1024px',
      xl: '1240px',
      '2xl': '1440px',
      1180: '1180px',
      1060: '1060px',
      991: '991px',
      868: '868px',
    },

    extend: {
      fontFamily: {
        body: 'var(--default-font-family)',
        poppins: 'var(--default-font-family)',

        heading: 'var(--heading-font-family)',
        dmserif: 'var(--heading-font-family)',
      },

      colors: {
        navyBlue: 'rgb(var(--color-primary))',
        lightOrange: '#F6F2EB',
        darkGreen: '#40994A',
        darkBlue: '#0044F2',
        darkPink: '#F85156',

        background: createColorVars('background'),
        surface: createColorVars('surface'),
        'surface-alt': createColorVars('surface-alt'),
        primary: createColorVars('primary'),
        secondary: createColorVars('secondary'),
        accent: createColorVars('accent'),
        neutral: createColorVars('neutral'),
        success: createColorVars('success'),
        warning: createColorVars('warning'),
        danger: createColorVars('danger'),
        info: createColorVars('info'),

        'on-background': 'rgb(var(--color-on-background))',
        'on-surface': 'rgb(var(--color-on-surface))',
        'on-surface-alt': 'rgb(var(--color-on-surface-alt))',
        'on-primary': 'rgb(var(--color-on-primary))',
        'on-secondary': 'rgb(var(--color-on-secondary))',
        'on-accent': 'rgb(var(--color-on-accent))',
        'on-neutral': 'rgb(var(--color-on-neutral))',
        'on-success': 'rgb(var(--color-on-success))',
        'on-warning': 'rgb(var(--color-on-warning))',
        'on-danger': 'rgb(var(--color-on-danger))',
        'on-info': 'rgb(var(--color-on-info))',
      },

      borderColor: {
        DEFAULT: 'rgb(var(--color-on-background) / 0.08)',
      },
    },
  },
};

function createColorVars(name) {
  const shades = ['50', '100', '200', '300', '400', '500', '600', '700', '800', '900', '950'];
  const colors = {};
  for (const shade of shades) {
    colors[shade] = `rgb(var(--color-${name}-${shade}))`;
  }
  colors.DEFAULT = `rgb(var(--color-${name}))`;
  return colors;
}
