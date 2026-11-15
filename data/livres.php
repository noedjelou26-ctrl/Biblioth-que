<?php
/**
 * ============================================================================
 * Fichier : data/livres.php
 * Projet  : Catalogue dynamique « Médiathèque IPNET »
 * UE      : IT 231 - Développement Web I
 * Niveau  : Licence 2 (GL, WIM, DWM, IG, IA)
 * Auteur  : DJELOU Komi Noé (Licence IG)
 * Année   : 2026 - 2027
 * ============================================================================
 * Description :
 * Ce fichier contient les données statiques de la médiathèque.
 * Conformément aux consignes du sujet, aucune base de données relationnelle
 * (MySQL, PostgreSQL, etc.) n'est utilisée à ce stade.
 *
 * Les livres sont modélisés sous la forme d'un tableau PHP multidimensionnel
 * (tableau associatif contenant des tableaux associatifs).
 * Chaque livre possède obligatoirement les clés suivantes :
 * - id          : (int) Identifiant unique du livre
 * - titre       : (string) Titre complet de l'ouvrage
 * - auteur      : (string) Nom et prénom de l'auteur
 * - annee       : (int) Année d'édition ou de parution
 * - categorie   : (string) Discipline ou genre littéraire
 * - prix        : (int|float) Valeur estimée de l'ouvrage (en FCFA)
 * - disponible  : (bool) Disponibilité actuelle pour le prêt (true / false)
 * - description : (string) Résumé court présenté sur la fiche détaillée
 * ============================================================================
 */

// Définition du tableau principal contenant le catalogue des livres
$livres = [
    [
        'id'          => 1,
        'titre'       => "Introduction aux Algorithmes et Structures de Données",
        'auteur'      => "Thomas Cormen",
        'annee'       => 2020,
        'categorie'   => "Informatique",
        'prix'        => 28500,
        'disponible'  => true,
        'description' => "Ouvrage de référence exhaustif couvrant les algorithmes fondamentaux, la complexité temporelle et les structures de données avancées."
    ],
    [
        'id'          => 2,
        'titre'       => "PHP 8 et MySQL : Maîtrisez le Développement Web Dynamique",
        'auteur'      => "Olivier Heurtel",
        'annee'       => 2022,
        'categorie'   => "Informatique",
        'prix'        => 19500,
        'disponible'  => true,
        'description' => "Manuel complet pour apprendre la programmation serveur avec PHP 8, la gestion des sessions et la manipulation sécurisée des données."
    ],
    [
        'id'          => 3,
        'titre'       => "Clean Code : Guide des Pratiques Agiles du Logiciel",
        'auteur'      => "Robert C. Martin",
        'annee'       => 2019,
        'categorie'   => "Informatique",
        'prix'        => 24000,
        'disponible'  => false,
        'description' => "Principes fondamentaux, conventions de nommage et méthodes pour concevoir du code clair, maintenable et exempt de dette technique."
    ],
    [
        'id'          => 4,
        'titre'       => "L'Étranger",
        'auteur'      => "Albert Camus",
        'annee'       => 1942,
        'categorie'   => "Roman",
        'prix'        => 6500,
        'disponible'  => true,
        'description' => "Récit emblématique du courant existentialiste décrivant la trajectoire de Meursault et son sentiment d'étrangeté face au monde."
    ],
    [
        'id'          => 5,
        'titre'       => "Une si longue lettre",
        'auteur'      => "Mariama Bâ",
        'annee'       => 1979,
        'categorie'   => "Roman",
        'prix'        => 5000,
        'disponible'  => true,
        'description' => "Roman épistolaire majeur de la littérature africaine, exposant les bouleversements de la société sénégalaise et la condition féminine."
    ],
    [
        'id'          => 6,
        'titre'       => "Les Soleils des Indépendances",
        'auteur'      => "Ahmadou Kourouma",
        'annee'       => 1968,
        'categorie'   => "Roman",
        'prix'        => 7500,
        'disponible'  => false,
        'description' => "Oeuvre marquante écrite dans un style original, dressant le bilan amer des désillusions politiques au lendemain des indépendances."
    ],
    [
        'id'          => 7,
        'titre'       => "Histoire Générale de l'Afrique : L'Afrique sous domination coloniale",
        'auteur'      => "Albert Adu Boahen (UNESCO)",
        'annee'       => 2011,
        'categorie'   => "Histoire",
        'prix'        => 18000,
        'disponible'  => true,
        'description' => "Analyse historique approfondie commandée par l'UNESCO sur les résistances et les transformations des sociétés africaines au XXe siècle."
    ],
    [
        'id'          => 8,
        'titre'       => "Physique Moderne : Théorie et Applications",
        'auteur'      => "Paul A. Tipler et Ralph A. Llewellyn",
        'annee'       => 2021,
        'categorie'   => "Sciences",
        'prix'        => 32000,
        'disponible'  => false,
        'description' => "Manuel universitaire d'initiation à la théorie de la relativité restreinte, à la mécanique quantique et à la physique de l'atome."
    ],
    [
        'id'          => 9,
        'titre'       => "Économie du Développement : Théories et Politiques",
        'auteur'      => "Michael Todaro et Stephen Smith",
        'annee'       => 2020,
        'categorie'   => "Économie",
        'prix'        => 22500,
        'disponible'  => true,
        'description' => "Étude comparative des modèles de croissance économique, des dynamiques démographiques et des politiques monétaires des pays en développement."
    ],
    [
        'id'          => 10,
        'titre'       => "Réseaux Informatiques : Notions Fondamentales",
        'auteur'      => "Andrew Tanenbaum et David Wetherall",
        'annee'       => 2021,
        'categorie'   => "Informatique",
        'prix'        => 29000,
        'disponible'  => true,
        'description' => "Manuel complet analysant le fonctionnement des couches réseau, des protocoles TCP/IP, des liaisons sans fil et de la cybersécurité."
    ]
];
