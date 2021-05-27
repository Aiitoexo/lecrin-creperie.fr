function getCommandEmporter() {
    axios.get('command/emporter').then(function (response) {

        const html = response.data.reduce(function (carry, command) {

            let items = ''

            console.log(command)

            for (const item of command.all_items_order) {
                items += `<div class="col-span-1 flex">
                            <p>${item.name}</p>
                            <p class="ml-2">x${item.quantity}</p>
                          </div>`
            }

            const adresse = `
                        <div class="col-span-3 pr-2">
                            <p>${command.adresse}</p>
                            <p>${command.city}</p>
                            <p>${command.postal}</p>
                        </div>
            `

            return carry += `
                     <div class="w-full h-auto bg-white shadow-2xl rounded px-6 py-3 my-6">
                        <div class="flex justify-between items-center pb-3">
                            <p>Commande n° ${command.reference}</p>
                            <p>${command.type_command}</p>
                            <p>${command.price}</p>
                            <a class="button" href="command/complete?id=${command.id}">Commande prête</a>
                        </div>
                        <div class="grid grid-cols-2 pt-3 border-t border-gray-800">
                            <div class="grid grid-cols-5 gap-x-8 col-span-1">
                                <div class="col-span-2 pr-2">
                                    <p>${command.last_name} ${command.first_name}</p>
                                    <p>${command.mail}</p>
                                    <p>${command.phone}</p>
                                </div>

                                ${command.adresse !== null ? adresse : ''}
                            </div>

                            <div class="col-span-1 grid grid-cols-2 bg-gray-300 rounded p-2">
                                ${items}
                            </div>
                        </div>
                    </div>
            `
        }, '')


        let element = document.getElementById('all_command_emporter');

        element.innerHTML = html;

    }).catch(function (error) {
        //TODO: error
    })
};

function getCommandLivraison() {
    axios.get('command/livraison').then(function (response) {

        const html = response.data.reverse().reduce(function (carry, command) {

            let items = ''

            for (const item of command.command) {
                items += `<div class="col-span-1 flex">
                            <p>${item.name}</p>
                            <p class="ml-2">x${item.quantity}</p>
                          </div>`
            }

            const adresse = `
                        <div class="col-span-3 pr-2">
                            <p>${command.adresse}</p>
                            <p>${command.city}</p>
                            <p>${command.postal}</p>
                        </div>
            `

            return carry += `
                     <div class="w-full h-auto bg-white shadow-2xl rounded px-6 py-3 my-6">
                        <div class="flex justify-between items-center pb-3">
                            <p>Commande n° ${command.reference}</p>
                            <p>${command.type_command}</p>
                            <p>${command.price}</p>
                            <a class="button" href="command/complete?id=${command.id}">Commande prête</a>
                        </div>
                        <div class="grid grid-cols-2 pt-3 border-t border-gray-800">
                            <div class="grid grid-cols-5 gap-x-8 col-span-1">
                                <div class="col-span-2 pr-2">
                                    <p>${command.last_name} ${command.first_name}</p>
                                    <p>${command.mail}</p>
                                    <p>${command.phone}</p>
                                </div>

                                ${command.adresse !== null ? adresse : ''}
                            </div>

                            <div class="col-span-1 grid grid-cols-2 bg-gray-300 rounded p-2">
                                ${items}
                            </div>
                        </div>
                    </div>
            `
        }, '')


        let element = document.getElementById('all_command_livraison');

        element.innerHTML = html;

    }).catch(function (error) {
        //TODO: error
    })
};

getCommandEmporter();

setInterval(getCommandEmporter(), getCommandLivraison(), 3000);


