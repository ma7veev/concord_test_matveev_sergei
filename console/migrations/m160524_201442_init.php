<?php
    
    use yii\db\Migration;
    
    class m160524_201442_init extends Migration
    {
        public function up()
        {
            $tableOptions = null;
            if ($this -> db -> driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this -> createTable('{{%user}}',
                  [
                        'id'                   => $this -> primaryKey(),
                        'username'             => $this -> string()
                                                        -> notNull()
                                                        -> unique(),
                        'auth_key'             => $this -> string(32) -> notNull(),
                        'password_hash'        => $this -> string() -> notNull(),
                        'password_reset_token' => $this -> string() -> unique(),
                        'email'                => $this -> string()
                                                        -> notNull()
                                                        -> unique(),
                        'status'     => $this -> smallInteger()
                                              -> notNull()
                                              -> defaultValue(10),
                        'created_at' => $this -> integer() -> notNull(),
                        'updated_at' => $this -> integer() -> notNull(),
                  ],
                  $tableOptions);
            $this -> insert('{{%user}}',
                  [
                        'username'      => 'admin',
                        'auth_key'      => 'tUACjswfBlx8X11HceUg70qE1OZW6bMp',
                        'password_hash' => '$2y$13$1r3G20m3uhWYeRMQF8VVkOgMqOYBI8rXmlNaY8M2xWVSZjbrXVMxi',
                        'email'         => 'admin@example.com',
                        'status'        => '10',
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s'),
                  ]);
        }
        
        public function down()
        {
            $this -> dropTable('{{%user}}');
        }
    }
