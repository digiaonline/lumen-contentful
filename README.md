# lumen-contentful

[![Build Status](https://travis-ci.org/digiaonline/lumen-contentful.svg?branch=master)](https://travis-ci.org/digiaonline/lumen-contentful)

This is a basic Lumen service provider for the Contentful PHP SDK.
 
## Requirements

* PHP >= 7.0
* Lumen 5.x

## Installation

Install the library:

```bash
composer require nordsoftware/lumen-contentful
```

Register the service provider:

```php
$app->register(Nord\Lumen\Contentful\ContentfulServiceProvider::class);
```

Finally, copy `config/contentful.php` to your application's `config/` directory, then define the environment variables 
in your `.env` file
