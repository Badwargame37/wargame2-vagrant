# Utilisez l'image de base nginx
FROM nginx:latest

# Copiez vos fichiers de configuration Nginx, HTML, et les certificats SSL dans l'image
COPY nginx.conf /etc/nginx/nginx.conf
COPY html /usr/share/nginx/html
COPY certs /etc/ssl/certs
COPY auth /etc/nginx/auth

# Exposez les ports 443
EXPOSE  443

# Démarrez Nginx en premier plan (pour que le conteneur ne se termine pas après le démarrage)
CMD ["nginx", "-g", "daemon off;"]
