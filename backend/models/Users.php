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
    class Users extends \common\models\Users
    {
        public $upload_file;
        const PHOTO_PATH = 'uploads/users_photo/';
        
        public function beforeSave($insert)
        {
            $this -> password = md5($this -> password);
            if ( !empty($this -> upload_file) && $this -> upload_file -> size !== 0) {
                
                $this -> photo = $this -> id.'.'.$this -> upload_file -> extension;
            }
            
            return parent ::beforeSave($insert);
        }
        
        public function upload()
        {
            if ( !is_null($this -> upload_file)) {
                $this -> upload_file -> saveAs(self::PHOTO_PATH.$this -> photo);
                
                return true;
            }
            
            return false;
        }
    }
