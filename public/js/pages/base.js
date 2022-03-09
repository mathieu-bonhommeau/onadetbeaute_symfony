// Code for manage the arrow button which go back on top of the page and fix menu on the top when scroll
const btn = document.querySelector('.go-up')

const heightHeader = document .querySelector('header').clientHeight

window.addEventListener('scroll', event => {
    if (document.body.scrollTop > '100') {
        btn.classList.replace('go-up--hidden', 'go-up--show')
    } else {
        btn.classList.replace('go-up--show', 'go-up--hidden')
    }

    if (document.body.scrollTop > '293') {
        document.querySelector('.nav-container').classList.add('fix-menu')
        document.querySelector('.logo-menu').classList.add('show-logo')
        document.querySelector('.presentations-banner').style.marginTop = 133

        if(window.screen.width < 993) {
            document.querySelector('.toggle-menu').classList.add('toggle-menu--right')
        }

    } else {
        document.querySelector('.nav-container').classList.remove('fix-menu')
        document.querySelector('.logo-menu').classList.remove('show-logo')
        if(window.screen.width < 993) {
            document.querySelector('.presentations-banner').style.marginTop = 0
        } else {
            document.querySelector('.presentations-banner').style.marginTop = 70
        }
        document.querySelector('.toggle-menu').classList.remove('toggle-menu--right')
    }
})

btn.addEventListener('click', event => {
    document.body.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
})

// Code for manage height and balls of header-container in term of the page which is display
const param = (new URLSearchParams(window.location.search)).get('routeName')

if(document.location.pathname === '/' || param === 'home') {
    document.querySelector('.ball--6').classList.add('show')
    document.querySelector('.ball--5').classList.add('show')
    document.querySelector('.header-container').classList.add('header-container--home')
    
} else {
    document.querySelector('.ball--6').classList.add('hide')
    document.querySelector('.ball--5').classList.add('hide')
    document.querySelector('.header-container').classList.remove('header-container--home')
}

// Toggle menu
const icon = document.querySelector('.toggle-menu__icon')
const toggleMenu = document.querySelector('.toggle-nav')

icon.addEventListener('click', () => {
    if (toggleMenu.classList.contains('visible')) {
        toggleMenu.classList.remove('visible')
    } else {
        toggleMenu.classList.add('visible')
    }
    document.querySelector('.toggle-menu__close').addEventListener('click', () => toggleMenu.classList.remove('visible'))
})