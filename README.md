# Racoin

## À propos du projet
Racoin est une application Web en PHP dédiée aux annonces. Il permet au particulier de vendre ou d'acheter des objets ou autres, il permet également de publier et de consulter des annonces diverses et variées.

## Lancement du projet 
### Avec docker 
1. Copier le fichier .env.exemple sous le nom .env

2. Créer et configurer le fichier config.ini dans le dossier config
``` bash
cp config/exemple-config.ini config/config.ini
```

3. Lancer les commandes suivantes :
``` bash
docker compose run --rm php composer install

docker compose up
```
### Sans docker 
1. Créer et configurer le fichier config.ini dans le dossier config
``` bash
cp config/exemple-config.ini config/config.ini
```

2. Lancer la commande suivante :
``` bash
composer install
```

## Technologies utilisées
- PHP >=5.4.0 & <= 7.4
- Composer
- Slim 2.x
- Twig 1.0
- Eloquent 4.2.9

## Structure du projet
- **[config](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/config)** : emplacement des fichiers de configuration
- **[controller](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/controller)** : controller de l'application
- **[db](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/db)** : classe de connexion à la base de données
- **[img](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/img)** : images de l'application
- **[js](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/js)** : fichier de code JavaScript
- **[model](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/model)** : model de l'application
- **[scss](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/scss)** : feuilles de style Sass
- **[stylesheets](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/stylesheets)** : feuilles de style CSS
- **[template](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/template)** : vue twig

## Améliorations éventuelles 

<table cellpadding="0">
  <tr>
    <th scope="col">Tâche</th>
    <th scope="col">Check</th>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Ajout d'un model de config.ini
    </td>
    <td valign="top">
        ✔
    </td>
  </tr>
  
  <tr style="padding: 0">
    <td valign="top">
        Nettoyage du code en commentaire
    </td>
    <td valign="top">
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Regroupement des fichiers SQL qui sont à la racine du projet
    </td>
    <td valign="top">
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Suppression du cache Sass dans les commits
    </td>
    <td valign="top">
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Mise en place de tests unitaires
    </td>
    <td valign="top">
    </td>
  </tr>
</table>