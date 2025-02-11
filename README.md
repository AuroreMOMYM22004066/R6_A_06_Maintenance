# Projet R6_A_06_Maintenance

## Description
Reprise et maintenance d'un projet existant en PHP.

## Technologies Utilisées
- PHP
- Symfony
- MySQL
- Composer

## Prérequis
- PHP ≥ 7.4
- Composer
- MySQL

## Installation

1. **Cloner le dépôt**
    ```bash
    git clone https://github.com/AuroreMOMYM22004066/R6_A_06_Maintenance.git
    cd R6_A_06_Maintenance
    ```

2. **Installer les dépendances**
    ```bash
    composer install
    ```

3. **Configurer la base de données**
    Modifier le fichier .env avec vos informations de base de données


4. **Créer et mettre à jour la base de données**
    ```bash
    symfony console doctrine:database:create
    symfony console make:migrations
    symfony console doctrine:migrations:migrate
    symfony console doctrine:fixtures:load
    ```

5. **Démarrer le serveur de développement**
    ```bash
    symfony server
    ```

## Utilisation

- **Générer une nouvelle migration**
    ```bash
    symfony console make:migration
    ```

- **Exécuter les migrations de base de données**
    ```bash
    symfony console doctrine:migrations:migrate
    ```
