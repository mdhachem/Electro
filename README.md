# Electro
E-commerce Website With Symfony 4

Commandes d'installation :
On clone le dépot les bros !

git clone https://github.com/pintra/Electro.git
On se déplace dans le dossier

cd Electro
Installez des dépendances:

    composer install

Créer une base de données et configurer les paramètres dans .env

    php bin/console doctrine:database:create

    php bin/console doctrine:migrations:migrate

Installation des faux donnés

    php bin/console doctrine:fixture:load

Accéder aux dashboard admin :

email: dhia@symfony.com
mot de passe: 123698745
