## Nom

`CHANOT Flora`

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
- PHP >=8.2
- Composer
- Slim 4.x
- Twig 3.8
- Eloquent 11.1.x

## Structure du projet
- **[config](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/config)** : emplacement des fichiers de configuration
- **[controller](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/controller)** : controller de l'application
- **[db](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/db)** : classe de connexion à la base de données
- **[public/img](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/img)** : images de l'application
- **[public/js](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/js)** : fichier de code JavaScript
- **[model](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/model)** : model de l'application
- **[public](https://github.com/Aquilis13/RACOIN_maintenance_applicative/tree/main/public)** : Fichier d'index + font/image/js/css
- **[sql](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/sql)** : Fichier SQL pour la création de la base de données
- **[scss](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/scss)** : feuilles de style Sass
- **[public/stylesheets](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/stylesheets)** : feuilles de style CSS
- **[template](https://github.com/Aquilis13/racoin--maintenance_applicative-/tree/main/template)** : vue twig

## Améliorations éventuelles 

<table cellpadding="0">
  <tr>
    <th scope="col">Tâche</th>
    <th scope="col">Temps de la modification</th>
    <th scope="col">Impact de la modification</th>
    <th scope="col">Check</th>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Ajout d'un model de config.ini
    </td>
    <td valign="top">
      1/10
    </td>
    <td valign="top">
      3/10
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
      5/10
    </td>
    <td valign="top">
      9/10
    </td>
    <td valign="top">
      ✔
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Regroupement des fichiers SQL qui sont à la racine du projet
    </td>
    <td valign="top">
      1/10
    </td>
    <td valign="top">
      2/10
    </td>
    <td valign="top">
        ✔
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Suppression du cache Sass dans les commits
    </td>
    <td valign="top">
      1/10
    </td>
    <td valign="top">
      3/10
    </td>
    <td valign="top">
      ✔
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Déplacement des pages d'index php à la racine dans un répertoire `public`
    </td>
    <td valign="top">
      4/10
    </td>
    <td valign="top">
      10/10
    </td>
    <td valign="top">
      ✔
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Mise en place de tests unitaires
    </td>
    <td valign="top">
      7/10
    </td>
    <td valign="top">
      7/10
    </td>
    <td valign="top">
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Migrer la version de SLIM (v2 -> v4)
    </td>
    <td valign="top">
      3/10
    </td>
    <td valign="top">
      9/10
    </td>
    <td valign="top">
     ✔
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Migrer la version de Twig (v1.* -> v3.8.0)
    </td>
    <td valign="top">
      3/10
    </td>
    <td valign="top">
      8/10
    </td>
    <td valign="top">
      ✔
    </td>
  </tr>

  <tr style="padding: 0">
    <td valign="top">
        Migrer la version de Eloquent (illuminate database) (v4.2.9/10 -> v11.1.1)
    </td>
    <td valign="top">
      3/10
    </td>
    <td valign="top">
      9/10
    </td>
    <td valign="top">
      ✔
    </td>
  </tr>
</table>