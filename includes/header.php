<?php
/**
 * ============================================================================
 * Fichier : includes/header.php
 * Projet  : Catalogue dynamique « Médiathèque IPNET »
 * UE      : IT 231 - Développement Web I
 * Niveau  : Licence 2 (GL, WIM, DWM, IG, IA)
 * Auteur  : DJELOU Komi Noé (Licence IG)
 * Année   : 2026 - 2027
 * ============================================================================
 * Description :
 * En-tête commun à toutes les pages de l'application web.
 * Contient la déclaration DOCTYPE, les balises META, l'inclusion de la feuille
 * de style CSS, et la barre de navigation institutionnelle.
 * ============================================================================
 */

// Détection de la page courante pour mettre en surbrillance le lien de menu actif
$pageActuelle = basename($_SERVER['PHP_SELF']);

// Titre par défaut si la page n'en a pas défini un avant l'inclusion
if (!isset($titrePage)) {
    $titrePage = "Catalogue dynamique";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8'); ?> | Médiathèque IPNET</title>
    
    <!-- Feuille de styles personnalisée du projet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- ===================================================================== -->
    <!-- EN-TETE PRINCIPAL DU SITE (Barre institutionnelle et navigation)       -->
    <!-- ===================================================================== -->
    <header class="site-header">
        <div class="header-container">
            
            <!-- Logo et identité institutionnelle IPNET -->
            <div class="brand">
                <a href="index.php" class="brand-link">
                    <span class="brand-title">IPNET Institute of Technology</span>
                    <span class="brand-subtitle">Médiathèque Numérique - UE IT 231</span>
                </a>
            </div>

            <!-- Menu de navigation principal -->
            <nav class="main-nav" aria-label="Navigation principale">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php echo ($pageActuelle === 'index.php') ? 'active' : ''; ?>">
                            Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="catalogue.php" class="nav-link <?php echo ($pageActuelle === 'catalogue.php' || $pageActuelle === 'detail.php') ? 'active' : ''; ?>">
                            Catalogue des livres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="apropos.php" class="nav-link <?php echo ($pageActuelle === 'apropos.php') ? 'active' : ''; ?>">
                            À propos
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </header>

    <!-- ===================================================================== -->
    <!-- CONTENU PRINCIPAL DES PAGES (Début de la zone de contenu)             -->
    <!-- ===================================================================== -->
    <main class="site-main">
        <div class="container">
