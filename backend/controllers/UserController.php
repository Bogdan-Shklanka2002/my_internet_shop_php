<?php

namespace backend\controllers;

use backend\models\UserForm;
use common\models\User;
use service\UserService;
use \yii\web\Controller;
use yii\filters\AccessControl;
use Yii;
use yii\web\UploadedFile;

use yii\data\ArrayDataProvider;

class UserController extends Controller
{

    private UserService $user_service;    
     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['admin', 'owner'],
                    ],
                ],
            ]  
        ];

    }

    public function __construct($id, $module, UserService $user_service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->user_service = $user_service;
    }
    public function actionIndex()
    {    
        $user = (new \yii\db\Query())
            ->select(['id', 'username', 'first_name', 'second_name', 'last_name', 'email', 'status'])
            ->from('user')
            ->all();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $user,
            'pagination' => [
                'pageSize' => 10,
    ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }    

    public function actionDelete($id)
    {
        $user = User::findOne(['id' => $id]);
        $user->status = User::STATUS_DELETED;
        $user->save();
        return $this->redirect(['/user/index']);
    }
    public function actionRecovery($id)
    {
        $user = User::findOne(['id' => $id]);
        $user->status = User::STATUS_ACTIVE;
        $user->save();
        return $this->redirect(['/user/index']);
    }

    public function actionUpdate($id){

        $user = User::findOne(['id' => $id]);

        $model = new UserForm();

        $model->username = $user->username;
        $model->email = $user->email;
        $model->first_name = $user->first_name;
        $model->second_name = $user->second_name;
        $model->last_name = $user->last_name;
        $model->status = $user->status;
        $auth = Yii::$app->authManager;
        
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user->last_name = $model->last_name;
            $user->first_name = $model->first_name;
            $user->second_name = $model->second_name;
            $user->status = $model->status;
            
            if($this->user_service->saveDB($model)){
                $auth->revokeAll($id);
                foreach($model->roles as $value){
                    $role = $auth->getRole($value);
                    $auth->assign($role, $id);
                }
            }
            return $this->redirect(['/user/index']);
        }



        $roles = $auth->getRoles();
        $roles_array = [];
        foreach($roles as $key => $value){
            switch($key){
                case 'admin':
                    $roles_array[$key] = 'Адміністратор';
                break; 
                case 'owner':
                    $roles_array[$key] = 'Власник';
                break; 
                case 'user':
                    $roles_array[$key] = 'Користувач';
                break;

                case 'seo_manager':
                    $roles_array[$key] = 'SEO-менеджер';
                break;

                case 'content_manager':
                    $roles_array[$key] = 'Контент-менеджер';
                break;
                default :
                    $roles_array[$key] = $key;
                break;
                 
            }
        }
        $roles = $auth->getRolesByUser($id);
        $model->roles = [];
        foreach($roles as $key => $value){
            $model->roles[] = $key;
        }
        return $this->render('update', ['model' => $model, 'roles_array' => $roles_array]);
    }
    
    
}
