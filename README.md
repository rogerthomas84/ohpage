OhPage
======

OhPage is a simple cheat, really it's because I'm tired of figuring out the skip / limit for paginating result sets.

[![Latest Stable Version](https://poser.pugx.org/rogerthomas84/ohpage/v/stable.svg)](https://packagist.org/packages/rogerthomas84/ohpage)
[![Total Downloads](https://poser.pugx.org/rogerthomas84/ohpage/downloads.svg)](https://packagist.org/packages/rogerthomas84/ohpage)
[![Latest Unstable Version](https://poser.pugx.org/rogerthomas84/ohpage/v/unstable.svg)](https://packagist.org/packages/rogerthomas84/ohpage)
[![License](https://poser.pugx.org/rogerthomas84/ohpage/license.svg)](https://packagist.org/packages/rogerthomas84/ohpage)
[![Build Status](https://travis-ci.org/rogerthomas84/ohpage.png)](http://travis-ci.org/rogerthomas84/ohpage)

Using Composer
--------------

To use OhPage with Composer, add the dependency (and version constraint) to your require block inside your `composer.json` file.

```json
{
    "require": {
        "rogerthomas84/ohpage": "1.0.*"
    }
}
```


Quick Start
-----------

```php
<?php
$db = new \MongoClient('mongodb://my.database.host:27017'); // Set up your database connection
$collection = $db->selectCollection('mydb', 'mycollection');

$perPage = 10; // How many results per page?
$currentPage = 1; // The current page
$totalResults = $collection->count(); // Get the total from the DB

$instance = new PaginateHelper($perPage, $currentPage, $totalResults);

$results = $collection->find()->sort(
    array('createdDate' => -1)
)->skip(
    $instance->getQueryOffset()
)->limit(
    $instance->getQueryLimit()
);
```
