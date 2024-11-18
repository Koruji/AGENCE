// Variables
let formulaireInscription = document.getElementById("inscription_form");
let zoneMessageErreur = document.getElementById("messageErreur");

//------------------------------------VERIFICATION DU FORMULAIRE---------------------------------------------//
formulaireInscription.addEventListener("submit", function(event) {
    zoneMessageErreur.innerHTML = "";
    const form = event.target;
    const elementsFormulaire = form.querySelectorAll("input, select");
    let isValid = true;

    elementsFormulaire.forEach(element => {
        if (!element.value.trim()) {
            isValid = false;
            zoneMessageErreur.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Veuillez remplir tous les champs.<br>`;
        } 
        if (element.name == "login") {
            if (element.value.trim().length < 4) {
                isValid = false;
                zoneMessageErreur.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Le login est trop court.<br>`;
            }
        } else if (element.name == "mdp") {
            if (element.value.trim().length < 4) {
                isValid = false;
                zoneMessageErreur.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Le mot de passe est trop court.<br>`;
            }
        }

        if (element.name === "login" || element.name === "mdp") {
            if (element.value.indexOf(" ") !== -1) {
                isValid = false;
                zoneMessageErreur.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Le ${element.name} ne doit pas contenir d'espaces.<br>`;
            }
        }
    });

    if (!isValid) {
        event.preventDefault();
        zoneMessageErreur.classList.add("text-danger");
        zoneMessageErreur.scrollIntoView({ behavior: "smooth", block: "center" });
    }
});
