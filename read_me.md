Pour démarrer le projet il faut suivre cette démarche:


1)- Installer les dépondences: 
        composer i && yarn install

2)- Configurer et Installer la base des données:

        Dans le fichier .env modifier cette ligne avec tes paramètres, modifier le user et le mot de passe de votre base des données: 
                DATABASE_URL=mysql://user:password@127.0.0.1:3306/vege_engine?serverVersion=5.7
        
        php bin/console doc:database:create
        php bin/console make:migration
        php bin/console doc:mig:mig -n

3)- Lancer le server: symfony server:start -d

Et voilà !