document.addEventListener("DOMContentLoaded", function() {
    // Variables
    let formulaireInscription = document.getElementById("inscription_form");
    let formulaireVehicule = document.getElementById("vehicle_form");
    let boutonConfirmerResa = document.getElementById("addReservation");
    let zoneMessageErreur = document.getElementById("messageErreur");
    let zoneMessageErreurV = document.getElementById("messageErreurV")
    //------------------------------------VERIFICATION DU FORMULAIRE COMPTE---------------------------------------------//
    if(formulaireInscription) {
        formulaireInscription.addEventListener("submit", function(event) {
            zoneMessageErreur.innerHTML = "";
            const form = event.target;
            const elementsFormulaire = form.querySelectorAll("input, select");
            let isValid = true;
            let noValue = false;

            elementsFormulaire.forEach(element => {
                if (!element.value.trim()) {
                    isValid = false;
                    noValue = true;
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

            if(noValue) {
                zoneMessageErreur.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Veuillez remplir tous les champs.<br>`;
            }
            if (!isValid) {
                event.preventDefault();
                zoneMessageErreur.classList.add("text-danger");
                zoneMessageErreur.scrollIntoView({ behavior: "smooth", block: "center" });
            }
        });
    }

    //------------------------------------VERIFICATION DU FORMULAIRE VEHICULE---------------------------------------------//
    else if(formulaireVehicule) {
        formulaireVehicule.addEventListener("submit", function(event) {
            zoneMessageErreurV.innerHTML = "";
            const form = event.target;
            const elementsFormulaire = form.querySelectorAll("input, select");
            let isValid = true;
            let noValue = false;

            elementsFormulaire.forEach(element => {
                if (!element.value.trim()) {
                    if(element.name != "photo") {
                        isValid = false;
                        noValue = true;
                    }
                }
                if(element.name == "prix_journalier") {
                    if(element.value < 100 || element.value > 350) {
                        isValid = false;
                        zoneMessageErreurV.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Le prix journalier ne doit pas être inférieur à 100€ ou être supérieur à 350€.<br>`;
                    } 
                } 
            });
            if(noValue) {
                zoneMessageErreurV.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> Veuillez remplir tous les champs.<br>`;
            }
            if (!isValid) {
                event.preventDefault();
                zoneMessageErreurV.classList.add("text-danger");
                zoneMessageErreurV.scrollIntoView({ behavior: "smooth", block: "center" });
            }
        });
    }

    //---------------------------------------------------------------------------POPUP
    let boutonConfirmerCompte = document.querySelectorAll(".accountSuppr");
    let boutonConfirmerVehicule = document.querySelectorAll(".vehicleSuppr");
    let boutonAnnulerResa = document.querySelectorAll(".resaSuppr");
    
    if(boutonConfirmerCompte) {
        boutonConfirmerCompte.forEach(function(bouton) {
            bouton.addEventListener("click", function(event) {
                event.preventDefault();
                let userResponseC = confirm("Voulez-vous supprimer ce compte utilisateur ?");
                if(userResponseC) {
                    window.location.href = this.href;
                } else {
                    event.preventDefault();
                }
            });
        });
    }
    if(boutonConfirmerVehicule) {
        boutonConfirmerVehicule.forEach(function(boutonV) {
            boutonV.addEventListener("click", function(event) {
                event.preventDefault();
                let userResponseV = confirm("Voulez-vous supprimer ce véhicule ?");
                if(userResponseV) {
                    window.location.href = this.href;
                } else {
                    event.preventDefault();
                }
            });
        });
    }
    if(boutonAnnulerResa) {
        boutonAnnulerResa.forEach(function(annuler) {
            annuler.addEventListener("click", function(event) {
                event.preventDefault();
                let demande = confirm("Voulez-vous supprimer cette réservation ?");
                if(demande) {
                    window.location.href = this.href;
                } else {
                    event.preventDefault();
                }
            });
        });
    }
    //------------------------------------------------------VERIFICATION DES DATES DE RESERVATION 
    if (boutonConfirmerResa) {
        boutonConfirmerResa.addEventListener("click", function(event) {
            let dateDebut = document.getElementById("date_debut");
            let dateFin = document.getElementById("date_fin");
            let messageErreurR = document.getElementById("messageErreur");
            messageErreurR.innerHTML = "";

            if (dateDebut.value > dateFin.value) {
                event.preventDefault();
                messageErreurR.innerHTML += `<i class="bi bi-exclamation-triangle-fill"></i> La date de début doit être inférieure à la date de fin.<br>`;
            } 
        });
    };
});




