let toggler = document.querySelector('span#menu-toggle');

toggler.addEventListener('click', (event) => {
    let nav_menu = document.querySelector('ul.navbar-menu');
    let visible = nav_menu.offsetWidth > 0 || nav_menu.offsetHeight > 0;
    if (visible)
        nav_menu.style.display = 'none';
    else
        nav_menu.style.display = 'flex';
});
