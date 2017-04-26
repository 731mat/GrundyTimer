<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Vysledky/vyber.latte

use Latte\Runtime as LR;

class Templated33b2532d7 extends Latte\Runtime\Template
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
		if (isset($this->params['kat'])) trigger_error('Variable $kat overwritten in foreach on line 7');
		if (isset($this->params['soutezici'])) trigger_error('Variable $soutezici overwritten in foreach on line 47');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>


    <div class="row">
        <div class="well">
            <label>Filter:</label>
<?php
		$iterations = 0;
		foreach ($dataKategorie as $kat) {
?>
                <span class="button-checkbox">
                <button type="button" class="btn" data-color="success">
                        <?php echo LR\Filters::escapeHtmlText($kat->name) /* line 10 */ ?> <span class="badge"><?php
			echo LR\Filters::escapeHtmlText($kat->count_round) /* line 10 */ ?> kol</span></button>
                <input type="checkbox" class="hidden" name="kategorie" onchange="filtr()" value=<?php echo LR\Filters::escapeHtmlAttrUnquoted($kat->name) /* line 11 */ ?>>
            </span>
<?php
			$iterations++;
		}
?>
        </div>
    </div>



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
			?>                <th>kolo<?php echo LR\Filters::escapeHtmlText($i+1) /* line 29 */ ?></th>
<?php
		}
?>
        </tr>
        </thead>
        <tfoot>
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
			?>                <th>kolo<?php echo LR\Filters::escapeHtmlText($i+1) /* line 42 */ ?></th>
<?php
		}
?>
        </tr>
        </tfoot>
        <tbody>
<?php
		$iterations = 0;
		foreach ($data as $soutezici) {
?>        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['start_number']) /* line 48 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['first_name']) /* line 49 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['last_name']) /* line 50 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['birth_year']) /* line 51 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['categoryName']) /* line 52 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici['rozdil'], '%H:%i:%s')) /* line 53 */ ?></td>
<?php
			for ($x = 0;
			$x< $maxCulom;
			$x++) {
?>            <td>
                <?php
				if (!(sizeof($soutezici['casy']) <= $x)) {
?>

                    <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici['casy'][$x], '%H:%i:%s')) /* line 56 */ ?>

<?php
				}
?>
            </td>
<?php
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
        $('#souetziciTable').dataTable( {
            "lengthChange": false,
            "pageLength": 150,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    text: 'Uložit PDF',
                    orientation: 'landscape',
                    filename:<?php echo LR\Filters::escapeJs(call_user_func($this->filters->webalize, $dataInfo->name."-ALL")) /* line 83 */ ?>,
                    title:<?php echo LR\Filters::escapeJs($dataInfo->name." - přehled všech") /* line 84 */ ?>,
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
                    title:<?php echo LR\Filters::escapeJs($dataInfo->name." - Přehled všch") /* line 95 */ ?>,
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
