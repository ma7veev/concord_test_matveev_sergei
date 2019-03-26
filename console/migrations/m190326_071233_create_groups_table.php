<?php
    
    use yii\db\Migration;
    
    /**
     * Handles the creation of table `{{%groups}}`.
     */
    class m190326_071233_create_groups_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this -> createTable('{{%groups}}', [
                  'id'    => $this -> primaryKey(),
                  'login' => $this -> string() -> notNull(),
            ],$tableOptions);
        }
        
        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this -> dropTable('{{%groups}}');
        }
    }
