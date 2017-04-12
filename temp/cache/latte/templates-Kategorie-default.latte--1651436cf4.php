<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Kategorie/default.latte

use Latte\Runtime as LR;

class Template1651436cf4 extends Latte\Runtime\Template
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
		if (isset($this->params['kategorie'])) trigger_error('Variable $kategorie overwritten in foreach on line 15');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		?>    <a role="button" class="btn btn-default"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("add")) ?>">Přidat</a>
    <table id="kategorieTable" class="display nowrap" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>id</th>
            <th>nazev</th>
            <th>pocet kol</th>
            <th>min time</th>
            <th>start time</th>
            <th class="text-center">Akce</th>
        </tr>
        </thead>
        <tbody>
<?php
		$iterations = 0;
		foreach ($data as $kategorie) {
?>        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($kategorie->id) /* line 16 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($kategorie->name) /* line 17 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($kategorie->count_round) /* line 18 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $kategorie->min_time, '%H:%M:%S')) /* line 19 */ ?></td>
            <td><?php
			if ($kategorie->start_time == NULL) {
				?>pokus<?php
			}
			else {
				?>pok<?php
			}
?></td>
            <td><a class="btn btn-primary" role="button" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit", [$kategorie->id])) ?>"><i class="fa fa-edit"></i> edit</a>
                <a class="btn btn-danger" role="button" onclick="return confirm('Opravdu to chceš?');" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("delete", [$kategorie->id])) ?>"><i class="fa fa-trash"></i> Smazat</a>
            </td>
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
