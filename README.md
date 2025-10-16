# choco-cda
Projet de cours PHP POO site chocoblast

## 1 Récupération du projet :
Lancer les commandes suivantes :
```bash
# 1 Cloner le repository
git clone https://github.com/evaluationWeb/choco-cda.git
# 2 Se déplacer dans le dossier
cd choco-cda
# 3 Lancer un composer install
composer install
```

## 2 Création du fichier d'environnement :
Créer le fichier d'environnement **.env** comme dans l'exemple ci-dessous avec vos propres valeurs :
```env
DATABASE_HOST=################# exemple localhost
DATABASE_NAME=################# nom de la BDD
DATABASE_USERNAME=############# Login de la BDD
DATABASE_PASSWORD=############# Password de la BDD
```

## 3 Créer la base de données avec le script db.sql \
_Adaptez le nom de BDD en fonction des bases existantes sur votre système_

## 4 Démarrer le serveur PHP avec la commande ci-dessous :
```bash
php -S 127.0.0.1:8000 -t public
```

## 5 Lancer le site avec l'url http://127.0.0.1:8000 
