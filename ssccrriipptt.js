let titre = document.querySelector(".titre")
let son = document.querySelector(".son")
let statut = document.querySelectorAll(".statut")

titre.addEventListener("click",function(){
    son.play()
    console.log("Salut")
})

for (let i = 0; i < statut.length; i++) {
    statut[i].addEventListener("click",function () { 
        console.log(i)
    if (statut[i].innerHTML === "A faire") {
    statut[i].innerHTML = "En cours"
    statut[i].style.backgroundColor = "orange"
    }
     else if (statut[i].innerHTML ==="En cours") {
    statut[i].innerHTML="Terminée"
    statut[i].style.backgroundColor = "green"
     }
    else { statut[i].innerHTML ="A faire"
    statut[i].style.backgroundColor = "#527D80"
}
})
}

