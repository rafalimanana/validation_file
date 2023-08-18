# file-validator
## Requirements
 * PHP version 8.0 ou supérieure

## Installation

* Avec composer:
```
composer require rafalimanana/file-validator
```

* Avec composer.phar:
```
php composer.phar require rafalimanana/file-validator
```

## Utilisation
### FileValidator
#### Importation de la classe
```php
use Pw\FileValidator\FileValidator
```

#### Instanciation
```php
$fileValidator = new FileValidator([]);
```

#### Exemple d’utilisation
###### Utilisation avec les définitions des extensions, des types et de la taille des fichiers autorisés
```php
use Pw\FileValidator\FileValidator

$allowedMimeTypes = ['image/jpeg', 'image/png'];
$allowedExtensions = ['jpg', 'jpeg', 'png'];
$maxFileSize = 1024 * 1024; // 1 MB

$fileValidator = new FileValidator(
    $allowedMimeTypes, 
    $allowedExtensions, 
    $maxFileSize
);

$file = [
    'name' => 'example.jpg',
    'type' => 'image/jpeg',
    'size' => 500000, // 500 KB
];

if ($fileValidator->validateFile($file)) {
    //Le fichier est valide.
} else {
    //Le fichier n'est pas valide.
}
```
###### Utilisation de verifier le type de fichier comme `image` en appelant juste la méthode `isImage`.
```php
use Pw\FileValidator\FileValidator

$fileValidator = new FileValidator();

$mimetype = $file->getMimeType();//Type de fichier

if ($fileValidator->isImage($mimetype)) {
    //Le fichier est un image.
} else {
    //Le fichier n'est un image.
}

//ou
if ($fileValidator->isImage($file)) {//Objet de fichier
    //Le fichier est un image.
} else {
    //Le fichier n'est un image.
}
```

###### Quelques méthodes sur la validation de fichier.
```php
uploadToPath($file, $dir, $file_name)
isImage($file)
isPdf($file)
isDocx($file)
isExcel($file)
isVideo($file)
getFileType($file)
validSize($file, $max_mb=1)
validateMimeType($file)
validateExtension($file)
validateFile($file)
```