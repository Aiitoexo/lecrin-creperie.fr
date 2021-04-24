const livraison = document.querySelector('#livraison')
const postal = document.querySelector('#postal')

livraison.addEventListener('click', function () {
    livraison.classList.add('opacity-0')
    setTimeout(function (){
        postal.classList.add('z-20')
    },500)
})


