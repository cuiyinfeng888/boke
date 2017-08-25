<?php
$db_config = json_decode(file_get_contents('/etc/myself_db_config.json'),true);
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$db_config['db.host'].';dbname='.$db_config['db.dbname'],
    'username' => $db_config['db.username'],
    'password' => $db_config['db.password'],
    'charset' => 'utf8',
];
