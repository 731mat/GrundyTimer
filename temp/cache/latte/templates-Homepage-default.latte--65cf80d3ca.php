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
		if (isset($this->params['kat'])) trigger_error('Variable $kat overwritten in foreach on line 24, 66');
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
		Název závodu: <strong><?php echo LR\Filters::escapeHtmlText($dataInfo->name) /* line 9 */ ?></strong><br>
		Místo konání: <strong><?php echo LR\Filters::escapeHtmlText($dataInfo->adress) /* line 10 */ ?></strong><br>
		cas:       <strong><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $dataInfo->date, '%d.%m.%Y')) /* line 11 */ ?></strong><br>
		<a type="button" class="btn btn-default	" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit")) ?>">edit</a>
	</div>
	<div class="well">
		<h4>Statistiky kategorie</h4>
		<div class="row">
			<div class="col-sm-4">
				<table class="table" width="100%">
                    <thead>
                    <th>nazev kategorie</th>
                    <th>pocet zaregistrovaných</th>
                    </thead>
                    <tbody>
<?php
		$iterations = 0;
		foreach ($dataKategorie as $kat) {
			?>                    <tr><td><?php echo LR\Filters::escapeHtmlText($kat->name) /* line 25 */ ?></td>
                        <td><?php echo LR\Filters::escapeHtmlText($kat->pocet) /* line 26 */ ?></td></tr>
<?php
			$iterations++;
		}
?>
                    </tbody>
                </table>

			</div>
			<div class="col-sm-8">
				<div id="chartContainer" style="height: 200px; width: 100%;"></div>
			</div>
		</div>


	</div>
<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
?>
	<script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer",
                {
                    backgroundColor: "#F5F5F5",
                    title:{
                        text: ""
                    },
                    animationEnabled: true,
                    legend:{
                        verticalAlign: "center",
                        horizontalAlign: "left"
                    },
                    data: [
                        {
                            indexLabelFontSize: 20,
                            indexLabelFontFamily: "Monospace",
                            indexLabelFontColor: "darkgrey",
                            indexLabelLineColor: "darkgrey",
                            indexLabelPlacement: "outside",
                            type: "pie",
                            showInLegend: true,
                            dataPoints: [
<?php
		$iterations = 0;
		foreach ($dataKategorie as $kat) {
			?>                                {  y: <?php echo LR\Filters::escapeJs($kat->pocet) /* line 67 */ ?>, legendText:<?php
			echo LR\Filters::escapeJs($kat->name) /* line 67 */ ?>, indexLabel: <?php echo LR\Filters::escapeJs($kat->name) /* line 67 */ ?>},
<?php
			$iterations++;
		}
?>
                            ]
                        }
                    ]
                });
            chart.render();
        }
	</script>
	<script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 76 */ ?>/js/canvasjs.min.js"></script>
<?php
	}


	function blockHead($_args)
	{
		
	}

}
