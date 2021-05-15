const colors = require('tailwindcss/colors');

module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
      colors: {
          white: colors.white,
          black: colors.black,
          gray: colors.trueGray,
          red: colors.red,
          green: colors.green,
          amber: colors.amber,
      },
      screens: {
          'sm': '576px',
          'md': '768px',
          'lg': '992px',
          'xl': '1200px',
          '2xl': '1400px',
      },
      extend: {
      },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
