﻿# FileUploader!

## Presentation

FileUploader is a php class which enables you to upload files on your website !

### features :
* Upload various type of files. You can choose the allowed formats.
* Rename uploaded files
* Choose location of the uploaded files
* Image resizing


## Installation

FileUploader is available via [Composer/Packagist](https://packagist.org/packages/pa-bru/file-uploader), so just add this line to your `composer.json` file:

```json
"pa-bru/file-uploader": "~1.0"
```

or

```sh
composer require pa-bru/file-uploader
```

## Usage

### Call the class:

```php

$file = $_FILES["myfile"];

$args = [
	  "fileName" => "my-filename",
          "contentDir" => "my-directory/",
          "allowedExts" => array(),
          "maxSize" => 1000000,
          "width" => 200,
          "height" => 300
];

$uploader = new FileUploader($file, $args);

```

$file : File upload data table
**$file is required**

$args : table arguments that can be passed to the constructor
**$args is optional**. eg: `$uploader = new FileUploader($file);`

### Properties

* `fileName` : name of file. If not specified, a single string is assigned.
* `contentDir` : Destination folder of the file added. The folder is created if it does not exist.
* `allowedExts` : Table of allowed extensions.
* `maxSize` : The maximum file size in bytes.
* `width` : In pixel (px) for resizing images (PNG, JPEG, JPG, GIF).
* `height` : In pixel (px) for resizing images (PNG, JPEG, JPG, GIF).

### Get the parameters (Getters) :

* Get file extension :
```php
$uploader->getFileExtension();
```
* Get the destination path of the file :
```php
$uploader->getPath();
```
* Get the height to be assigned to the image file :
```php
$uploader->getHeight();
```
* Get the width to be assigned to the image file :
```php
$uploader->getWidth();
```
* Get the maximum file size :
```php
$uploader->getMaxSize();
```
* Get the destination folder of the file :
```php
$uploader->getContentDir();
```
* Get the filename :
```php
$uploader->getFileName();
```
* Get file data table :
```php
$uploader->getTmpFile();
```
* Get the allowed extensions for uploading a file :
```php
$uploader->getAllowedExts();
```

### Set the parameters (Setters) :

* Set file path :
```php
$uploader->setPath($path);
```
* Set the height to be assigned to the file (if it is an image) :
```php
$uploader->setHeight($height);
```
* Set the width to be assigned to the file (if it is an image):
```php
$uploader->setWidth($width);
```
* Set the maximum size allowed for file upload :
```php
$uploader->setMaxSize($maxSize);
```
* Set the destination folder of the file :
```php
$uploader->setContentDir($contentDir);
```
* Set the name to be assigned to the file :
```php
$uploader->setFileName($fileName);
```
* Set the file to upload :
```php
$uploader->setTmpFile($tmpFile);
```
* Set the table of allowed extensions for file upload :
```php
$uploader->setAllowedExts(array $allowedExts);
```

### Launch upload :

```php
$uploader->upload();
```
**If successful the upload () method returns the path of the uploaded file.**


## Releases

**v1.0 :**
* Initial Version


## Author

* Paul-Adrien Bru [Linkedin][linkedin]

Copyright © 2016 Paul-Adrien Bru | MIT license

  [linkedin]: https://fr.linkedin.com/in/pauladrienbru "Visit My Linkedin"
