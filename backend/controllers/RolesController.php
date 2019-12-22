<?php

namespace backend\controllers;

use common\models\Role;
use common\utils\StaticMembers;
use Yii;
use yii\rbac\Role as Role2;
use yii\web\NotFoundHttpException;

/**
 * RolesController implements the CRUD actions for Role model.
 */
class RolesController extends GenericController {

    public function beforeAction($action) {
        $this->entityId = 'roles';
        Yii::$app->view->params['active'] = $this->entityId;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex() {
        $roles = Yii::$app->authManager->getRoles();
        return $this->render('index', ['roles' => $roles]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Role();
        $authManager = Yii::$app->authManager;
        $role = new Role2();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate() && $model->validateName()) {
            $role = $authManager->createRole($model->name);
            $role->description = $model->description;
            $authManager->add($role);
            unset($post['Role'], $post['_csrf']);
            foreach ($post as $permIndex => $permName) {
                $perm = $authManager->getPermission($permIndex);
                if ($perm) {
                    $authManager->addChild($role, $perm);
                }
            }
            return $this->actionIndex();
        }
        $entitiesAndPerms = StaticMembers::getAuthEntitiesAndPerms($authManager, $role);
        return $this->render('create', ['model' => $model, 'perms' => $entitiesAndPerms]);
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $name
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($name) {
        $model = $this->findModel($name);
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($model->name);
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $post = Yii::$app->request->post();
            $role->description = $model->description;
            $authManager->update($role->name, $role);
            
            $rolePermissions = $authManager->getPermissionsByRole($role->name);
            foreach ($rolePermissions as $rolePermission) {
                $authManager->removeChild($role, $rolePermission);
            }
            
            unset($post['Role'], $post['_csrf']);
            foreach ($post as $permIndex => $permName) {
                $perm = $authManager->getPermission($permIndex);
                if ($perm) {
                    $authManager->addChild($role, $perm);
                }
            }
            
            return $this->actionIndex();
        }
        $entitiesAndPerms = StaticMembers::getAuthEntitiesAndPerms($authManager, $role);
        return $this->render('update', ['model' => $model, 'perms' => $entitiesAndPerms]);
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $name
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($name) {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($name);
        if ($role) {
            $authManager->remove($role);
            return $this->actionIndex();
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $name
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name) {
        if (($model = Yii::$app->authManager->getRole($name)) !== null) {
            return new Role(['name' => $model->name, 'description' => $model->description]);
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
