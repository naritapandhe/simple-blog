<?php
$keys = parse_ini_file('/Users/admin/Documents/cloud-elements/basic/secure/keys/config.ini', true);

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=blog',
    'username' => $keys['db_username'],
    'password' => $keys['db_password'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
