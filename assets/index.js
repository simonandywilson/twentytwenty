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
  
  // Add keyboard event listener for Enter key
  element.addEventListener("keydown", (event) => {
    if (event.key === "Enter" && element.getAttribute("href")) {
      window.location.href = element.getAttribute("href");
    }
  });
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
const menuButton = document.querySelector('button[onclick="toggleMenu()"]');

const toggleMenu = () => {
  const isExpanded = menu.style.display === "block";
  if (isExpanded) {
    menu.style.display = "none";
    menuButton.setAttribute("aria-expanded", "false");
  } else {
    menu.style.display = "block";
    menuButton.setAttribute("aria-expanded", "true");
  }
};

const isMediumScreen = window.matchMedia("(min-width: 768px)");

isMediumScreen.addEventListener("change", (e) => {
  if (e.matches === true) {
    menu.style.display = "block";
    if (menuButton) menuButton.setAttribute("aria-expanded", "true");
  } else {
    menu.style.display = "none";
    if (menuButton) menuButton.setAttribute("aria-expanded", "false");
  }
});

window.onload = () => {
  if (isMediumScreen.matches) {
    menu.style.display = "block";
    if (menuButton) menuButton.setAttribute("aria-expanded", "true");
  }
  resetMenuState();
};

document.addEventListener("DOMContentLoaded", function () {
  const cookieModal = document.getElementById("cookie-modal");
  if (!cookieModal) return;

  // Add ARIA attributes to make it a proper modal
  cookieModal.setAttribute("role", "dialog");
  cookieModal.setAttribute("aria-modal", "true");
  cookieModal.setAttribute("aria-label", "Cookie Preferences");

  function getFocusableElements(element) {
    return Array.from(
      element.querySelectorAll(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])',
      ),
    ).filter(
      (el) => !el.hasAttribute("disabled") && !el.getAttribute("aria-hidden"),
    );
  }

  function trapFocus(event) {
    if (!cookieModal || cookieModal.classList.contains("cookie-modal--hidden"))
      return;

    const focusableElements = getFocusableElements(cookieModal);
    const firstFocusable = focusableElements[0];
    const lastFocusable = focusableElements[focusableElements.length - 1];

    // If there are no focusable elements, do nothing
    if (!firstFocusable || !lastFocusable) return;

    const isTabPressed = event.key === "Tab";
    if (!isTabPressed) return;

    if (event.shiftKey) {
      if (document.activeElement === firstFocusable) {
        lastFocusable.focus();
        event.preventDefault();
      }
    } else {
      if (document.activeElement === lastFocusable) {
        firstFocusable.focus();
        event.preventDefault();
      }
    }
  }

  function setBackgroundElementsAccessibility(hide) {
    const mainContent = document.querySelector("main");
    const header = document.querySelector("header");

    [mainContent, header].forEach((element) => {
      if (element) {
        if (hide) {
          element.setAttribute("aria-hidden", "true");
          // Store original tabindex values and set them to -1
          element.querySelectorAll("[tabindex]").forEach((el) => {
            el.setAttribute(
              "data-original-tabindex",
              el.getAttribute("tabindex"),
            );
            el.setAttribute("tabindex", "-1");
          });
          // Set tabindex=-1 on focusable elements
          getFocusableElements(element).forEach((el) => {
            if (!el.hasAttribute("tabindex")) {
              el.setAttribute("data-had-no-tabindex", "true");
            }
            el.setAttribute("tabindex", "-1");
          });
        } else {
          element.removeAttribute("aria-hidden");
          // Restore original tabindex values
          element.querySelectorAll("[data-original-tabindex]").forEach((el) => {
            el.setAttribute(
              "tabindex",
              el.getAttribute("data-original-tabindex"),
            );
            el.removeAttribute("data-original-tabindex");
          });
          // Remove tabindex from elements that didn't have it
          element.querySelectorAll("[data-had-no-tabindex]").forEach((el) => {
            el.removeAttribute("tabindex");
            el.removeAttribute("data-had-no-tabindex");
          });
        }
      }
    });
  }

  // Set up a MutationObserver to watch for when the modal becomes visible
  const observer = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      if (mutation.target.id === "cookie-modal") {
        const isHidden = mutation.target.classList.contains(
          "cookie-modal--hidden",
        );
        setBackgroundElementsAccessibility(!isHidden);

        if (!isHidden) {
          const focusableElements = getFocusableElements(cookieModal);
          if (focusableElements.length > 0) {
            focusableElements[0].focus();
          }
        }
      }
    });
  });

  // Start observing the cookie modal
  observer.observe(cookieModal, {
    attributes: true,
    attributeFilter: ["class"],
  });

  // Add keyboard event listener for focus trapping
  document.addEventListener("keydown", trapFocus);

  // Initial setup if modal is visible on page load
  if (!cookieModal.classList.contains("cookie-modal--hidden")) {
    setBackgroundElementsAccessibility(true);
    const focusableElements = getFocusableElements(cookieModal);
    if (focusableElements.length > 0) {
      focusableElements[0].focus();
    }
  }
});