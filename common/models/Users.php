<?php
    
    namespace common\models;
    
    use Yii;
    
    /**
     * This is the model class for table "users".
     *
     * @property int    $id
     * @property string $login
     * @property string $password
     * @property string $email
     * @property int    $group_id
     * @property string $photo
     * @property string $created_at
     * @property string $updated_at
     *
     * @property Groups $group
     */
    class Users extends \yii\db\ActiveRecord
    {
        /**
         * {@inheritdoc}
         */
        public static function tableName()
        {
            return 'users';
        }
        
        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                  [
                        ['login', 'password', 'email', 'group_id',],
                        'required',
                  ],
                  [['group_id'], 'integer'],
                //  [['created_at', 'updated_at'], 'safe'],
                  [
                        'created_at',
                        'default',
                        'value' => date('Y-m-d H:i:s'),
                        'when'  => function ($model) {
                            return $model -> isNewRecord;
                        },
                  ],
                  [['login', 'password', 'email'], 'string', 'max' => 255],
                  [['login', 'email'], 'unique'],
                  [
                        ['upload_file'],
                        'file',
                        'skipOnEmpty' => !$this->isNewRecord,
                        'extensions'  => 'png, jpg, jpeg',
                        
                  ],
                  [['upload_file'],'required','on'=>['create']],
                  [
                        ['group_id'],
                        'exist',
                        'skipOnError'     => true,
                        'targetClass'     => Groups ::className(),
                        'targetAttribute' => ['group_id' => 'id'],
                  ],
            ];
        }
        
        /**
         * {@inheritdoc}
         */
        public function attributeLabels()
        {
            return [
                  'id'         => 'ID',
                  'login'      => 'Login',
                  'password'   => 'Password',
                  'email'      => 'Email',
                  'group_id'   => 'Group ID',
                  'photo'      => 'Photo',
                  'created_at' => 'Created At',
                  'updated_at' => 'Updated At',
            ];
        }
        
        /**
         * @return \yii\db\ActiveQuery
         */
        public function getGroup()
        {
            return $this -> hasOne(Groups ::className(), ['id' => 'group_id']);
        }
    }
