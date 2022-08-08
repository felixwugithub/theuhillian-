/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      "./node_modules/flowbite/**/*.js"

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
              hotPink100:'#f8adad',
              defaultPink: '#e0a7c4',
              defaultPurple: '#bcaac2',
              defaultMidBlue: '#9CB4CC',
              defaultDarkerBlue: '#748Da6',
              notRealBlack: '#592525',
              felixSalmon: '#fcdfdc'

          }
    },

  },
  plugins: [
      require('flowbite/plugin')
  ],
}
