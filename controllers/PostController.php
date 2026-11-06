<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [

                    // Author dan Admin boleh melihat daftar artikel
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['Author', 'Admin'],
                    ],

                    // Hanya Author yang boleh membuat artikel
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['Author'],
                    ],

                    // Author dan Admin boleh mengedit artikel
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['Author', 'Admin'],
                    ],

                    // Hanya Admin yang boleh menghapus artikel
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],

                    // Hanya Author yang boleh mengajukan review
                    [
                        'actions' => ['ajukan-review'],
                        'allow' => true,
                        'roles' => ['Author'],
                    ],

                    // Hanya Admin yang boleh approve dan reject
                    [
                        'actions' => ['approve', 'reject'],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'ajukan-review' => ['POST'],
                    'approve' => ['POST'],
                    'reject' => ['GET', 'POST'],
                ],
            ],
        ];
    }


    /**
     * Lists all Post models.
     * @return mixed
     */

    public function actionIndex()
    {
        // Ambil semua artikel
        $query = Post::find()->orderBy(['date' => SORT_DESC]);

        // Jika bukan Admin, tampilkan artikel milik sendiri saja
        if (!Yii::$app->user->can('Admin')) {
            $query->andWhere([
                'username' => Yii::$app->user->identity->username
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post())) {

            // Identitas dan status ditentukan oleh server
            $model->date = date('Y-m-d H:i:s');
            $model->username = Yii::$app->user->identity->username;
            $model->status = 'draft';
            $model->rejection_reason = null;

            if ($model->save()) {
                Yii::$app->session->setFlash(
                    'success',
                    'Artikel berhasil disimpan sebagai Draft.'
                );

                return $this->redirect([
                    'view',
                    'id' => $model->idpost
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $id > 2) {
            $model->date = date('Y-m-d H:i:s');
            $model->username = \Yii::$app->user->identity->username;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->idpost]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($id > 2) {
            $this->findModel($id)->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionAjukanReview($id)
    {
        $model = $this->findModel($id);

        // Pastikan artikel milik Author yang login
        if ($model->username !== Yii::$app->user->identity->username) {
            throw new \yii\web\ForbiddenHttpException(
                'Kamu tidak memiliki akses ke artikel ini.'
            );
        }

        // Hanya draft dan rejected yang boleh diajukan
        if (!in_array($model->status, ['draft', 'rejected'])) {
            throw new \yii\web\BadRequestHttpException(
                'Artikel tidak dapat diajukan dalam status ini.'
            );
        }

        // Ajukan kembali untuk direview
        $model->status = 'pending';

        // Hapus alasan penolakan sebelumnya
        $model->rejection_reason = null;

        if ($model->save(false)) {
            Yii::$app->session->setFlash(
                'success',
                'Artikel berhasil diajukan kembali untuk review.'
            );
        }

        return $this->redirect(['index']);
    }


    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $model->status = 'published';
        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Artikel berhasil di-approve dan dipublikasikan.');
        }
        return $this->redirect(['index']);
    }

    public function actionReject($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 'rejected';
            if ($model->save(false)) {
                Yii::$app->session->setFlash('warning', 'Artikel telah ditolak.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('reject', [
            'model' => $model,
        ]);
    }
}
