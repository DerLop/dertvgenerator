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
$categoriacanal_delete = new categoriacanal_delete();

// Run the page
$categoriacanal_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categoriacanal_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcategoriacanaldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcategoriacanaldelete = currentForm = new ew.Form("fcategoriacanaldelete", "delete");
	loadjs.done("fcategoriacanaldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $categoriacanal_delete->showPageHeader(); ?>
<?php
$categoriacanal_delete->showMessage();
?>
<form name="fcategoriacanaldelete" id="fcategoriacanaldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categoriacanal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($categoriacanal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($categoriacanal_delete->id->Visible) { // id ?>
		<th class="<?php echo $categoriacanal_delete->id->headerCellClass() ?>"><span id="elh_categoriacanal_id" class="categoriacanal_id"><?php echo $categoriacanal_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($categoriacanal_delete->categoria->Visible) { // categoria ?>
		<th class="<?php echo $categoriacanal_delete->categoria->headerCellClass() ?>"><span id="elh_categoriacanal_categoria" class="categoriacanal_categoria"><?php echo $categoriacanal_delete->categoria->caption() ?></span></th>
<?php } ?>
<?php if ($categoriacanal_delete->descripcion->Visible) { // descripcion ?>
		<th class="<?php echo $categoriacanal_delete->descripcion->headerCellClass() ?>"><span id="elh_categoriacanal_descripcion" class="categoriacanal_descripcion"><?php echo $categoriacanal_delete->descripcion->caption() ?></span></th>
<?php } ?>
<?php if ($categoriacanal_delete->urlImagen->Visible) { // urlImagen ?>
		<th class="<?php echo $categoriacanal_delete->urlImagen->headerCellClass() ?>"><span id="elh_categoriacanal_urlImagen" class="categoriacanal_urlImagen"><?php echo $categoriacanal_delete->urlImagen->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$categoriacanal_delete->RecordCount = 0;
$i = 0;
while (!$categoriacanal_delete->Recordset->EOF) {
	$categoriacanal_delete->RecordCount++;
	$categoriacanal_delete->RowCount++;

	// Set row properties
	$categoriacanal->resetAttributes();
	$categoriacanal->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$categoriacanal_delete->loadRowValues($categoriacanal_delete->Recordset);

	// Render row
	$categoriacanal_delete->renderRow();
?>
	<tr <?php echo $categoriacanal->rowAttributes() ?>>
<?php if ($categoriacanal_delete->id->Visible) { // id ?>
		<td <?php echo $categoriacanal_delete->id->cellAttributes() ?>>
<span id="el<?php echo $categoriacanal_delete->RowCount ?>_categoriacanal_id" class="categoriacanal_id">
<span<?php echo $categoriacanal_delete->id->viewAttributes() ?>><?php echo $categoriacanal_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($categoriacanal_delete->categoria->Visible) { // categoria ?>
		<td <?php echo $categoriacanal_delete->categoria->cellAttributes() ?>>
<span id="el<?php echo $categoriacanal_delete->RowCount ?>_categoriacanal_categoria" class="categoriacanal_categoria">
<span<?php echo $categoriacanal_delete->categoria->viewAttributes() ?>><?php echo $categoriacanal_delete->categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($categoriacanal_delete->descripcion->Visible) { // descripcion ?>
		<td <?php echo $categoriacanal_delete->descripcion->cellAttributes() ?>>
<span id="el<?php echo $categoriacanal_delete->RowCount ?>_categoriacanal_descripcion" class="categoriacanal_descripcion">
<span<?php echo $categoriacanal_delete->descripcion->viewAttributes() ?>><?php echo $categoriacanal_delete->descripcion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($categoriacanal_delete->urlImagen->Visible) { // urlImagen ?>
		<td <?php echo $categoriacanal_delete->urlImagen->cellAttributes() ?>>
<span id="el<?php echo $categoriacanal_delete->RowCount ?>_categoriacanal_urlImagen" class="categoriacanal_urlImagen">
<span<?php echo $categoriacanal_delete->urlImagen->viewAttributes() ?>><?php echo $categoriacanal_delete->urlImagen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$categoriacanal_delete->Recordset->moveNext();
}
$categoriacanal_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categoriacanal_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$categoriacanal_delete->showPageFooter();
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
$categoriacanal_delete->terminate();
?>