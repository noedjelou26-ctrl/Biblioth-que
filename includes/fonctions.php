<?php
/**
 * ============================================================================
 * Fichier : includes/fonctions.php
 * Projet  : Catalogue dynamique « Médiathèque IPNET »
 * UE      : IT 231 - Développement Web I
 * Niveau  : Licence 2 (GL, WIM, DWM, IG, IA)
 * Auteur  : DJELOU Komi Noé (Licence IG)
 * Année   : 2026 - 2027
 * ============================================================================
 * Description :
 * Ce fichier regroupe l'ensemble des fonctions utilitaires du projet.
 * Conformément au sujet de TP, quatre fonctions obligatoires sont définies :
 * 1. afficherLivre(array $livre): string
 * 2. filtrerParCategorie(array $livres, string $categorie): array
 * 3. trouverLivreParId(array $livres, int $id): ?array
 * 4. compterLivresDisponibles(array $livres): int
 
 */

/**
 * Fonction 1 : afficherLivre
 * ----------------------------------------------------------------------------
 * Objectif : Générer le code HTML d'une carte (vignette) représentant un livre.
 * 
 * @param array $livre Le tableau associatif contenant les données d'un seul livre.
 * @return string Le code HTML complet prêt à être affiché dans le navigateur.
 */
function afficherLivre(array $livre): string
{
    // Sécurisation des données textuelles pour empêcher les failles XSS (Cross-Site Scripting)
    $id          = (int) $livre['id'];
    $titre       = htmlspecialchars((string) $livre['titre'], ENT_QUOTES, 'UTF-8');
    $auteur      = htmlspecialchars((string) $livre['auteur'], ENT_QUOTES, 'UTF-8');
    $annee       = (int) $livre['annee'];
    $categorie   = htmlspecialchars((string) $livre['categorie'], ENT_QUOTES, 'UTF-8');
    $prixFormate = number_format($livre['prix'], 0, ',', ' ') . ' FCFA';

    // Détermination de l'état de disponibilité (vrai ou faux)
    // On adapte la classe CSS et le texte du badge en fonction du statut
    if ($livre['disponible'] === true) {
        $badgeDispo = '<span class="badge badge-success">Disponible</span>';
    } else {
        $badgeDispo = '<span class="badge badge-danger">Indisponible</span>';
    }

    // Construction du bloc HTML représentant la carte du livre
    $html  = '<article class="book-card">';
    $html .= '  <div class="book-card-header">';
    $html .= '    <span class="badge badge-category">' . $categorie . '</span>';
    $html .= '    ' . $badgeDispo;
    $html .= '  </div>';

    $html .= '  <div class="book-card-body">';
    $html .= '    <h3 class="book-card-title">' . $titre . '</h3>';
    $html .= '    <p class="book-card-author">Auteur : <span>' . $auteur . '</span></p>';
    $html .= '    <p class="book-card-year">Année d\'édition : <span>' . $annee . '</span></p>';
    $html .= '  </div>';

    $html .= '  <div class="book-card-footer">';
    $html .= '    <div class="book-card-price">';
    $html .= '      <span class="price-label">Valeur :</span>';
    $html .= '      <span class="price-value">' . $prixFormate . '</span>';
    $html .= '    </div>';
    $html .= '    <a href="detail.php?id=' . $id . '" class="btn btn-primary btn-sm">Consulter</a>';
    $html .= '  </div>';
    $html .= '</article>';

    // Retour de la chaîne HTML générée
    return $html;
}

/**
 * Fonction 2 : filtrerParCategorie
 * ----------------------------------------------------------------------------
 * Objectif : Filtrer la liste des livres pour ne conserver que ceux appartenant
 *            à la catégorie passée en paramètre.
 * 
 * @param array  $livres    Le tableau contenant l'ensemble des livres.
 * @param string $categorie Le nom de la catégorie recherchée.
 * @return array Le sous-tableau contenant uniquement les livres correspondants.
 */
function filtrerParCategorie(array $livres, string $categorie): array
{
    // Initialisation d'un tableau vide pour stocker les résultats du filtre
    $livresFiltres = [];

    // Nettoyage et conversion en minuscules de la catégorie recherchée pour une comparaison insensible à la casse
    $categorieCible = mb_strtolower(trim($categorie), 'UTF-8');

    // Parcours de chaque livre du catalogue grâce à une boucle foreach simple
    foreach ($livres as $livre) {
        // Nettoyage et conversion de la catégorie du livre courant
        $categorieLivre = mb_strtolower(trim($livre['categorie']), 'UTF-8');

        // Si les deux chaînes correspondent, on ajoute le livre dans le tableau résultat
        if ($categorieLivre === $categorieCible) {
            $livresFiltres[] = $livre;
        }
    }

    // Renvoi du tableau filtré
    return $livresFiltres;
}

/**
 * Fonction 3 : trouverLivreParId
 * ----------------------------------------------------------------------------
 * Objectif : Rechercher un livre dans le catalogue à partir de son identifiant numérique unique.
 * 
 * @param array $livres Le catalogue complet des livres.
 * @param int   $id     L'identifiant numérique recherché.
 * @return array|null   Le tableau associatif du livre trouvé, ou null si introuvable.
 */
function trouverLivreParId(array $livres, int $id): ?array
{
    // Parcours séquentiel de tous les livres du catalogue
    foreach ($livres as $livre) {
        // Vérification de la correspondance de l'identifiant
        if ((int) $livre['id'] === $id) {
            // Livre trouvé : on le retourne immédiatement sans continuer la boucle
            return $livre;
        }
    }

    // Si la boucle se termine sans correspondance, le livre n'existe pas
    return null;
}

/**
 * Fonction 4 : compterLivresDisponibles
 * ----------------------------------------------------------------------------
 * Objectif : Parcourir le catalogue et compter combien de livres ont le statut "disponible".
 * 
 * @param array $livres Le catalogue de livres à analyser.
 * @return int Le nombre total d'ouvrages actuellement disponibles au prêt.
 */
function compterLivresDisponibles(array $livres): int
{
    // Initialisation du compteur à zéro
    $totalDisponibles = 0;

    // Boucle sur chaque livre du tableau
    foreach ($livres as $livre) {
        // Vérification de la clé "disponible" (doit être un booléen true)
        if (isset($livre['disponible']) && $livre['disponible'] === true) {
            // Incrémentation du compteur
            $totalDisponibles++;
        }
    }

    // Renvoi du résultat
    return $totalDisponibles;
}

/**
 * Fonction utilitaire d'aide : extraireCategories
 * ----------------------------------------------------------------------------
 * Objectif : Récupérer la liste unique de toutes les catégories présentes dans le catalogue,
 *            afin de générer dynamiquement les boutons de filtrage de la médiathèque.
 * 
 * @param array $livres Le catalogue de livres.
 * @return array La liste des catégories uniques, triées par ordre alphabétique.
 */
function extraireCategories(array $livres): array
{
    $categories = [];

    foreach ($livres as $livre) {
        // Si la catégorie n'est pas encore enregistrée dans notre liste, on l'ajoute
        if (!in_array($livre['categorie'], $categories, true)) {
            $categories[] = $livre['categorie'];
        }
    }

    // Tri alphabétique des catégories pour une présentation soignée
    sort($categories);

    return $categories;
}
