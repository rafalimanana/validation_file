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
use FileValidator\FileValidator
```

#### Instanciation
```php
$fileValidator = new FileValidator([]);
```

#### Exemple d’utilisation
```php
use FileValidator\FileValidator

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
    echo "Le fichier est valide.";
} else {
    echo "Le fichier n'est pas valide.";
}
```