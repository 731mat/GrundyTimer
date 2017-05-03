<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Vysledky/sub.latte

use Latte\Runtime as LR;

class Templatea78a703b43 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<table id="souetziciTable" class="display nowrap" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>St.č</th>
        <th>Jméno</th>
        <th>Přijmeni</th>
        <th>Tým</th>
        <th>Ročník</th>
        <th>Kategorie</th>
        <th>Čas</th>
<?php
		for ($i = 0;
		$i < $maxCulom;
		$i++) {
			?>            <th>kolo<?php echo LR\Filters::escapeHtmlText($i+1) /* line 12 */ ?></th>
<?php
		}
?>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>St.č</th>
        <th>Jméno</th>
        <th>Přijmeni</th>
        <th>Tým</th>
        <th>Ročník</th>
        <th>Kategorie</th>
        <th>Čas</th>
<?php
		for ($i = 0;
		$i < $maxCulom;
		$i++) {
			?>            <th>kolo<?php echo LR\Filters::escapeHtmlText($i+1) /* line 26 */ ?></th>
<?php
		}
?>
    </tr>
    </tfoot>
    <tbody>
<?php
		$iterations = 0;
		foreach ($data as $soutezici) {
?>    <tr>
        <td><?php echo LR\Filters::escapeHtmlText($soutezici['start_number']) /* line 32 */ ?></td>
        <td><?php echo LR\Filters::escapeHtmlText($soutezici['first_name']) /* line 33 */ ?></td>
        <td><?php echo LR\Filters::escapeHtmlText($soutezici['last_name']) /* line 34 */ ?></td>
        <td><?php echo LR\Filters::escapeHtmlText($soutezici['team']) /* line 35 */ ?></td>
        <td><?php echo LR\Filters::escapeHtmlText($soutezici['birth_year']) /* line 36 */ ?></td>
        <td><?php echo LR\Filters::escapeHtmlText($soutezici['categoryName']) /* line 37 */ ?></td>
<?php
			if (!$soutezici['dfn']) {
				?>            <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici['rozdil'], '%H:%I:%S')) /* line 39 */ ?></td>
<?php
			}
			else {
?>
            <td>DFN</td>
<?php
			}
			for ($x = 0;
			$x< $maxCulom;
			$x++) {
?>        <td>
            <?php
				if (!(sizeof($soutezici['casy']) <= $x)) {
?>

                <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici['casy'][$x], '%H:%I:%S')) /* line 45 */ ?>

<?php
				}
?>
        </td>
<?php
			}
?>
    </tr>
<?php
			$iterations++;
		}
?>
    </tbody>
</table><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['soutezici'])) trigger_error('Variable $soutezici overwritten in foreach on line 31');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}

}
