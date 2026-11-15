# Projet : Catalogue dynamique « Médiathèque IPNET »

**Année Académique :** 2026 - 2027  
**Niveau :** Licence 2 (Semestre 3)  
**Filière :** Informatique de Gestion (IG)  
**Unité d'Enseignement :** IT 231 – Développement Web I  
**Chargé du Cours :** M. EDOU Dodji  
**Étudiant :** DJELOU Komi Noé  

---
Lien du dépot Github : https://github.com/noedjelou26-ctrl/Biblioth-que

## 1. Description du projet

Le projet **Médiathèque IPNET** est une application web dynamique développée en **PHP procédural** pur, **HTML5** sémantique et **CSS3**. Il constitue le premier travail pratique (TP 1) de l'UE **IT 231**.

Ce mini-projet a pour objectif de concevoir un catalogue d'ouvrages consultables par les étudiants de l'institut. Conformément au cahier des charges, **aucune base de données relationnelle (MySQL, etc.) n'est utilisée** : l'ensemble des données est centralisé et géré au sein d'un tableau associatif PHP multidimensionnel dans le fichier `data/livres.php`.

L'application démontre la maîtrise des concepts fondamentaux du développement web côté serveur :
- Manipulation des variables, conditions, boucles et tableaux PHP.
- Modularisation du code avec `require_once`.
- Écriture et typage de fonctions réutilisables.
- Transmission et sécurisation des données via les paramètres d'URL (`$_GET`).
- Protection contre les failles d'injection XSS via `htmlspecialchars()`.
- Conception d'une interface utilisateur institutionnelle, sobre et responsive.

---

## 2. Structure et arborescence du projet

L'arborescence imposée par le sujet est scrupuleusement respectée :

```text
mediatheque-mp1/
├── index.php                 # Page d'accueil : bienvenue, statistiques dynamiques, aperçu
├── catalogue.php             # Page catalogue : liste des livres, filtrage par catégorie
├── detail.php                # Page détail : fiche complète d'un livre (paramètre ?id=...)
├── apropos.php               # Page À propos : présentation de la médiathèque, date du jour
├── includes/
│   ├── header.php            # En-tête HTML commun et barre de navigation
│   ├── footer.php            # Pied de page commun avec mentions académiques
│   └── fonctions.php         # Fonctions PHP obligatoires et utilitaires
├── data/
│   └── livres.php            # Données sources : tableau associatif de 10 ouvrages
├── css/
│   └── style.css             # Feuille de style CSS sobre, institutionnelle et responsive
├── JOURNAL_DE_BORD.md        # Livrable 4 : Journal de bord de réalisation
└── README.md                 # Livrable 2 : Documentation complète du projet
```

---

## 3. Prérequis et procédure de lancement

### Prérequis techniques
- **PHP 8.0 ou version supérieure** (testé et validé sous PHP 8.2+).
- Un serveur web local au choix :
  - **WampServer** (recommandé sous Windows, dossier `c:\wamp64\www\`),
  - **XAMPP** (dossier `htdocs/`),
  - Ou directement le **serveur web interne de PHP** en ligne de commande.
- Un navigateur web moderne (Google Chrome, Mozilla Firefox, Microsoft Edge).

---

### Procédure d'installation et d'exécution

#### Option A : Exécution via WampServer (environnement local)
1. Démarrez WampServer et assurez-vous que l'icône dans la zone de notification est verte.
2. Copiez le dossier du TP dans le répertoire `www` de WampServer :
   ```text
   C:\wamp64\www\DJELOU_Komi Noé_IG_2026-2027_TP_1_IT231\mediatheque-mp1\
   ```
3. Ouvrez votre navigateur et accédez à l'URL suivante :
   ```text
   http://localhost/DJELOU_Komi%20No%C3%A9_IG_2026-2027_TP_1_IT231/mediatheque-mp1/
   ```

#### Option B : Exécution via le serveur interne PHP (Ligne de commande)
1. Ouvrez un terminal (PowerShell ou Invite de commandes) dans le dossier du projet :
   ```bash
   cd "c:\wamp64\www\DJELOU_Komi Noé_IG_2026-2027_TP_1_IT231\mediatheque-mp1"
   ```
2. Lancez le serveur local intégré de PHP sur le port 8000 :
   ```bash
   php -S localhost:8000
   ```
   *(Ou avec le chemin complet vers l'exécutable PHP de Wamp : `& "C:\wamp64\bin\php\php8.2.29\php.exe" -S localhost:8000`)*
3. Ouvrez votre navigateur et rendez-vous sur :
   ```text
   http://localhost:8000/
   ```

---

## 4. Fonctionnalités réalisées

| Fonctionnalité | Page concernée | Description détaillée |
|---|---|---|
| **Accueil & Statistiques** | `index.php` | Bannière de bienvenue, lien d'accès au catalogue, calcul dynamique en PHP du nombre total de livres disponibles au prêt via `compterLivresDisponibles()`, affichage du nombre de disciplines et aperçu des ouvrages. |
| **Catalogue & Vignettes** | `catalogue.php` | Affichage sous forme de cartes structurées de l'ensemble des livres. Présentation pour chaque livre du titre, auteur, année, catégorie, prix formaté en FCFA et statut de disponibilité. Indicateur dynamique du nombre de livres affichés. |
| **Filtrage par catégorie** | `catalogue.php` | Liens de filtrage direct par paramètre URL (`?categorie=Informatique`, etc.). Vérification de la validité du paramètre avec affichage d'un message d'erreur si la catégorie demandée n'existe pas. Bouton de réinitialisation pour revenir à l'affichage complet. |
| **Fiche détaillée** | `detail.php` | Affichage des informations complètes d'un ouvrage sélectionné via `detail.php?id=3`. Validation rigoureuse de l'identifiant (présence, type entier positif, existence dans le catalogue). Message d'erreur clair si l'ID est absent, invalide ou inexistant. |
| **Page « À propos »** | `apropos.php` | Présentation institutionnelle de la médiathèque IPNET, horaires d'ouverture, filières concernées et utilisation d'une fonction PHP pour générer la date du jour en français de façon dynamique. |
| **Sécurité des affichages** | Global | Échappement systématique de toutes les données dynamiques avec `htmlspecialchars($chaine, ENT_QUOTES, 'UTF-8')` pour parer tout risque d'attaque XSS. |
| **Design et ergonomie** | `css/style.css` | Design professionnel, institutionnel et sobre (palette marine/ardoise, bordures fines, typographie Segoe UI, zéro émoji, pas de dégradés criards). |

---

## 5. Fonctions obligatoires (`includes/fonctions.php`)

Conformément à la section 4 du sujet de TP, les fonctions suivantes ont été implémentées avec un typage strict PHP 8+ et documentées :

### 1. `afficherLivre(array $livre): string`
- **Rôle :** Prend en paramètre le tableau associatif d'un livre et retourne une chaîne HTML représentant sa carte (vignette).
- **Éléments inclus :** Titre, auteur, année d'édition, badge de catégorie, badge de statut (vert "Disponible" ou rouge "Indisponible"), valeur estimée et bouton vers la page de détail.

### 2. `filtrerParCategorie(array $livres, string $categorie): array`
- **Rôle :** Parcourt le tableau complet des livres et extrait uniquement ceux correspondant à la catégorie spécifiée.
- **Particularité :** La comparaison est insensible à la casse (`mb_strtolower()`) pour garantir la robustesse du filtrage même en cas de saisie manuelle dans l'URL.

### 3. `trouverLivreParId(array $livres, int $id): ?array`
- **Rôle :** Recherche séquentiellement un ouvrage à partir de son identifiant unique.
- **Retour :** Retourne le tableau associatif du livre s'il est trouvé, ou `null` si l'identifiant ne correspond à aucun livre.

### 4. `compterLivresDisponibles(array $livres): int`
- **Rôle :** Itère sur le tableau `$livres` et compte le nombre d'entrées dont la clé `disponible` vaut strictement `true`.

---

## 6. Structure des données (`data/livres.php`)

Le catalogue contient **10 livres** (le sujet en demandant au moins 8) couvrant diverses disciplines (Informatique, Roman, Histoire, Sciences, Économie).

Chaque livre est un tableau associatif possédant scrupuleusement les clés imposées :
```php
[
    'id'          => 1,
    'titre'       => "Introduction aux Algorithmes et Structures de Données",
    'auteur'      => "Thomas Cormen",
    'annee'       => 2020,
    'categorie'   => "Informatique",
    'prix'        => 28500,
    'disponible'  => true,
    'description' => "Ouvrage de référence exhaustif couvrant les algorithmes fondamentaux..."
]
```

---

