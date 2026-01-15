document.querySelectorAll('.faq-item').forEach(item => {
  const summary = item.querySelector('summary');
  const content = item.querySelector('.faq-content');

  let isAnimating = false;

  // Init
  content.style.maxHeight = item.hasAttribute('open')
    ? content.scrollHeight + 'px'
    : '0px';

  summary.addEventListener('click', e => {
    e.preventDefault();
    if (isAnimating) return;

    const isOpen = item.hasAttribute('open');

    // Close others
    document.querySelectorAll('.faq-item').forEach(other => {
      if (other !== item && other.hasAttribute('open')) {
        closeItem(other);
      }
    });

    isOpen ? closeItem(item) : openItem(item);
  });

  function openItem(el) {
    const c = el.querySelector('.faq-content');
    isAnimating = true;

    el.setAttribute('open', '');
    c.style.maxHeight = c.scrollHeight + 'px';

    c.addEventListener('transitionend', function handler() {
      c.removeEventListener('transitionend', handler);
      isAnimating = false;
    });
  }

  function closeItem(el) {
    const c = el.querySelector('.faq-content');
    isAnimating = true;

    c.style.maxHeight = c.scrollHeight + 'px';

    requestAnimationFrame(() => {
      c.style.maxHeight = '0px';
    });

    c.addEventListener('transitionend', function handler() {
      c.removeEventListener('transitionend', handler);
      el.removeAttribute('open');
      isAnimating = false;
    });
  }
});
