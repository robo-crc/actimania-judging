<section id="content">
<!--
        <?php
        if ($flags)
        {
            echo '<section id="flags"><header>FLAGGED</header><ul>';
            foreach ($flags as $school)
            {
                echo sprintf('<li>%s</li>', $school);
            }
            echo "</ul></section>";
        }
        ?>
-->
    <section id="results">
        <?php
            $this->table->set_caption(lang('result-table-caption') . " " . $component);
            $this->table->set_heading( array(
//                lang('result-table-school-rank'),
//                lang('result-table-school-id'),
                lang('result-table-school-name'),
                lang('result-table-school-score'),
                "Link",
            ));

            // A bit of a hack, don't judge me.
            $i = 29;
			$j = 1;
            foreach ($schools as $id => $score)
            {
				$result_link = sprintf('<a href="/results/team_report?c=%s&s=%s&p=%s&r=%s">Results</a>', $component, $id, isset($score->score) ? $i : 0, $j);
//                $this->table->add_row($id, $score->name, isset($score->score) ? $i : 0, $result_link);
//                $this->table->add_row($i, $id, $score->name, isset($score->score) ? $i : 0);
                $this->table->add_row($score->name, $score->score, $result_link);
                $i--;
				$j++;
            }

            echo $this->table->generate();
        ?>
    </section>
</section>