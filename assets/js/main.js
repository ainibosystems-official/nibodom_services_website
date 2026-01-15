document.addEventListener("DOMContentLoaded", () => {
  /* =========================
     ELEMENTS
  ========================= */
  const toggle = document.querySelector(".nav-toggle");
  const nav = document.querySelector(".mobile-nav");
  const header = document.querySelector(".site-header");

  const DESKTOP_BREAKPOINT = 1024;

  /* =========================
     HELPERS
  ========================= */
  const closeMenu = () => {
    nav?.classList.remove("open");
    toggle?.classList.remove("open");
    document.body.classList.remove("menu-open");
  };

  /* =========================
     MOBILE NAV
  ========================= */
  if (toggle && nav) {
    toggle.addEventListener("click", (e) => {
      e.stopPropagation();

      // Safety: do nothing on desktop
      if (window.innerWidth >= DESKTOP_BREAKPOINT) return;

      const isOpen = nav.classList.toggle("open");
      toggle.classList.toggle("open", isOpen);
      document.body.classList.toggle("menu-open", isOpen);
    });

    // Close when clicking outside
    document.addEventListener("click", (e) => {
      if (!nav.contains(e.target) && !toggle.contains(e.target)) {
        closeMenu();
      }
    });

    // Close when clicking a link
    nav.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", closeMenu);
    });

    // 🔑 CRITICAL FIX: close menu when entering desktop
    window.addEventListener("resize", () => {
      if (window.innerWidth >= DESKTOP_BREAKPOINT) {
        closeMenu();
      }
    });
  }

  /* =========================
     SERVICES SCROLL ANIMATION
  ========================= */
  const animatedRows = document.querySelectorAll(".animate-row");

  if (animatedRows.length > 0) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("in-view");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.25 }
    );

    animatedRows.forEach((row) => observer.observe(row));
  }

  /* =========================
     SMART HEADER
     - Hide on scroll DOWN
     - Show on scroll UP
     - Always visible when menu is open
  ========================= */
  if (header) {
    let lastScrollY = window.scrollY;
    const HEADER_HEIGHT = header.offsetHeight;

    window.addEventListener(
      "scroll",
      () => {
        // Always visible if menu is open
        if (document.body.classList.contains("menu-open")) {
          header.style.top = "0";
          lastScrollY = window.scrollY;
          return;
        }

        const currentScrollY = window.scrollY;

        if (currentScrollY > lastScrollY) {
          // scrolling DOWN → hide
          header.style.top = `-${HEADER_HEIGHT}px`;
        } else if (currentScrollY < lastScrollY) {
          // scrolling UP → show immediately
          header.style.top = "0";
        }

        lastScrollY = currentScrollY;
      },
      { passive: true }
    );
  }

  /* =========================
   LANGUAGE DROPDOWN (DESKTOP ONLY)
========================= */
  const langDropdown = document.querySelector(".site-nav .lang-dropdown");
  const langButton = document.querySelector(".site-nav .lang-current");

  if (langDropdown && langButton) {

    langButton.addEventListener("click", (e) => {
      e.stopPropagation();
      langDropdown.classList.toggle("open");
    });

    document.addEventListener("click", (e) => {
      if (!langDropdown.contains(e.target)) {
        langDropdown.classList.remove("open");
      }
    });

    langDropdown.querySelectorAll(".lang-menu a").forEach(link => {
      link.addEventListener("click", () => {
        langDropdown.classList.remove("open");
      });
    });
  }

  /* =========================
   HERO BACKGROUND CAROUSEL
   (SMOOTH CROSSFADE)
========================= */

  (function () {
    const hero = document.querySelector(".hero-bg");
    if (!hero) return;

    const layerA = hero.querySelector(".layer-a");
    const layerB = hero.querySelector(".layer-b");

    const images = [
      "/assets/images/hero_image_v2.jpg",
      "/assets/images/hero_image_2.jpg",
      "/assets/images/hero_image_3.jpg"
    ];

    let index = 0;
    let activeLayer = layerA;

    // init first image
    activeLayer.style.backgroundImage = `url("${images[0]}")`;
    activeLayer.classList.add("active");

    // preload images
    images.forEach(src => {
      const img = new Image();
      img.src = src;
    });

    setInterval(() => {
      const nextLayer = activeLayer === layerA ? layerB : layerA;

      index = (index + 1) % images.length;
      nextLayer.style.backgroundImage = `url("${images[index]}")`;

      // fade layers
      nextLayer.classList.add("active");
      activeLayer.classList.remove("active");

      activeLayer = nextLayer;

    }, 6000);
  })();

  /* =========================
   LOGO → SMOOTH SCROLL TO TOP
========================= */
  const logoLink = document.querySelector(".logo");

  if (logoLink) {
    logoLink.addEventListener("click", (e) => {
      const href = logoLink.getAttribute("href");

      // Are we already on the same language root?
      if (
        href &&
        window.location.pathname.startsWith(href)
      ) {
        e.preventDefault();

        // close mobile menu if open
        closeMenu?.();

        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      }
    });
  }

  /* =========================
   LANGUAGE SWITCH – FULLY SMART
   (hash OR scroll position)
========================= */
  (function () {

    const langLinks = document.querySelectorAll(
      '.lang-menu a, .lang-mobile a'
    );

    if (!langLinks.length) return;

    const isHomePage = () => {
      return (
        window.location.pathname === '/bg/' ||
        window.location.pathname === '/en/' ||
        window.location.pathname === '/ua/'
      );
    };

    langLinks.forEach(link => {
      link.addEventListener('click', e => {

        const targetLang = link.getAttribute('href').replace(/\/$/, '');
        const currentPath = window.location.pathname;
        const currentHash = window.location.hash;

        // =========================
        // HOME PAGE
        // =========================
        if (isHomePage()) {
          e.preventDefault();

          if (currentHash) {
            // store hash
            sessionStorage.setItem('restoreHash', currentHash);
          } else {
            // store scroll position
            sessionStorage.setItem(
              'restoreScrollY',
              String(window.scrollY)
            );
          }

          window.location.href = targetLang + '/';
          return;
        }

        // =========================
        // INNER PAGES (FAQ, etc.)
        // =========================
        e.preventDefault();

        const newPath = currentPath.replace(
          /^\/(bg|en|ua)\//,
          targetLang + '/'
        );

        window.location.href = newPath;
      });
    });

    // =========================
    // RESTORE AFTER LOAD
    // =========================
    window.addEventListener('load', () => {

      const hash = sessionStorage.getItem('restoreHash');
      const scrollY = sessionStorage.getItem('restoreScrollY');

      if (hash) {
        sessionStorage.removeItem('restoreHash');

        const target = document.querySelector(hash);
        if (!target) return;

        setTimeout(() => {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }, 150);

        return;
      }

      if (scrollY) {
        sessionStorage.removeItem('restoreScrollY');

        setTimeout(() => {
          window.scrollTo({
            top: parseInt(scrollY, 10),
            behavior: 'smooth'
          });
        }, 150);
      }
    });

  })();

});
