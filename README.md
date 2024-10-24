
Pour installer et configurer le projet, suivez les étapes ci-dessous :

1. Clonez le dépôt :
https://github.com/ons33/Symfony3A.git
2. Accédez au répertoire du projet :
   cd Symfony3A36
3. Installez les dépendances avec Composer :
composer install
4. Créez la base de données :
php bin/console doctrine:database:create
5. Exécutez les migrations :
   php bin/console doctrine:migrations:migrate
6. Démarrez le serveur Symfony :
   symfony serve
