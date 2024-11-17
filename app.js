//Variables
let formulaireInscription = document.getElementById("inscription_form");
let zoneMessageErreur = document.getElementById("messageErreur");

//Verification du formulaire d'inscription
formulaireInscription.addEventListener("submit", function(event) {
    zoneMessageErreur.innerHTML = "";
    const form = event.target;
    const elementsFormulaire = form.querySelectorAll("input, select");
    let isValid = true;

    elementsFormulaire.forEach(element => {
        if (!element.value.trim()) {
            isValid = false;
            return false;
        } 
        if (element.name == "login") {
            if(element.length < 4) {
                zoneMessageErreur.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Le login est trop court.`;
            } 
        } else if (element.name == "mdp") {
            if(element.length < 4) {
                zoneMessageErreur.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Le mot de passe est trop court.`;
            } 
        }
    });

    if (!isValid) {
        event.preventDefault();
        zoneMessageErreur.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Veuillez remplir tous les champs.`;
        zoneMessageErreur.classList.add("text-danger");
        zoneMessageErreur.scrollIntoView({ behavior: "smooth", block: "center" });
    }
});