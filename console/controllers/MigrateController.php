<?php
    /**
     * Created by PhpStorm.
     * User: baduser
     * Date: 27.03.2019
     * Time: 17:05
     */
    namespace console\controllers;
    use yii\console\controllers\MigrateController as BasicMigrateController;
    use Yii;
    class MigrateController extends BasicMigrateController
    {
       public function init()
        {
           Yii::$app->preinstallDb->createCommand('CREATE DATABASE concord_test_matveev_sergei')->execute();
           parent::init();
        }
    }