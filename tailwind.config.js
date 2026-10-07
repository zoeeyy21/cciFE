/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50:  '#fdf6ef',
          100: '#fae9d8',
          200: '#f4d0af',
          300: '#edb083',
          400: '#e58a55',
          500: '#dc6a34',
          600: '#c9511f',
          700: '#a73f1b',
          800: '#86351c',
          900: '#6d2e1a',
        },
        paper: '#faf7f1',
        ink: '#201a17',
      },
      fontFamily: {
        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        serif: ['Fraunces', 'Georgia', 'serif'],
      },
      letterSpacing: {
        widest2: '0.22em',
      },
    },
  },
  plugins: [],
}