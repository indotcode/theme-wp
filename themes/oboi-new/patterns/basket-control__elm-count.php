<?php if(!empty($_SESSION['basket'][$data['ID']])){ ?>
    <a href="/basket" class="basket-control__elm-count">+ <span><?=$_SESSION['basket'][$data['ID']]?></span></a>
<?php } ?>