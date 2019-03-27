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
        
        public function beforeSave($insert)
        {
            $this -> password = md5($this -> password);
            if ( !is_null($this -> upload_file)) {
                
                $new_file_name = substr(md5(mt_rand()), 0, 7);
                $this -> photo = $new_file_name;
            }
            
            return parent ::beforeSave($insert);
        }
        
      
        public function upload()
        {
            if ( !is_null($this -> upload_file)) {
                $this -> upload_file -> saveAs('uploads/users_photo/'.$this -> id.'.'.$this -> upload_file -> extension);
                
                return true;
            }
            
            return false;
        }
        
    }
