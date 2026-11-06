<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Postingan';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="post-index">

    <div class="post-page-header">
        <div>
            <span class="home-label">PENGATURAN ARTIKEL</span>
            <h1>Postingan Artikel</h1>
            <p>Anda dapat mengelola artikel melalui panel di bawah ini.</p>
        </div>

        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Html::a(
                '<span class="glyphicon glyphicon-plus"></span> Buat Artikel Baru',
                ['create'],
                ['class' => 'btn btn-create-post']
            ) ?>
        <?php endif; ?>
    </div>

    <div class="post-table-card">

        <div class="post-table-heading">
            <h3>Daftar Artikel</h3>
            <span>Semua artikel yang tersedia</span>
        </div>

        <div class="post-table-scroll">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => [
                    'class' => 'table post-table',
                ],
                'layout' => "{items}\n<div class='post-pagination'>{pager}</div>\n<div class='post-summary'>{summary}</div>",
                'summary' => 'Menampilkan <b>{begin}-{end}</b> dari <b>{totalCount}</b> artikel.',
                'emptyText' => 'Belum ada artikel.',
                'columns' => [

                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => '#',
                        'contentOptions' => ['class' => 'post-number'],
                    ],

                    [
                        'attribute' => 'title',
                        'label' => 'Judul Artikel',
                        'contentOptions' => ['class' => 'post-title-cell'],
                        'value' => function ($model) {
                            return $model->title;
                        },
                    ],

                    [
                        'attribute' => 'content',
                        'label' => 'Isi Artikel',
                        'format' => 'text',
                        'value' => function ($model) {
                            return StringHelper::truncate(
                                trim(strip_tags($model->content)),
                                160
                            );
                        },
                        'contentOptions' => [
                            'class' => 'post-content-cell',
                        ],
                    ],

                    [
                        'attribute' => 'date',
                        'label' => 'Tanggal',
                        'contentOptions' => ['class' => 'post-date-cell'],
                        'value' => function ($model) {
                            return Yii::$app->formatter->asDatetime(
                                $model->date,
                                'php:d M Y H:i'
                            );
                        },
                    ],

                    [
                        'attribute' => 'username',
                        'label' => 'Penulis',
                    ],

                    [
                        'attribute' => 'status',
                        'label' => 'Status Publikasi',
                        'format' => 'raw',
                        'value' => function ($model) {

                            $status = $model->status ?: 'draft';

                            $badges = [
                                'draft' => 'status-draft',
                                'pending' => 'status-pending',
                                'published' => 'status-published',
                                'rejected' => 'status-rejected',
                            ];

                            $labels = [
                                'draft' => 'Draft',
                                'pending' => 'Pending',
                                'published' => 'Published',
                                'rejected' => 'Rejected',
                            ];

                            $class = $badges[$status] ?? 'status-draft';
                            $label = $labels[$status] ?? ucfirst($status);

                            $html = Html::tag(
                                'span',
                                Html::encode($label),
                                ['class' => 'status-badge ' . $class]
                            );

                            if ($status === 'rejected' && $model->rejection_reason) {
                                $html .= Html::tag(
                                    'div',
                                    'Alasan: ' . Html::encode($model->rejection_reason),
                                    ['class' => 'rejection-reason']
                                );
                            }

                            return $html;
                        },
                    ],

                    [
                        'label' => 'Pengajuan Review',
                        'format' => 'raw',
                        'value' => function ($model) {

                            if (Yii::$app->user->isGuest) {
                                return '-';
                            }

                            $user = Yii::$app->user->identity;
                            $isAdmin = Yii::$app->user->can('Admin');
                            $isAuthor = Yii::$app->user->can('Author');
                            $isOwner = $model->username === $user->username;

                            $buttons = [];

                            if (
                                $isAuthor && $isOwner &&
                                in_array($model->status, ['draft', 'rejected'])
                            ) {

                                $buttons[] = Html::a(
                                    'Ajukan Review',
                                    ['ajukan-review', 'id' => $model->idpost],
                                    [
                                        'class' => 'btn btn-workflow',
                                        'data-method' => 'post',
                                        'data-confirm' => 'Yakin ingin mengajukan artikel ini untuk direview?',
                                    ]
                                );
                            }

                            if ($isAdmin && $model->status === 'pending') {

                                $buttons[] = Html::a(
                                    'Approve',
                                    ['approve', 'id' => $model->idpost],
                                    [
                                        'class' => 'btn btn-workflow-approve',
                                        'data-method' => 'post',
                                    ]
                                );

                                $buttons[] = Html::a(
                                    'Reject',
                                    ['reject', 'id' => $model->idpost],
                                    [
                                        'class' => 'btn btn-workflow-reject',
                                    ]
                                );
                            }

                            return $buttons ? implode(' ', $buttons) : '-';
                        },
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Aksi',
                        'template' => '<div class="post-actions">{view}{update}{delete}</div>',
                        'contentOptions' => ['class' => 'post-action-cell'],
                        'buttons' => [

                            'view' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    $url,
                                    ['class' => 'post-action-view', 'title' => 'Lihat']
                                );
                            },

                            'update' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-pencil"></span>',
                                    $url,
                                    ['class' => 'post-action-edit', 'title' => 'Edit']
                                );
                            },

                            'delete' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-trash"></span>',
                                    $url,
                                    [
                                        'class' => 'post-action-delete',
                                        'title' => 'Hapus',
                                        'data-confirm' => 'Yakin ingin menghapus artikel ini?',
                                        'data-method' => 'post',
                                    ]
                                );
                            },
                        ],
                    ],

                ],
            ]); ?>

        </div>
    </div>

</div>