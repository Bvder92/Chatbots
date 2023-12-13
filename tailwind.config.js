/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        animation: {
          blob: "blob 7s infinite",
        },
        keyframes: {
          blob: {
            "0%": {
              transform: "translate(0px, 0px) scale(1)",
            },
            "33%": {
              transform: "translate(30px, -50px) scale(1.1)",
            },
            "66%": {
              transform: "translate(-20px, 20px) scale(0.9)",
            },
            "100%": {
              transform: "tranlate(0px, 0px) scale(1)",
            },
          },
        },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
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

