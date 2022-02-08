// Slider with title on home page
const slide1 = document.querySelector('.slide-1')
const slide2 = document.querySelector('.slide-2')
const slide3 = document.querySelector('.slide-3')

slide1.style.animation = "slide-presentation 6s ease infinite"

slide1.addEventListener('animationiteration', (event) => {
    slide1.style.transform = "translateX(-100%)"
    slide1.style.animation = ''

    slide2.style.transform = "translateX(0)"
    slide2.style.animation = "slide-presentation 6s ease infinite"
})

slide2.addEventListener('animationiteration', (event) => {
    slide2.style.transform = "translateX(-100%)"
    slide2.style.animation = ''

    slide3.style.transform = "translateX(0)"
    slide3.style.animation = "slide-presentation 6s ease infinite"
})

slide3.addEventListener('animationiteration', (event) => {
    slide3.style.transform = "translateX(-100%)"
    slide3.style.animation = ''

    slide1.style.transform = "translateX(0)"
    slide1.style.animation = "slide-presentation 6s ease infinite"
})