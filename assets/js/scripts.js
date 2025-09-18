// Header Js
const menuOverlay = document.getElementById("menuOverlay");
const openMenu = document.querySelectorAll(".openMenuClass");
const closeMenu = document.getElementById("closeMenu");
openMenu.forEach(function (element) {
  element.addEventListener("click", function () {
    menuOverlay.classList.add("show");
  });
});
closeMenu.onclick = () => {
  menuOverlay.classList.remove("show");
};

document.querySelectorAll(".menu-item span h5").forEach((header) => {
  header.addEventListener("click", () => {
    const ul = header.nextElementSibling;
    document.querySelectorAll(".menu-item ul").forEach((list) => {
      if (list !== ul) list.classList.remove("active");
    });
    ul.classList.toggle("active");
  });
});

// this is menu code

document.addEventListener("DOMContentLoaded", function () {
  const currentURL = window.location.href;
  // Highlight current URL match
  document.querySelectorAll(".menu-group").forEach((group) => {
    const dropdownLinks = group.querySelectorAll("ul li a");

    dropdownLinks.forEach((link) => {
      if (currentURL.includes(link.href)) {
        const ul = link.closest("ul");
        ul.classList.add("active");

        const parentItem = group.querySelector(".menu-item");
        if (parentItem) {
          parentItem.classList.add("active");
        }
      }
    });
  });
  // Dropdown toggle with close-others and toggle-same logic
  document.querySelectorAll(".dropdown-toggle").forEach((toggle) => {
    toggle.addEventListener("click", function (e) {
      e.preventDefault();
      const group = this.closest(".menu-group");
      const ul = group.querySelector("ul");
      const item = group.querySelector(".menu-item");
      const isAlreadyActive = ul.classList.contains("active");
      // Close all dropdowns
      document
        .querySelectorAll(".menu-group ul")
        .forEach((u) => u.classList.remove("active"));
      document
        .querySelectorAll(".menu-group .menu-item")
        .forEach((i) => i.classList.remove("active"));
      // If it was NOT active, activate this one
      if (!isAlreadyActive) {
        ul.classList.add("active");
        item.classList.add("active");
      }
    });
  });
});
//end

//Footer Accordion logic for mobile
// (() => {
//   const footerHeaders = document.querySelectorAll(".footer-column h4");

//   footerHeaders.forEach((header) => {
//     header.addEventListener("click", () => {
//       if (window.innerWidth <= 768) {
//         const column = header.parentElement;

//         // Close all other columns
//         document.querySelectorAll(".footer-column").forEach((col) => {
//           if (col !== column) col.classList.remove("active");
//         });

//         // Toggle current
//         column.classList.toggle("active");
//       }
//     });
//   });
// })();
//  function toggleIcons1() {
//     const container = document.getElementById("socialContainer");
//     container.classList.toggle("show");
//   }

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    991: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    1367: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
});

var swiper = new Swiper(".series-swiper", {
  slidesPerView: 3,
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    991: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    1367: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
});
var swiper = new Swiper(".audio-swiper", {
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1.4,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    991: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    1200: {
      slidesPerView: 4.2,
      spaceBetween: 10,
    },
  },
});

jQuery("body").on("click", "#openMenu,#closeMenu", function () {
  jQuery("body").toggleClass("no-scroll");
});

jQuery("body").on("click", "span.toggle-btn", function () {
  console.log("yes it is woling instide cli9ck !!!!!");
  var self = jQuery(this);
  var targetDiv = self.parent().next();
  var divlinks = jQuery("div.links");
  if (targetDiv.hasClass("active")) {
    targetDiv.removeClass("active");
  } else {
    divlinks.removeClass("active");
    targetDiv.addClass("active");
  }
});



jQuery(document).ready(function ($) {
  var currentPath = window.location.pathname; // only path, not domain/query
  var activeSlug = "";
  // Reset
  $(".variety-tabs-nav li").removeClass("latest-news-line");

  $(".variety-tabs-nav li a").each(function () {
    var hrefPath = $("<a>").prop("href", $(this).attr("href"))[0].pathname;
    if (currentPath === hrefPath || currentPath.indexOf(hrefPath) !== -1) {
      // Add class to li
      //$(this).parent('li').addClass('latest-news-line');
      // Get slug from data-slug
      activeSlug = $(this).parent("li").data("slug");
    }
  });
  // Add class to body
  if (activeSlug) {
    // $('body').addClass('tab-' + activeSlug);
  } else {
    $("body").addClass("variety-line-hight"); // default fallback
  }
});

jQuery(document).ready(function ($) {
  function loadVideo($card, autoplay = true) {
    let url = $card.data("url");
    let title = $card.data("title");
    let link = $card.data("link");

    if (autoplay) {
      url += url.indexOf("?") !== -1 ? "&autoplay=1" : "?autoplay=1";
    }

    $("#main-video-player").attr("src", url);
    $("#main-video-title").html('<a href="' + link + '">' + title + "</a>");

    $(".overlay-now").remove();
    $card
      .find(".overlay-now-play")
      .append('<div class="overlay-now"><h3>Now Playing</h3></div>');
  }

  // ✅ Click anywhere on card EXCEPT links will load video
  $(document).on("click", ".featured-card-div", function (e) {
    if ($(e.target).is("a, a *")) {
      // let links work normally (go to detail page)
      return;
    }
    e.preventDefault();
    loadVideo($(this), true);
  });

  // Enforec comment form to be validate
  if (jQuery("#comments #commentform")) {
    jQuery("#comments #commentform").removeAttr("novalidate");
    jQuery("#comment").attr("placeholder","Leave your comment here");
    jQuery("#comment").attr("maxlength","500");
    $('#commentform').on('submit', function(e) {
        var emailField = $('#commentform #email');
        var email = emailField.val().trim();
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      console.log(email);
        if ( email === '' || !emailPattern.test(email) ) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            emailField.focus();
            return false;
        }
    });
  }

  /* Header Search Popup  */
  $(document).on("click", ".right-section", function () {
    var self = $(this);
    self.next().fadeIn(300);
    // $(".header-popup-wrapper").fadeIn(300); // smooth animation
    $(".header-popup-wrapper input").trigger("focus");
  });

  // Close popup
  $(document).on("click", "#closeSearch", function () {
    $(".header-popup-wrapper").fadeOut(300); // smooth animation
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const selectBtn = document.querySelector(".select-menu .select-btn");
  const selectMenu = document.querySelector(".select-menu");

  selectBtn.addEventListener("click", function () {
    selectMenu.classList.toggle("active");
  });

  // Optional: close when clicking outside
  document.addEventListener("click", function (e) {
    if (!selectMenu.contains(e.target)) {
      selectMenu.classList.remove("active");
    }
  });
});

jQuery(window).on("scroll", function () {
  // var scroll = $(window).scrollTop();
  const scrollTop = $(window).scrollTop();
  const docHeight = $(document).height();
  const windowHeight = $(window).height();
  console.log(scrollTop);
  const scrollPercent = (scrollTop / (docHeight - windowHeight)) * 100;

  // Clamp the value between 0 and 100
  const clampedPercent = Math.min(Math.max(scrollPercent, 0), 100);
  const fixedScrollPercent = clampedPercent.toFixed(0);
  console.log(fixedScrollPercent);
  if (window.screen.width >= 767) {
    if (scrollTop <= 310) {
      jQuery(".header-sticky").removeClass("stiky-header d-block");
    } else {
      jQuery(".header-sticky").addClass("stiky-header d-block");
    }
  }
  if (window.screen.width <= 767) {
    if (fixedScrollPercent <= 3) {
      jQuery("#header").removeClass("dark-stiky-header");
    } else {
      jQuery("#header").addClass("dark-stiky-header");
    }
  }
});

jQuery(document).on("click", "#mobilemenu", function () {
  console.log("mobile menu");
  jQuery(".showmobilemenu").toggleClass("d-none");
});

jQuery(document).on("change", ".filternewsallover", function () {
  var val = jQuery("#global-desk-drop").val();
  if (val == "/tag/asia") {
    window.location.href = "https://variety.com/c/asia/";
  } else if (val == "/category/global") {
    window.location.href = "https://variety.com/c/global/";
  } else if (val == "/tag/us") {
    window.location.href = "https://variety.com/";
  }
});

jQuery(document).on("change", "#global-drop-mob-new", function () {
  var val = jQuery("#global-drop-mob-new").val();
  if (val == "/tag/asia") {
    window.location.href = "https://variety.com/c/asia/";
  } else if (val == "/category/global") {
    window.location.href = "https://variety.com/c/global/";
  } else if (val == "/tag/us") {
    window.location.href = "https://variety.com/";
  }
});

jQuery(document).ready(function($) {
  $(document).on("click", ".autherAlllastestpost", function() {
    $(".latest-auther-post-data").removeClass("d-none");
    $(".latest-auther-post-data").toggleClass("d-block");
  });
});



