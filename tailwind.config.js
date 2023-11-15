module.exports = {
  content: [
    "./site/templates/*.php",
    "./site/snippets/*.php",
    "./site/stylesheets/*.css",
  ],
  theme: {
    fontFamily: {
      sans: ["helvetica"],
    },
    extend: {
      colors: {
        theme: {
          artists: "#75fb4c",
          essays: "#92956e",
          introduction: "#d8d7ca",
          contact: "#f4bbfb",
          text: "#f3fff1",
          figcaption: "#f3fff1",
          home: "#f3fff1",
        },
      },
      height: {
        screen: ['100vh', '100svh'],
      },
      maxHeight: {
        screen: ['100vh', '100svh'],
      },
    },
  },
};
