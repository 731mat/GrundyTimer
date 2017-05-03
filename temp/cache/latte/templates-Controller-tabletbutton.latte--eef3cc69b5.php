<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/Controller/tabletbutton.latte

use Latte\Runtime as LR;

class Templateeef3cc69b5 extends Latte\Runtime\Template
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
		if (isset($this->params['tl'])) trigger_error('Variable $tl overwritten in foreach on line 3');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    </div>
<?php
		$iterations = 0;
		foreach ($tlacitka as $tl) {
?>
        <div class="col-sm-13">
        <button type="button" class="btn btn-default" id="button<?php echo LR\Filters::escapeHtmlAttr($tl->id) /* line 5 */ ?>" onclick="kolo(<?php
			echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeJs($tl->id)) /* line 5 */ ?>)"><?php echo LR\Filters::escapeHtmlText($tl->start_number) /* line 5 */ ?></button>
        </div>
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
            $("body").css("background","white");
            $.get("kolo/" + id, function(data, status){
                if(data.odpoved == "true")
                    $("body").css("background","white");
                else
                    $("body").css("background","black");
            });
        }
        setInterval(ajaxCall, 300);

        function ajaxCall() {
            $.get("json", function(data, status){
                for(var i = 0; i < data.length; i++){
                    if(data[i].cout_round == 0) {
                        $("#button" + data[i].id).attr('disabled', 'disabled');
                        $("#button" + data[i].id).attr('class', 'btn btn-danger');
                    }else
                        if(data[i].enable == 0){
                            $("#button"+data[i].id).attr('disabled','disabled');
                            $("#button" + data[i].id).attr('class', 'btn btn-danger');
                        }else {
                            $("#button" + data[i].id).removeAttr('disabled');
                            $("#button" + data[i].id).removeAttr('class');
                            $("#button" + data[i].id).attr('class', 'btn btn-default');
                        }
                    $("#button"+data[i].id).html("<span class='buttonController'><strong>" + data[i].start_number + "</strong></div> ("+ data[i].cout_round + ")" );

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
