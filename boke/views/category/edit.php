<?php
use yii\helpers\Url;
?>
<header class="row">
    <nav class="col-sm-2  col-lg-2">
        <ul>
            <li  class="active">
                <a href="javascript:;">修改分类--<?=$cate_name?></a>
            </li>
        </ul>
    </nav>
</header>

<div class="row">
     <div class="col-sm-12  col-lg-12 panel-body">
        <div class="row col-sm-12  col-lg-12 ">
            <form class="form-horizontal" role="form" action="" method="post">
                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">分类名称</a>
                    <div class="require-star">*</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="cate_name" required placeholder="请输入分类名称" value="<?=$cate_name?>">
                    </div>
                </div>
                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">排序</a>
                    <div class="require-star">*</div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="name" name="sort" required placeholder="排序数字越小越靠前" value = "<?=$sort?>">
                    </div>
                </div>
                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">是否显示</a>
                    <div class="require-star">*</div>
                    <div class="col-sm-6">
                        <select class="form-control m-bot15 font-col" id="cate_one" name="isshow" required>
                            <option value="1" <?= $isshow==1?'selected="selected"':''?>>显示</option>
                            <option value="0" <?= $isshow==0?'selected="selected"':''?>>不显示</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <a class="col-sm-1 btn search-btn">排序字段</a>
                    <div class="require-star">*</div>
                    <div class="col-sm-6">
                        <select class="form-control m-bot15 font-col" id="cate_one" name="q_sort" required>
                            <option value="create_time,desc" <?= $q_sort=='create_time,desc'?'selected="selected"':''?>>时间倒叙</option>
                            <option value="create_time,asc" <?=$q_sort=='create_time,asc'?'selected="selected"':''?>>时间正序</option>
                            <option value="praise,desc" <?= $q_sort=='praise,desc'?'selected="selected"':''?>>点赞数倒叙</option>
                            <option value="praise,asc" <?= $q_sort=='praise,asc'?'selected="selected"':''?>>点赞数正序</option>
                        </select>
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