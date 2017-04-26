<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Vysledky/default.latte

use Latte\Runtime as LR;

class Template624fd45600 extends Latte\Runtime\Template
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
		if (isset($this->params['kat'])) trigger_error('Variable $kat overwritten in foreach on line 5');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

    <div class="row">
            <label>Filter:</label>
<?php
		$iterations = 0;
		foreach ($dataKategorie as $kat) {
?>
                <span class="button-checkbox">
                <button type="button" class="btn" data-color="success">
                        <?php echo LR\Filters::escapeHtmlText($kat->name) /* line 8 */ ?> <span class="badge"><?php
			echo LR\Filters::escapeHtmlText($kat->count_round) /* line 8 */ ?> kol</span></button>
                <input type="checkbox" class="hidden" name="kategorie" onchange="filtr()" value=<?php echo LR\Filters::escapeHtmlAttrUnquoted($kat->name) /* line 9 */ ?>>
            </span>
<?php
			$iterations++;
		}
?>
        <hr>
    </div>


<?php
		/* line 16 */
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
        $('#souetziciTable').dataTable( {
            "lengthChange": false,
            "pageLength": 150,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    text: 'Uložit PDF',
                    orientation: 'landscape',
                    filename:<?php echo LR\Filters::escapeJs(call_user_func($this->filters->webalize, $dataInfo->name."-ALL")) /* line 37 */ ?>,
                    title:<?php echo LR\Filters::escapeJs($dataInfo->name." - přehled všech") /* line 38 */ ?>,
                    message:'©GrundyTimer',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'print',
                    text: 'vytiskni',
                    title:<?php echo LR\Filters::escapeJs($dataInfo->name." - Přehled všch") /* line 49 */ ?>,
                    message:'©GrundyTimer',
                    exportOptions: {
                        stripHtml: false,
                        modifier: {
                            page: 'current'
                        }
                    }
                }
            ]
        });




        var table = $('#souetziciTable').DataTable();
        function filtr() {
            $yourArray = "";
            $("input:checkbox[name=kategorie]:checked").each(function(){
                $yourArray =$(this).val()+'|'+$yourArray;
            });
            table.column( 4 ).search( '^('+$yourArray+')$', true, false ).draw();
        }



        $(function () {
            $('.button-checkbox').each(function () {

                // Settings
                var $widget = $(this),
                    $button = $widget.find('button'),
                    $checkbox = $widget.find('input:checkbox'),
                    color = $button.data('color'),
                    settings = {
                        on: {
                            icon: 'fa fa-check-square-o'
                        },
                        off: {
                            icon: 'fa fa-square-o'
                        }
                    };

                // Event Handlers
                $button.on('click', function () {
                    $checkbox.prop('checked', !$checkbox.is(':checked'));
                    $checkbox.triggerHandler('change');
                    updateDisplay();
                });
                $checkbox.on('change', function () {
                    updateDisplay();
                });

                // Actions
                function updateDisplay() {
                    var isChecked = $checkbox.is(':checked');

                    // Set the button's state
                    $button.data('state', (isChecked) ? "on" : "off");

                    // Set the button's icon
                    $button.find('.state-icon')
                        .removeClass()
                        .addClass('state-icon ' + settings[$button.data('state')].icon);

                    // Update the button's color
                    if (isChecked) {
                        $button
                            .removeClass('btn-default')
                            .addClass('btn-' + color + ' active');
                    }
                    else {
                        $button
                            .removeClass('btn-' + color + ' active')
                            .addClass('btn-default');
                    }
                }

                // Initialization
                function init() {

                    updateDisplay();

                    // Inject the icon if applicable
                    if ($button.find('.state-icon').length == 0) {
                        $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                    }
                }
                init();
            });
        });
    </script>
<?php
	}


	function blockHead($_args)
	{
		
	}

}
