<?php if ($_POST['auth']==0) : ?>
      <li class="nav-item">
      <a href="<?=$_POST['url']?>" class="<?=$_POST['class']?>"><?=$_POST['head']?></a>
      </li>
<?php elseif ($_POST['auth']==1) : ?>
      <li class="nav-item">
      <a href="<?=$_POST['url']?>" class="<?=$_POST['class']?>"><?=$_POST['head']?></a>
      </li>
<?php endif; ?>
