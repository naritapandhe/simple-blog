<?php

$keys = parse_ini_file('/Users/admin/Documents/cloud-elements/basic/secure/keys/config.ini', true);
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
	'name' =>'BlogYii',
	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'enableUnconfirmedLogin' => true,
			'confirmWithin' => 21600,
			'cost' => 12,
			'admins' => ['admin']
		],
		'gridview' =>  [
			'class' => 'kartik\grid\Module',
		]
	],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'iVgcMdbaUAUQi9rqmHqOk2ONWC_XZdfK',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@app/mailer',
			'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => $keys['smtp_host'],
				'username' => $keys['smtp_username'],
				'password' => $keys['smtp_password'],
				'port' => '2525',
				'encryption' => 'tls',
			],
		],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','trace'],
					'categories' => ['test1'],
					'logFile' => '@app/test/test1.log',
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'rules' => [],
        ],
		'view' => [
			'theme' => [
				'pathMap' => [
					'@dektrium/user/views' => '@app/views/user'
				],
			],
		],
		'authClientCollection' => [
			'class' => 'yii\authclient\Collection',
			'clients' => [
				'github' => [
					'class' => 'yii\authclient\clients\GitHub',
					'clientId' => $keys['auth_github_key'],
					'clientSecret' => $keys['oauth_github_secret'],
				],
			],
		],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
