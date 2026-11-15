<?php
/**
 * ============================================================================
 * Fichier : index.php
 * Projet  : Catalogue dynamique « Médiathèque IPNET »
 * UE      : IT 231 - Développement Web I
 * Niveau  : Licence 2 (GL, WIM, DWM, IG, IA)
 * Auteur  : DJELOU Komi Noé (Licence IG)
 * Année   : 2026 - 2027
 * ============================================================================
 * Description :
 * Page d'accueil de la médiathèque IPNET.
 * Fonctionnalités attendues par le sujet :
 * - Message de bienvenue institutionnel.
 * - Lien direct vers le catalogue.
 * - Affichage du nombre total de livres disponibles (calculé dynamiquement
 *   en PHP à l'aide de la fonction compterLivresDisponibles()).
 * ============================================================================
 */

// 1. Inclusion des données du catalogue et des fonctions utilitaires
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

// 2. Définition du titre de la page pour l'en-tête HTML
$titrePage = "Accueil - Portail Documentaire";

// 3. Calculs statistiques en PHP à partir des données
$nombreTotalLivres       = count($livres);
$nombreLivresDisponibles = compterLivresDisponibles($livres);
$nombreLivresEmpruntes   = $nombreTotalLivres - $nombreLivresDisponibles;
$listeCategories         = extraireCategories($livres);
$nombreCategories        = count($listeCategories);

// 4. Inclusion de l'en-tête HTML commun
require_once __DIR__ . '/includes/header.php';
?>

<!-- ========================================================================= -->
<!-- SECTION BANNIERE DE BIENVENUE (HERO)                                     -->
<!-- ========================================================================= -->
<section class="hero-section">
    <div class="hero-content">
        <span class="badge badge-primary">Espace Numérique Étudiant</span>
        <h1 class="hero-title">Bienvenue sur le portail de la Médiathèque IPNET</h1>
        <p class="hero-description">
            Accédez facilement aux ressources documentaires et pédagogiques recommandées 
            pour les filières Génie Logiciel, Réseaux, Web &amp; Multimédia et Informatique de Gestion.
            Consultez les disponibilités en temps réel avant de vous rendre en salle de prêt.
        </p>
        <div class="hero-actions">
            <a href="catalogue.php" class="btn btn-primary">Explorer le catalogue des livres</a>
            <a href="apropos.php" class="btn btn-secondary">En savoir plus sur nos services</a>
        </div>
    </div>
</section>

<!-- ========================================================================= -->
<!-- SECTION STATISTIQUES EN TEMPS REEL (Calculées dynamiquement en PHP)      -->
<!-- ========================================================================= -->
<section class="stats-section">
    <div class="section-header">
        <h2 class="section-title">État du fonds documentaire</h2>
        <p class="section-subtitle">Données calculées en direct depuis notre inventaire</p>
    </div>

    <div class="stats-grid">
        
        <!-- Total des ouvrages enregistrés -->
        <div class="stat-card">
            <span class="stat-number"><?php echo $nombreTotalLivres; ?></span>
            <span class="stat-label">Total des ouvrages</span>
            <p class="stat-help">Titres référencés au catalogue</p>
        </div>

        <!-- Total des livres disponibles au prêt (exigence du sujet 3.1) -->
        <div class="stat-card stat-card-success">
            <span class="stat-number"><?php echo $nombreLivresDisponibles; ?></span>
            <span class="stat-label">Livres disponibles</span>
            <p class="stat-help">Prêts immédiats en rayon</p>
        </div>

        <!-- Total des livres actuellement indisponibles / en prêt -->
        <div class="stat-card">
            <span class="stat-number"><?php echo $nombreLivresEmpruntes; ?></span>
            <span class="stat-label">En cours de consultation</span>
            <p class="stat-help">Actuellement empruntés</p>
        </div>

        <!-- Total des disciplines couvertes -->
        <div class="stat-card">
            <span class="stat-number"><?php echo $nombreCategories; ?></span>
            <span class="stat-label">Disciplines académiques</span>
            <p class="stat-help">Domaines d'apprentissage</p>
        </div>

    </div>
</section>

<!-- ========================================================================= -->
<!-- SECTION RACCOURCIS PAR CATEGORIE                                          -->
<!-- ========================================================================= -->
<section class="categories-section">
    <div class="section-header">
        <h2 class="section-title">Parcourir par discipline</h2>
        <p class="section-subtitle">Sélectionnez une catégorie pour filtrer instantanément les ouvrages</p>
    </div>

    <div class="category-pills">
        <a href="catalogue.php" class="pill pill-all">Tous les ouvrages (<?php echo $nombreTotalLivres; ?>)</a>
        <?php foreach ($listeCategories as $cat): ?>
            <?php 
                // Filtrage temporaire pour connaître le nombre de livres dans cette catégorie
                $livresDeLaCat = filtrerParCategorie($livres, $cat);
                $compteCat     = count($livresDeLaCat);
            ?>
            <a href="catalogue.php?categorie=<?php echo urlencode($cat); ?>" class="pill">
                <?php echo htmlspecialchars($cat, ENT_QUOTES, 'UTF-8'); ?>
                <span class="pill-count">(<?php echo $compteCat; ?>)</span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- ========================================================================= -->
<!-- SECTION APERÇU D'OUVRAGES RECOMMANDES                                    -->
<!-- ========================================================================= -->
<section class="featured-section">
    <div class="section-header">
        <h2 class="section-title">Sélection d'ouvrages du moment</h2>
        <p class="section-subtitle">Quelques références incontournables à consulter en priorité</p>
    </div>

    <div class="books-grid">
        <?php
        // Affichage des 3 premiers livres du catalogue en guise d'aperçu
        $livresSelectionnes = array_slice($livres, 0, 3);
        foreach ($livresSelectionnes as $unLivre) {
            // Utilisation de la fonction obligatoire afficherLivre()
            echo afficherLivre($unLivre);
        }
        ?>
    </div>

    <div class="section-footer-action">
        <a href="catalogue.php" class="btn btn-primary">Voir tous les livres disponibles (<?php echo $nombreTotalLivres; ?>)</a>
    </div>
</section>

<?php
// 5. Inclusion du pied de page HTML commun
require_once __DIR__ . '/includes/footer.php';
?>
