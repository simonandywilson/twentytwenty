module.exports = {
  content: ['./site/**/*.{html,js,php}"'],
  theme: {
    fontFamily: {
      sans: [`"Helvetica"`, "Helvetica"],
    },
    extend: {
      colors: {
        theme: {
          artists: "#03ff00",
          essays: "#b9bd9b",
          introduction: "#ffffff",
          contact: "#bf86ff",
          text: "#ffffff",
          figcaption: "#e8e8e8",
          home: "#fd8f38",
          recordings: "#ffb8ff",
          sponsors: "#e9ffb8",
          menu: "#ff0100",
        },
      },
      height: {
        screen: ["100vh", "100svh"],
      },
      maxHeight: {
        screen: ["100vh", "100svh"],
      },
    },
  },
};
