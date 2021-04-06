<?php

/* @var $this yii\web\View */

$this->title = 'Категории';
?>
<a class="btn btn-success" href="/message">Отправить сообщение</a>
<div class="site-index">
    <h1>Категории</h1>
    <?if(is_array($categories)):?>
    <ul>
    <?foreach ($categories as $category):?>
     <li><?=$category->name?></li>
    <?endforeach?>
    </ul>
    <?endif?>
</div>
