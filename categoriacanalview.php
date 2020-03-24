<?php
namespace PHPMaker2020\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$categoriacanal_view = new categoriacanal_view();

// Run the page
$categoriacanal_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categoriacanal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$categoriacanal_view->isExport()) { ?>
<script>
var fcategoriacanalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcategoriacanalview = currentForm = new ew.Form("fcategoriacanalview", "view");
	loadjs.done("fcategoriacanalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$categoriacanal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $categoriacanal_view->ExportOptions->render("body") ?>
<?php $categoriacanal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $categoriacanal_view->showPageHeader(); ?>
<?php
$categoriacanal_view->showMessage();
?>
<form name="fcategoriacanalview" id="fcategoriacanalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categoriacanal">
<input type="hidden" name="modal" value="<?php echo (int)$categoriacanal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($categoriacanal_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $categoriacanal_view->TableLeftColumnClass ?>"><span id="elh_categoriacanal_id"><?php echo $categoriacanal_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $categoriacanal_view->id->cellAttributes() ?>>
<span id="el_categoriacanal_id">
<span<?php echo $categoriacanal_view->id->viewAttributes() ?>><?php echo $categoriacanal_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categoriacanal_view->categoria->Visible) { // categoria ?>
	<tr id="r_categoria">
		<td class="<?php echo $categoriacanal_view->TableLeftColumnClass ?>"><span id="elh_categoriacanal_categoria"><?php echo $categoriacanal_view->categoria->caption() ?></span></td>
		<td data-name="categoria" <?php echo $categoriacanal_view->categoria->cellAttributes() ?>>
<span id="el_categoriacanal_categoria">
<span<?php echo $categoriacanal_view->categoria->viewAttributes() ?>><?php echo $categoriacanal_view->categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categoriacanal_view->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion">
		<td class="<?php echo $categoriacanal_view->TableLeftColumnClass ?>"><span id="elh_categoriacanal_descripcion"><?php echo $categoriacanal_view->descripcion->caption() ?></span></td>
		<td data-name="descripcion" <?php echo $categoriacanal_view->descripcion->cellAttributes() ?>>
<span id="el_categoriacanal_descripcion">
<span<?php echo $categoriacanal_view->descripcion->viewAttributes() ?>><?php echo $categoriacanal_view->descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($categoriacanal_view->urlImagen->Visible) { // urlImagen ?>
	<tr id="r_urlImagen">
		<td class="<?php echo $categoriacanal_view->TableLeftColumnClass ?>"><span id="elh_categoriacanal_urlImagen"><?php echo $categoriacanal_view->urlImagen->caption() ?></span></td>
		<td data-name="urlImagen" <?php echo $categoriacanal_view->urlImagen->cellAttributes() ?>>
<span id="el_categoriacanal_urlImagen">
<span<?php echo $categoriacanal_view->urlImagen->viewAttributes() ?>><?php echo $categoriacanal_view->urlImagen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$categoriacanal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$categoriacanal_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$categoriacanal_view->terminate();
?>