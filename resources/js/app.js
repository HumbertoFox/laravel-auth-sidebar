document.querySelectorAll('[data-password-toggle]').forEach(button => {
    button.addEventListener('click', () => {
        const input = button.closest('.relative').querySelector('input')
        const isPassword = input.type === 'password'

        input.type = isPassword ? 'text' : 'password'

        button.querySelector('[data-icon-eye]').style.display     = isPassword ? 'none'  : 'block'
        button.querySelector('[data-icon-eye-off]').style.display = isPassword ? 'block' : 'none'
    })
})
