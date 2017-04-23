<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Controller/display.latte

use Latte\Runtime as LR;

class Template423e973ef0 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'contentBezOkraju' => 'blockContentBezOkraju',
		'scripts' => 'blockScripts',
		'head' => 'blockHead',
	];

	public $blockTypes = [
		'content' => 'html',
		'contentBezOkraju' => 'html',
		'scripts' => 'html',
		'head' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		$this->renderBlock('contentBezOkraju', get_defined_vars());
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
		
	}


	function blockContentBezOkraju($_args)
	{
		extract($_args);
?>
    <table class="table table-bordered" width="100%">
<?php
		for ($row = 0;
		$row < $countRow;
		$row++) {
			?>            <tr id="row<?php echo LR\Filters::escapeHtmlAttr($row) /* line 6 */ ?>" style="font-size: <?php
			echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeCss(400/$countRow)) /* line 6 */ ?>px"><td></td><td></td><td></td></tr>
<?php
		}
?>
    </table>
<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
?>
    <script>

        setInterval(ajaxCall, 700);

        function ajaxCall() {
            $.get("../jsondisplay/"+<?php echo LR\Filters::escapeJs($countRow) /* line 18 */ ?>, function(data, status){
                for(var i = 0; i < data.length; i++){
                    $("#row"+i).html("<td>"+data[i].start_number+"</td><td>"+data[i].cout_round+"</td><td style='padding-left: 20%'>"+data[i].odstartu+"</td>");

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
