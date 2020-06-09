<?php

use fgh151\modules\params\models\ParamsModel;
use fgh151\modules\params\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\editors\Summernote;

/* @var $model ParamsModel */
/* @var $form yii\widgets\ActiveForm */
/* @var $file string */

$accordion = null;
$content_abwesenheiten = null;
$content_email = null;
$content_sonstiges = null;
$content_debug = null;
?>

<div class="app_params_settings-main-index">
    <h1><?= $model->paramsFilePath ?></h1>
    <?php echo Html::a(Module::t('app', 'Add'), ['add', 'file' => $file], ['class' => 'btn btn-success']); ?>
    <br>
    <br>
    <?php $form = ActiveForm::begin();
    foreach ($model->attributes() as $attribute):
        switch ($attribute) {
            case 'pauseBis':
                $content_abwesenheiten .= $form->field($model, $attribute)->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'DD, dd.mm.yyyy hh:ii:ss'
                    ]
                ]);
                break;
            case 'pauseMessage':
                $content_abwesenheiten .= $form->field($model, $attribute)->widget(Summernote::class, [
                    'options' => ['placeholder' => 'Das Yoga findet nicht statt, weil ich Ferien habe']
                ]);
                break;
            case 'maxTeilnehmer':
                $content_sonstiges .= $form->field($model, $attribute, [
                    'template' => ' {label}
                <div class="input-group">
                     {input}
                     <a href="' . Yii::$app->urlManager->createUrl(['params/main/delete', 'file' => $file, 'key' => $attribute]) . '" class="input-group-addon">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>{error}'
                ]);
                break;
            case 'messageFull':
                $content_sonstiges .= $form->field($model, $attribute, [
                    'template' => ' {label}
                <div class="input-group">
                     {input}
                     <a href="' . Yii::$app->urlManager->createUrl(['params/main/delete', 'file' => $file, 'key' => $attribute]) . '" class="input-group-addon">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>{error}'
                ]);
                break;
            case 'domainServer':
                $content_debug .= $form->field($model, $attribute, [
                    'template' => ' {label}
                <div class="input-group">
                     {input}
                     <a href="' . Yii::$app->urlManager->createUrl(['params/main/delete', 'file' => $file, 'key' => $attribute]) . '" class="input-group-addon">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>{error}'
                ]);
                break;
            case 'enableEmail':
                $content_debug .= $form->field($model, $attribute, [
                    'template' => ' {label}
                <div class="input-group">
                     {input}
                     <a href="' . Yii::$app->urlManager->createUrl(['params/main/delete', 'file' => $file, 'key' => $attribute]) . '" class="input-group-addon">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>{error}'
                ]);
                break;
            default:
                $content_email .= $form->field($model, $attribute, [
                    'template' => ' {label}
                <div class="input-group">
                     {input}
                     <a href="' . Yii::$app->urlManager->createUrl(['params/main/delete', 'file' => $file, 'key' => $attribute]) . '" class="input-group-addon">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>{error}'
                ]);
                break;
        }
    endforeach;
    if (gethostname() === 'mf-HP-ZBook-17') {
      $in='';
      $indebug='in';
    } else {
        $in='in';
        $indebug='';
    }

$accordion = '
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne" >
                <h4 class="panel-title">
                    <a class="collapsed collapsebutton" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false">
                       Abwesenheiten
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse '.$in.'" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    {content_abwesenheiten}
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed collapsebutton" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Sonstiges
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    {content_sonstiges}
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed collapsebutton" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        E-Mail
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    {content_email}
                </div>
            </div>
        </div>

    <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a class="collapsed collapsebutton" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                       Debug
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse '.$indebug.'" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                    {content_debug}
                </div>
            </div>
        </div>


    </div>
';
        $accordion = str_replace("{content_abwesenheiten}",$content_abwesenheiten,$accordion);
        $accordion = str_replace("{content_sonstiges}",$content_sonstiges,$accordion);
        $accordion = str_replace("{content_email}",$content_email,$accordion);
        $accordion = str_replace("{content_debug}",$content_debug,$accordion);

    echo $accordion;

    echo Html::submitButton(Module::t('app', 'Save settings'), ['class' => 'btn btn-success']);

    ?>
    <?php ActiveForm::end() ?>
</div>
