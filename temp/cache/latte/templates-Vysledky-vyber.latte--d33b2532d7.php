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
		if (isset($this->params['kat'])) trigger_error('Variable $kat overwritten in foreach on line 4, 40');
		if (isset($this->params['soutezici'])) trigger_error('Variable $soutezici overwritten in foreach on line 22');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>


<?php
		$iterations = 0;
		foreach ($dataKategorie as $kat) {
			?>    <a class="btn btn-success" role="button" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("kategorie", [$kat->id])) ?>">
        <?php echo LR\Filters::escapeHtmlText($kat->name) /* line 5 */ ?> <span class="badge"><?php echo LR\Filters::escapeHtmlText($kat->count_round) /* line 5 */ ?> kol</span>
    </a>
<?php
			$iterations++;
		}
?>
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
			?>                <th>kolo<?php echo LR\Filters::escapeHtmlText($i+1) /* line 17 */ ?></th>
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
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['start_number']) /* line 23 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['first_name']) /* line 24 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['last_name']) /* line 25 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['birth_year']) /* line 26 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici['categoryName']) /* line 27 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici['rozdil'], '%H:%i:%s')) /* line 28 */ ?></td>
<?php
			for ($x = 0;
			$x< $maxCulom;
			$x++) {
?>            <td>
                <?php
				if (!(sizeof($soutezici['casy']) <= $x)) {
?>

                    <?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $soutezici['casy'][$x], '%H:%i:%s')) /* line 31 */ ?>

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

    <div class="row">
        <label for="OptionsSelect">Filter:</label>
<?php
		$iterations = 0;
		foreach ($dataKategorie as $kat) {
			?>            <input type="checkbox" name="kategorie" value="<?php echo LR\Filters::escapeHtmlAttr($kat->name) /* line 40 */ ?>">
<?php
			$iterations++;
		}
		?>                <?php echo LR\Filters::escapeHtmlText($kat->name) /* line 41 */ ?>

            </input>
            <button id="vyhledat">filtr</button>
    </div>







<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
?>
    <script>


        var table = $('#souetziciTable').DataTable();


        $('#vyhledat').on('click', function() {
            $yourArray = "";
            $("input:checkbox[name=kategorie]:checked").each(function(){
                $yourArray =$(this).val()+' '+$yourArray;
            });
            table.search( 'senioři Junioři' ,true ).draw();
        });



    </script>
<?php
	}


	function blockHead($_args)
	{
		
	}

}
