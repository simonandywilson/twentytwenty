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
          essays: "#D9E6D6",
          introduction: "#d8d7ca",
          contact: "#f4bbfb",
          text: "#f3fff1",
          figcaption: "#f3fff1",
          home: "#ff7d2f",
          recordings: "#ffffff",
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
