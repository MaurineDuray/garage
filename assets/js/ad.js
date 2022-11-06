// js qui permet l'ajout de lignes de formulaire pour ajouter des images à la galerie de chaque voiture

const addImage = document.querySelector('#add-image')

addImage.addEventListener('click',()=>{
    // compter combien j'ai de form-group pour les indices ex: annonce_image_0_url
    const widgetCounter = document.querySelector("#widgets-counter")
    const index = +widgetCounter.value
    // transformation en nombre grâce au +
    const annonceImages = document.querySelector('#voitures_pictures')

    //recup le prototype des entrées data-prototype
    const prototype = annonceImages.dataset.prototype.replace(/__name__/g, index) 
    // drapeau g pour indiquer que l'on va le faire plusieurs fois 

    //injecter le code dans la div
    annonceImages.insertAdjacentHTML('beforeend', prototype)
    widgetCounter.value = index+1

    handleDeleteButtons()
     // pour mettre à jour le table deletes et ajouter l'évent 
})

// compte le nombre d'images ajoutées à la galerie
const updateCounter = () => {
    const count = document.querySelectorAll('#voitures_pictures div.form-group').length
    document.querySelector('#widgets-counter').value = count
}

// suppression des images du formulaire
const handleDeleteButtons = () => {
    var deletes = document.querySelectorAll("button[data-action='delete']")

    deletes.forEach(button => {
        button.addEventListener('click',()=>{
            const target = button.dataset.target
            const elementTarget = document.querySelector(target)
            if(elementTarget){
                elementTarget.remove() // supprimer l'élément 
            }
        })
    })


}

updateCounter()
handleDeleteButtons()