# Electro
E-commerce Website With Symfony 4

<h2>Commandes d'installation :</h2>


On clone le dépot les Amis !

git clone https://github.com/pintra/Electro.git


<h4>On se déplace dans le dossier</h4>

 cd Electro

<h4>Installez des dépendances:</h4>

    composer install

<h4>Créer une base de données et configurer les paramètres dans .env</h4>

    php bin/console doctrine:database:create 

    php bin/console doctrine:migrations:migrate

<h4>Installation des faux donnés</h4>

    php bin/console doctrine:fixture:load

<h4>Accéder aux dashboard admin :</h4>

email: dhia@symfony.com<br>
mot de passe: 123698745
