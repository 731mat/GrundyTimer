<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Soutezici/default.latte

use Latte\Runtime as LR;

class Template82e6330a78 extends Latte\Runtime\Template
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
		if (isset($this->params['soutezici'])) trigger_error('Variable $soutezici overwritten in foreach on line 16');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		?>    <a role="button" class="btn btn-default"  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("add")) ?>">Přidat</a>
    <table id="souetziciTable" class="display nowrap" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Startovní číslo</th>
            <th>Jmeno</th>
            <th>Přijmení</th>
            <th>datum narození</th>
            <th>kategorie</th>
            <th>ZDE</th>
            <th class="text-center">Akce</th>
        </tr>
        </thead>
        <tbody>
<?php
		$iterations = 0;
		foreach ($data as $soutezici) {
?>        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->start_number) /* line 17 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->first_name) /* line 18 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->last_name) /* line 19 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->birth_year) /* line 20 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($soutezici->ref('category','category')->name) /* line 21 */ ?></td>
            <td><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("chacked", [$soutezici->id])) ?>">
                <?php
			if ($soutezici->chacked) {
?><i class="fa fa-thumbs-o-up" aria-hidden="true" style="color: #5CB85C;"></i>
                <?php
			}
			else {
?><i class="fa fa-thumbs-o-down" aria-hidden="true" style="color: #D9534F;"></i>
                <?php
			}
?></a>
                </td>
            <td><a class="btn btn-success" role="button" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("detail", [$soutezici->id])) ?>"><i class="fa fa-list"></i></a>
                <a class="btn btn-primary" role="button" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit", [$soutezici->id])) ?>"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" role="button" onclick="return confirm('Opravdu to chceš?');" href="<?php
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("delete", [$soutezici->id])) ?>"><i class="fa fa-trash"></i></a>
            </td>
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
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
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
