import $ from 'jquery';

/*---------------ON READY---------------*/
document.addEventListener('DOMContentLoaded', function(e) {

  const page           = document.querySelector('#page-scrollBox');
  const scrollBtns     = document.querySelector('#scroll-buttons');
  const scrollToTopBtn = document.querySelector('#scroll-to-top-btn');
  const scrollToBotBtn = document.querySelector('#scroll-to-bot-btn');
  const menu           = document.querySelector('#menu');
  const topPanel       = document.querySelector('#top-panel');
  const header         = document.querySelector('#header');

  stickyMenu();

  scrollToTopBtn.onclick = scrollToTop;
  scrollToBotBtn.onclick = scrollToBot;

  window.addEventListener('resize', stickyMenu);

  page.addEventListener('scroll', showScrollBtns);
  page.addEventListener('scroll', stickyMenu);

/*---------------SIDE BUTTONS VISIBILITY---------------*/
  function showScrollBtns() {
    scrollBtns.className = page.scrollTop >= page.clientHeight ? 'active' : '';
  }

/*---------------SCROLL BUTTONS ACTIONS---------------*/
  function scrollToTop() {
    $(page).animate({scrollTop: 0}, 'fast');
  }

  function scrollToBot() {
    const scrollY = page.scrollHeight - page.clientHeight;

    $(page).animate({scrollTop: scrollY + 'px'}, 'fast');
  }

/*---------------RESPONSIVE---------------*/
  function stickyMenu() {
    const headerHeight = header.offsetHeight;
    const menuHeight   = menu.offsetHeight;
    const bodyScrolled = page.offsetWidth > 650 && page.scrollTop > headerHeight;

    menu.className = bodyScrolled ? 'fixed' : '';

    topPanel.style.marginTop = bodyScrolled ? `${menuHeight}px` : '';
  }
});
