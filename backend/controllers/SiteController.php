<?php
    
    namespace backend\controllers;
    
    use Yii;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;
    use common\models\LoginForm;
    use frontend\models\SignupForm;

    use frontend\models\ResendVerificationEmailForm;
    use frontend\models\VerifyEmailForm;
    /**
     * Site controller
     */
    class SiteController extends Controller
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
                                    'allow'   => true,
                                    'roles'   => ['@'],
                              ],
                              [
                                    'actions' => ['login', 'error'],
                                    'allow'   => true,
                              ],
                        ],
                  ],
                  'verbs'  => [
                        'class' => VerbFilter ::className(),
                        'actions' => [
                              'logout' => ['post'],
                        ],
                  ],
            ];
        }
        
        /**
         * {@inheritdoc}
         */
        public function actions()
        {
            return [
                  'error' => [
                        'class' => 'yii\web\ErrorAction',
                  ],
            ];
        }
        
        /**
         * Displays homepage.
         *
         * @return string
         */
        public function actionIndex()
        {
          
            return $this -> render('index');
        }
        /**
         * Login action.
         *
         * @return string
         */
        public function actionLogin()
        {
            if ( !Yii ::$app -> user -> isGuest) {
                return $this -> goHome();
            }
            $model = new LoginForm;
            if ($model -> load(Yii ::$app -> request -> post()) && $model -> login()) {
                return $this -> goBack();
            } else {
                $model -> password = '';
                
                return $this -> render('login',
                      [
                            'model' => $model,
                      ]);
            }
        }
        
        public function actionSignup()
        {
            $model = new SignupForm;
            if ($model -> load(Yii ::$app -> request -> post()) && $model -> signup()) {
                Yii ::$app -> session -> setFlash('success',
                      'Thank you for registration. Please check your inbox for verification email.');
                
                return $this -> goHome();
            }
            
            return $this -> render('signup',
                  [
                        'model' => $model,
                  ]);
        }
        
        /**
         * Logout action.
         *
         * @return string
         */
        public function actionLogout()
        {
            Yii ::$app -> user -> logout();
            
            return $this -> goHome();
        }
    }
