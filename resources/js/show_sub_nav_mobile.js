const hamburger = document.querySelector('#hamburger')
const sub_nav_mobile = document.querySelector('#sub_nav_mobile')
const close_sub_nav = document.querySelector('#close_sub_nav')

hamburger.addEventListener('click', function () {
    sub_nav_mobile.classList.remove('hidden')
})

close_sub_nav.addEventListener('click', function () {
    sub_nav_mobile.classList.add('hidden')
})
