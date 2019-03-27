<?php
    
    namespace backend\controllers;
    
    use Yii;
    use backend\models\Users;
    use backend\models\Groups;
    use backend\models\UsersSearch;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;
    use yii\web\UploadedFile;
    use yii\filters\AccessControl;
    
    /**
     * UsersController implements the CRUD actions for Users model.
     */
    class UsersController extends Controller
    {
        /**
         * {@inheritdoc}
         */
        public function behaviors()
        {
            return [
                  'access' => [
                        'class' => AccessControl ::className(),
                        'rules' => [
                              [
                                    'allow' => true,
                                    'roles' => ['@'],
                              ],
                        ],
                  ],
                  'verbs' => [
                        'class'   => VerbFilter ::className(),
                        'actions' => [
                              'delete' => ['POST'],
                        ],
                  ],
            ];
        }
        
        /**
         * Lists all Users models.
         * @return mixed
         */
        public function actionIndex()
        {
            $searchModel = new UsersSearch;
            $dataProvider = $searchModel -> search(Yii ::$app -> request -> queryParams);
            
            return $this -> render('index',
                  [
                        'searchModel'  => $searchModel,
                        'dataProvider' => $dataProvider,
                  ]);
        }
        
        /**
         * Displays a single Users model.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionView($id)
        {
            return $this -> render('view',
                  [
                        'model' => $this -> findModel($id),
                  ]);
        }
        
        /**
         * Creates a new Users model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate()
        {
            $model = new Users;
            if ($model -> load(Yii ::$app -> request -> post())) {
                
                $model -> upload_file = UploadedFile ::getInstance($model, 'upload_file');
                if ($model -> save() && $model -> upload()) {
                    return $this -> redirect(['view', 'id' => $model -> id]);
                }
            }
            $groups_list = Groups ::find() -> select('name') -> indexBy('id') -> column();
            
            //  var_dump($groups_list);
            return $this -> render('create',
                  [
                        'model'       => $model,
                        'groups_list' => $groups_list,
                  ]);
        }
        
        /**
         * Updates an existing Users model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionUpdate($id)
        {
            $model = $this -> findModel($id);
            if ($model -> load(Yii ::$app -> request -> post())) {
                
                $model -> upload_file = UploadedFile ::getInstance($model, 'upload_file');
                if ($model -> save() && $model -> upload()) {
                    return $this -> redirect(['view', 'id' => $model -> id]);
                }
            }
            $groups_list = Groups ::find() -> select('name') -> indexBy('id') -> column();
            
            return $this -> render('update',
                  [
                        'model'       => $model,
                        'groups_list' => $groups_list,
                  ]);
        }
        
        /**
         * Deletes an existing Users model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionDelete($id)
        {
            $this -> findModel($id) -> delete();
            
            return $this -> redirect(['index']);
        }
        
        /**
         * Finds the Users model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Users the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id)
        {
            if (($model = Users ::findOne($id)) !== null) {
                return $model;
            }
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        public function actionUpload()
        {
            $model = new Users;
            if (Yii ::$app -> request -> isPost) {
                var_dump(Yii ::$app -> request -> post());
                
                return $this -> asJson(Yii ::$app -> request -> post());
                $model -> photo = UploadedFile ::getInstance($model, 'photo');
                if ($model -> upload()) {
                    // file is uploaded successfully
                    return $this -> asJson($model -> photo);
                }
            }
            //   return $this->render('upload', ['model' => $model]);
        }
    }
