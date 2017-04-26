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
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		?>    <a class="btn btn-warning" role="button" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Vysledky:default")) ?>"><i class="fa fa-step-backward"></i></a>
    <br>
<?php
		/* line 4 */
		$this->createTemplate('sub.latte', $this->params, "include")->renderToContentType('html');
?>

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
                        filename:<?php echo LR\Filters::escapeJs(call_user_func($this->filters->webalize, $dataInfo->name."-".$dataKategorie->name)) /* line 20 */ ?>,
                        title:<?php echo LR\Filters::escapeJs($dataInfo->name." - ".$dataKategorie->name) /* line 21 */ ?>,
                        message:<?php echo LR\Filters::escapeJs($dataInfo->adress) /* line 22 */ ?>+" "+<?php
		echo LR\Filters::escapeJs(call_user_func($this->filters->date, $dataInfo->date, '%d.%m.%Y')) /* line 22 */ ?>+"      -   ©GrundyTimer  časomíra ",
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        }
                    },
                    {
                        extend: 'print',
                        text: 'vytiskni',
                        title:<?php echo LR\Filters::escapeJs($dataInfo->name." - ".$dataKategorie->name) /* line 32 */ ?>,
                        message:<?php echo LR\Filters::escapeJs($dataInfo->adress) /* line 33 */ ?>+" "+<?php
		echo LR\Filters::escapeJs(call_user_func($this->filters->date, $dataInfo->date, '%d.%m.%Y')) /* line 33 */ ?>+"      -   ©GrundyTimer  časomíra ",
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
