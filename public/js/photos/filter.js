// Ajax request for filter photos by tags with selected element
const listbox = document.getElementById('photoSort')
const tags = document.querySelectorAll('.tag')

let photosContainer = document.querySelector('.photos-content')

listbox.addEventListener('change', e => {
    const value = e.target.value
    sortByTag(value)
})

tags.forEach(e => {
    e.addEventListener('click', event => {
        const value = event.target.innerHTML
        sortByTag(value)
    })
})

function sortByTag (value) {
    photosContainer.innerHTML = ''

    const fetchPhotos = async () => {
        try {
            const datas = await fetch(`/photos/${value}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'message-type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
            })
            const photos = await datas.json()
            const photosDOM = photos.filter(e => e!== null)
                                    .map(e => {
                                        const photoDOM = document.createElement('div')
                                        photoDOM.classList.add('photo')
                                        photoDOM.innerHTML = `
                                            <h2 class="photo__title">${e.name}</h2>
                                            <div class="photo__img">
                                                <img src="/images/upload_photos/${e.path}" alt="${e.name}">
                                            </div>
                                            <div class="photo__actions">
                                                <div class="photo__tags"></div>
                                                <div class="photo__date">Créé le : ${new Date(e.date).toLocaleDateString()}</div>
                                            </div>
                                        `
                                        const tagsDOM = photoDOM.querySelector('.photo__tags')
                                        
                                        Object.values(e.tags).forEach(tag => {
                                            const spanDOM = document.createElement('span')
                                            spanDOM.classList.add('tag')
                                            spanDOM.innerHTML = tag
                                            tagsDOM.append(spanDOM)
                                        })
                                        

                                        return photoDOM
                                    })
            
            photosDOM.forEach(e => photosContainer.append(e))
            const tags = document.querySelectorAll('.tag')
            tags.forEach(e => {
                e.addEventListener('click', event => {
                    const value = event.target.innerHTML
                    sortByTag(value)
                })
            })
            
        }
        catch (err) {
            console.log(err)
        }
    }
    fetchPhotos()
}
