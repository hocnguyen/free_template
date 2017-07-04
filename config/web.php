<?php
$params = require(__DIR__ . '/params.php');
Yii::setAlias('@designwebvn','/front');
Yii::setAlias('@front','/front');
Yii::setAlias('@back','/backend');
Yii::setAlias('@uploads','/uploads');
Yii::setAlias('@RealDirectory', dirname(__DIR__) );
Yii::setAlias('@webroot', dirname(__DIR__)."/web" );
Yii::setAlias('@vendor', dirname(__DIR__)."/vendor");

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\AdminModules',
            'layout' => 'main'
        ],
        'front' => [
            'class' => 'app\modules\front\FrontModules',
            'layout' => 'main'
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TZwIkvdtEATzAsdDMRBetEAKDDVny_8W',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'func' => [
            'class' => 'app\components\CFunctions',
        ],
        'Paypal' => [
            'class' => 'app\components\Paypal',
        ],
        'errorHandler' => [
            'errorAction' => 'front/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'transport' => [
                'class'         => 'Swift_SmtpTransport',
                'host'          => 'smtp.gmail.com',
                'username'      => 'kingdevtran@gmail.com',
                'password'      => 'kcmklqignhanaaez',
                'port'          => '465',
                'encryption'    => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => require(__DIR__ . '/route.php'),
        'i18n' => [
            'translations' => [
            'app*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/messages', // if advanced application, set @frontend/messages
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                    'app' => 'app.php',
                    'app/error' => 'error.php',
                ],
                ],
            ],
        ],
    ],
    'params' => $params
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module'
    ];
}

return $config;
