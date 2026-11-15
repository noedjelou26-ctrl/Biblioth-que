# Journal de Bord – Travaux Pratiques 1 (IT 231)

**Nom et Prénoms :** DJELOU Komi Noé  
**Filière :** Licence Informatique de Gestion (IG) – Semestre 3  
**Année Académique :** 2026 - 2027  
**Établissement :** IPNET Institute of Technology  
**UE :** IT 231 – Développement Web I  
**Chargé du Cours :** M. EDOU Dodji  
**Projet :** Catalogue dynamique « Médiathèque IPNET »  

---

## 1. Difficultés rencontrées

Au cours de la réalisation de ce premier travail pratique en PHP procédural, plusieurs difficultés techniques et conceptuelles se sont présentées :

1. **Manipulation et parcours des tableaux multidimensionnels en PHP pur :**  
   N'ayant pas encore recours à un Système de Gestion de Bases de Données (SGBD) tel que MySQL, il a fallu structurer rigoureusement les données en mémoire via un tableau associatif de tableaux associatifs. La manipulation des index (`id`, `categorie`, `disponible`) et les opérations de recherche séquentielle ont nécessité une grande attention pour éviter les erreurs d'index indéfini (*Undefined array key*).

2. **Validation robuste et sécurisation des paramètres URL (`$_GET`) :**  
   La transmission de variables via l'URL pour le filtrage par catégorie (`?categorie=...`) et pour l'accès aux fiches détaillées (`?id=...`) ouvre la porte à des comportements imprévus : paramètres absents, valeurs non numériques, catégories inexistantes ou tentatives d'injections de balises HTML/JavaScript (XSS).

3. **Harmonisation de la casse lors du filtrage :**  
   Si un utilisateur tapait manuellement `catalogue.php?categorie=roman` en minuscules alors que le tableau contenait `'Roman'`, une simple comparaison stricte avec `===` échouait, retournant une liste vide.

4. **Modularisation et portée des variables :**  
   Lors de l'inclusion des fichiers de gabarit (`header.php` et `footer.php`), il a fallu s'assurer que les variables nécessaires (telles que `$titrePage` ou `$pageActuelle`) étaient correctement définies avant l'appel à `require_once`.

---

## 2. Solutions apportées

Pour surmonter ces difficultés de manière propre, pédagogique et conforme aux standards du développement web :

1. **Typage strict et fonctions dédiées dans `includes/fonctions.php` :**  
   J'ai créé des fonctions modulaires avec typage PHP 8 (`array`, `string`, `int`, `?array`). La fonction `trouverLivreParId()` effectue un parcours avec arrêt anticipé (`return $livre;`) dès que l'identifiant correspond, optimisant ainsi le traitement.

2. **Validation stricte avec `filter_var()` et échappement systématique :**  
   - Pour la page `detail.php`, j'ai utilisé la fonction native `filter_var($_GET['id'], FILTER_VALIDATE_INT)` pour vérifier formellement que la valeur transmise est un entier positif non nul.  
   - Pour prévenir toute vulnérabilité XSS, **toutes les sorties textuelles** sont protégées par `htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8')`.

3. **Normalisation des chaînes avec `mb_strtolower()` et `trim()` :**  
   Dans la fonction `filtrerParCategorie()`, les chaînes sont nettoyées de leurs espaces superflus et converties en minuscules avant comparaison. De plus, une vérification d'existence préalable compare la saisie aux catégories officielles, affichant un message d'alerte explicite si la catégorie n'existe pas.

4. **Organisation en architecture en couches :**  
   Séparation claire entre les données (`data/livres.php`), la logique métier (`includes/fonctions.php`), la mise en page commune (`includes/header.php`, `footer.php`) et la présentation finale (`index.php`, `catalogue.php`, `detail.php`, `apropos.php`).

---

## 3. Ce qui a été appris

Ce mini-projet a été particulièrement formateur sur les plans technique et méthodologique :

- **Compréhension du cycle requête/réponse HTTP :** La façon dont un serveur web local (WampServer / Apache) interprète un script PHP, exécute le code côté serveur et renvoie uniquement du code HTML au navigateur client.
- **Différence fondamentale entre `include` et `require_once` :** Compréhension de l'importance de `require_once` pour les fichiers de données ou de fonctions critiques, évitant les redéfinitions de fonctions et bloquant l'exécution en cas de fichier manquant.
- **Rigueur algorithmique sans framework :** Concevoir une application web complète en PHP natif sans dépendance externe permet d'assimiler les fondations indispensables avant d'aborder plus tard des frameworks complexes ou des ORM.
- **Sensibilité à l'expérience utilisateur et au design institutionnel :** Importance d'une charte graphique sobre, d'une typographie lisible et de messages d'erreur clairs qui guident l'utilisateur au lieu de bloquer la navigation.
