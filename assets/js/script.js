// ============================================
// GESTION ÉTUDIANTS — Validation JavaScript
// ============================================

/**
 * Valide un champ texte (longueur minimale).
 * Affiche / efface le message d'erreur associé.
 * @returns {boolean}
 */
function validerChamp(input, erreurId, min) {
    const errEl = document.getElementById(erreurId);
    const valeur = input.value.trim();

    if (valeur.length < min) {
        errEl.textContent = "Ce champ doit contenir au moins " + min + " caractères.";
        input.style.borderColor = "#c0392b";
        return false;
    }

    errEl.textContent = "";
    input.style.borderColor = "";
    return true;
}

// ---------- Formulaire d'ajout / modification ----------
const form = document.getElementById("form-ajout");

if (form) {
    const inputNom    = document.getElementById("nom");
    const inputPrenom = document.getElementById("prenom");

    // Validation en temps réel (au changement de champ)
    inputNom.addEventListener("blur", function () {
        validerChamp(inputNom, "err-nom", 2);
    });

    inputPrenom.addEventListener("blur", function () {
        validerChamp(inputPrenom, "err-prenom", 2);
    });

    // Validation à la soumission — bloque l'envoi si invalide
    form.addEventListener("submit", function (e) {
        const nomOk    = validerChamp(inputNom,    "err-nom",    2);
        const prenomOk = validerChamp(inputPrenom, "err-prenom", 2);

        if (!nomOk || !prenomOk) {
            e.preventDefault(); // Empêche l'envoi du formulaire
        }
    });
}

// ---------- Confirmation avant suppression ----------
document.querySelectorAll(".delete-link").forEach(function (lien) {
    lien.addEventListener("click", function (e) {
        const ok = confirm("Voulez-vous vraiment supprimer cet étudiant ?\nCette action est irréversible.");
        if (!ok) {
            e.preventDefault(); // Annule la navigation si l'utilisateur refuse
        }
    });
});
