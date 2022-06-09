// Get the nodeElement for add the slider
const facebookSlider = document.getElementById('facebook-card')
let loading = true

facebookSlider.innerHTML = `<div class="loading"><img src="./images/loading.gif" alt="Loader"></div>`

/**
 * Fetch posts facebook
 * @returns {Promise<void>}
 */
const fetchPosts = async () => {
    try {
        const response = await fetch('/getPosts', {
            method: 'GET',
            headers: {
                'Content-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })

        const onadetbeaute = await response.json()

        const responsePosts = await fetch(`https://graph.facebook.com/v12.0/${onadetbeaute[0].facebookPageId}/published_posts`, {
            method: 'GET',
            headers: {
                'Content-type': 'application/json',
                'Authorization': 'Bearer ' + onadetbeaute[0].facebookToken
            }
        })
        const data = await responsePosts.json()

        const partstart =`<div class="bloc-iframes" id="facebook-frames">`
        const partend = `</div>`

        const facebookPostsMax = data.data.slice(0,10)

        let frames = ''
        facebookPostsMax.forEach(e => {
            const id = e.id.split('_')[1]
            frames += `<div class="posts-iframe card">
                        <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FONadetBeaute%2Fposts%2F${id}&show_text=true"></iframe>
                       </div>`
        })

        facebookSlider.innerHTML = partstart + frames + partend
        buildSliderPosts()

    } catch (err) {
        facebookSlider.innerHTML = `<p class="alert">Oups !! Facebook a rencontré un problème</p>`
    }
}
fetchPosts()

/**
 * Build the slider with slick and JQuery
 */
function buildSliderPosts() {
    jQuery(document).ready(function() {
        jQuery('.bloc-iframes').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 4,
            responsive: [
                {
                    breakpoint: 1366,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '100px',
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '100px',
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '150px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 587,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '50px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '10px',
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
}
