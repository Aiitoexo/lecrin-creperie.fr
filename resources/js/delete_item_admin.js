const button_delete = document.querySelectorAll('.delete_item')
const modals_items = document.querySelectorAll('.modal_item')
const button_cancel = document.querySelectorAll('.cancel_modal')

for (let i = 0; i < button_delete.length; i++) {
    button_delete[i].addEventListener('click', function () {
        modals_items[i].classList.remove('hidden')
    })
}

for (let j = 0; j < button_delete.length; j++) {
    button_cancel[j].addEventListener('click', function () {
        modals_items[j].classList.add('hidden')
    })
}

const all_button_details = document.querySelectorAll('.button_details')
const all_details = document.querySelectorAll('.details')

for (let i = 0; i < all_button_details.length; i++) {
    all_button_details[i].addEventListener('click', function () {
        all_details[i].classList.toggle('hidden')
    })
}
