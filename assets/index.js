// Lightbox
Array.from(document.querySelectorAll("[data-lightbox]")).forEach(element => {
  element.onclick = (e) => {
    e.preventDefault();
    const instance = basicLightbox.create(`<img src="${element.href}">`)
    instance.show(() => {
      instance.element().querySelector( '.basicLightbox__placeholder > *:first-child' ).focus();
    });
    document.body.addEventListener('keypress', (e) => {
      if (e.key === "Escape") instance.close()
    })
  };
});

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

const circleImages = [
  ...document.getElementsByClassName("artist-circle"),
];

const artistLinks = [
  ...document.getElementsByClassName("artist-link"),
];

artistLinks.forEach((element) => {
  ["mouseenter", "focus"].forEach((evt) =>
    element.addEventListener(
      evt,
      () => {
        const thisSlug = element.getAttribute("data-artist-slug");
        backgroundImages.forEach((element) => {
          if (element.dataset.artistSlug === thisSlug) {
            element.classList.remove('opacity-0');
          } else {
            element.classList.add('opacity-0');
          }
        });
        circleImages.forEach((element) => {
          if (element.dataset.artistSlug === thisSlug) {
            element.classList.remove('opacity-0');
          } else {
            element.classList.add('opacity-0');
          }
        });
        artistLinks.forEach((element) => {
          if (element.dataset.artistSlug === thisSlug) {
            element.classList.add('underline');
          } else {
            element.classList.remove('underline');
          }
        });
      },
      false
    )
  );
});
