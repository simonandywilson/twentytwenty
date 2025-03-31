module.exports = {
  content: ['./site/**/*.{html,js,php}"'],
  theme: {
    fontFamily: {
      sans: [`"HelveticaNeueLTPro"`],
    },
    extend: {
      colors: {
        theme: {
          menu: "#ffffff",
          artists: "#F4F4F4",
          essays: "#E8E8E8",
          introduction: "#DDDDDD",
          contact: "#D2D2D2",
          recordings: "#C6C6C6",
          accessibility: "#bbbbbb",
          sponsors: "#b1b1b1",
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
