<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="main-container page-container">
    <section class="new-task">
        <div class="new-task__wrapper">
            <h1>Новые задания</h1>
            <?php foreach ($data as $task): ?>
            <div class="new-task__card">
                <div class="new-task__title">
                    <a href="#" class="link-regular"><h2><?= $task['name'];?></h2></a>
                    <a class="new-task__type link-regular" href="#"><p><?= $task['category'];?></p></a>
                </div>
                <div class="new-task__icon new-task__icon--<?= $task['icon'];?>"></div>
                <p class="new-task_description">
                    <?= $task['description'];?>
                </p>
                <b class="new-task__price new-task__price--<?= $task['icon'];?>"><?= $task['budget'];?><b> ₽</b></b>
                <p class="new-task__place"><?= $task['city'];?></p>
                <span class="new-task__time"><?= $task['registration_date'];?></span>
            </div>
            <?php endforeach;?>
        </div>
        <div class="new-task__pagination">
            <ul class="new-task__pagination-list">
                <li class="pagination__item"><a href="#"></a></li>
                <li class="pagination__item pagination__item--current">
                    <a>1</a></li>
                <li class="pagination__item"><a href="#">2</a></li>
                <li class="pagination__item"><a href="#">3</a></li>
                <li class="pagination__item"><a href="#"></a></li>
            </ul>
        </div>
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
                    'name' => 'test'
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
                    <?= $f->field($form, 'no_replies', [
                        'template' => '{input}{label}'
                    ])->checkbox([
                        'class' => 'visually-hidden checkbox__input'
                    ], false); ?>

                    <?= $f->field($form, 'remote_work', [
                        'template' => '{input}{label}'
                    ])->checkbox([
                        'class' => 'visually-hidden checkbox__input'
                    ], false); ?>
                </fieldset>

                <?= $f->field($form, 'period', [
                    'template' => '{label}{input}',
					'labelOptions' => ['class' => 'search-task__name']
                ])->dropDownList([
                    'day' => 'За день',
                    'week' => 'За неделю',
                    'month' => 'За месяц'
                ], [
                    'class' => 'multiple-select input',
                ]); ?>

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
