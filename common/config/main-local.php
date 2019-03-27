<?php
    return [
          'controllerMap' => [
                'migrate' => [
                      'class' => 'console\controllers\MigrateController',
                ],
          ],
          'components' => [
                'preinstallDb' => [
                      'class' => 'yii\db\Connection',
                      'dsn' => 'mysql:host=localhost',
                      'username' => 'root',
                      'password' => '',
                      'charset' => 'utf8',
                ],
                'db'           => [
                      'class'    => 'yii\db\Connection',
                      'dsn'      => 'mysql:host=localhost;dbname=concord_test_matveev_sergei',
                      'username' => 'root',
                      'password' => '',
                      'charset'  => 'utf8',
                ],
                'mailer'       => [
                      'class'            => 'yii\swiftmailer\Mailer',
                      'viewPath'         => '@common/mail',
                    // send all mails to a file by default. You have to set
                    // 'useFileTransport' to false and configure a transport
                    // for the mailer to send real emails.
                      'useFileTransport' => true,
                ],
          ],
    ];
