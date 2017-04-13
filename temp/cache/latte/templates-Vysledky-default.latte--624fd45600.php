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
		if (isset($this->params['soutezici'])) trigger_error('Variable $soutezici overwritten in foreach on line 15');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    <table id="kategorieTable" class="display nowrap" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>number</th>
            <th>jmeno</th>
            <th>prijmeni</th>
            <th>rocnik</th>
            <th>kategorie</th>
            <th>time</th>
            <th>spent</th>
        </tr>
        </thead>
        <tbody>
<?php
		$iterations = 0;
		foreach ($data as $soutezici) {
?>        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->start_number) /* line 16 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->first_name) /* line 17 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->last_name) /* line 18 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->birth_year) /* line 19 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->ref('category','category')->name) /* line 20 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici->finish_time->sub($soutezici->finish_time), '%H:%i:%s')) /* line 21 */ ?></td>
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
            $('#kategorieTable').dataTable( {
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
