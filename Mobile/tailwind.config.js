module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      backgroundImage: {
        'geometry-pattern': 'url(/assets/images/geometry.png)',
      },
      fontFamily: {
        sans: ['Montserrat', 'sans-serif']
      }
    }
  },
  variants: {
    extend: {}
  },
  plugins: []
}
