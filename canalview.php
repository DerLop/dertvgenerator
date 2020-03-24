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
$canal_view = new canal_view();

// Run the page
$canal_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$canal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$canal_view->isExport()) { ?>
<script>
var fcanalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcanalview = currentForm = new ew.Form("fcanalview", "view");
	loadjs.done("fcanalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$canal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $canal_view->ExportOptions->render("body") ?>
<?php $canal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $canal_view->showPageHeader(); ?>
<?php
$canal_view->showMessage();
?>
<form name="fcanalview" id="fcanalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="canal">
<input type="hidden" name="modal" value="<?php echo (int)$canal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($canal_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $canal_view->TableLeftColumnClass ?>"><span id="elh_canal_id"><?php echo $canal_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $canal_view->id->cellAttributes() ?>>
<span id="el_canal_id">
<span<?php echo $canal_view->id->viewAttributes() ?>><?php echo $canal_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($canal_view->nombreCanal->Visible) { // nombreCanal ?>
	<tr id="r_nombreCanal">
		<td class="<?php echo $canal_view->TableLeftColumnClass ?>"><span id="elh_canal_nombreCanal"><?php echo $canal_view->nombreCanal->caption() ?></span></td>
		<td data-name="nombreCanal" <?php echo $canal_view->nombreCanal->cellAttributes() ?>>
<span id="el_canal_nombreCanal">
<span<?php echo $canal_view->nombreCanal->viewAttributes() ?>><?php echo $canal_view->nombreCanal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($canal_view->urlCanal->Visible) { // urlCanal ?>
	<tr id="r_urlCanal">
		<td class="<?php echo $canal_view->TableLeftColumnClass ?>"><span id="elh_canal_urlCanal"><?php echo $canal_view->urlCanal->caption() ?></span></td>
		<td data-name="urlCanal" <?php echo $canal_view->urlCanal->cellAttributes() ?>>
<span id="el_canal_urlCanal">
<span<?php echo $canal_view->urlCanal->viewAttributes() ?>><?php echo $canal_view->urlCanal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($canal_view->urlImage->Visible) { // urlImage ?>
	<tr id="r_urlImage">
		<td class="<?php echo $canal_view->TableLeftColumnClass ?>"><span id="elh_canal_urlImage"><?php echo $canal_view->urlImage->caption() ?></span></td>
		<td data-name="urlImage" <?php echo $canal_view->urlImage->cellAttributes() ?>>
<span id="el_canal_urlImage">
<span<?php echo $canal_view->urlImage->viewAttributes() ?>><?php echo $canal_view->urlImage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($canal_view->id_categoriaCanal->Visible) { // id_categoriaCanal ?>
	<tr id="r_id_categoriaCanal">
		<td class="<?php echo $canal_view->TableLeftColumnClass ?>"><span id="elh_canal_id_categoriaCanal"><?php echo $canal_view->id_categoriaCanal->caption() ?></span></td>
		<td data-name="id_categoriaCanal" <?php echo $canal_view->id_categoriaCanal->cellAttributes() ?>>
<span id="el_canal_id_categoriaCanal">
<span<?php echo $canal_view->id_categoriaCanal->viewAttributes() ?>><?php echo $canal_view->id_categoriaCanal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("categoriacanal", explode(",", $canal->getCurrentDetailTable())) && $categoriacanal->DetailView) {
?>
<?php if ($canal->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("categoriacanal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "categoriacanalgrid.php" ?>
<?php } ?>
</form>
<?php
$canal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$canal_view->isExport()) { ?>
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
$canal_view->terminate();
?>