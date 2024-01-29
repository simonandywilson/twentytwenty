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
          contact: "#bf86ff",
          text: "#ffffff",
          figcaption: "#b9bd9b",
          home: "#ff4d00",
          recordings: "#ffb8ff",
          sponsors: "#e9ffb8",
          menu: "#ff0100"
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
