// Show & Hide Password
function show_hide_password() {
    const eye = document.querySelector('#eye')
    const passwordInput = document.getElementById('password')

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text'
        eye.classList.remove('fa-eye-slash')
        eye.classList.add('fa-eye')
    } else {
        passwordInput.type = 'password'
        eye.classList.remove('fa-eye')
        eye.classList.add('fa-eye-slash')
    }
}

// Lang Switcher
const defaultOption = document.querySelector('.default__lang');
const selectUl = document.querySelector('.lang__select__list');
const selectWrap = document.querySelector('.lang__switcher');

defaultOption.addEventListener('click', function() {
    this.parentNode.classList.toggle('active');
});

const selectLi = selectUl.querySelectorAll('li');
for (let i = 0; i < selectLi.length; i++) {
    selectLi[i].addEventListener('click', function() {
        // document.querySelector('.default__lang li').innerHTML = this.innerHTML;
        selectUl.querySelectorAll('li').forEach(li => li.classList.remove('active'));
        this.classList.add('active');
        this.parentNode.parentNode.classList.remove('active');
    });
}
