<?php
use framework\core\Application;
use framework\core\forms\Form;
use framework\core\View;
/** @var $this View */

?>

<section>
    <div class="container">
        <?php $form = Form::begin('', 'post'); ?>

            <?php echo $form->field($model, 'usr_lname'); ?>

        <?php $form::end() ?>
    </div>
</section>
