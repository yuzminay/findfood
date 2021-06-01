<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
  <title>Admin | <?= Html::encode($this->title) ?></title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <?php $this->head() ?>
</head>

<body>
  <?php $this->beginBody() ?>

  <header class="header">
    <div class="container">
      <div class="header__inner">
        <a href="/" class="home__link">Foods</a>
        <a href="/" class="logo">
          <img src="/web/img/findfoodlogo.svg" alt="Find Food Logo" class="logo__img">
          <div class="logo__text">FindFood</div>
        </a>
        <a href="<?= yii\helpers\Url::to(['/admin']) ?>" class="admin__link" style="color:blue">Admin</a>
      </div>
    </div>
  </header>
  <header class="header">
    <div class="container">
      <div class="header__inner">
        <a href="<?= \yii\helpers\Url::to(['/admin/food']) ?>" class="home__link" style="color:brown">Create Food</a>
        <a href="<?= \yii\helpers\Url::to(['/admin/ingredient']) ?>" class="home__link" style="color:brown">Create Ingredient</a>
      </div>
    </div>
  </header>
  <main class="main">
    <div class="container">
      <?= $content ?>
    </div>
  </main>

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>