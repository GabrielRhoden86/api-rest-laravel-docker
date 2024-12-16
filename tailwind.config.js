/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      extend: {
        colors: {
            primary: {
              600: '#007bff', // Substitua com a cor desejada
            },
          },
      },
    },
    plugins: [
        require('flowbite/plugin')
    ],
  }
