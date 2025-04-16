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
const body = document.body;

// Function to get focusable elements within a given element
function getFocusableElements(element) {
  return Array.from(
    element.querySelectorAll(
      'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])',
    ),
  ).filter(
    (el) => !el.hasAttribute("disabled") && !el.getAttribute("aria-hidden"),
  );
}

// Function to trap focus within the menu
function trapMenuFocus(event) {
  if (!menu || menu.style.display !== "block") return; // Only trap focus if menu is open

  const focusableElements = getFocusableElements(menu);
  if (focusableElements.length === 0) return;

  const firstFocusable = focusableElements[0];
  const lastFocusable = focusableElements[focusableElements.length - 1];

  const isTabPressed = event.key === "Tab";
  if (!isTabPressed) return;

  if (event.shiftKey) {
    // Shift + Tab
    if (document.activeElement === firstFocusable) {
      lastFocusable.focus();
      event.preventDefault();
    }
  } else {
    // Tab
    if (document.activeElement === lastFocusable) {
      firstFocusable.focus();
      event.preventDefault();
    }
  }
}

// Function to set accessibility attributes for background elements when menu is open/closed
function setMenuBackgroundAccessibility(isOpen) {
    const mainContent = document.querySelector("main");
    const header = document.querySelector("header"); // Assuming header contains the menu button

    [mainContent, header].forEach((element) => {
      if (element) {
        if (isOpen) {
          element.setAttribute("aria-hidden", "true");
          // Make elements non-focusable, except the menu itself and its button
          element.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').forEach(el => {
            if (!menu.contains(el) && el !== menuButton) {
               if (!el.hasAttribute('tabindex')) {
                 el.setAttribute('data-had-no-tabindex', 'true');
               }
               const currentTabIndex = el.getAttribute('tabindex');
               if (currentTabIndex !== "-1") {
                 el.setAttribute('data-original-tabindex', currentTabIndex || '0'); // Store 0 if no tabindex
                 el.setAttribute('tabindex', '-1');
               }
            }
          });
        } else {
          element.removeAttribute("aria-hidden");
          // Restore focusability
           element.querySelectorAll('[data-original-tabindex]').forEach(el => {
             el.setAttribute('tabindex', el.getAttribute('data-original-tabindex'));
             el.removeAttribute('data-original-tabindex');
           });
           element.querySelectorAll('[data-had-no-tabindex]').forEach(el => {
             el.removeAttribute('tabindex');
             el.removeAttribute('data-had-no-tabindex');
           });
        }
      }
    });
     // Ensure menu button itself remains accessible if it's outside the hidden header/main
     if (menuButton && !header?.contains(menuButton) && !mainContent?.contains(menuButton)) {
         if (isOpen) {
             // If button is somehow focusable despite parent being hidden, force non-focusable state?
             // This case might need specific handling based on exact HTML structure
         } else {
             // Restore button focusability if needed
             if (menuButton.getAttribute('tabindex') === '-1' && menuButton.hasAttribute('data-original-tabindex')) {
                 menuButton.setAttribute('tabindex', menuButton.getAttribute('data-original-tabindex'));
                 menuButton.removeAttribute('data-original-tabindex');
             } else if (menuButton.hasAttribute('data-had-no-tabindex')) {
                 menuButton.removeAttribute('tabindex');
                 menuButton.removeAttribute('data-had-no-tabindex');
             }
         }
     }
}

const toggleMenu = () => {
  const isExpanded = menu.style.display === "block";
  if (isExpanded) {
    menu.style.display = "none";
    menuButton.setAttribute("aria-expanded", "false");
    body.style.overflow = ""; // Restore body scroll
    document.removeEventListener("keydown", trapMenuFocus); // Remove focus trap listener
    setMenuBackgroundAccessibility(false); // Make background accessible
    menuButton.focus(); // Return focus to the button
  } else {
    menu.style.display = "block";
    menuButton.setAttribute("aria-expanded", "true");
    body.style.overflow = "hidden"; // Prevent body scroll
    document.addEventListener("keydown", trapMenuFocus); // Add focus trap listener
    setMenuBackgroundAccessibility(true); // Hide background from assistive tech
    // Focus the first focusable element in the menu
    const focusableElements = getFocusableElements(menu);
    if (focusableElements.length > 0) {
      focusableElements[0].focus();
    }
  }
};

const isMediumScreen = window.matchMedia("(min-width: 768px)");

isMediumScreen.addEventListener("change", (e) => {
  if (e.matches === true) {
    // Desktop view
    menu.style.display = "block";
    if (menuButton) menuButton.setAttribute("aria-expanded", "true");
    body.style.overflow = ""; // Ensure body scroll is enabled
    document.removeEventListener("keydown", trapMenuFocus); // Remove listener if active
    setMenuBackgroundAccessibility(false); // Ensure background is accessible
  } else {
    // Mobile view - close menu by default
    menu.style.display = "none";
    if (menuButton) menuButton.setAttribute("aria-expanded", "false");
    body.style.overflow = ""; // Ensure body scroll is enabled if menu closed
    document.removeEventListener("keydown", trapMenuFocus); // Remove listener if active
    setMenuBackgroundAccessibility(false); // Ensure background is accessible
  }
});

window.onload = () => {
  if (isMediumScreen.matches) {
    // Desktop view on load
    menu.style.display = "block";
    if (menuButton) menuButton.setAttribute("aria-expanded", "true");
    body.style.overflow = ""; // Ensure body scroll is enabled
    setMenuBackgroundAccessibility(false); // Ensure background is accessible
  } else {
    // Mobile view on load
    menu.style.display = "none";
     if (menuButton) menuButton.setAttribute("aria-expanded", "false");
     body.style.overflow = ""; // Ensure body scroll is enabled
     setMenuBackgroundAccessibility(false); // Ensure background is accessible
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