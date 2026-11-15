<?php
/**
 * ============================================================================
 * Fichier : apropos.php
 * Projet  : Catalogue dynamique « Médiathèque IPNET »
 * UE      : IT 231 - Développement Web I
 * Niveau  : Licence 2 (GL, WIM, DWM, IG, IA)
 * Auteur  : DJELOU Komi Noé (Licence IG)
 * Année   : 2026 - 2027
 * ============================================================================
 * Description :
 * Page institutionnelle de présentation de la médiathèque.
 * Fonctionnalités attendues :
 * - Présentation statique de la médiathèque IPNET (missions, services, horaires).
 * - Utilisation d'une fonction PHP pour afficher la date du jour de façon dynamique.
 * ============================================================================
 */

// 1. Définition du titre de la page pour le header
$titrePage = "À propos de la Médiathèque";

// 2. Traitement PHP de la date du jour
// Exigence du sujet : utilisation d'une fonction PHP pour afficher la date du jour.
// Pour obtenir un affichage élégant en français sans dépendre des locales du système d'exploitation,
// nous utilisons des tableaux de correspondance simples pour les jours et les mois.
$joursFr = [
    'Sunday'    => 'Dimanche',
    'Monday'    => 'Lundi',
    'Tuesday'   => 'Mardi',
    'Wednesday' => 'Mercredi',
    'Thursday'  => 'Jeudi',
    'Friday'    => 'Vendredi',
    'Saturday'  => 'Samedi'
];

$moisFr = [
    '01' => 'janvier',
    '02' => 'février',
    '03' => 'mars',
    '04' => 'avril',
    '05' => 'mai',
    '06' => 'juin',
    '07' => 'juillet',
    '08' => 'août',
    '09' => 'septembre',
    '10' => 'octobre',
    '11' => 'novembre',
    '12' => 'décembre'
];

// Récupération des composants de la date courante grâce à la fonction standard date() de PHP
$nomJourEn    = date('l');        // ex: 'Sunday'
$numeroJour   = date('d');        // ex: '15'
$codeMois     = date('m');        // ex: '11'
$annee        = date('Y');        // ex: '2026'
$heureCourante = date('H:i');     // ex: '16:45'

// Assemblage de la date complète en français
$jourTraduit  = $joursFr[$nomJourEn] ?? $nomJourEn;
$moisTraduit  = $moisFr[$codeMois] ?? $codeMois;
$dateDuJour   = $jourTraduit . ' ' . $numeroJour . ' ' . $moisTraduit . ' ' . $annee;
$dateCourte   = date('d/m/Y');    // Format court classique : JJ/MM/AAAA

// 3. Inclusion de l'en-tête HTML commun
require_once __DIR__ . '/includes/header.php';
?>

<!-- ========================================================================= -->
<!-- EN-TETE DE LA PAGE A PROPOS                                               -->
<!-- ========================================================================= -->
<section class="page-header">
    <div class="page-header-content">
        <h1 class="page-title">À propos de la Médiathèque IPNET</h1>
        <p class="page-subtitle">
            Découvrez nos missions, les collections mises à la disposition des étudiants
            et le cadre pédagogique de réalisation de cette plateforme web.
        </p>
    </div>
</section>

<!-- ========================================================================= -->
<!-- BANDEAU DYNAMIQUE DE LA DATE DU JOUR (Généré en PHP)                      -->
<!-- ========================================================================= -->
<section class="date-banner">
    <div class="date-banner-content">
        <div class="date-info">
            <span class="date-label">Date de consultation du portail :</span>
            <strong class="date-value"><?php echo $dateDuJour; ?></strong>
            <span class="date-badge">(<?php echo $dateCourte; ?> - <?php echo $heureCourante; ?>)</span>
        </div>
        <p class="date-note">
            Généré dynamiquement par le serveur local via les fonctions PHP <code>date()</code>.
        </p>
    </div>
</section>

<!-- ========================================================================= -->
<!-- PRESENTATION INSTITUTIONNELLE                                             -->
<!-- ========================================================================= -->
<section class="about-grid">
    
    <!-- Colonne 1 : Missions et Public cible -->
    <article class="about-card">
        <h2 class="about-card-title">Missions de la Médiathèque</h2>
        <p class="about-card-text">
            La Médiathèque de l'<strong>IPNET Institute of Technology</strong> est un centre de ressources
            spécialisé qui a pour vocation d'accompagner les étudiants, enseignants et chercheurs
            dans leurs travaux académiques et projets technologiques.
        </p>
        <p class="about-card-text">
            Elle met à disposition des ouvrages fondamentaux et récents couvrant les différents domaines
            enseignés au sein de l'institut :
        </p>
        <ul class="about-list">
            <li><strong>GL :</strong> Génie Logiciel et architectures applicatives.</li>
            <li><strong>WIM &amp; DWM :</strong> Web, Multimédia et technologies front-end / back-end.</li>
            <li><strong>IG :</strong> Informatique de Gestion, systèmes d'information et bases de données.</li>
            <li><strong>IA :</strong> Intelligence Artificielle, science des données et apprentissage automatique.</li>
        </ul>
    </article>

    <!-- Colonne 2 : Modalités et Horaires -->
    <article class="about-card">
        <h2 class="about-card-title">Horaires et Modalités d'Accès</h2>
        <p class="about-card-text">
            L'accès à la salle de lecture et au service de prêt est réservé aux étudiants et au personnel
            de l'institut porteurs d'un badge ou d'une carte d'étudiant active.
        </p>
        
        <div class="schedule-box">
            <h3 class="schedule-title">Horaires d'ouverture standard :</h3>
            <ul class="schedule-list">
                <li><strong>Du lundi au vendredi :</strong> 08h00 &agrave; 18h30 sans interruption.</li>
                <li><strong>Samedi :</strong> 08h30 &agrave; 13h00.</li>
                <li><strong>Dimanche et jours fériés :</strong> Fermeture hebdomadaire.</li>
            </ul>
        </div>

        <p class="about-card-text">
            <strong>Règles de prêt :</strong> Jusqu'à 3 ouvrages simultanés pour une période maximale de 
            14 jours calendrier, renouvelable une fois si le document n'est pas réservé.
        </p>
    </article>

</section>

<!-- ========================================================================= -->
<!-- SECTION CADRE ACADEMIQUE DU MINI-PROJET                                   -->
<!-- ========================================================================= -->
<section class="academic-context-card">
    <div class="academic-header">
        <h2 class="academic-title">Fiche descriptive du Travail Pratique</h2>
        <span class="badge badge-primary">Semestre 3 - Année 2026-2027</span>
    </div>

    <div class="academic-body">
        <div class="table-responsive">
            <table class="detail-table">
                <tbody>
                    <tr>
                        <th scope="row">Établissement</th>
                        <td>IPNET Institute of Technology (Lomé - Togo)</td>
                    </tr>
                    <tr>
                        <th scope="row">Unité d'Enseignement (UE)</th>
                        <td>IT 231 - Développement Web I</td>
                    </tr>
                    <tr>
                        <th scope="row">Intitulé du projet</th>
                        <td>Catalogue dynamique « Médiathèque IPNET » (TP 1)</td>
                    </tr>
                    <tr>
                        <th scope="row">Chargé du cours</th>
                        <td>M. EDOU Dodji</td>
                    </tr>
                    <tr>
                        <th scope="row">Étudiant réalisateur</th>
                        <td>DJELOU Komi Noé</td>
                    </tr>
                    <tr>
                        <th scope="row">Filière / Niveau</th>
                        <td>Licence Informatique de Gestion (IG) - Semestre 3</td>
                    </tr>
                    <tr>
                        <th scope="row">Technologies employées</th>
                        <td>PHP 8.2+ (procédural pur), HTML5 sémantique, CSS3 moderne sans framework externe</td>
                    </tr>
                    <tr>
                        <th scope="row">Objectifs pédagogiques validés</th>
                        <td>
                            Manipulation des tableaux associatifs multidimensionnels, structure modulaire avec 
                            <code>require_once</code>, passage et contrôle des paramètres <code>$_GET</code>, 
                            sécurisation des sorties avec <code>htmlspecialchars()</code>, respect strict du barème.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php
// 4. Inclusion du pied de page HTML commun
require_once __DIR__ . '/includes/footer.php';
?>
