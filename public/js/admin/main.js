// Open & Shrink Sidebar
const shrink__btn = document.querySelector('.shrink__btn')
shrink__btn.addEventListener('click', () => {
    const template = document.querySelector('.panel__page__template')
    template.classList.toggle('shrink')

    const shrink_icon = document.querySelector('#shrink')

    if (shrink_icon.classList.contains('fa-bars')) {
        shrink_icon.classList.remove('fa-bars')
        shrink_icon.classList.add('fa-chart-simple')
    } else {
        shrink_icon.classList.remove('fa-chart-simple')
        shrink_icon.classList.add('fa-bars')
    }

    if (window.innerWidth < 776) {
        const style = (node, styles) => Object.keys(styles).forEach((key) => (node.style[key] = styles[key]))

        const templateElement = document.getElementById('page__template')
        const templateClasses = templateElement.classList
        let main__container = document.querySelector('.main__container')

        if (templateClasses.contains('shrink')) {
            style(main__container, {
                // transform: 'scaleX(0)',
                display: 'none',
            })
        } else {
            style(main__container, {
                // transform: 'scaleX(1)',
                display: 'flex',

            })
        }
    }

    const header = document.querySelector('.header')
    header.classList.toggle('header__shrink')

    const main__content = document.querySelector('.main__content')
    main__content.classList.toggle('main__content__shrink')

})

// Open Submenu After Click Parent
const sidebar__parent__menus = document.querySelectorAll('.sidebar__menu__link__parent');

sidebar__parent__menus.forEach((sidebar__parent__menu) => {
    sidebar__parent__menu.addEventListener('click', () => {
        const submenu = sidebar__parent__menu.nextElementSibling;
        submenu.classList.toggle('sidebar__submenu__extend');

        const sidebar__menu__item__parent__arrow = sidebar__parent__menu.querySelector('.sidebar__menu__item__parent__arrow');
        sidebar__menu__item__parent__arrow.classList.toggle('sidebar__menu__item__parent__arrow__rotate');
    });
});


// Main Language Switcher
const defaultOption = document.querySelector('.default__lang');
const selectUl = document.querySelector('.lang__select');
const selectWrap = document.querySelector('.lang__switcher');

defaultOption.addEventListener('click', function () {
    selectWrap.classList.toggle('active');
});

const selectLi = selectUl.querySelectorAll('li');
for (let i = 0; i < selectLi.length; i++) {
    selectLi[i].addEventListener('click', function () {
        selectUl.querySelectorAll('li').forEach(li => li.classList.remove('active'));
        this.classList.add('active');
        selectWrap.classList.remove('active');
    });
}
