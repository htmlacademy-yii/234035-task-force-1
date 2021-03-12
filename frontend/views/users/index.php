<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="main-container page-container">
    <section class="user__search">
        <div class="user__search-link">
            <p>Сортировать по:</p>
            <ul class="user__search-list">
                <li class="user__search-item user__search-item--current">
                    <a href="#" class="link-regular">Рейтингу</a>
                </li>
                <li class="user__search-item">
                    <a href="#" class="link-regular">Числу заказов</a>
                </li>
                <li class="user__search-item">
                    <a href="#" class="link-regular">Поsdfпулярности</a>
                </li>
            </ul>
        </div>
        <?php foreach ($data as $task): ?>
        <div class="content-view__feedback-card user__search-wrapper">
            <div class="feedback-card__top">
                <div class="user__search-icon">
                    <a href="#"><img src="<?= $task['avatar'];?>" width="65" height="65"></a>
                    <span><?= $task['tasks_count'] . ' заданий';?></span>
                    <span><?= $task['opinions_count'] . ' отзывов';?></span>
                </div>
                <div class="feedback-card__top--name user__search-card">
                    <p class="link-name"><a href="#" class="link-regular"><?= $task['name']?></a></p>
                    <?php
                    $stars = floor($task['rate']);
                    for ($i = 0; $i < 5; $i++) {
                    if ($stars > 0) { $stars--; ?>
                        <span></span>
                    <? } else { ?>
                        <span class="star-disabled"></span>
                    <? }
                    }
                    ?>
                    <b><?= $task['rate'];?></b>
                    <p class="user__search-content">
                        <?= $task['info'];?>
                    </p>
                </div>
                <span class="new-task__time"><?= $task['online'];?></span>
            </div>
            <div class="link-specialization user__search-link--bottom">
                <a href="#" class="link-regular">Ремонт</a>
                <a href="#" class="link-regular">Курьер</a>
                <a href="#" class="link-regular">Оператор ПК</a>
            </div>
        </div>
        <?php endforeach;?>
    </section>
    <section  class="search-task">
        <div class="search-task__wrapper">
            <?php $f = ActiveForm::begin([
                'fieldConfig' => [
                    'options' => [
                        'tag' => false,
                    ],
                ],
                'options' => [
                    'class' => 'search-task__form',
                    'name' => 'users'
                ]
            ]) ?>
                <fieldset class="search-task__categories">
                    <legend>Категории</legend>
                    <?= $f->field($form, 'categories', [
                        'template' => '{input}{label}'
                    ])->checkboxList(array_column($categories, 'name', 'id'), [
                        'item' => function ($index, $label, $name, $checked, $value) {
                            $checked = $checked ? 'checked ' : '';
                            return "<input class=\"visually-hidden checkbox__input\" id='{$index}' type='checkbox' name='{$name}' value='{$value}' $checked>
                                    <label for='{$index}'>{$label}</label>";
                        }
                    ])->label(false); ?>
                </fieldset>
                <fieldset class="search-task__categories">
                    <legend>Дополнительно</legend>
                    <?= $f->field($form, 'free_now', [
                        'template' => '{input}{label}'
                    ])->checkbox([
                        'class' => 'visually-hidden checkbox__input'
                    ], false); ?>
                    <?= $f->field($form, 'online_now', [
                        'template' => '{input}{label}'
                    ])->checkbox([
                        'class' => 'visually-hidden checkbox__input'
                    ], false); ?>
                    <?= $f->field($form, 'is_opinions', [
                        'template' => '{input}{label}'
                    ])->checkbox([
                        'class' => 'visually-hidden checkbox__input'
                    ], false); ?>
                    <?= $f->field($form, 'in_favorites', [
                        'template' => '{input}{label}'
                    ])->checkbox([
                        'class' => 'visually-hidden checkbox__input'
                    ], false); ?>
                </fieldset>
                <?= $f->field($form, 'search', [
                    'template' => '{label}{input}',
                    'labelOptions' => [
                        'class' => 'search-task__name',
                    ]
                ])->input('search', [
                    'class' => 'input-middle input'
                ]); ?>
                <?= Html::submitButton('Искать',[
                    'class' => 'button'
                ])?>
            <?php ActiveForm::end(); ?>
        </div>
    </section>
</div>
