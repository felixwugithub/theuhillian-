/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",

  ],
  theme: {
      screens: {
          sm: '480px',
          md: '768px',
          lg: '976px',
          xl: '1440px'
      },
    extend: {
          colors:{
              hotPink:'#ff8282',
              defaultPink: '#e0a7c4',
              defaultPurple: '#bcaac2',
              defaultMidBlue: '#9CB4CC',
              defaultDarkerBlue: '#748Da6',
              notRealBlack: '#2f0000'
          }
    },

  },
  plugins: [],
}
