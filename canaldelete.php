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
$canal_delete = new canal_delete();

// Run the page
$canal_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$canal_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcanaldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcanaldelete = currentForm = new ew.Form("fcanaldelete", "delete");
	loadjs.done("fcanaldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $canal_delete->showPageHeader(); ?>
<?php
$canal_delete->showMessage();
?>
<form name="fcanaldelete" id="fcanaldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="canal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($canal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($canal_delete->id->Visible) { // id ?>
		<th class="<?php echo $canal_delete->id->headerCellClass() ?>"><span id="elh_canal_id" class="canal_id"><?php echo $canal_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($canal_delete->nombreCanal->Visible) { // nombreCanal ?>
		<th class="<?php echo $canal_delete->nombreCanal->headerCellClass() ?>"><span id="elh_canal_nombreCanal" class="canal_nombreCanal"><?php echo $canal_delete->nombreCanal->caption() ?></span></th>
<?php } ?>
<?php if ($canal_delete->urlCanal->Visible) { // urlCanal ?>
		<th class="<?php echo $canal_delete->urlCanal->headerCellClass() ?>"><span id="elh_canal_urlCanal" class="canal_urlCanal"><?php echo $canal_delete->urlCanal->caption() ?></span></th>
<?php } ?>
<?php if ($canal_delete->urlImage->Visible) { // urlImage ?>
		<th class="<?php echo $canal_delete->urlImage->headerCellClass() ?>"><span id="elh_canal_urlImage" class="canal_urlImage"><?php echo $canal_delete->urlImage->caption() ?></span></th>
<?php } ?>
<?php if ($canal_delete->id_categoriaCanal->Visible) { // id_categoriaCanal ?>
		<th class="<?php echo $canal_delete->id_categoriaCanal->headerCellClass() ?>"><span id="elh_canal_id_categoriaCanal" class="canal_id_categoriaCanal"><?php echo $canal_delete->id_categoriaCanal->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$canal_delete->RecordCount = 0;
$i = 0;
while (!$canal_delete->Recordset->EOF) {
	$canal_delete->RecordCount++;
	$canal_delete->RowCount++;

	// Set row properties
	$canal->resetAttributes();
	$canal->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$canal_delete->loadRowValues($canal_delete->Recordset);

	// Render row
	$canal_delete->renderRow();
?>
	<tr <?php echo $canal->rowAttributes() ?>>
<?php if ($canal_delete->id->Visible) { // id ?>
		<td <?php echo $canal_delete->id->cellAttributes() ?>>
<span id="el<?php echo $canal_delete->RowCount ?>_canal_id" class="canal_id">
<span<?php echo $canal_delete->id->viewAttributes() ?>><?php echo $canal_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($canal_delete->nombreCanal->Visible) { // nombreCanal ?>
		<td <?php echo $canal_delete->nombreCanal->cellAttributes() ?>>
<span id="el<?php echo $canal_delete->RowCount ?>_canal_nombreCanal" class="canal_nombreCanal">
<span<?php echo $canal_delete->nombreCanal->viewAttributes() ?>><?php echo $canal_delete->nombreCanal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($canal_delete->urlCanal->Visible) { // urlCanal ?>
		<td <?php echo $canal_delete->urlCanal->cellAttributes() ?>>
<span id="el<?php echo $canal_delete->RowCount ?>_canal_urlCanal" class="canal_urlCanal">
<span<?php echo $canal_delete->urlCanal->viewAttributes() ?>><?php echo $canal_delete->urlCanal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($canal_delete->urlImage->Visible) { // urlImage ?>
		<td <?php echo $canal_delete->urlImage->cellAttributes() ?>>
<span id="el<?php echo $canal_delete->RowCount ?>_canal_urlImage" class="canal_urlImage">
<span<?php echo $canal_delete->urlImage->viewAttributes() ?>><?php echo $canal_delete->urlImage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($canal_delete->id_categoriaCanal->Visible) { // id_categoriaCanal ?>
		<td <?php echo $canal_delete->id_categoriaCanal->cellAttributes() ?>>
<span id="el<?php echo $canal_delete->RowCount ?>_canal_id_categoriaCanal" class="canal_id_categoriaCanal">
<span<?php echo $canal_delete->id_categoriaCanal->viewAttributes() ?>><?php echo $canal_delete->id_categoriaCanal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$canal_delete->Recordset->moveNext();
}
$canal_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $canal_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$canal_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$canal_delete->terminate();
?>