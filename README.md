ConfigServiceProvider
=====================

A config ServiceProvider for Silex with support for yaml.

Parameters
----------

* **config.path** : Path to the directory containing Yaml configuration files (it can also be an array of paths).

Registering
-----------

To enable it, add this dependency to your `composer.json` file:

```js
"oziks/config-service-provider": "dev-master"
```

And enable it in your application:

``` php
<?php

use Oziks\Provider\ConfigServiceProvider;

$app->register(new ConfigServiceProvider(), array(
    'config.path' => glob(__DIR__.'/*/Resources/views/')
));
```
