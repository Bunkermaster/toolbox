# Configuration

## Créer la base de données locale
Créer la base de données de votre projet

## Composer
### Installer composer
[Composer](https://getcomposer.org/download/)

### Installer la ToolBox
Composer définit l'autoload de la ToolBox. Lancer la commande suivante dans le terminal:
```
cd repertoire/de/votre/projet/
composer dumpautoload
```

## Configurer la connection base de données
Pour configurer l'accès à la base de donnée, nous utiliserons des constantes d'espace de nom. Elles sont initialisées dans le fichier suivant :
```
toolbox/conf.php
```

Ce fichier contient la déclaration de toutes les constantes de connection PDO comme suit :
``` php
<?php
namespace ToolBox;

const PHP_TOOLBOX_DB_HOST = "localhost";
const PHP_TOOLBOX_DB_PORT = "3306";
const PHP_TOOLBOX_DB_NAME = "toolbox";
const PHP_TOOLBOX_DB_USER = "root";
const PHP_TOOLBOX_DB_PASS = "root";
```
