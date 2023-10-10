# Projet Nginx avec Authentification de Base

Ce projet configure un serveur Nginx pour servir une page de bienvenue sur HTTPS, rediriger toutes les requêtes HTTP vers HTTPS, et fournir une authentification de base pour accéder aux différents niveaux.

## Structure du Répertoire

```plaintext
|-- Dockerfile
|-- nginx.conf
|-- html/
|   |-- index.html
|-- certs/
|   |-- server.crt
|   |-- server.key
|-- auth/
    |-- level0.htpasswd
    |-- level1.htpasswd
    # ... et ainsi de suite pour chaque niveau
    ```

Instructions de Déploiement
Construire l'Image Docker :

bash
Copy code
docker build -t my-nginx-image .
Lancer un Conteneur :

bash
Copy code
docker run -d -p 80:80 -p 443:443 my-nginx-image
Accéder au Serveur Web :

Ouvrez votre navigateur et accédez à https://localhost pour voir la page de bienvenue.
Accédez à https://level0.wargame.esd, https://level1.wargame.esd, etc. pour accéder aux différents niveaux avec authentification de base.
Configuration
La configuration de Nginx se trouve dans le fichier nginx.conf. Les certificats SSL auto-signés se trouvent dans le répertoire certs, et les fichiers d'authentification de base se trouvent dans le répertoire auth.

Sécurité
Notez que ce projet utilise des certificats SSL auto-signés et une authentification de base, qui ne sont pas considérés comme sécurisés pour des environnements de production. Veillez à utiliser des certificats SSL valides et d'autres mesures de sécurité appropriées pour des environnements de production.




Générer des fichiers .htpasswd :
bash
```
sudo apt-get update
sudo apt-get install apache2-utils -y

htpasswd -c ./auth/level1.htpasswd user1
```
# Répétez cette étape pour chaque niveau avec des utilisateurs et des mots de passe différents
Lorsque vous exécutez la commande ci-dessus, vous serez invité à entrer et à confirmer un mot de passe pour user1. Répétez cette étape pour chaque niveau, en changeant le nom d'utilisateur et le nom du fichier .htpasswd en conséquence.