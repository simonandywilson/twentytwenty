// Menu
const details = document.querySelectorAll("details.secondary-details");

details.forEach((targetDetail) => {
  targetDetail.addEventListener("click", () => {
    details.forEach((detail) => {
      if (detail !== targetDetail) {
        detail.removeAttribute("open");
      }
    });
  });
});

//  Homepage images
const backgroundImages = [
  ...document.getElementsByClassName("artist-background"),
];

const circleImages = [...document.getElementsByClassName("artist-circle")];

const circleImagesDefault = [...document.getElementsByClassName("artist-circle-default")];


const artistLinks = [...document.getElementsByClassName("artist-link")];

artistLinks.forEach((element) => {
  ["mouseenter", "focus"].forEach((evt) =>
    element.addEventListener(
      evt,
      () => {
        const thisSlug = element.getAttribute("data-artist-slug");
        backgroundImages.forEach((element) => {
          if (element.dataset.artistSlug === thisSlug) {
            element.classList.remove("opacity-0");
          } else {
            element.classList.add("opacity-0");
          }
        });
        circleImages.forEach((element) => {
          if (element.dataset.artistSlug === thisSlug) {
            element.classList.remove("opacity-0");
          } else {
            element.classList.add("opacity-0");
          }
        });
        artistLinks.forEach((element) => {
          if (element.dataset.artistSlug === thisSlug) {
            element.classList.add("ul");
          } else {
            element.classList.remove("ul");
          }
        });
        circleImagesDefault.forEach(element => {
          element.classList.add("opacity-0");
        });
      },
      false
    )
  );
});

const siteMenuContent = document.getElementById("site-menu-content");

const resetMenuState = () => {
  backgroundImages.forEach(element => {
    element.classList.add("opacity-0");
  });
  circleImages.forEach(element => {
    element.classList.add("opacity-0");
  });
  artistLinks.forEach(element => {
    element.classList.remove("ul");
  });
  circleImagesDefault.forEach(element => {
    element.classList.remove("opacity-0");
  });
};

// Add both mouseleave and blur event listeners to the menu content
["mouseleave", "blur"].forEach(evt => {
  siteMenuContent.addEventListener(evt, resetMenuState);
});

const menu = document.getElementById("site-menu");

const toggleMenu = () => {
  if (menu.style.display === "block") {
    menu.style.display = "none";
  } else {
    menu.style.display = "block";
  }
};

const isMediumScreen = window.matchMedia("(min-width: 768px)");

isMediumScreen.addEventListener("change", (e) => {
  if (e.matches === true) {
    menu.style.display = "block";
  } else {
    menu.style.display = "none";
  }
});

window.onload = () => {
  if (isMediumScreen.matches) {
    menu.style.display = "block";
  }
  resetMenuState();
};
