<?php
if ($model->hasErrors()) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger display">
                <button class="close" data-close="alert"></button>
                <ul>
                    <?php
                    $errors = $model->getErrors();
                    foreach ($errors as $error) {
                        echo '<li>' . $error[0] . '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
}
?>
