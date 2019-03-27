<?php
    
    use yii\db\Migration;
    
    /**
     * Class m190326_092828_create_concord_test_matveev_sergei_db
     */
    class m190326_062828_create_concord_test_matveev_sergei_db extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
         //   $this -> execute('CREATE DATABASE concord_test_matveev_sergei');
        }
        
        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this -> execute('DROP DATABASE [IF EXISTS] concord_test_matveev_sergei');
        }
        /*
        // Use up()/down() to run migration code without a transaction.
        public function up()
        {
    
        }
    
        public function down()
        {
            echo "m190326_092828_create_concord_test_matveev_sergei_db cannot be reverted.\n";
    
            return false;
        }
        */
    }
