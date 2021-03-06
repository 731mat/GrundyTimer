<?php
// source: /var/www/html/GrundyBike/app/presenters/templates/@layout.latte

use Latte\Runtime as LR;

class Template9a38cbe948 extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'contentBezOkraju' => 'blockContentBezOkraju',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'head' => 'html',
		'contentBezOkraju' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title><?php
		if (isset($this->blockQueue["title"])) {
			$this->renderBlock('title', $this->params, function ($s, $type) {
				$_fi = new LR\FilterInfo($type);
				return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striphtml', $_fi, $s));
			});
			?> | <?php
		}
?>GrundyTimer	</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 13 */ ?>/css/style.css">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 14 */ ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 15 */ ?>/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 16 */ ?>/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 17 */ ?>/css/font-awesome.min.css">
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 18 */ ?>/js/jquery.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 19 */ ?>/js/jquery-1.12.4.js“"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 20 */ ?>/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 21 */ ?>/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 22 */ ?>/js/buttons.flash.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 23 */ ?>/js/jszip.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 24 */ ?>/js/pdfmake.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 25 */ ?>/js/vfs_fonts.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 26 */ ?>/js/buttons.html5.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 27 */ ?>/js/buttons.print.min.js"></script>
	<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
?>
</head>

<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

				<a class="navbar-brand" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:default")) ?>"><i class="fa fa-black-tie" aria-hidden="true"></i> GrundyTimer</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li<?php
		if ($this->global->uiPresenter->isLinkCurrent("Homepage:")) {
			?> class="active"<?php
		}
		?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:default")) ?>"><i class="fa fa-info-circle"></i> Info</a></li>
				<li<?php
		if ($this->global->uiPresenter->isLinkCurrent("Vysledky:")) {
			?> class="active"<?php
		}
		?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Vysledky:default")) ?>"><i class="fa fa-table"></i> Vysledky</a></li>
<?php
		if ($user->loggedIn) {
?>
				<!-- SOUTĚŽICI -->
					<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Soutezici:")) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Soutezici:default")) ?>"><i class="fa fa-user-circle-o"></i> Soutěžící</a></li>
				<!-- KATEGORIE -->
					<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Kategorie:")) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Kategorie:default")) ?>"><i class="fa fa-bars"></i> Kategorie</a></li>
				<!-- TABLET -->
					<li class="dropdown<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:")) {
				?> active<?php
			}
?>">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-tablet"></i> Tablet
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:tabletButton")) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:tabletbutton")) ?>">tlacitka</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:tabletNumber")) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:tabletnumber")) ?>">cisla</a></li>
						</ul>
					</li>
				<!-- STARTER -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-sun-o"></i> Starter
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Starter:start")) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Starter:start")) ?>"><i class="fa fa-play"></i> Start</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Starter:stop")) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Starter:stop")) ?>"><i class="fa fa-stop"></i> Stop</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Starter:reset")) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Starter:reset")) ?>"><i class="fa fa-repeat"></i> Reset</a></li>
							</ul>
					</li>
				<!-- DISPLAY-->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-television"></i> Display
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:display", [1])) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:display", [1])) ?>">1</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:display", [2])) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:display", [2])) ?>">2</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:display", [3])) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:display", [3])) ?>">3</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:display", [4])) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:display", [4])) ?>">4</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:display", [5])) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:display", [5])) ?>">5</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:display", [6])) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:display", [6])) ?>">6</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:display", [7])) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:display", [7])) ?>">7</a></li>
							<li<?php
			if ($this->global->uiPresenter->isLinkCurrent("Controller:display", [8])) {
				?> class="active"<?php
			}
			?>><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Controller:display", [8])) ?>">8</a></li>
						</ul>
					</li>
				<?php
		}
?><!-- /.pouze pro přihlášené -->

			</ul>

			<ul class="nav navbar-nav navbar-right">
<?php
		if ($user->loggedIn) {
			?>					<li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:vypis")) ?>"><span class="fa fa-user"></span> <?php
			echo LR\Filters::escapeHtmlText($user->getIdentity()->roles['name']) /* line 93 */ ?></a></li>
					<li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:out")) ?>"><span class="fa fa-sign-out"></span> Odhlásit</a></li>
<?php
		}
		else {
			?>					<li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Sign:in")) ?>"><span class="fa fa-sign-in"></span> Login</a></li>
<?php
		}
?>
			</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container">


<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			?>	<div <?php if ($_tmp = array_filter(['alert','flash', $flash->type])) echo ' class="', LR\Filters::escapeHtmlAttr(implode(" ", array_unique($_tmp))), '"' ?>><?php
			echo LR\Filters::escapeHtmlText($flash->message) /* line 105 */ ?></div>
<?php
			$iterations++;
		}
?>

<?php
		$this->renderBlock('content', $this->params, 'html');
?>
	</div>
<?php
		$this->renderBlock('contentBezOkraju', get_defined_vars());
		$this->renderBlock('scripts', get_defined_vars());
?>
</body>
</html>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 105');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockHead($_args)
	{
		
	}


	function blockContentBezOkraju($_args)
	{
		
	}


	function blockScripts($_args)
	{
		extract($_args);
?>

	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 113 */ ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 114 */ ?>/js/main.js"></script>
<?php
	}

}
