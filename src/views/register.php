<?php
use framework\core\Application;
use framework\core\forms\Form;
use framework\core\View;
/** @var $this View */

?>

<section>
    <div class="container">
        <?php $form = Form::begin('', 'post'); ?>
            <div class="row">
                <div class="col-sm-6">
                    <?php echo $form->field($model, 'usr_fname'); ?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->field($model, 'usr_lname'); ?>
                </div>
            </div>

            <?php echo $form->field($model, 'cmny'); ?>

            <?php echo $form->field($model, 'usr_email')->emailField(); ?>

            <?php echo $form->field($model, 'usr_pass')->passwordField(); ?>

            <?php echo $form->field($model, 'rpass')->passwordField(); ?>

            <input type="submit" name="submit" value="Register" />
        <?php $form::end() ?>
    </div>
</section>
