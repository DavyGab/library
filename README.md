
**

## Library

**

***Installation***

**Cloner le projet git**
Installer les dependances composer
    *composer install*

**Créer la base de données :**
    *php bin/console doctrine:database:create
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate*

Créer un dossier uploads dans le dossier "public".


 C'est tout.



***Pour tester l'API :***
URL/api/books?before_date=2017-11-19&after_date=2012-11-19&nationality=fr