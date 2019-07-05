<?php

/* @var $this yii\web\View */

$this->title = '编辑';

use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\web\View;

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

AppAsset::register($this);

if (isset($js_list)) {
    foreach ($js_list as $k => $href) {
        AppAsset::addScript($this, Url::home() . $href);
    }
}
if (isset($css_list)) {
    foreach ($css_list as $k => $href) {
        AppAsset::addCss($this, Url::home() . $href);
    }
}

?>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
            <div style="float: right">
                <!-- 按钮触发模态框 -->
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">append归档标签</button>
            </div>
            <div style="margin-top: 100px;">
                <form action="<?= $action?>" method="post">
                    <div class="form-group">
                        <label for="" class="control-label">标题</label>
                        <input type="text" class="form-control" name="title" required
                               value="<?= $keyword['title'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">摘要</label>
                        <input type="text" class="form-control" name="subtitle" required
                               value="<?= $keyword['subtitle'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">标签</label>
                        <select name="tag_id" id="tag_id" class="selected chosen-select" data-placeholder="请选择">
                            <option value="">请选择</option>
                            <?php foreach ($tag as $key => $item): ?>
                                <option value="<?= $item['id'];?>"
                                    <?= isset($keyword['tag_id']) && ($keyword['tag_id'] == $item['id']) ? "selected": '' ?> ><?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">可见范围</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio"  value="1" name="status" <?php if (isset($keyword['status']) && intval($keyword['status']) == 1) echo "checked"?> >公开
                            </label>
                            <label class="radio-inline">
                                <input type="radio"  value="-1" name="status" <?php if (isset($keyword['status']) && intval($keyword['status']) == -1) echo "checked"?>>私密
                            </label>
                        </div>
                    </div>

                    <label for="" class="control-label">内容</label>
                    <div class="form-group" id="editor">
                        <textarea style="display:none;" name="editor_markdown_code"><?= $keyword['content'] ?? '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">提交</button>
                    </div>
                </form>
            </div>
            <!-- 模态框（Modal） -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">归档标签</h4>
                        </div>
                        <form class="form-horizontal" role="form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label col-sm-2">归档标签</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tagName" value=""
                                               placeholder="标签：PHP">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary" id="tag-form">确定</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>
            <!-- 模态框（Modal）END -->
        </div>
    </div>
</div>
<script>
    <?php $this->beginBlock('js_end') ?>
    $(function () {
        $(".chosen-select").chosen({
            disable_search_threshold: 9,   //当选项小于10个隐藏搜索
            allow_single_deselect: true,    //允许取消选择单个选择
            no_results_text: "没有找到匹配的结果",
            width: "100%"
        });

        $("#tag-form").click(function () {
            let tagName = $("input[name='tagName']").val();
            if (tagName === '') {
                Swal({title: "温馨提醒", html: "<h5>标签不能为空!</h5>", type: "warning"})
            } else {
                $.ajax({
                    type: "POST",
                    url: "/home/tag-add/",
                    data: {"tagName": tagName},
                    dataType: "json",
                    success: function (res) {
                        console.log(res);
                        if (res.status) {
                            Swal({title: "温馨提醒", html: "<h5>" + res.msg + "</h5>", type: "success"}).then((result) => {
                                console.log(result);
                                if (result.value) {
                                    $('#myModal').modal('hide');
                                }
                            })
                        } else {
                            Swal({title: "温馨提醒", html: "<h5>" + res.msg + "</h5>", type: "error"})
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.readyState)
                    }
                });
            }
        });
    });
    <?php $this->endBlock(); ?>
</script>

<?php $this->registerJs($this->blocks['js_end'], View::POS_END); ?>
