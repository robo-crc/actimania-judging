<?php
// A bit of a hack, don't judge me.
$i = 1;

// TODO Refactor max limit in counting loop
?>
<div id="container">

    <div id="judge-long">
        <?= form_open('submit/' . $component, array('id' => $component)); ?>
        <fieldset>
            <legend>School information</legend>
            <a href="<?= $school_url ?>" title="<?= $school_name ?>" target="_blank"><?= $school_name; ?> [<?= $school_url ?>]</a>
        </fieldset>

        <fieldset>
            <legend>Reminders</legend>

            <ol>
                <?php for($i; $i <= 5; $i++) { ?>
                <li>
                    <p class="axis-text"><?= lang($component . '-axis-' . $i) ?></p>
                    <div class="slider" id="axis-<?= $i ?>-slider"></div>
                    <input type="text" value="1" name="axis-<?= $i ?>" id="axis-<?= $i ?>" class="input-hidden" />
                </li>
                <?php } ?>

            </ol>
        </fieldset>
        <fieldset>
            <legend><?= lang('axis-comments'); ?></legend>
            <textarea name="comment" class="comment" cols="80" rows="12"></textarea>
        </fieldset>
        <input type="hidden" name="judge_id" value="<?= $judge_id ?>" />
        <input type="hidden" name="school" value="<?= $school_id ?>" />
        <?= form_submit("submit", lang('submit')) ?>
        <?= form_close(); ?>
    </div>
</div>