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
          artists: "#03ff00",
          essays: "#b9bd9b",
          introduction: "#ffffff",
          contact: "#d8d7ca",
          text: "#f3fff1",
          figcaption: "#f3fff1",
          home: "#ff621f",
          recordings: "#ffb8ff",

          sponsors: "#ffffff",
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
