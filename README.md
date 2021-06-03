# FindFood with Yii2

## Installation

1. Install the repo to your host folder.

2. Then run in your folder

```bash
composer update
```

3. Change app URL in config/params.php

```bash
return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    'appUrl' => 'http://findfood.test', //Your SITE URL
];

```


4. Change db params in config/db.php

```bash

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=findfood',
    'username' => 'samir',
    'password' => 'password',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];


```

5. Import database from root folder.
