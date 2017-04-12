<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Controller/default.latte

use Latte\Runtime as LR;

class Templatee90543ff6a extends Latte\Runtime\Template
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
		if (isset($this->params['tl'])) trigger_error('Variable $tl overwritten in foreach on line 2');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		$iterations = 0;
		foreach ($tlacitka as $tl) {
			?>        <button type="button" class="btn btn-info" id="button<?php echo LR\Filters::escapeHtmlAttr($tl->id) /* line 3 */ ?>" onclick="kolo(<?php
			echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeJs($tl->id)) /* line 3 */ ?>)"><?php echo LR\Filters::escapeHtmlText($tl->start_number) /* line 3 */ ?></button>
<?php
			$iterations++;
		}
		
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
?>
    <script>
        function kolo(id) {
            $.get("kolo/" + id, function(data, status){
            });
        }
        setInterval(ajaxCall, 500); //300000 MS == 5 minutes

        function ajaxCall() {
            $.get("json", function(data, status){
                for(var i = 0; i < data.length; i++){
                    if(data[i].cout_round == 0)
                        $("#button"+data[i].id).attr('disabled','disabled');
                }
            });
        }
    </script>
<?php
	}


	function blockHead($_args)
	{
		
	}

}
