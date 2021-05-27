let all_button_section = document.querySelectorAll('.button_section')
let all_section = document.querySelectorAll('.section')

for (let i = 0; i < all_button_section.length; i++) {
    all_button_section[i].addEventListener('click', function () {
        for (let j = 0; j < all_section.length; j++) {
            all_section[j].classList.remove('hidden')
            all_button_section[j].classList.remove('bg-yellow-500', 'text-gray-800')
            all_button_section[j].classList.add('bg-gray-800', 'text-white')
            all_section[j].classList.add('hidden')
        }
        all_section[i].classList.remove('hidden')
        all_button_section[i].classList.remove('bg-gray-800', 'text-white')
        all_button_section[i].classList.add('bg-yellow-500', 'text-gray-800')
    })
}

const inputs_quantity = document.querySelectorAll('.quantity')
const buttons_less = document.querySelectorAll('.less')
const buttons_more = document.querySelectorAll('.more')

for (let i = 0; i < buttons_less.length; i++) {
    buttons_less[i].addEventListener('click', function () {
        if (inputs_quantity[i].value > 1) {
            inputs_quantity[i].value = parseInt(inputs_quantity[i].value) - 1
        }
    })
}

for (let i = 0; i < buttons_more.length; i++) {
    buttons_more[i].addEventListener('click', function () {
        if (inputs_quantity[i].value < 100) {
            inputs_quantity[i].value = parseInt(inputs_quantity[i].value) + 1
        }
    })
}

const button_modal = document.querySelectorAll('#button_modal')
const modal_type_command = document.querySelector('#modal_type_command')

for (let i = 0; i < button_modal.length; i++) {
    button_modal[i].addEventListener('click', function () {
        modal_type_command.classList.remove('hidden')
    })
}

const button_modal_items = document.querySelectorAll('.button_modal_items')
const modal_items = document.querySelectorAll('.modal_items')


for (let i = 0; i < button_modal_items.length; i++) {
    button_modal_items[i].addEventListener('click', function () {
        for (let j = 0; j < button_modal_items.length; j++) {
            modal_items[j].classList.remove('hidden')
            modal_items[j].classList.add('hidden')
        }
        modal_items[i].classList.remove('hidden')
    })
}
