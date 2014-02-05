<div id="container">
    <header>
        <h1><?= $component ?> Rank Entry</h1>
    </header>

    <div id="judge-long">
        <?= form_open('submit/kiosk', array('id' => 'kiosk')); ?>

        <fieldset>
            <legend>Enter a rank</legend>
            <?= form_dropdown('school', $school_list, null); ?>
        </fieldset>

        <fieldset>
            <legend>Reminders</legend>

            <ol>
                <li>
                    <p class="axis-text">The overall design, choice and combination of colours, fonts, and layout are appealing and conducive to a pleasant user experience.</p>
                    <div class="slider" id="axis-<?= $i ?>-slider"></div>
                    <input type="text" value="1" name="axis-<?= $i ?>" id="axis-<?= $i ?>" class="input-hidden" /><?php $i++ ?>
                </li>
                <li>
                    <p class="axis-text">The site structure, page structure and menu design makes finding information easy.</p>
                    <div class="slider" id="axis-<?= $i ?>-slider"></div>
                    <input type="text" value="1" name="axis-<?= $i ?>" id="axis-<?= $i ?>" class="input-hidden" /><?php $i++ ?>
                </li>
                <li>
                    <p class="axis-text">There is some aspect of user / social interaction.</p>
                    <div class="slider" id="axis-<?= $i ?>-slider"></div>
                    <input type="text" value="1" name="axis-<?= $i ?>" id="axis-<?= $i ?>" class="input-hidden" /><?php $i++ ?>
                </li>
                <li>
                    <p class="axis-text">There are no uncaught exceptions, broken links or broken images.</p>
                    <div class="slider" id="axis-<?= $i ?>-slider"></div>
                    <input type="text" value="1" name="axis-<?= $i ?>" id="axis-<?= $i ?>" class="input-hidden" /><?php $i++ ?>
                </li>
                <li>
                    <p class="axis-text">The site’s code is well-formed and validates.</p>
                    <div class="slider" id="axis-<?= $i ?>-slider"></div>
                    <input type="text" value="1" name="axis-<?= $i ?>" id="axis-<?= $i ?>" class="input-hidden" /><?php $i++ ?>
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>Comments</legend>
            <textarea class="comment" cols="80" rows="12"></textarea>
        </fieldset>
        <input type="hidden" value="<?= $judge_id ?>" />
        <?= form_submit("submit", "Submit Critique") ?>
        <?= form_close(); ?>
    </div>
</div>