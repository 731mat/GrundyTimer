<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Vysledky/kategorie.latte

use Latte\Runtime as LR;

class Template2e0b31f3d9 extends Latte\Runtime\Template
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
		if (isset($this->params['cas'])) trigger_error('Variable $cas overwritten in foreach on line 26');
		if (isset($this->params['soutezici'])) trigger_error('Variable $soutezici overwritten in foreach on line 19');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		?>    <a class="btn btn-warning" role="button" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Vysledky:default")) ?>"><i class="fa fa-step-backward"></i></a>
    <br>
    <table id="souetziciTable" class="display nowrap" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>St. číslo</th>
            <th>Jméno</th>
            <th>Přijmeni</th>
            <th>Ročník</th>
            <th>Kategorie</th>
            <th>Čas</th>
<?php
		for ($i = 0;
		$i < $maxCulom;
		$i++) {
			?>                <th>kolo<?php echo LR\Filters::escapeHtmlText($i+1) /* line 14 */ ?></th>
<?php
		}
?>
        </tr>
        </thead>
        <tbody>
<?php
		$iterations = 0;
		foreach ($data as $soutezici) {
?>        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['start_number']) /* line 20 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['first_name']) /* line 21 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['last_name']) /* line 22 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['birth_year']) /* line 23 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['categoryName']) /* line 24 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici['rozdil'], '%H:%i:%s')) /* line 25 */ ?></td>
<?php
			$iterations = 0;
			foreach ($soutezici['casy'] as $cas) {
?>            <td>
                <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $cas, '%H:%i:%s')) /* line 27 */ ?>

            </td>
<?php
				$iterations++;
			}
?>
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
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'pdf',
                        text: 'Uložit PDF',
                        orientation: 'landscape',
                        filename:<?php echo LR\Filters::escapeJs(call_user_func($this->filters->webalize, $dataInfo->name."-".$dataKategorie->name)) /* line 47 */ ?>,
                        title:<?php echo LR\Filters::escapeJs($dataInfo->name." - ".$dataKategorie->name) /* line 48 */ ?>,
                        message:<?php echo LR\Filters::escapeJs($dataInfo->adress) /* line 49 */ ?>+" "+<?php
		echo LR\Filters::escapeJs(call_user_func($this->filters->date, $dataInfo->date, '%d.%m.%Y')) /* line 49 */ ?>+"      -   ©GrundyTimer  časomíra ",
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        }
                    },
                    {
                        extend: 'print',
                        text: 'vytiskni',
                        title:<?php echo LR\Filters::escapeJs($dataInfo->name." - ".$dataKategorie->name) /* line 59 */ ?>,
                        message:<?php echo LR\Filters::escapeJs($dataInfo->adress) /* line 60 */ ?>+" "+<?php
		echo LR\Filters::escapeJs(call_user_func($this->filters->date, $dataInfo->date, '%d.%m.%Y')) /* line 60 */ ?>+"      -   ©GrundyTimer  časomíra ",
                        exportOptions: {
                            stripHtml: false,
                            modifier: {
                                page: 'current'
                            }
                        }
                    }
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
