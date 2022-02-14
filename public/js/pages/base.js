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
    } else {
        document.querySelector('.nav-container').classList.remove('fix-menu')
        document.querySelector('.logo-menu').classList.remove('show-logo')
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

