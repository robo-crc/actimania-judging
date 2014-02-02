<div id="container">

    <div id="judge-long">

        <section>
            <header>
                <h1><?= $cards[0]['name'] . " (" . $component . ")" ?> </h1>
<!--				<h2>Points: --><?//= $points ?><!--</h2>-->
				<h2>Rank: <?= $rank ?></h2>
            </header>

            <div class="group">
            <?php
                foreach ($cards as $row)
                {
                    echo '<div class="cards">';

                    if (($component == "video" ||  $component == "journalism") && $row !== false)
                    {
//                        echo sprintf('<div class="boolean %s" title="%s"></div>', $row[1], lang($component . '-axis-1'));
						echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">%s</span></div>', lang($component . '-axis-1'), $row[1]);
						echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-2'), $row[2]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-3'), $row[3]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-4'), $row[4]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-5'), $row[5]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-6'), $row[6]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-7'), $row[7]);

						echo sprintf('<div class="card"><span class="comment">%s:</span>&nbsp;<span>%s</span></div>', lang('axis-comments'), htmlspecialchars($row['comments']));
                    } elseif ($component == "web" && $row !== false) {
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-1'), $row[1]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-2'), $row[2]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-3'), $row[3]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-4'), $row[4]);
                        echo sprintf('<div class="card"><span class="axis">%s</span>&nbsp;<span class="value">(%s/5)</span></div>', lang($component . '-axis-5'), $row[5]);

						echo sprintf('<div class="card"><span class="comment">%s:</span>&nbsp;<span>%s</span></div>', lang('axis-comments'), htmlspecialchars($row['comments']));
                    }

                    echo "</div>";
                }
            ?>
            </div>

    </div>
    </section>
</div>