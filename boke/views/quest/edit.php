<?php
use yii\helpers\Url;
?>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<header class="row">
    <nav class="col-sm-1  col-lg-1">
        <ul>
            <li  class="active">
                <a href="javascript:;">修改问题</a>
            </li>
        </ul>
    </nav>
</header>

<div class="row">
     <div class="col-sm-12  col-lg-12 panel-body">
        <div class="row col-sm-12  col-lg-12 ">
            <form class="form-horizontal" role="form" action="" method="post">
                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">标题</a>
                    <div class="require-star">*</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="title" value="<?=$quest->title?>" required placeholder="请输入标题">
                    </div>
                </div>

                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">排序</a>
                    <div class="require-star">*</div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="name" name="sort"  value="<?=$quest->sort?>" required placeholder="排序数字越大越靠前">
                    </div>
                </div>
                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">是否显示</a>
                    <div class="require-star">*</div>
                    <div class="col-sm-6">
                        <select class="form-control m-bot15 font-col" id="cate_one" name="isshow" required>
                            <option value="1"  <?=$quest->isshow==1?'selected':''?>>显示</option>
                            <option value="0"  <?=$quest->isshow==0?'selected':''?>>不显示</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">简介</a>
                    <div class="col-sm-6">
                        <textarea name="intro" class="form-control" id="intro" cols="30" rows="5" ><?=$quest->intro?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">正文</a>
                    <div class="col-sm-9">
                        <textarea name="content"  id="content" cols="30" rows="200" style="height:500px;" required><?=$quest->content?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" id="subbtn" class="btn search-btn">确认修改</button>
                    </div>
                </div>
            </form>

        </div>



     </div>
</div>
<script>
    $(function(){
        var ue = UE.getEditor('content');
    })
</script>