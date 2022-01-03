const tr = document.querySelectorAll('.datagrid tbody tr')

//For each photo, checking change and reload page for call server and adapt easy admin actions
tr.forEach((element) => {

    let isDeleteInit = ''
    let isDelete = ''

    const principalPhoto = element.querySelector('.principal-photo input')
    const frontPhoto = element.querySelector('.front-photo input')
    const isMyWorksPhoto = element.querySelector('.ismyworks-photo input')
    const prestationTypePhoto = element.querySelector('.prestationtype-photo a')
    const prestationPhoto = element.querySelector('.prestation-photo a')

    if (principalPhoto.checked || 
        frontPhoto.checked || 
        isMyWorksPhoto.checked ||
        prestationTypePhoto ||
        prestationPhoto
    ) {
        isDeleteInit = true
    } else {
        isDeleteInit = false
    }

    const listPhoto = document.querySelector('.datagrid tbody')

    listPhoto.addEventListener('change', () => {
        
        if (principalPhoto.checked || 
            frontPhoto.checked || 
            isMyWorksPhoto.checked ||
            prestationTypePhoto ||
            prestationPhoto
        ) {
            isDelete = true
        } else {
            isDelete = false
        } 
        if (isDeleteInit != isDelete) {
            location.reload()
        }
    })

    principalPhoto.addEventListener('change', () => location.reload())
})
