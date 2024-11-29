module.exports = {
  content: ['./site/**/*.{html,js,php}"'],
  theme: {
    fontFamily: {
      sans: [`"Helvetica"`, "Helvetica"],
    },
    extend: {
      colors: {
        theme: {
          menu: "#ffffff",
          artists: "#F9FAFB",
          essays: "#F1F3F5",
          introduction: "#E9EBEE",
          contact: "#E1E4E8",
          recordings: "#D9DCE1",
          sponsors: "#D1D5DB",

          text: "#ffffff",
          figcaption: "#ffffff",
          home: "#ffffff",

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
