<?php
/** @var \dosamigos\fileupload\FileUploadUI $this */
use yii\helpers\Html;

$context = $this->context;
?>
    <!-- The file upload form used as target for the file upload widget -->
<?= Html::beginTag('div', $context->options); ?>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar">
        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?= Yii::t('fileupload', 'Add files') ?>...</span>

                <?= $context->model instanceof \yii\base\Model && $context->attribute !== null
                    ? Html::activeFileInput($context->model, $context->attribute, $context->fieldOptions)
                    : Html::fileInput($context->name, $context->value, $context->fieldOptions);?>

            </span>
<!--            <a class="btn btn-primary start">-->
<!--                <i class="glyphicon glyphicon-upload"></i>-->
<!--                <span>--><?//= Yii::t('fileupload', 'Start upload') ?><!--</span>-->
<!--            </a>-->
<!--            <a class="btn btn-warning cancel">-->
<!--                <i class="glyphicon glyphicon-ban-circle"></i>-->
<!--                <span>--><?//= Yii::t('fileupload', 'Cancel upload') ?><!--</span>-->
<!--            </a>-->
            <a class="btn btn-danger delete">
                <i class="glyphicon glyphicon-trash"></i>
                <span><?= Yii::t('fileupload', 'Delete') ?></span>
            </a>
            <input type="checkbox" class="toggle">
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
        </div>
        <!-- The global progress state -->
        <div class="col-lg-5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped"><tbody class="files">
        <?php
        if($images){
            foreach($images as $img){
                ?>
                <tr data-class="<?=$img['class']?>" data-class_id="<?=$img['class_id']?>" data-id_image="<?=$img['id_image']?>"
                    data-order="<?=$img['order_image']?>" class="template-download fade in">
                    <td>
                <span class="preview">
                    <?php if($img['thumbnailUrl']){
                        ?>
                        <a href="<?=$img['url']?>" title="<?=$img['name']?>" download="<?=$img['name']?>" data-gallery><img src="<?=$img['thumbnailUrl']?>"></a>
                        <?php
                    }?>
                </span>
                    </td>
                    <td>
                        <p class="name">
                    <a href="<?=$img['url']?>" title="<?=$img['name']?>" download="<?=$img['name']?>"><?=$img['name']?></a>
                        </p>
                    </td>
                    <td>
                        <span class="size"><?=$img['size']?></span>
                    </td>
                    <td>
                        <button class="btn btn-danger delete" data-type="<?=$img['deleteType']?>" data-url="<?=$img['deleteUrl']?>">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span><?= Yii::t('fileupload', 'Delete') ?></span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody></table>
<script type="text/javascript">
    $(document).ready(function(){
        $('table.table-striped span.size').each(function(key){
            $(this).html(Smile.Image.calculateFileSize(parseInt($(this).html())));
        });
    });
</script>
<?= Html::endTag('div');?>
