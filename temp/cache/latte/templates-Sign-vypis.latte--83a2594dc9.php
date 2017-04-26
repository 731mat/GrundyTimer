<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Sign/vypis.latte

use Latte\Runtime as LR;

class Template83a2594dc9 extends Latte\Runtime\Template
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
		if (isset($this->params['registrovany'])) trigger_error('Variable $registrovany overwritten in foreach on line 11');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		?>    <a role="button" class="btn btn-default"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("new")) ?>"><span class="fa fa-plus"></span> Přidat</a>
    <table id="souetziciTable" class="display nowrap" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Jmeno</th>
            <th class="text-center">Akce</th>
        </tr>
        </thead>
        <tbody>
<?php
		$iterations = 0;
		foreach ($data as $registrovany) {
?>        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($registrovany->name) /* line 12 */ ?></td>
            <td>
                <a class="btn btn-danger" role="button" onclick="return confirm('Opravdu to chceš?');" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("delete", [$registrovany->id])) ?>"><i class="fa fa-trash"></i></a>
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
            $('#souetziciTable').dataTable( {
                "lengthChange": false,
                dom: 'Bfrtip'

            });
        });
    </script>
<?php
	}


	function blockHead($_args)
	{
		
	}

}
