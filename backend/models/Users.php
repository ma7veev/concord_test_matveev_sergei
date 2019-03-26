<?php
    
    namespace backend\models;
    
    use Yii;
    use yii\web\UploadedFile;
    
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
        public $uploaded_file = '';
        
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
                        ['photo'],
                        'file',
                        'skipOnEmpty' => false,
                        'extensions'  => 'png, jpg',
                  ],
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
        
        public function upload()
        {
            if ($this -> validate()) {
                $new_file_name = substr(md5(mt_rand()), 0, 7);
                $this -> photo -> saveAs('uploads/'.$new_file_name.'.'.$this -> photo -> extension);
             //   $this->photo = $new_file_name;
                return true;
            } else {
                return false;
            }
        }
    }
