/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    function ({ addComponents }) {
      addComponents({
        '.container-fluid': {
          maxWidth: '100%',
          marginLeft: 'auto',
          marginRight: 'auto',
        },
      })
    },
  ],
}

