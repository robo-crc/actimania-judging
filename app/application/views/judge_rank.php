<div id="container">

    <div id="judge-long">

        <div class="ui-state-highlight ui-corner-all">
            <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            <?= lang('rating-pre-ordered'); ?>
        </div>

        <?= form_open('submit/overall/' . $component, array('id' => $component)); ?>

        <fieldset>
            <legend><?= lang('please-rank'); ?> (<?= $component ?>)</legend>
            <div id="rank-<?= $component ?>" class="sortable">
            <?php
                foreach ($rubric_matrix as $row)
                {
                    echo sprintf('<div id="%s" class="school sortable-element ui-state-default" xmlns="http://www.w3.org/1999/html"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><span class="schoolname">%s</span> <span class="schoollink"><a href="%s" target="_blank">[%s]</a></span>', $row['id'], $row['name'], $row['url'], lang('link'));

                    if (($component == "video" ||  $component == "journalism") && $row !== false)
                    {
                        echo sprintf('<div class="boolean %s" title="%s"></div>', $row[1], lang($component . '-axis-1'));
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-2'), $row[2]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-3'), $row[3]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-4'), $row[4]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-5'), $row[5]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-6'), $row[6]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-7'), $row[7]);
                        echo sprintf('<div class="comments">%s: %s</div>', lang('axis-comments'), htmlspecialchars($row['comments']));
                    } elseif ($component == "web" && $row !== false) {
	                    echo sprintf('<div class="boolean %s" title="%s"></div>', $row[6], lang($component . '-axis-6'));
	                    echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-1'), $row[1]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-2'), $row[2]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-3'), $row[3]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-4'), $row[4]);
                        echo sprintf('<div class="progressbar" title="%s" data-value="%s"></div>', lang($component . '-axis-5'), $row[5]);

                        echo sprintf('<div class="comments">%s: %s</div>', lang('axis-comments'), htmlspecialchars($row['comments']));
                    } elseif ($row == false) {
                        echo sprintf('<span class="todo-warning">%s</span>', lang('not-yet-judged'));
                    }

                    echo "</div>";
                }
            ?>
            </div>
        </fieldset>
        <?php if (isset($missing) && $missing != null) { ?>
        <fieldset>
            <legend><?= lang('not-yet-judged') ?></legend>
            <ol id="missing">
            <?php
                foreach ($missing as $row)
                {
                    echo sprintf('<li title="%s">%s</li>', $row['name'], $row['name']);
                }
            ?>
            </ol>
        </fieldset>
        <?php } ?>

        <input type="hidden" name="judge_id" value="<?= $judge_id ?>" />
        <input type="hidden" id="sort_order" name="sort_order" value="" />
        <input type="hidden" value="component" value="<?= $component ?>" />
        <?= form_submit("submit", lang('submit')) ?>
        <?= form_close(); ?>
    </div>
</div>