<div id="container">
	<div id="body-welcome">
        <div id="message"><?= lang('judge-welcome-message'); ?></div>

        <!-- Web Site -->
        <?= form_open('judge/web/'); ?>
            <fieldset>
            <legend><?= lang('page-header-web'); ?></legend>
            <span class="welcome-left-container">
                <?= form_dropdown('school_id', $web, null, 'class="ui-button ui-widget ui-state-default ui-corner-all"'); ?>
                <?= form_submit('web-submit', lang('judge-this-entry')); ?>
            </span>
            <span class="huge">»</span>
            <span class="welcome-right-container">
                <a href="<?= base_url() . "judge/web/overall"; ?>" class="big-button"><?= lang('proceed-to-overall') . " " . lang('page-header-web') . " " .  lang('overall'); ?></a>
            </span>
            </fieldset>
        <?= form_close(); ?>

        <!-- Journalism -->
        <?= form_open('judge/journalism/'); ?>
        <fieldset>
            <legend><?= lang('page-header-journalism'); ?></legend>
            <span class="welcome-left-container">
                <?= form_dropdown('school_id', $journalism, null, 'class="ui-button ui-widget ui-state-default ui-corner-all"'); ?>
                <?= form_submit('journalism-submit', lang('judge-this-entry')); ?>
            </span>
            <span class="huge">»</span>
            <span class="welcome-right-container">
                <a href="<?= base_url() . "judge/journalism/overall"; ?>" class="big-button"><?= lang('proceed-to-overall') . " " . lang('page-header-journalism') . " " .  lang('overall'); ?></a>
            </span>
        </fieldset>
        <?= form_close(); ?>

        <!-- Video -->
        <?= form_open('judge/video/'); ?>
        <fieldset>
            <legend><?= lang('page-header-video'); ?></legend>
            <span class="welcome-left-container">
                <?= form_dropdown('school_id', $video, null, 'class="ui-button ui-widget ui-state-default ui-corner-all"'); ?>
                <?= form_submit('video-submit', lang('judge-this-entry')); ?>
            </span>
            <span class="huge">»</span>
            <span class="welcome-right-container">
                <a href="<?= base_url() . "judge/video/overall"; ?>" class="big-button"><?= lang('proceed-to-overall') . " " . lang('page-header-video') . " " .  lang('overall'); ?></a>
            </span>
        </fieldset>
        <?= form_close(); ?>

        <!-- Overall -->
<!--
        <fieldset>
            <legend><?= lang('page-header-overall'); ?></legend>
            <span class="welcome-left-container">
                <a href="<?= base_url() . "judge/kiosk/overall"; ?>" class="big-button"><?= lang('proceed-to-overall') . " " . lang('page-header-kiosk') . " " .  lang('overall'); ?></a>
            </span>

            <span class="welcome-left-container">
                <a href="<?= base_url() . "judge/build/overall"; ?>" class="big-button"><?= lang('proceed-to-overall') . " " . lang('page-header-build') . " " .  lang('overall'); ?></a>
            </span >

            <span class="welcome-left-container">
                <a href="<?= base_url() . "judge/design/overall"; ?>" class="big-button"><?= lang('proceed-to-overall') . " " . lang('page-header-design') . " " .  lang('overall'); ?></a>
            </span>
        </fieldset>
-->

 	</div>


</div>