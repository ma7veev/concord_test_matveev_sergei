<?php
    
    use yii\db\Migration;
    
    /**
     * Handles the creation of table `{{%users}}`.
     */
    class m190326_084812_create_users_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $tableOptions = null;
            if ($this -> db -> driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this -> createTable('{{%users}}',
                  [
                        'id'         => $this -> primaryKey(),
                        'login'      => $this -> string() -> notNull(),
                        'password'   => $this -> string() -> notNull(),
                        'email'      => $this -> string() ->unique()-> notNull(),
                        'group_id'   => $this -> integer() -> notNull(),
                        'photo'      => $this -> string() -> notNull(),
                        'created_at' => $this -> timestamp() -> notNull(),
                        'updated_at' => $this -> timestamp()
                                              -> defaultExpression('CURRENT_TIMESTAMP')
                                              -> notNull(),
                  ],
                  $tableOptions);
            $this -> createIndex('idx-users-group_id', 'users', 'group_id');
            $this -> addForeignKey('fk-users-group_id',
                  'users',
                  'group_id',
                  'groups',
                  'id',
                  'CASCADE');
        }
        
        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            // drops foreign key for table `user`
            $this -> dropForeignKey('fk-users-group_id', 'group_id');
            // drops index for column `author_id`
            $this -> dropIndex('idx-users-group_id', 'users');
            $this -> dropTable('{{%users}}');
        }
    }
