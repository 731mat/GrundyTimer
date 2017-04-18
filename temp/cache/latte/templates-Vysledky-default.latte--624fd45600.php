<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Vysledky/default.latte

use Latte\Runtime as LR;

class Template624fd45600 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'scripts' => 'blockScripts',
		'head' => 'blockHead',
	];

	public $blockTypes = [
		'content' => 'html',
		'scripts' => 'html',
		'head' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
?>

<?php
		$this->renderBlock('scripts', get_defined_vars());
?>


<?php
		$this->renderBlock('head', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['cas'])) trigger_error('Variable $cas overwritten in foreach on line 25');
		if (isset($this->params['soutezici'])) trigger_error('Variable $soutezici overwritten in foreach on line 18');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    <table id="vysledkyTable" class="display nowrap" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>number</th>
            <th>jmeno</th>
            <th>prijmeni</th>
            <th>rocnik</th>
            <th>kategorie</th>
            <th>time</th>
<?php
		for ($i = 0;
		$i <= $maxCulom;
		$i++) {
			?>                <th>kolo<?php echo LR\Filters::escapeHtmlText($i) /* line 12 */ ?></th>
<?php
		}
?>
            <th></th>
        </tr>
        </thead>
        <tbody>
<?php
		$iterations = 0;
		foreach ($data as $soutezici) {
?>        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['start_number']) /* line 19 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['first_name']) /* line 20 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['last_name']) /* line 21 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['birth_year']) /* line 22 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['categoryName']) /* line 23 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici['rozdil'], '%H:%i:%s')) /* line 24 */ ?></td>
<?php
			$iterations = 0;
			foreach ($soutezici['casy'] as $cas) {
?>            <td>
                <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $cas, '%H:%i:%s')) /* line 26 */ ?>

            </td>
<?php
				$iterations++;
			}
?>
        </tr>
<?php
			$iterations++;
		}
?>
        </tbody>
    </table>

<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
?>
    <script>
        $(document).ready(function(){
            $('#vysledkyTable').dataTable( {
                "lengthChange": false,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>
<?php
	}


	function blockHead($_args)
	{
		
	}

}
