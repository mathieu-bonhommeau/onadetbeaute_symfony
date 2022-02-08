const submit = document.querySelector('.field--submit')

submit.addEventListener('click', (event) => {

    // Remove items on localStorage - this is for data-error attribute
    localStorage.removeItem('email')
    localStorage.removeItem('subject')
    localStorage.removeItem('message')

    // Remove data-error attribute on all form elements(input)
    document.querySelectorAll('.formData').forEach(element => {
        element.removeAttribute('data-error')
        element.removeAttribute('data-error-visible')
    })

    // Container of each inputs
    const email = document.querySelector('.contact_email')
    const subject = document.querySelector('.contact_subject')
    const message= document.querySelector('.contact_message')

    let emailToSend = ''

    // Create a new Message object. Use getter and setter for check datas
    emailToSend = new Message ()
    emailToSend.email = document.querySelector('#contact_email').value
    emailToSend.subject = document.querySelector('#contact_subject').value
    emailToSend.message = document.querySelector('#contact_message').value

    let errors = 0
    
    // if an item is save in local storage, that means an error is throw for this input
    if (localStorage.getItem('email')) {
        email.setAttribute('data-error', localStorage.getItem('email'))
        email.setAttribute('data-error-visible', true)
        errors++
    }
    if (localStorage.getItem('subject')) {
        subject.setAttribute('data-error', localStorage.getItem('subject'))
        subject.setAttribute('data-error-visible', true)
        errors++
    }
    if (localStorage.getItem('message')) {
        message.setAttribute('data-error', localStorage.getItem('message'))
        message.setAttribute('data-error-visible', true)
        errors++
    }

    // If no error, datas are send to server for send the email
    if (errors === 0) {
        // Datas are send by Ajax
        const mail = fetch('/contact', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'message-type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(emailToSend)
        }).then ((res) => {
            if (res.ok) {
                return res.json()
            }
        }).then((value) => {
            if (value === undefined) {
                value = 'La connexion avec le serveur est impossible !!'
            }
            document.querySelector('.message-area').innerHTML = `<p class="alert alert--success">${value}</p>`
            document.querySelectorAll('.formData .field').forEach(element => {
                element.value = ''
            })
        }).catch ((err) => {
            console.log(err)
        })
    }
})

/**
 * Class for create an message object - check datas with getter and setter
 */
class Message {
    constructor (email, subject, message) {
        this._email = email
        this._subject = subject
        this._message = message
    }

    get email () {
        return this._email
    }
    
    set email (email) {
        const emailReg = /^([a-zA-Z0-9-.]{2,})@([a-zA-Z]+)\.[a-z]{2,4}/
    
        console.log(email)

        if (!(emailReg.test(email))) {
           localStorage.setItem('email', 'Cette adresse n\'est pas valide.')
        } else {
          this._email = email
        }
    }

    get subject () {
        return this._subject
    }
    
    set subject (subject) {
        if (subject === '') {
            localStorage.setItem('subject', 'Le sujet du message est vide.')
        }
        this._subject = subject
    }

    get message () {
        return this._message
    }
    
    set message (message) {
        if (message === '') {
            localStorage.setItem('message', 'Le message ne peut pas être vide.')
        }
        this._message = message
    }
}