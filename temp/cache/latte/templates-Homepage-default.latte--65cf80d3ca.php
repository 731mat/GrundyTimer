<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template65cf80d3ca extends Latte\Runtime\Template
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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
	<div class="jumbotron">

		<h1><i class="fa fa-black-tie" aria-hidden="true"></i> GrundyTimer</h1>
		<p>Webová aplikace, pro měření času.</p>
	</div>
	<div class="well">
		<h4>Info o závodu</h4>
		Název závodu: <strong><?php echo LR\Filters::escapeHtmlText($data->name) /* line 9 */ ?></strong><br>
		Místo konání: <strong><?php echo LR\Filters::escapeHtmlText($data->adress) /* line 10 */ ?></strong><br>
		Adresa:       <strong><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $data->date, '%d.%m.%Y')) /* line 11 */ ?></strong><br>
		<button type="button" class="btn btn-default">edit</button>
	</div>
	<div class="well">
		<h4>Statistiky</h4>
		pocet soutezici: <strong><?php echo LR\Filters::escapeHtmlText($data->name) /* line 16 */ ?></strong><br>
		Místo konání: <strong><?php echo LR\Filters::escapeHtmlText($data->adress) /* line 17 */ ?></strong><br>
		Adresa:       <strong><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $data->date, '%d.%m.%Y')) /* line 18 */ ?></strong>
	</div>
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
