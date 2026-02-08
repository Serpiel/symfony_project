# 🎸 SERPIEL SHOWDOWN

## 1. Description du projet
Ce projet est une application web complète développée avec le framework **Symfony 6**. Il s'agit d'une plateforme de gestion d'événements spécialisée dans les concerts de Rock et de Metal.

L'objectif est de permettre aux utilisateurs de consulter les événements à venir, et aux administrateurs de gérer l'ensemble des ressources (événements, catégories, utilisateurs) via un Back-Office sécurisé. Le design a été personnalisé pour offrir une ambiance "Dark/Metal".

Ce projet a été réalisé dans un cadre académique pour valider les compétences de développement web moderne : architecture MVC, ORM Doctrine, Sécurité et templating Twig.

---

## 2. Choix techniques
L'application respecte l'architecture MVC et les standards Symfony :

* **Backend :** Symfony 6.4 (PHP 8.1+).
* **Base de données :** MySQL avec **Doctrine ORM** pour le mapping des entités et les relations (OneToMany/ManyToOne).
* **Frontend :** * Moteur de template **Twig** pour le rendu dynamique.
    * **Bootstrap 5** pour la structure responsive (mobile-first).
    * **Webpack Encore** pour la compilation des assets (SCSS/JS).
    * CSS personnalisé pour le thème "Metal" (Dark mode, polices Oswald, accents rouges).
* **Sécurité :**
    * Système d'authentification complet (Login/Register).
    * Hashage des mots de passe (Bcrypt/Argon2).
    * Hiérarchie des rôles (`ROLE_USER`, `ROLE_ADMIN`).
    * Protection des routes via `access_control` et attributs `#[IsGranted]`.
* **Qualité de code :**
    * Utilisation de contrôleurs spécialisés (Admin, Event, Home, Security).
    * Injection de dépendances.
    * Fixtures pour les données de test.

---

## 3. Instructions d'installation
Voici les étapes pour lancer le projet localement :

**Prérequis :**
* PHP 8.1 ou supérieur
* Composer
* Symfony CLI
* Node.js & NPM
* Serveur MySQL

**Installation pas à pas :**

1.  **Cloner le dépôt :**
    ```bash
    git clone [https://https://github.com/Serpiel/symfony_project.git](https://github.com/Serpiel/symfony_project.git)
    cd symfony_project
    ```

2.  **Installer les dépendances PHP :**
    ```bash
    composer install
    ```

3.  **Installer les dépendances Front-end et compiler :**
    ```bash
    npm install
    npm run build
    ```

4.  **Configuration de la base de données :**
    * Dupliquer le fichier `.env` en `.env.local`.
    * Modifier la ligne `DATABASE_URL` avec vos identifiants :
    ```env
    DATABASE_URL="mysql://root:root@127.0.0.1:3306/serpiel_db?serverVersion=8.0.32&charset=utf8mb4"
    ```

5.  **Création de la base et des tables :**
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

6.  **Chargement des données de test (Fixtures) :**
    ```bash
    php bin/console doctrine:fixtures:load
    ```
    *(Répondre 'yes' pour vider la base)*

7.  **Lancer le serveur :**
    ```bash
    symfony server:start
    ```

---

## 4. Comptes de test
Pour tester l'application, les comptes suivants ont été générés par les Fixtures :

| Rôle | Email | Mot de passe | Accès |
| :--- | :--- | :--- | :--- |
| **Administrateur** | `admin@event.com` | `password` | Accès complet + Back-Office (`/admin`) |
| **Utilisateur** | `user@event.com` | `password` | Accès Front-Office + Profil |

---

## 5. Difficultés rencontrées
Durant le développement, plusieurs défis ont été relevés :

1.  **Évolution de Symfony (Attributs PHP 8) :** L'adaptation aux nouvelles syntaxes de Symfony 6/7, changement de syntaxe
2.  **Configuration Webpack Encore :** La mise en place correcte du pipeline d'assets pour intégrer Bootstrap et le CSS personnalisé a nécessité une attention particulière sur les imports dans `app.js`.
3.  **Sécurité & Rôles :** La gestion fine des droits (empêcher un utilisateur lambda d'accéder au dashboard admin) a demandé une configuration précise du fichier `security.yaml` et des contrôleurs.

---

## 6. Pistes d'amélioration
Pour aller plus loin, les fonctionnalités suivantes pourraient être ajoutées :

* **Upload d'images :** Permettre d'uploader une affiche réelle pour chaque concert.
* **Système de billetterie :** Intégration de Stripe pour réserver des places.
* **Filtres de recherche :** Ajouter une barre de recherche pour filtrer les concerts par date ou catégorie.
* **Emails :** Envoi d'un email de confirmation lors de l'inscription (Mailer).

---
*Projet réalisé dans le cadre des études en Bachelor à H3 Hitema et non à but commercial.*


<h1>SCREENSHOTS</h1>


## Home page (user view)
<img width="2497" height="1366" alt="image" src="https://github.com/user-attachments/assets/3f73216c-2cb9-45d9-8186-5ed590aad032" />


## Login page
<img width="2512" height="373" alt="image" src="https://github.com/user-attachments/assets/705f98d2-8ed3-4c75-b1a9-ef74da558e5a" />


## Admin interface
<img width="2511" height="370" alt="image" src="https://github.com/user-attachments/assets/444e357e-52f8-4ed4-a156-36cd6c4482c1" />

## Manage events
<img width="2515" height="619" alt="image" src="https://github.com/user-attachments/assets/05dc1164-0ab4-4e28-9421-7530c18e6f6b" />





