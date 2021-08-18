<?php


use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>My Internet Shop</title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <!-- <?php
    // $menuItems = [];
    // if (Yii::$app->user->isGuest) {
    //     $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    //     $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    // } else {
    //     $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    //     $menuItems[] =  ['label' => 'Корзина', 'url' => ['/site/index']];
    //     $menuItems[] = '<li class="nav-item">'
    //         . Html::beginForm(['/site/logout'], 'post')
    //         . Html::submitButton(
    //             'Logout (' . Yii::$app->user->identity->username . ')',
    //             ['class' => 'btn btn-link logout nav-link ']
    //         )
    //         . Html::endForm()
    //         . '</li>';
    // }

    // NavBar::begin(['brandLabel' => 'My Internet Shop']);
    // echo Nav::widget([
    // 'items' => $menuItems,
    // 'options' => ['class' => 'navbar-nav'],
    // ]);
    // NavBar::end();
    ?> -->
<div class="container-fuild">
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex align-center">
    <a class="navbar-brand ml-5" href="#">My Internet Shop</a>
    <div class="navbar-collapse d-flex justify-content-end mr-5" id="navbarNav">
        <ul class="navbar-nav">
            <?php if(Yii::$app->user->isGuest){?>
                <li class="nav-item ">
                <a class="nav-link" href="/site/signup">Signup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/site/login">Login</a>
                </li>
            <?php } else{?>
                <li class="nav-item">
                    <a class="nav-link" href="/site/login">Login</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../shop/index">Корзина</a>
                </li>
                <li class="nav-item">
                    <?php
                    echo '<li class="nav-item">'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout nav-link ']
                            )
                            . Html::endForm()
                            . '</li>';
                       
                    ?>
                </li>
            <?php } ?> 
        </ul>
    </div>
  </div>
</nav>
    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
