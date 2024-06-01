Etape d'installation

1- cloner le projet
git clone https://github.com/DariusStone7/YOUPI-TEST-LARAVEL-API.git

2- Creer un fichier .env a la racine du projet et coller le contenu du fichier .env.exemple dans ce ficiher puis modifier les parametre de connexion a la base de donnéé

3- executer les commandes suivantes dans l'ordre a la racine du projet:
    composer install
    php artisan key:generate
    php artisan migrate

4- Lancer le projet
    php artisan serve
