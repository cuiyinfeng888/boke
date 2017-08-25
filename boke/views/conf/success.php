<?php
   if(empty($msg)){
     $msg = '操作成功';
   }
   if(empty($url)){
     $url = '/';
   }
  if(empty($time)){
    $time = 5;
  }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$msg?></title>
  <link rel="stylesheet" href="/css/success.css">
  <script src="/js/jquery.js"></script>
</head>
<body>
 <div id="msgbox">
      <div id ='mainmsg'>
        <?=$msg?>
      </div>
     <div id="sec_msg">页面跳转中……</div>
   <a href="<?=$url?>" class="btn">立即跳转</a>
   <div class="time">
           <?=$time?>
   </div>
 </div>
</body>
</html>
<script>
  $(function(){
     var daojishi = function(){
       var time = parseInt($('.time').html());
       time--;
       if(time==0){
         location.href = '<?=$url?>';
         return;
       }
       $('.time').html(time);
     };
    var timer = setInterval(daojishi,1000);
  })
</script>