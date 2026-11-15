<?php
/**
 * ============================================================================
 * Fichier : detail.php
 * Projet  : Catalogue dynamique « Médiathèque IPNET »
 * UE      : IT 231 - Développement Web I
 * Niveau  : Licence 2 (GL, WIM, DWM, IG, IA)
 * Auteur  : DJELOU Komi Noé (Licence IG)
 * Année   : 2026 - 2027
 * ============================================================================
 * Description :
 * Page affichant la fiche détaillée d'un ouvrage sélectionné via son identifiant.
 * Exemple d'accès : detail.php?id=3
 * 
 * Fonctionnalités attendues :
 * - Vérification de la présence et de la validité de l'identifiant (paramètre GET "id").
 * - Message d'erreur soigné si l'identifiant est absent, non numérique ou inexistant.
 * - Affichage de toutes les caractéristiques de l'ouvrage trouvé.
 * - Échappement rigoureux avec htmlspecialchars().
 * - Liens de retour vers le catalogue général ou vers la catégorie du livre.
 * ============================================================================
 */

// 1. Inclusion des données du catalogue et des fonctions
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

// 2. Initialisation des variables
$livreTrouve   = null;
$messageErreur = null;

// 3. Contrôle et validation du paramètre URL "id"
// On s'assure d'abord que le paramètre "id" existe dans l'URL
if (!isset($_GET['id']) || trim($_GET['id']) === '') {
    $messageErreur = "Aucun identifiant de livre n'a été spécifié dans l'URL. Veuillez sélectionner un livre depuis le catalogue.";
} else {
    $idBrut = trim($_GET['id']);

    // Validation du format : l'identifiant doit être un entier positif strictement supérieur à 0
    // On utilise filter_var avec FILTER_VALIDATE_INT, fonction standard et sûre de PHP
    if (filter_var($idBrut, FILTER_VALIDATE_INT) === false || (int)$idBrut <= 0) {
        $messageErreur = "L'identifiant fourni (« " . htmlspecialchars($idBrut, ENT_QUOTES, 'UTF-8') . " ») est invalide. Il doit s'agir d'un nombre entier positif.";
    } else {
        $idRecherche = (int) $idBrut;
        
        // Recherche du livre dans le catalogue via la fonction obligatoire
        $livreTrouve = trouverLivreParId($livres, $idRecherche);

        // Si la fonction retourne null, le livre n'existe pas dans le tableau
        if ($livreTrouve === null) {
            $messageErreur = "Aucun ouvrage ne correspond à la référence #" . $idRecherche . " dans le catalogue de la médiathèque.";
        }
    }
}

// 4. Définition dynamique du titre de la page
if ($livreTrouve !== null) {
    $titrePage = $livreTrouve['titre'] . " - Fiche détaillée";
} else {
    $titrePage = "Ouvrage non trouvé";
}

// 5. Inclusion de l'en-tête HTML commun
require_once __DIR__ . '/includes/header.php';
?>

<!-- ========================================================================= -->
<!-- FIL D'ARIANE (Navigation hiérarchique)                                    -->
<!-- ========================================================================= -->
<nav class="breadcrumb-nav" aria-label="Fil d'Ariane">
    <ol class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
        <li class="breadcrumb-item"><a href="catalogue.php">Catalogue</a></li>
        <?php if ($livreTrouve !== null): ?>
            <li class="breadcrumb-item">
                <a href="catalogue.php?categorie=<?php echo urlencode($livreTrouve['categorie']); ?>">
                    <?php echo htmlspecialchars($livreTrouve['categorie'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo htmlspecialchars($livreTrouve['titre'], ENT_QUOTES, 'UTF-8'); ?>
            </li>
        <?php else: ?>
            <li class="breadcrumb-item active" aria-current="page">Erreur</li>
        <?php endif; ?>
    </ol>
</nav>

<!-- ========================================================================= -->
<!-- CAS D'ERREUR : Identifiant manquant, invalide ou introuvable               -->
<!-- ========================================================================= -->
<?php if ($messageErreur !== null): ?>

    <div class="alert alert-danger detail-error-box" role="alert">
        <div class="alert-content">
            <h2 class="alert-title">Impossible d'afficher la fiche détaillée</h2>
            <p class="alert-text"><?php echo $messageErreur; ?></p>
            <p class="alert-help">
                Vous pouvez revenir à la liste complète de nos références pour choisir un ouvrage existant.
            </p>
        </div>
        <div class="alert-action">
            <a href="catalogue.php" class="btn btn-primary">Retourner au catalogue</a>
            <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
        </div>
    </div>

<!-- ========================================================================= -->
<!-- CAS NORMAL : Le livre existe et ses informations sont affichées           -->
<!-- ========================================================================= -->
<?php else: ?>

    <?php
    // Préparation sécurisée des variables du livre pour l'affichage
    $idLivre       = (int) $livreTrouve['id'];
    $titreLivre    = htmlspecialchars((string) $livreTrouve['titre'], ENT_QUOTES, 'UTF-8');
    $auteurLivre   = htmlspecialchars((string) $livreTrouve['auteur'], ENT_QUOTES, 'UTF-8');
    $anneeLivre    = (int) $livreTrouve['annee'];
    $catLivre      = htmlspecialchars((string) $livreTrouve['categorie'], ENT_QUOTES, 'UTF-8');
    $prixFormate   = number_format($livreTrouve['prix'], 0, ',', ' ') . ' FCFA';
    $description   = isset($livreTrouve['description']) ? htmlspecialchars((string) $livreTrouve['description'], ENT_QUOTES, 'UTF-8') : 'Aucune description disponible pour cet ouvrage.';
    $estDisponible = ($livreTrouve['disponible'] === true);
    ?>

    <article class="book-detail-card">
        
        <!-- En-tête de la fiche de détail -->
        <header class="detail-header">
            <div class="detail-tags">
                <span class="badge badge-category"><?php echo $catLivre; ?></span>
                <span class="detail-ref">Référence interne : #<?php echo str_pad((string)$idLivre, 3, '0', STR_PAD_LEFT); ?></span>
            </div>

            <h1 class="detail-title"><?php echo $titreLivre; ?></h1>

            <div class="detail-meta">
                <p>Auteur principal : <strong><?php echo $auteurLivre; ?></strong></p>
                <p class="detail-meta-sep">&bull;</p>
                <p>Année de publication : <strong><?php echo $anneeLivre; ?></strong></p>
            </div>
        </header>

        <!-- Corps de la fiche : Résumé et tableau des caractéristiques -->
        <div class="detail-body">
            
            <!-- Section résumé / présentation -->
            <div class="detail-section">
                <h2 class="detail-section-title">Présentation de l'ouvrage</h2>
                <p class="detail-description-text"><?php echo $description; ?></p>
            </div>

            <!-- Tableau récapitulatif des caractéristiques techniques -->
            <div class="detail-section">
                <h2 class="detail-section-title">Informations d'inventaire</h2>
                <div class="table-responsive">
                    <table class="detail-table">
                        <tbody>
                            <tr>
                                <th scope="row">Identifiant système</th>
                                <td>#<?php echo $idLivre; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Titre complet</th>
                                <td><?php echo $titreLivre; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Auteur</th>
                                <td><?php echo $auteurLivre; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Année de parution</th>
                                <td><?php echo $anneeLivre; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Discipline / Catégorie</th>
                                <td>
                                    <a href="catalogue.php?categorie=<?php echo urlencode($livreTrouve['categorie']); ?>" class="link-category">
                                        <?php echo $catLivre; ?> (voir tous les ouvrages de cette catégorie)
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Valeur estimée</th>
                                <td><strong class="price-highlight"><?php echo $prixFormate; ?></strong></td>
                            </tr>
                            <tr>
                                <th scope="row">Statut de disponibilité</th>
                                <td>
                                    <?php if ($estDisponible): ?>
                                        <span class="badge badge-success">Disponible pour prêt immédiat</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Actuellement indisponible (en cours de prêt)</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Encadré sur les conditions d'emprunt à l'IPNET -->
            <div class="detail-notice">
                <h3 class="notice-title">Modalités d'emprunt à la Médiathèque IPNET</h3>
                <p class="notice-text">
                    Pour emprunter cet ouvrage, présentez-vous au guichet de la médiathèque muni de votre 
                    carte d'étudiant IPNET en cours de validité. La durée standard de prêt est de 14 jours, 
                    renouvelable une fois sous réserve qu'aucune réservation ne soit en attente.
                </p>
            </div>

        </div>

        <!-- Pied de fiche : actions et retour -->
        <footer class="detail-footer">
            <div class="detail-footer-actions">
                <a href="catalogue.php" class="btn btn-secondary">Retour au catalogue</a>
                <a href="catalogue.php?categorie=<?php echo urlencode($livreTrouve['categorie']); ?>" class="btn btn-primary">
                    Voir les autres livres « <?php echo $catLivre; ?> »
                </a>
            </div>
        </footer>

    </article>

<?php endif; ?>

<?php
// 6. Inclusion du pied de page HTML commun
require_once __DIR__ . '/includes/footer.php';
?>
