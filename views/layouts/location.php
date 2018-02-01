<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Html;
use yii\helpers\Url;
use backend\components\Monav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use kartik\widgets\Growl;

//use kartik\nav\NavX;

AppAsset::register($this);

$js = <<< 'SCRIPT'
/* To initialize BS3 tooltips set this below */
$(function () {
    $("[data-toggle='tooltip']").on('click',function(e){
    e.preventDefault();
  }).tooltip();
});
/* To initialize BS3 popovers set this below */
$(function () {
    $("[data-toggle='popover']").on('click',function(e){
    e.preventDefault();
  }).popover();
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    $this->registerCss("
		.wrap > .container {
			 padding: 0px 15px 20px;
		}
		.cmmslogo{
			align-content: left;
			width: 45px;
			padding: 3px;
		}
		.navtablelogo{
			float:right;
		}
		.navbar-brand {
			 padding: 2px 15px;
		}
		.navbar-brand > img {
			 display: inline;
		}
		.breadcrumb>li+li:before {
            content:\"»\";
        }
		/* PADDING VERTICAL */
		.padding-v-xxs {
		padding-top: 5px;
		padding-bottom: 5px;
		}
		.padding-v-xs {
		padding-top: 10px;
		padding-bottom: 10px;
		}
		.padding-v-base {
		padding-top: 15px;
		padding-bottom: 15px;
		}
		.padding-v-md {
		padding-top: 20px;
		padding-bottom: 20px;
		}
		.padding-v-lg {
		padding-top: 30px;
		padding-bottom: 30px;
		}
		.line {
		width: 100%;
		height: 2px;
		margin: 10px 0;
		overflow: hidden;
		font-size: 0;
		}
		.line-xs {
		margin: 0;
		}
		.line-lg {
		margin-top: 15px;
		margin-bottom: 15px;
		}
		.line-dashed {
		background-color: transparent;
		border-bottom: 1px dashed #dee5e7 !important;
		}
		div.required label:after{
			content: \" *\";
			color: red;
		}
		.panbtn{
			float:right;
			margin: -5px 5px 0px 0px;
		}
		.media a{
			color: black;
			text-decoration: none;
		}
		.media:hover {
          background-color: #f5f5f5;
        }
        .menu-large {
            position: static !important;
        }
        .megamenu{
            padding: 20px 0px;
            width:100%;
        }
        .megamenu> li > ul {
            padding: 0;
            margin: 0;
        }
        .megamenu> li > ul > li {
            list-style: none;
        }
        .megamenu> li > ul > li > a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.428571429;
            color: #333333;
            white-space: normal;
        }
        .megamenu> li ul > li > a:hover,
        .megamenu> li ul > li > a:focus {
            text-decoration: none;
            color: #262626;
            background-color: #f5f5f5;
        }
        .megamenu.disabled > a,
        .megamenu.disabled > a:hover,
        .megamenu.disabled > a:focus {
            color: #999999;
        }
        .megamenu.disabled > a:hover,
        .megamenu.disabled > a:focus {
            text-decoration: none;
            background-color: transparent;
            background-image: none;
            filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
            cursor: not-allowed;
        }
        .megamenu.dropdown-header {
            color: #428bca;
            font-size: 18px;
        }
        @media (max-width: 768px) {
            .megamenu{
                margin-left: 0 ;
                margin-right: 0 ;
            }
            .megamenu> li {
                margin-bottom: 30px;
            }
            .megamenu> li:last-child {
                margin-bottom: 0;
            }
            .megamenu.dropdown-header {
                padding: 3px 15px !important;

            }
            .navbar-nav .open .dropdown-menu .dropdown-header{
                color:#fff;
            }
        }
        .alert-custom {
            color: #a15426;
            background-color: #ffffff;
            border: 1px solid #a15426;
        }
        .btn-link{
            padding: 15px;
        }
        .nav-main-backend{
		    display : none; 
		}
		.mywrap{
		    margin-top: -50px;
        }
     ");
    ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
$modul = \Yii::$app->controller->module;
?>
<?php
$this->registerLinkTag([
    //'title' => 'Live News for Yii',
    'rel' => 'shortcut icon',
    'type' => 'image/x-icon',
    'href' => '/media/commsci.ico',
]);
?>
<div class="wrap mywrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img class="cmmslogo" alt="Brand" src="/media/parallax/img/commsci_logo_black.png">' . '<table class="navtablelogo"><tbody>
		  <tr><td>' . Yii::t('app', 'ระบบจัดการสถานที่') . '</td></tr>
		  <tr style="font-size: small;"><td>' . Yii::t('app', 'ข้อมูลห้อง/สถานที่ คณะวิทยาการสื่อสาร') . '</td></tr>
		  </tbody></table>',
        'brandUrl' => Url::toRoute('/' . $modul->id),
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [
            'class' => 'navbar-default',
        ],
    ]);
    $menuItems = [
        [
            'label' => Html::Icon('tasks').' '.Yii::t( 'app', 'จัดการ'),
            'url' => ['#'],
            'items' => [
                ['label' => Html::Icon('plus').' '.Yii::t( 'app', 'เพิ่มสถานที่'), 'url' => ['loc/create']],
                ['label' => Html::Icon('list').' '.Yii::t( 'app', 'รายการ'), 'url' => ['loc/']],
            ]
        ],
        [
            'label' => Html::Icon('fullscreen') . ' ' . Yii::t('app', 'ระบบที่เกี่ยวข้อง'),
            'url' => ['#'],
            'items' => [
                ['label' => Html::Icon('scissors') . ' ' . Yii::t('app', 'ระบบจัดการพัสดุ'), 'url' => ['/inventory/']],
                ['label' => Html::Icon('phone-alt') . ' ' . Yii::t('app', 'ระบบจัดการโทรศัพท์ภายใน'), 'url' => ['/intercom/']],
            ]
        ],
        ['label' => Html::Icon('info-sign') . ' ' . Yii::t('app', 'คำแนะนำการใช้'), 'url' => ['default/intro']],
    ];
    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => Yii::t( $moduleID.'/app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems1[] = ['label' => Html::Icon('log-in').' '.Yii::t( 'app', 'เข้าสู่ระบบ'), 'url' => Yii::$app->user->loginUrl];
    } else {
        $menuItems1[] = ['label' => Html::Icon('dashboard').' '.Yii::t( 'app', 'office'), 'url' => ['/']];
        $menuItems1[] = ['label' => Html::Icon('globe').' '.Yii::t( 'app', 'หน้าเว็บไซต์หลัก'), 'url' => '/'];
        $menuItems1[] = '<li>'
            . Html::beginForm(['/site/logout', 'url' => Url::current()], 'post')
            . Html::submitButton(
                Html::Icon('log-out') . ' ' . Yii::t('app', 'ออกจากระบบ') . ' (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Monav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    echo Monav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems1,
    ]);
    NavBar::end();
    ?>
    <div class="container-fluid">
        <?php
        $cookies = Yii::$app->request->cookies;

        if (($cookie = $cookies->get($modul->params['modulecookies'])) !== null) {
            if ($cookie->value != $modul->params['ModuleVers']) {
                $delcookies = Yii::$app->response->cookies;
                $delcookies->remove($modul->params['modulecookies']);
            }
        } else {
            echo $this->render('/_version');
        }
        ?>

        <?= Breadcrumbs::widget([
            'encodeLabels' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => Html::Icon('home'),
                'url' => Url::toRoute('/' . $modul->id),
            ],
        ]) ?>
        <?= Alert::widget() ?>
        <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
            <?php
            echo Growl::widget([
                'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                //'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
                'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
                'showSeparator' => true,
                'delay' => 1, //This delay is how long before the message shows
                'pluginOptions' => [
                    'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                    'placement' => [
                        'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                        'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'center',
                    ]
                ]
            ]);
            ?>
        <?php endforeach; ?>
        <?php /*
echo Nav::widget([
    'encodeLabels' => false,
    'items' => [
        '<li style="padding: 10px;" role="presentation" class="disabled"><span class="glyphicon glyphicon-tasks"></span>  สำหรับเจ้าหน้าที่</li>',
        ['label' => Html::Icon('play').' '.Yii::t( $moduleID.'/app', 'Invt Mains'),
            'items' => [
                ['label' => Html::Icon('menu-right').' '.Yii::t( $moduleID.'/app', 'add'), 'url' => ['/inventory/invtmain/create']],
                ['label' => Html::Icon('menu-right').' '.Yii::t( $moduleID.'/app', 'index'), 'url' => ['/inventory/invtmain']],
            ],
        ],
    ],
    'options' => ['class' =>'nav-pills bg-warning'], // set this to nav-tab to get tab-styled navigation
]);*/
        ?>
        <div class="col-md-12">
            <?= $content ?>
        </div>

        <?php /*if(isset($this->blocks['block1'])){
			$this->blocks['block1'];
		 }else{
			echo 'no block';
		 }*/ ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p>© 2016 PSU YII DEV <span
                class="label label-danger"><?php echo $modul->params['ModuleVers']; ?></span>
            <?php echo '  ' . Yii::t('app', 'พบปัญหาในการใช้งาน ติดต่อ - '); ?> : <?php echo Html::mailto('อับดุลอาซิส ดือราแม', 'abdul-aziz.d@psu.ac.th'); ?>
            <?php echo ' ' . Yii::t('app', 'โทรศัพท์ภายใน : 2618'); ?>
            <a href="#" data-toggle="tooltip" title="<?php echo Yii::t('app', 'responsive_web'); ?>"><img
                    src="<?php echo '/uploads/adzpireImages/responsive-icon.png'; ?>"
                    width="30" height="30"/></a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
