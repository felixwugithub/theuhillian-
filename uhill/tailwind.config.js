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
              pinkWhite: 'rgba(255,238,238,0.23)',
              hotPink100:'#f8adad',
              defaultPink: '#e0a7c4',
              defaultPurple: '#bcaac2',
              defaultMidBlue: '#9CB4CC',
              defaultDarkerBlue: '#748Da6',
              notRealBlack: '#482525',
              felixSalmon: '#fcdfdc',

              rawBanana:'#d9d2be',
              ripeBanana:'#fcf5e4',
              babyBanana:'#f8f7a9',
              rottenBanana:'#d3b626',
              deadBanana: 'rgba(255,234,189,0.42)',
              notReallyBlack: '#2e2f0b'


          }
    },

  },
  plugins: [
      require('flowbite/plugin')
  ],
}
