<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

defined('_JEXEC') or die;

$app   = JFactory::getApplication();
$doc   = JFactory::getDocument();
$lang  = JFactory::getLanguage();
$this->language = $doc->language;
$this->direction = $doc->direction;
$input = $app->input;
$user  = JFactory::getUser();

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' .$this->template. '/js/template.js');


// Add Stylesheets
$doc->addStyleSheet('templates/' . $this->template . '/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);
$doc->addStyleSheet('../media/jui/css/icomoon.css');
// Load specific language related CSS
$file = 'language/' . $lang->getTag() . '/' . $lang->getTag() . '.css';
if (is_file($file))
{
	$doc->addStyleSheet($file);
}

// Detecting Active Variables
$option   = $input->get('option', '');
$view     = $input->get('view', '');
$layout   = $input->get('layout', '');
$task     = $input->get('task', '');
$itemid   = $input->get('Itemid', '');
$sitename = $app->getCfg('sitename');

$cpanel = ($option === 'com_cpanel');

$showSubmenu = false;
$this->submenumodules = JModuleHelper::getModules('submenu');
foreach ($this->submenumodules as $submenumodule)
{
	$output = JModuleHelper::renderModule($submenumodule);
	if (strlen($output))
	{
		$showSubmenu = true;
		break;
	}
}

// Logo file
if ($this->params->get('logoFile'))
{
	$logo = JUri::root() . $this->params->get('logoFile');
}
else
{
	$logo = $this->baseurl . '/templates/' . $this->template . '/images/logo.png';
}

// Template Parameters
$displayHeader = $this->params->get('displayHeader', '1');
$statusFixed = $this->params->get('statusFixed', '1');
$stickyToolbar = $this->params->get('stickyToolbar', '1');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<jdoc:include type="head" />

	<!-- Template color -->
	<?php if ($this->params->get('templateColor')) : ?>
	<style type="text/css">
		.navbar-inner, .navbar-inverse .navbar-inner, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .navbar-inverse .nav li.dropdown.open > .dropdown-toggle, .navbar-inverse .nav li.dropdown.active > .dropdown-toggle, .navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle, #status.status-top
		{
			background: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner, .navbar-inverse .nav li.dropdown.open > .dropdown-toggle, .navbar-inverse .nav li.dropdown.active > .dropdown-toggle, .navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
	</style>
	<?php endif; ?>

	<!-- Template header color -->
	<?php if ($this->params->get('headerColor')) : ?>
	<style type="text/css">
		.header
		{
			background: <?php echo $this->params->get('headerColor'); ?>;
		}
	</style>
	<?php endif; ?>

	<!-- Sidebar background color -->
	<?php if ($this->params->get('sidebarColor')) : ?>
	<style type="text/css">
		.navbar
		{
			background: <?php echo $this->params->get('sidebarColor'); ?>;
		color:#fff
		}
		.dropdown a, a.brand
		{color:#fff}


		#status a , #status {color:#fff; text-align:right; font-size:0.9em}
		#status div {margin-left:5px}
		#sidebar {padding:10px;margin-right:20px}
		.filter-select h4 {font-size:1em;font-weight:bold}
	
		.chzn-container-single .chzn-single
		{border-radius:0; box-shadow:none; }
		#j-sidebar-container
		{ margin-top:0em}
		#toolbar button span,  	#toolbar button i {padding:0px; border-radius:100%; line-height:12px; height:1em; width:2em; padding:14px 6px; display:block; margin:5px auto 10px auto; background:#fff; font-size:1.2em }
		#toolbar .btn, #toolbar .btn-small {text-align:center; background:none; border:0; font-size:0.8em; color:#184A7D}
		#toolbar span	{color:#0077DD}
		#toolbar .btn-success span {color:white; background:green}
		.btn-group .icon-publish, .btn .icon-publish {color:green}
		#toolbar span.icon-publish {color:green}
		#toolbar {display:block; text-align:right; padding-right:10px}

		#toolbar .icon-unpublish, .icon-unpublish {color:#B02866}
		#toolbar .icon-featured, .btn-group .icon-featured, .icon-featured {color:#FFBF00}
		header h1 {margin:0}
		h1 span {margin:10px}
		.sidebar-nav h2 { padding:5px; font-weight:bold; border-bottom:solid 1px #ddd}

		.order input {width:21px; padding:0 2px; background:#FFFFBF; border:solid 1px #ddd; font-weight:bold; color:#3399FF; float:right; text-align:center}
		button.dropdown-toggle {background:#bbb; padding:6px 3px}
		td .btn {float:none !important}
		.filter_search{}
		#filter_search {background:#ebf7fd; }
		#filter-bar .btn {border:0; border-radius:0}
		#filter-bar .btn-group.pull-left {margin:0}



	</style>
	<?php endif; ?>

	<!--[if lt IE 9]>
		<script src="../media/jui/js/html5.js"></script>
	<![endif]-->


</head>

<body class="admin <?php echo $option . " view-" . $view . " layout-" . $layout . " task-" . $task . " itemid-" . $itemid . " "; ?>" <?php if ($stickyToolbar) : ?>data-spy="scroll" data-target=".subhead" data-offset="87"<?php endif; ?>>

			<?php if ($displayHeader) : ?>
			<header class="header">
				<div class="container">
					<div class="row-fluid">
						<div class="span2 container-logo">
							<a class="logo" href="<?php echo $this->baseurl; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $sitename; ?>" /></a>
						</div>
						<div class="span5">

							<jdoc:include type="modules" name="title" />
							</div>

							<?php if ( ($this->countModules('status'))) : ?>
							<!-- Begin Status Module -->
							<div  id="status" class="  col-5">

								<a class="brand visible-desktop visible-tablet"  style="margin-top:5px; display:inline-block" href="<?php echo JUri::root(); ?>" title="<?php echo JText::sprintf('TPL_ISIS_PREVIEW', $sitename); ?>" target="_blank"><?php echo JHtml::_('string.truncate', $sitename, 14, false, false); ?></a>
								<ul  class=" <?php if ($this->direction == 'rtl') : ?>nav<?php else : ?>nav pull-right<?php endif; ?>">

									<li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $user->name; ?> <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li class=""><a href="index.php?option=com_admin&task=profile.edit&id=<?php echo $user->id; ?>"><?php echo JText::_('TPL_ISIS_EDIT_ACCOUNT'); ?></a></li>
											<li class="divider"></li>
											<li class=""><a href="<?php echo JRoute::_('index.php?option=com_login&task=logout&'. JSession::getFormToken() .'=1');?>"><?php echo JText::_('TPL_ISIS_LOGOUT');?></a></li>
										</ul>
									</li>
								</ul>


							</div>
							<!-- End Status Module -->
							<?php endif; ?>
						</div>
					</div>
				</div>

			</header>
				<?php endif; ?>



            <div class="navbar">
			<nav class="container">
			<div class="row">
				<?php if ($this->params->get('admin_menus') != '0') : ?>
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" style="display:none">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
				<?php endif; ?>

				<?php if ($this->params->get('admin_menus') != '0') : ?>

				<?php else : ?>

				<?php endif; ?>
			<div class="col-12" style="padding:0px">			<div class="col-2"></div>
				<div class="col-10">
			<jdoc:include type="modules" name="menu" style="none" />
			</div>


			</div>
			</nav>
			</div>
			</div>

	<!-- Header -->


	<?php if (!$cpanel) : ?>
	<!-- Subheader -->


            <div class=""  style="background:#49BDF4; border-bottom:solid 1px #ddd">
			<div class="container">

				<div class="row" id="toolbar" style="padding:5px 0;clear:left">

						<jdoc:include type="modules" name="toolbar" style="no" />

				</div>
			</div>
			</div>


	<?php else : ?>

	<?php endif; ?>
	<!-- container-fluid -->
	<div class="container container-main">
		<section id="content" style=" padding:10px 0">
			<!-- Begin Content -->
			<jdoc:include type="modules" name="top" style="xhtml" />
			<div class="row">
				<?php if ($showSubmenu) : ?>
					<div class="span2">
						<div style="padding:20px; border:solid 1px">
						<jdoc:include type="modules" name="submenu" style="none" /></div>
					</div>
					<div class="col-10">
				<?php else : ?>
					<div class="col-12">
				<?php endif; ?>
						<jdoc:include type="message" />
						<?php
						// Show the page title here if the header is hidden
						if (!$displayHeader) : ?>
						<h1 class="content-title"><?php echo JHtml::_('string.truncate', $app->JComponentTitle, 0, false, false);?></h1>
						<?php endif; ?>
						<jdoc:include type="component" />
					</div>
			</div>
			<?php if ($this->countModules('bottom')) : ?>
				<jdoc:include type="modules" name="bottom" style="xhtml" />
			<?php endif; ?>
			<!-- End Content -->
		</section>

		<?php if (!$this->countModules('status') || (!$statusFixed && $this->countModules('status'))) : ?>
			<footer class="footer">
				<p align="center">
				<jdoc:include type="modules" name="footer" style="no" />
				&copy; <?php echo $sitename; ?> <?php echo date('Y'); ?></p>
			</footer>
		<?php endif; ?>
	</div>
	<?php if (($statusFixed) && ($this->countModules('status'))) : ?>
	<!-- Begin Status Module -->
	<div id="status" class="navbar navbar-fixed-bottom hidden-phone">
		<div class="btn-toolbar">
			<div class="btn-group pull-right">
				<p><jdoc:include type="modules" name="footer" style="no" />
				&copy; <?php echo $sitename; ?> <?php echo date('Y'); ?></p>

			</div>
			<jdoc:include type="modules" name="status" style="no" />
		</div>
	</div>
	<!-- End Status Module -->
	<?php endif; ?>
	<jdoc:include type="modules" name="debug" style="none" />
	<?php if ($stickyToolbar) : ?>
	<script>
		(function($) {
			// fix sub nav on scroll
			var $win = $(window)
			  , $nav = $('.subhead')
			  , navTop = $('.subhead').length && $('.subhead').offset().top - <?php if ($displayHeader || !$statusFixed) : ?>40<?php else:?>20<?php endif;?>
			  , isFixed = 0

			processScroll()

			// hack sad times - holdover until rewrite for 2.1
			$nav.on('click', function() {
				if (!isFixed) setTimeout(function() {
					$win.scrollTop($win.scrollTop() - 47)
				}, 10)
			})

			$win.on('scroll', processScroll)

			function processScroll() {
				var i, scrollTop = $win.scrollTop()
				if (scrollTop >= navTop && !isFixed) {
					isFixed = 1
					$nav.addClass('subhead-fixed')
				} else if (scrollTop <= navTop && isFixed) {
					isFixed = 0
					$nav.removeClass('subhead-fixed')
				}
			}
		})(jQuery);
	</script>
	<?php endif; ?>
</body>
</html>
