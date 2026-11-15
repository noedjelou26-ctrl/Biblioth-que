<?php
/**
 * ============================================================================
 * Fichier : catalogue.php
 * Projet  : Catalogue dynamique « Médiathèque IPNET »
 * UE      : IT 231 - Développement Web I
 * Niveau  : Licence 2 (GL, WIM, DWM, IG, IA)
 * Auteur  : DJELOU Komi Noé (Licence IG)
 * Année   : 2026 - 2027
 * ============================================================================
 * Description :
 * Page catalogue de la médiathèque.
 * Fonctionnalités attendues :
 * - Affichage de tous les livres sous forme de cartes élégantes et lisibles.
 * - Présentation des métadonnées de chaque livre : titre, auteur, année,
 *   catégorie, prix, disponibilité.
 * - Affichage dynamique du nombre de livres affichés.
 * - Filtrage par catégorie via le paramètre URL GET (?categorie=...).
 * - Vérification de la validité du paramètre avec message d'erreur si la
 *   catégorie n'existe pas.
 * - Possibilité de revenir à l'affichage complet (réinitialisation du filtre).
 * ============================================================================
 */

// 1. Inclusion des données et des fonctions utilitaires
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

// 2. Définition du titre de la page
$titrePage = "Catalogue des Ouvrages";

// 3. Récupération de la liste de toutes les catégories existantes
$toutesLesCategories = extraireCategories($livres);

// 4. Initialisation des variables de contrôle du filtre
$categorieActive = null;  // Contiendra le nom officiel de la catégorie si le filtre est actif
$erreurCategorie = null;  // Contiendra le message d'erreur si une catégorie invalide est demandée
$livresAffiches  = [];    // Contiendra les livres qui seront effectivement présentés

// 5. Traitement et validation du paramètre URL "categorie"
if (isset($_GET['categorie']) && trim($_GET['categorie']) !== '') {
    $paramCategorie = trim($_GET['categorie']);
    
    // Recherche si la catégorie demandée correspond à une catégorie valide
    $categorieTrouvee = null;
    foreach ($toutesLesCategories as $cat) {
        if (mb_strtolower($cat, 'UTF-8') === mb_strtolower($paramCategorie, 'UTF-8')) {
            $categorieTrouvee = $cat;
            break;
        }
    }

    if ($categorieTrouvee !== null) {
        // La catégorie est valide : on filtre le catalogue grâce à la fonction requise
        $categorieActive = $categorieTrouvee;
        $livresAffiches  = filtrerParCategorie($livres, $categorieTrouvee);
    } else {
        // La catégorie demandée n'existe pas : on enregistre un message d'erreur propre
        $erreurCategorie = "La catégorie demandée « " . htmlspecialchars($paramCategorie, ENT_QUOTES, 'UTF-8') . " » n'existe pas dans le catalogue.";
        // Par sécurité et convivialité, on réinitialise l'affichage avec l'ensemble des livres
        $livresAffiches  = $livres;
    }
} else {
    // Aucun paramètre de filtre : on affiche la totalité des livres du catalogue
    $livresAffiches = $livres;
}

// 6. Calcul du nombre d'ouvrages actuellement affichés
$nombreAffiches = count($livresAffiches);

// 7. Inclusion de l'en-tête HTML commun
require_once __DIR__ . '/includes/header.php';
?>

<!-- ========================================================================= -->
<!-- EN-TETE DE LA PAGE CATALOGUE                                              -->
<!-- ========================================================================= -->
<section class="page-header">
    <div class="page-header-content">
        <h1 class="page-title">Catalogue des Livres</h1>
        <p class="page-subtitle">
            Consultez les ouvrages disponibles au sein de la médiathèque IPNET. 
            Utilisez les filtres thématiques pour affiner votre recherche documentaire.
        </p>
    </div>
</section>

<!-- ========================================================================= -->
<!-- ZONE DE NOTIFICATION / ERREUR DE FILTRAGE (Si catégorie introuvable)      -->
<!-- ========================================================================= -->
<?php if ($erreurCategorie !== null): ?>
    <div class="alert alert-danger" role="alert">
        <div class="alert-content">
            <h4 class="alert-title">Catégorie non reconnue</h4>
            <p><?php echo $erreurCategorie; ?></p>
            <p class="alert-help">
                L'ensemble du catalogue vous est présenté ci-dessous. Vous pouvez sélectionner
                une catégorie valide parmi les options proposées.
            </p>
        </div>
        <div class="alert-action">
            <a href="catalogue.php" class="btn btn-outline btn-sm">Réinitialiser le filtre</a>
        </div>
    </div>
<?php endif; ?>

<!-- ========================================================================= -->
<!-- BARRE DE FILTRAGE PAR CATEGORIE (Menu de filtres cliquables)             -->
<!-- ========================================================================= -->
<section class="filter-section">
    <div class="filter-header">
        <h2 class="filter-label">Filtrer par discipline :</h2>
        <?php if ($categorieActive !== null): ?>
            <a href="catalogue.php" class="reset-filter-link">Voir tout le catalogue</a>
        <?php endif; ?>
    </div>

    <div class="filter-buttons">
        <!-- Bouton pour afficher la totalité sans filtre -->
        <a href="catalogue.php" class="btn-filter <?php echo ($categorieActive === null && $erreurCategorie === null) ? 'active' : ''; ?>">
            Tous les livres (<?php echo count($livres); ?>)
        </a>

        <!-- Boutons dynamiques pour chaque catégorie du catalogue -->
        <?php foreach ($toutesLesCategories as $cat): ?>
            <?php 
                $nbParCat   = count(filtrerParCategorie($livres, $cat));
                $estActive  = ($categorieActive === $cat);
            ?>
            <a href="catalogue.php?categorie=<?php echo urlencode($cat); ?>" 
               class="btn-filter <?php echo $estActive ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($cat, ENT_QUOTES, 'UTF-8'); ?>
                <span class="filter-count">(<?php echo $nbParCat; ?>)</span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- ========================================================================= -->
<!-- STATUT DE L'AFFICHAGE DU CATALOGUE                                        -->
<!-- ========================================================================= -->
<section class="catalogue-status-bar">
    <div class="status-left">
        <?php if ($categorieActive !== null): ?>
            <p class="status-text">
                Affichage de <strong><?php echo $nombreAffiches; ?></strong> ouvrage(s) dans la discipline 
                <span class="highlight-category">« <?php echo htmlspecialchars($categorieActive, ENT_QUOTES, 'UTF-8'); ?> »</span>.
            </p>
        <?php else: ?>
            <p class="status-text">
                Affichage de <strong><?php echo $nombreAffiches; ?></strong> ouvrage(s) au total dans le catalogue.
            </p>
        <?php endif; ?>
    </div>

    <div class="status-right">
        <?php if ($categorieActive !== null): ?>
            <a href="catalogue.php" class="btn btn-secondary btn-sm">Afficher tous les livres</a>
        <?php endif; ?>
    </div>
</section>

<!-- ========================================================================= -->
<!-- GRILLE D'AFFICHAGE DES LIVRES (Générée via afficherLivre())                -->
<!-- ========================================================================= -->
<section class="catalogue-grid-section">
    <?php if ($nombreAffiches > 0): ?>
        
        <div class="books-grid">
            <?php
            // Parcours de chaque livre filtré et génération de la carte HTML
            foreach ($livresAffiches as $livreCourant) {
                // Appel de la fonction obligatoire afficherLivre()
                echo afficherLivre($livreCourant);
            }
            ?>
        </div>

    <?php else: ?>

        <!-- Bloc informatif si aucun livre ne correspond -->
        <div class="empty-state">
            <h3 class="empty-title">Aucun ouvrage trouvé</h3>
            <p class="empty-text">Aucun livre ne correspond aux critères de sélection actuels.</p>
            <a href="catalogue.php" class="btn btn-primary">Revenir à la liste complète</a>
        </div>

    <?php endif; ?>
</section>

<?php
// 8. Inclusion du pied de page HTML commun
require_once __DIR__ . '/includes/footer.php';
?>
