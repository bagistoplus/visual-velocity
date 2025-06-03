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
        poppins: ['Poppins', 'sans-serif'],
        dmserif: ['DM Serif Display', 'serif'],
      },
      colors: {
        navyBlue: 'var(--color-primary)',
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

        'on-background:': 'var(--on-background)',
        'on-surface': 'var(--on-surface)',
        'on-surface-alt': 'var(--on-surface-alt)',
        'on-primary': 'var(--on-primary)',
        'on-secondary': 'var(--on-secondary)',
        'on-accent': 'var(--on-accent)',
        'on-neutral': 'var(--on-neutral)',
        'on-success': 'var(--on-success)',
        'on-warning': 'var(--on-warning)',
        'on-danger': 'var(--on-danger)',
        'on-info': 'var(--on-info)',
      },
    },
  },
};

function createColorVars(name) {
  const shades = ['50', '100', '200', '300', '400', '500', '600', '700', '800', '900', '950'];
  const colors = {};
  for (const shade of shades) {
    colors[shade] = `var(--color-${name}-${shade})`;
  }
  colors.DEFAULT = `var(--color-${name})`;
  return colors;
}
