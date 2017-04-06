<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Soutezici/default.latte

use Latte\Runtime as LR;

class Template82e6330a78 extends Latte\Runtime\Template
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
		?>    <a role="button" class="btn btn-default"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("add")) ?>">Přidat</a>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Startovní číslo</th>
            <th>Jmeno</th>
            <th>Přijmení</th>
            <th>datum narození</th>
            <th>kategorie</th>
            <th class="text-center">Akce</th>
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
            <td><?php echo LR\Filters::escapeHtmlText($kategorie[$soutezici->category]) /* line 20 */ ?></td>
            <td><a class="btn btn-primary" role="button" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit", [$soutezici->id])) ?>"><i class="fa fa-edit"></i> edit</a>
                <a class="btn btn-danger" role="button" onclick="return confirm('Opravdu to chceš?');" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("delete", [$soutezici->id])) ?>"><i class="fa fa-trash"></i> Smazat</a>
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
		
	}


	function blockHead($_args)
	{
		
	}

}
