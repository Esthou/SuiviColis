<?php
function getColis($id) {
    // Code pour récupérer un colis de la base de données
}

function createColis($nature, $nom_expediteur, $nom_destinataire, $destination) {
    // Code pour créer un nouveau colis
}

function updateColis($id, $nature, $nom_expediteur, $nom_destinataire, $destination) {
    // Code pour mettre à jour un colis
}

function deleteColis($id) {
    // Code pour supprimer un colis
}

function etreDeposer($id_colis) {
    // Code pour marquer un colis comme déposé
}

function etreExpedier($id_colis) {
    // Code pour marquer un colis comme expédié
}

function etreRecuperer($id_colis) {
    // Code pour marquer un colis comme récupéré
}