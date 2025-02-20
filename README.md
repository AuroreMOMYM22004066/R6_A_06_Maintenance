<div align=center>
  
# Projet R6_A_06_Maintenance

</div>
<div align="center">
  <br>
  <a href="https://www.php.net/manual/en/"><kbd> <br> PHP doc <br> </kbd></a>&ensp;&ensp;
  <a href="https://symfony.com/doc/current/index.html"><kbd> <br> Symfony doc <br> </kbd></a>&ensp;&ensp;
  <a href="https://getcomposer.org/doc/"><kbd> <br> Composer doc <br> </kbd></a>&ensp;&ensp;
</div><br>

## Description
Reprise et maintenance d'un projet existant en PHP. <br>
- Récupérer le projet original :
```bash
git clone https://github.com/AuroreMOMYM22004066/Ugsel_Project
```
<br>

- Documentation du projet original :<br>
<a href="https://github.com/AuroreMOMYM22004066/R6_A_06_Maintenance/blob/master/UgselWeb-Documentation.pdf">guide utilisateur</a> <br>
<a href="https://github.com/AuroreMOMYM22004066/R6_A_06_Maintenance/blob/master/UgselWeb-Documentation-Admin.pdf">guide admin</a>

## Branche Github 

```md
master (Branch de dev)
      ↓     
Test (Branche de test)
      ↓
prod (Branch de production)
      ↓
```

Les autre branche dependande de master pour le dev comme database ou styles qui on était crée a des fin de dev

## Technologies Utilisées

* **php:** `8.2.12`
* **symfony:** `7.2.2`
* **mysql:** `8.0.41`
* **composer:** `2.7.9`

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
   - D'abord crée le .env
   -  Modifier le fichier .env avec vos informations de base de données voici la docs pour ajoute se qu il faut au .env
   -  Voici la template sur se repo du .env et .env.test https://github.com/symfony/demo/blob/main/ et la docs de la configuration https://symfony.com/doc/current/configuration.html_
   Pour ce qui est des test c est pareil faut crée le .env.test et mettre vottre bd


4. **Créer et mettre à jour la base de données**
    ```bash
    symfony console doctrine:database:create
    symfony console doctrine:migrations:migrate
    symfony console doctrine:fixtures:load
    ```

5. **Démarrer le serveur de développement**
    ```bash
    symfony serve
    ```

## Utilisation

- **Générer une nouvelle migration**
    ```bash
    symfony console make:migration
    ```

- **Exécuter les migrations vers la base de données**
    ```bash
    symfony console doctrine:migrations:migrate
    ```
