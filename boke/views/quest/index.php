<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<header class="row">
    <nav class="col-sm-1 col-lg-1">
        <ul>
            <li  class="active">
                <a href="javascript:;">问题列表</a>
            </li>
        </ul>
    </nav>
</header>

<div class="row">
     <div class="col-sm-12  col-lg-12 panel-body">
         <div class="row">
             <div class=" col-md-1 col-sm-12 col-lg-1">
                 <div class="form-group">
                     <label for="cate" class=" col-md-12 col-sm-12 col-lg-12">共 <?=$count;?> 个 问 题</label>
                 </div>
             </div>
             <div class=" col-md-3 col-sm-12 col-lg-3">
                 <div class="form-group">
                     <label for="cate" class="col-sm-3">前台显隐</label>
                     <div class="col-sm-9">
                         <select class="form-control m-bot15 font-col" id="isshow">
                             <option value="0">是否在前台显示</option>
                             <option value="2" <?= $isshow==2?'selected="selected"':''?>>显示</option>
                             <option value="1" <?= $isshow==1?'selected="selected"':''?>>隐藏</option>
                         </select>
                     </div>
                 </div>
             </div>
             <div class="form-group col-md-3 col-sm-12 col-lg-3">
                 <label for="cate" class="col-sm-3">关键词</label>
                 <div class="input-group m-bot15">
                     <input type="text" class="form-control" id="keyword"  value="<?=$keyword?>" placeholder="请输入您要搜索的内容">
                        <span class="input-group-btn">
                            <button id="searchbtn" class="btn search-btn" type="button" style="width:60px"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                     </input>
                 </div>
             </div>
             <div class="form-group col-md-1 col-sm-12 col-lg-1">
                 <a id="getdatabtn" href="<?=Url::toRoute('/quest/add')?>" class="btn btn-warning">添加问题</a>
             </div>
         </div>
         <section id="no-more-tables">
             <table class="table table-bordered table-striped table-condensed cf wxgzh">
                   <thead>
                       <th width="10%" class="blue-bg">序号</th>
                       <th width="40%" class="blue-bg">标题</th>
                       <th width="10%" class="blue-bg">排序</th>
                       <th width="10%" class="blue-bg">是否显示</th>
                       <th width="10%" class="blue-bg">浏览次数</th>
                       <th width="10%" class="blue-bg">添加时间</th>
                       <th width="10%" class="blue-bg">编辑</th>
                   </thead>
                   <tbody>
                    <?php if(empty($list)):?>
                        <tr>
                            <td colspan="7">暂无分类数据</td>
                        </tr>

                    <?php else:?>
                        <?php foreach($list as $k=>$v): ?>
                           <tr>
                               <td><?=$k+1?></td>
                               <td><?=$v['title']?></td>
                               <td><?=$v['sort']?></td>
                               <td>
                                   <?=$v['isshow']?'显示':'不显示'?>
                               </td>
                               <td>
                                   <?=$v['view_times']?>
                               </td>
                               <td>
                                   <?=$v['create_time']?>
                               </td>
                               <td class="last-td" myid="<?=$v['id']?>"><a href="<?=Url::toRoute(['/quest/edit','id'=>$v['id']])?>" class="glyphicon glyphicon-pencil"></a> | <a  href="javascript:;"  class="glyphicon glyphicon-trash"></a></td>
                           </tr>
                        <?php endforeach?>
                      <?php endif ?>
                   </tbody>
             </table>
         </section>
         <div class="col-sm-12  col-lg-12 pager">
             <?=  LinkPager::widget([
                 'pagination' => $pager,
                 'nextPageLabel' => '下一页',
                 'prevPageLabel' => '上一页',
                 'firstPageLabel' => '首页',
                 'lastPageLabel' => '尾页',
             ]);
             ?>
         </div>
     </div>
</div>
<script>
    $(function(){
        $('#searchbtn').click(function(){
            var show = $.trim($('#isshow option:selected').val());
            var name = $.trim($('#keyword').val());
            if(show||name){
                location.href = '?isshow='+show+'&keyword='+name;
            }else{
                alert('请选择要搜索的条件！')
            }
        });
        $('.glyphicon-trash').click(function(){
            if(confirm('确定要删除此问题吗？')){
                var id = $(this).parent('td').attr('myid');
                location.href = '/category/del?id='+id;
            }
        })
    })
</script>