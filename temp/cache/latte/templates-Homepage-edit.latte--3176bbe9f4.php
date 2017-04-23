<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Homepage/edit.latte

use Latte\Runtime as LR;

class Template3176bbe9f4 extends Latte\Runtime\Template
{
	public $blocks = [
		'zpet' => 'blockZpet',
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'zpet' => 'html',
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('zpet', get_defined_vars());
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockZpet($_args)
	{
?><button class="btn btn-danger">Zpet</button>
<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    <h2>edit</h2>
<?php
		/* line 6 */ $_tmp = $this->global->uiControl->getComponent("infoForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(NULL, FALSE);
		$_tmp->render();
		
	}

}
