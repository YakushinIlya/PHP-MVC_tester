<?php if ($auth==0) : ?>
      <li class="nav-item">
      <a href="<?=$url?>" class="<?=$class?>"><?=$head?></a>
      </li>
<?php elseif ($auth==1) : ?>
      <li class="nav-item">
      <a href="<?=$url?>" class="<?=$class?>"><?=$head?></a>
      </li>
<?php endif; ?>
