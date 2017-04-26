<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Soutezici/detail.latte

use Latte\Runtime as LR;

class Template07a341779d extends Latte\Runtime\Template
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
		if (isset($this->params['index'])) trigger_error('Variable $index overwritten in foreach on line 10, 16');
		if (isset($this->params['cas'])) trigger_error('Variable $cas overwritten in foreach on line 10, 16, 53');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		?>    <h2><?php echo LR\Filters::escapeHtmlText($data->first_name) /* line 2 */ ?> <?php echo LR\Filters::escapeHtmlText($data->last_name) /* line 2 */ ?></h2>
    <h4>Ročník: <?php echo LR\Filters::escapeHtmlText($data->birth_year) /* line 3 */ ?></h4>
    <br>
    <br>
    <div class="well">
        <h4 class="text-center">Casy odjetých kol v tabulce</h4>
        <table class="table table-bordered" width="100%">
            <thead>
<?php
		$iterations = 0;
		foreach ($dataCasy as $index => $cas) {
			?>                <th>kolo <?php echo LR\Filters::escapeHtmlText($index+1) /* line 11 */ ?></th>
<?php
			$iterations++;
		}
?>
            </thead>
            <tbody>
            <tr>
<?php
		$iterations = 0;
		foreach ($dataCasy as $index => $cas) {
			?>              <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $cas->time, '%H:%i:%s')) /* line 17 */ ?></td>
<?php
			$iterations++;
		}
?>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="well">
        <h4 class="text-center">Casy odjetých kol v grafu</h4>
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
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
                    axisY: {
                        title: "cas v sekundach"
                    },
                    legend: {
                        verticalAlign: "bottom",
                        horizontalAlign: "center"
                    },
                    theme: "theme2",
                    data: [

                        {
                            type: "line",
                            dataPoints: [
<?php
		$iterations = 0;
		foreach ($dataCasy as $cas) {
			?>                                {  y: <?php echo LR\Filters::escapeJs($cas->time->h*3600 + $cas->time->i*60 + $cas->time->s) /* line 54 */ ?>,indexLabel:<?php
			echo LR\Filters::escapeJs(call_user_func($this->filters->date, $cas->time, '%H:%i:%s')) /* line 54 */ ?>, legend:"pokus"},
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
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 64 */ ?>/js/canvasjs.min.js"></script>
<?php
	}


	function blockHead($_args)
	{
		
	}

}
