<?php
namespace PHPMaker2020\project1;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($categoriacanal_grid))
	$categoriacanal_grid = new categoriacanal_grid();

// Run the page
$categoriacanal_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categoriacanal_grid->Page_Render();
?>
<?php if (!$categoriacanal_grid->isExport()) { ?>
<script>
var fcategoriacanalgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcategoriacanalgrid = new ew.Form("fcategoriacanalgrid", "grid");
	fcategoriacanalgrid.formKeyCountName = '<?php echo $categoriacanal_grid->FormKeyCountName ?>';

	// Validate form
	fcategoriacanalgrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($categoriacanal_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_grid->id->caption(), $categoriacanal_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categoriacanal_grid->categoria->Required) { ?>
				elm = this.getElements("x" + infix + "_categoria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_grid->categoria->caption(), $categoriacanal_grid->categoria->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categoriacanal_grid->descripcion->Required) { ?>
				elm = this.getElements("x" + infix + "_descripcion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_grid->descripcion->caption(), $categoriacanal_grid->descripcion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categoriacanal_grid->urlImagen->Required) { ?>
				elm = this.getElements("x" + infix + "_urlImagen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_grid->urlImagen->caption(), $categoriacanal_grid->urlImagen->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcategoriacanalgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "categoria", false)) return false;
		if (ew.valueChanged(fobj, infix, "descripcion", false)) return false;
		if (ew.valueChanged(fobj, infix, "urlImagen", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcategoriacanalgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcategoriacanalgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcategoriacanalgrid");
});
</script>
<?php } ?>
<?php
$categoriacanal_grid->renderOtherOptions();
?>
<?php if ($categoriacanal_grid->TotalRecords > 0 || $categoriacanal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($categoriacanal_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> categoriacanal">
<div id="fcategoriacanalgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_categoriacanal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_categoriacanalgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$categoriacanal->RowType = ROWTYPE_HEADER;

// Render list options
$categoriacanal_grid->renderListOptions();

// Render list options (header, left)
$categoriacanal_grid->ListOptions->render("header", "left");
?>
<?php if ($categoriacanal_grid->id->Visible) { // id ?>
	<?php if ($categoriacanal_grid->SortUrl($categoriacanal_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $categoriacanal_grid->id->headerCellClass() ?>"><div id="elh_categoriacanal_id" class="categoriacanal_id"><div class="ew-table-header-caption"><?php echo $categoriacanal_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $categoriacanal_grid->id->headerCellClass() ?>"><div><div id="elh_categoriacanal_id" class="categoriacanal_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categoriacanal_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($categoriacanal_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categoriacanal_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categoriacanal_grid->categoria->Visible) { // categoria ?>
	<?php if ($categoriacanal_grid->SortUrl($categoriacanal_grid->categoria) == "") { ?>
		<th data-name="categoria" class="<?php echo $categoriacanal_grid->categoria->headerCellClass() ?>"><div id="elh_categoriacanal_categoria" class="categoriacanal_categoria"><div class="ew-table-header-caption"><?php echo $categoriacanal_grid->categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="categoria" class="<?php echo $categoriacanal_grid->categoria->headerCellClass() ?>"><div><div id="elh_categoriacanal_categoria" class="categoriacanal_categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categoriacanal_grid->categoria->caption() ?></span><span class="ew-table-header-sort"><?php if ($categoriacanal_grid->categoria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categoriacanal_grid->categoria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categoriacanal_grid->descripcion->Visible) { // descripcion ?>
	<?php if ($categoriacanal_grid->SortUrl($categoriacanal_grid->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $categoriacanal_grid->descripcion->headerCellClass() ?>"><div id="elh_categoriacanal_descripcion" class="categoriacanal_descripcion"><div class="ew-table-header-caption"><?php echo $categoriacanal_grid->descripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $categoriacanal_grid->descripcion->headerCellClass() ?>"><div><div id="elh_categoriacanal_descripcion" class="categoriacanal_descripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categoriacanal_grid->descripcion->caption() ?></span><span class="ew-table-header-sort"><?php if ($categoriacanal_grid->descripcion->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categoriacanal_grid->descripcion->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categoriacanal_grid->urlImagen->Visible) { // urlImagen ?>
	<?php if ($categoriacanal_grid->SortUrl($categoriacanal_grid->urlImagen) == "") { ?>
		<th data-name="urlImagen" class="<?php echo $categoriacanal_grid->urlImagen->headerCellClass() ?>"><div id="elh_categoriacanal_urlImagen" class="categoriacanal_urlImagen"><div class="ew-table-header-caption"><?php echo $categoriacanal_grid->urlImagen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="urlImagen" class="<?php echo $categoriacanal_grid->urlImagen->headerCellClass() ?>"><div><div id="elh_categoriacanal_urlImagen" class="categoriacanal_urlImagen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categoriacanal_grid->urlImagen->caption() ?></span><span class="ew-table-header-sort"><?php if ($categoriacanal_grid->urlImagen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categoriacanal_grid->urlImagen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$categoriacanal_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$categoriacanal_grid->StartRecord = 1;
$categoriacanal_grid->StopRecord = $categoriacanal_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($categoriacanal->isConfirm() || $categoriacanal_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($categoriacanal_grid->FormKeyCountName) && ($categoriacanal_grid->isGridAdd() || $categoriacanal_grid->isGridEdit() || $categoriacanal->isConfirm())) {
		$categoriacanal_grid->KeyCount = $CurrentForm->getValue($categoriacanal_grid->FormKeyCountName);
		$categoriacanal_grid->StopRecord = $categoriacanal_grid->StartRecord + $categoriacanal_grid->KeyCount - 1;
	}
}
$categoriacanal_grid->RecordCount = $categoriacanal_grid->StartRecord - 1;
if ($categoriacanal_grid->Recordset && !$categoriacanal_grid->Recordset->EOF) {
	$categoriacanal_grid->Recordset->moveFirst();
	$selectLimit = $categoriacanal_grid->UseSelectLimit;
	if (!$selectLimit && $categoriacanal_grid->StartRecord > 1)
		$categoriacanal_grid->Recordset->move($categoriacanal_grid->StartRecord - 1);
} elseif (!$categoriacanal->AllowAddDeleteRow && $categoriacanal_grid->StopRecord == 0) {
	$categoriacanal_grid->StopRecord = $categoriacanal->GridAddRowCount;
}

// Initialize aggregate
$categoriacanal->RowType = ROWTYPE_AGGREGATEINIT;
$categoriacanal->resetAttributes();
$categoriacanal_grid->renderRow();
if ($categoriacanal_grid->isGridAdd())
	$categoriacanal_grid->RowIndex = 0;
if ($categoriacanal_grid->isGridEdit())
	$categoriacanal_grid->RowIndex = 0;
while ($categoriacanal_grid->RecordCount < $categoriacanal_grid->StopRecord) {
	$categoriacanal_grid->RecordCount++;
	if ($categoriacanal_grid->RecordCount >= $categoriacanal_grid->StartRecord) {
		$categoriacanal_grid->RowCount++;
		if ($categoriacanal_grid->isGridAdd() || $categoriacanal_grid->isGridEdit() || $categoriacanal->isConfirm()) {
			$categoriacanal_grid->RowIndex++;
			$CurrentForm->Index = $categoriacanal_grid->RowIndex;
			if ($CurrentForm->hasValue($categoriacanal_grid->FormActionName) && ($categoriacanal->isConfirm() || $categoriacanal_grid->EventCancelled))
				$categoriacanal_grid->RowAction = strval($CurrentForm->getValue($categoriacanal_grid->FormActionName));
			elseif ($categoriacanal_grid->isGridAdd())
				$categoriacanal_grid->RowAction = "insert";
			else
				$categoriacanal_grid->RowAction = "";
		}

		// Set up key count
		$categoriacanal_grid->KeyCount = $categoriacanal_grid->RowIndex;

		// Init row class and style
		$categoriacanal->resetAttributes();
		$categoriacanal->CssClass = "";
		if ($categoriacanal_grid->isGridAdd()) {
			if ($categoriacanal->CurrentMode == "copy") {
				$categoriacanal_grid->loadRowValues($categoriacanal_grid->Recordset); // Load row values
				$categoriacanal_grid->setRecordKey($categoriacanal_grid->RowOldKey, $categoriacanal_grid->Recordset); // Set old record key
			} else {
				$categoriacanal_grid->loadRowValues(); // Load default values
				$categoriacanal_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$categoriacanal_grid->loadRowValues($categoriacanal_grid->Recordset); // Load row values
		}
		$categoriacanal->RowType = ROWTYPE_VIEW; // Render view
		if ($categoriacanal_grid->isGridAdd()) // Grid add
			$categoriacanal->RowType = ROWTYPE_ADD; // Render add
		if ($categoriacanal_grid->isGridAdd() && $categoriacanal->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$categoriacanal_grid->restoreCurrentRowFormValues($categoriacanal_grid->RowIndex); // Restore form values
		if ($categoriacanal_grid->isGridEdit()) { // Grid edit
			if ($categoriacanal->EventCancelled)
				$categoriacanal_grid->restoreCurrentRowFormValues($categoriacanal_grid->RowIndex); // Restore form values
			if ($categoriacanal_grid->RowAction == "insert")
				$categoriacanal->RowType = ROWTYPE_ADD; // Render add
			else
				$categoriacanal->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($categoriacanal_grid->isGridEdit() && ($categoriacanal->RowType == ROWTYPE_EDIT || $categoriacanal->RowType == ROWTYPE_ADD) && $categoriacanal->EventCancelled) // Update failed
			$categoriacanal_grid->restoreCurrentRowFormValues($categoriacanal_grid->RowIndex); // Restore form values
		if ($categoriacanal->RowType == ROWTYPE_EDIT) // Edit row
			$categoriacanal_grid->EditRowCount++;
		if ($categoriacanal->isConfirm()) // Confirm row
			$categoriacanal_grid->restoreCurrentRowFormValues($categoriacanal_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$categoriacanal->RowAttrs->merge(["data-rowindex" => $categoriacanal_grid->RowCount, "id" => "r" . $categoriacanal_grid->RowCount . "_categoriacanal", "data-rowtype" => $categoriacanal->RowType]);

		// Render row
		$categoriacanal_grid->renderRow();

		// Render list options
		$categoriacanal_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($categoriacanal_grid->RowAction != "delete" && $categoriacanal_grid->RowAction != "insertdelete" && !($categoriacanal_grid->RowAction == "insert" && $categoriacanal->isConfirm() && $categoriacanal_grid->emptyRow())) {
?>
	<tr <?php echo $categoriacanal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$categoriacanal_grid->ListOptions->render("body", "left", $categoriacanal_grid->RowCount);
?>
	<?php if ($categoriacanal_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $categoriacanal_grid->id->cellAttributes() ?>>
<?php if ($categoriacanal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_id" class="form-group"></span>
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="o<?php echo $categoriacanal_grid->RowIndex ?>_id" id="o<?php echo $categoriacanal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($categoriacanal_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($categoriacanal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_id" class="form-group">
<span<?php echo $categoriacanal_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($categoriacanal_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="x<?php echo $categoriacanal_grid->RowIndex ?>_id" id="x<?php echo $categoriacanal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($categoriacanal_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($categoriacanal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_id">
<span<?php echo $categoriacanal_grid->id->viewAttributes() ?>><?php echo $categoriacanal_grid->id->getViewValue() ?></span>
</span>
<?php if (!$categoriacanal->isConfirm()) { ?>
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="x<?php echo $categoriacanal_grid->RowIndex ?>_id" id="x<?php echo $categoriacanal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($categoriacanal_grid->id->FormValue) ?>">
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="o<?php echo $categoriacanal_grid->RowIndex ?>_id" id="o<?php echo $categoriacanal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($categoriacanal_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="fcategoriacanalgrid$x<?php echo $categoriacanal_grid->RowIndex ?>_id" id="fcategoriacanalgrid$x<?php echo $categoriacanal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($categoriacanal_grid->id->FormValue) ?>">
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="fcategoriacanalgrid$o<?php echo $categoriacanal_grid->RowIndex ?>_id" id="fcategoriacanalgrid$o<?php echo $categoriacanal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($categoriacanal_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($categoriacanal_grid->categoria->Visible) { // categoria ?>
		<td data-name="categoria" <?php echo $categoriacanal_grid->categoria->cellAttributes() ?>>
<?php if ($categoriacanal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_categoria" class="form-group">
<input type="text" data-table="categoriacanal" data-field="x_categoria" name="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->categoria->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->categoria->EditValue ?>"<?php echo $categoriacanal_grid->categoria->editAttributes() ?>>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_categoria" name="o<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="o<?php echo $categoriacanal_grid->RowIndex ?>_categoria" value="<?php echo HtmlEncode($categoriacanal_grid->categoria->OldValue) ?>">
<?php } ?>
<?php if ($categoriacanal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_categoria" class="form-group">
<input type="text" data-table="categoriacanal" data-field="x_categoria" name="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->categoria->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->categoria->EditValue ?>"<?php echo $categoriacanal_grid->categoria->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($categoriacanal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_categoria">
<span<?php echo $categoriacanal_grid->categoria->viewAttributes() ?>><?php echo $categoriacanal_grid->categoria->getViewValue() ?></span>
</span>
<?php if (!$categoriacanal->isConfirm()) { ?>
<input type="hidden" data-table="categoriacanal" data-field="x_categoria" name="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" value="<?php echo HtmlEncode($categoriacanal_grid->categoria->FormValue) ?>">
<input type="hidden" data-table="categoriacanal" data-field="x_categoria" name="o<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="o<?php echo $categoriacanal_grid->RowIndex ?>_categoria" value="<?php echo HtmlEncode($categoriacanal_grid->categoria->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="categoriacanal" data-field="x_categoria" name="fcategoriacanalgrid$x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="fcategoriacanalgrid$x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" value="<?php echo HtmlEncode($categoriacanal_grid->categoria->FormValue) ?>">
<input type="hidden" data-table="categoriacanal" data-field="x_categoria" name="fcategoriacanalgrid$o<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="fcategoriacanalgrid$o<?php echo $categoriacanal_grid->RowIndex ?>_categoria" value="<?php echo HtmlEncode($categoriacanal_grid->categoria->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($categoriacanal_grid->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion" <?php echo $categoriacanal_grid->descripcion->cellAttributes() ?>>
<?php if ($categoriacanal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_descripcion" class="form-group">
<input type="text" data-table="categoriacanal" data-field="x_descripcion" name="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->descripcion->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->descripcion->EditValue ?>"<?php echo $categoriacanal_grid->descripcion->editAttributes() ?>>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_descripcion" name="o<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="o<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" value="<?php echo HtmlEncode($categoriacanal_grid->descripcion->OldValue) ?>">
<?php } ?>
<?php if ($categoriacanal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_descripcion" class="form-group">
<input type="text" data-table="categoriacanal" data-field="x_descripcion" name="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->descripcion->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->descripcion->EditValue ?>"<?php echo $categoriacanal_grid->descripcion->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($categoriacanal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_descripcion">
<span<?php echo $categoriacanal_grid->descripcion->viewAttributes() ?>><?php echo $categoriacanal_grid->descripcion->getViewValue() ?></span>
</span>
<?php if (!$categoriacanal->isConfirm()) { ?>
<input type="hidden" data-table="categoriacanal" data-field="x_descripcion" name="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" value="<?php echo HtmlEncode($categoriacanal_grid->descripcion->FormValue) ?>">
<input type="hidden" data-table="categoriacanal" data-field="x_descripcion" name="o<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="o<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" value="<?php echo HtmlEncode($categoriacanal_grid->descripcion->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="categoriacanal" data-field="x_descripcion" name="fcategoriacanalgrid$x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="fcategoriacanalgrid$x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" value="<?php echo HtmlEncode($categoriacanal_grid->descripcion->FormValue) ?>">
<input type="hidden" data-table="categoriacanal" data-field="x_descripcion" name="fcategoriacanalgrid$o<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="fcategoriacanalgrid$o<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" value="<?php echo HtmlEncode($categoriacanal_grid->descripcion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($categoriacanal_grid->urlImagen->Visible) { // urlImagen ?>
		<td data-name="urlImagen" <?php echo $categoriacanal_grid->urlImagen->cellAttributes() ?>>
<?php if ($categoriacanal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_urlImagen" class="form-group">
<input type="text" data-table="categoriacanal" data-field="x_urlImagen" name="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->urlImagen->EditValue ?>"<?php echo $categoriacanal_grid->urlImagen->editAttributes() ?>>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_urlImagen" name="o<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="o<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" value="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->OldValue) ?>">
<?php } ?>
<?php if ($categoriacanal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_urlImagen" class="form-group">
<input type="text" data-table="categoriacanal" data-field="x_urlImagen" name="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->urlImagen->EditValue ?>"<?php echo $categoriacanal_grid->urlImagen->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($categoriacanal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $categoriacanal_grid->RowCount ?>_categoriacanal_urlImagen">
<span<?php echo $categoriacanal_grid->urlImagen->viewAttributes() ?>><?php echo $categoriacanal_grid->urlImagen->getViewValue() ?></span>
</span>
<?php if (!$categoriacanal->isConfirm()) { ?>
<input type="hidden" data-table="categoriacanal" data-field="x_urlImagen" name="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" value="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->FormValue) ?>">
<input type="hidden" data-table="categoriacanal" data-field="x_urlImagen" name="o<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="o<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" value="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="categoriacanal" data-field="x_urlImagen" name="fcategoriacanalgrid$x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="fcategoriacanalgrid$x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" value="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->FormValue) ?>">
<input type="hidden" data-table="categoriacanal" data-field="x_urlImagen" name="fcategoriacanalgrid$o<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="fcategoriacanalgrid$o<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" value="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$categoriacanal_grid->ListOptions->render("body", "right", $categoriacanal_grid->RowCount);
?>
	</tr>
<?php if ($categoriacanal->RowType == ROWTYPE_ADD || $categoriacanal->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcategoriacanalgrid", "load"], function() {
	fcategoriacanalgrid.updateLists(<?php echo $categoriacanal_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$categoriacanal_grid->isGridAdd() || $categoriacanal->CurrentMode == "copy")
		if (!$categoriacanal_grid->Recordset->EOF)
			$categoriacanal_grid->Recordset->moveNext();
}
?>
<?php
	if ($categoriacanal->CurrentMode == "add" || $categoriacanal->CurrentMode == "copy" || $categoriacanal->CurrentMode == "edit") {
		$categoriacanal_grid->RowIndex = '$rowindex$';
		$categoriacanal_grid->loadRowValues();

		// Set row properties
		$categoriacanal->resetAttributes();
		$categoriacanal->RowAttrs->merge(["data-rowindex" => $categoriacanal_grid->RowIndex, "id" => "r0_categoriacanal", "data-rowtype" => ROWTYPE_ADD]);
		$categoriacanal->RowAttrs->appendClass("ew-template");
		$categoriacanal->RowType = ROWTYPE_ADD;

		// Render row
		$categoriacanal_grid->renderRow();

		// Render list options
		$categoriacanal_grid->renderListOptions();
		$categoriacanal_grid->StartRowCount = 0;
?>
	<tr <?php echo $categoriacanal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$categoriacanal_grid->ListOptions->render("body", "left", $categoriacanal_grid->RowIndex);
?>
	<?php if ($categoriacanal_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$categoriacanal->isConfirm()) { ?>
<span id="el$rowindex$_categoriacanal_id" class="form-group categoriacanal_id"></span>
<?php } else { ?>
<span id="el$rowindex$_categoriacanal_id" class="form-group categoriacanal_id">
<span<?php echo $categoriacanal_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($categoriacanal_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="x<?php echo $categoriacanal_grid->RowIndex ?>_id" id="x<?php echo $categoriacanal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($categoriacanal_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="o<?php echo $categoriacanal_grid->RowIndex ?>_id" id="o<?php echo $categoriacanal_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($categoriacanal_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($categoriacanal_grid->categoria->Visible) { // categoria ?>
		<td data-name="categoria">
<?php if (!$categoriacanal->isConfirm()) { ?>
<span id="el$rowindex$_categoriacanal_categoria" class="form-group categoriacanal_categoria">
<input type="text" data-table="categoriacanal" data-field="x_categoria" name="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->categoria->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->categoria->EditValue ?>"<?php echo $categoriacanal_grid->categoria->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_categoriacanal_categoria" class="form-group categoriacanal_categoria">
<span<?php echo $categoriacanal_grid->categoria->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($categoriacanal_grid->categoria->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_categoria" name="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="x<?php echo $categoriacanal_grid->RowIndex ?>_categoria" value="<?php echo HtmlEncode($categoriacanal_grid->categoria->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="categoriacanal" data-field="x_categoria" name="o<?php echo $categoriacanal_grid->RowIndex ?>_categoria" id="o<?php echo $categoriacanal_grid->RowIndex ?>_categoria" value="<?php echo HtmlEncode($categoriacanal_grid->categoria->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($categoriacanal_grid->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion">
<?php if (!$categoriacanal->isConfirm()) { ?>
<span id="el$rowindex$_categoriacanal_descripcion" class="form-group categoriacanal_descripcion">
<input type="text" data-table="categoriacanal" data-field="x_descripcion" name="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->descripcion->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->descripcion->EditValue ?>"<?php echo $categoriacanal_grid->descripcion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_categoriacanal_descripcion" class="form-group categoriacanal_descripcion">
<span<?php echo $categoriacanal_grid->descripcion->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($categoriacanal_grid->descripcion->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_descripcion" name="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="x<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" value="<?php echo HtmlEncode($categoriacanal_grid->descripcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="categoriacanal" data-field="x_descripcion" name="o<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" id="o<?php echo $categoriacanal_grid->RowIndex ?>_descripcion" value="<?php echo HtmlEncode($categoriacanal_grid->descripcion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($categoriacanal_grid->urlImagen->Visible) { // urlImagen ?>
		<td data-name="urlImagen">
<?php if (!$categoriacanal->isConfirm()) { ?>
<span id="el$rowindex$_categoriacanal_urlImagen" class="form-group categoriacanal_urlImagen">
<input type="text" data-table="categoriacanal" data-field="x_urlImagen" name="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_grid->urlImagen->EditValue ?>"<?php echo $categoriacanal_grid->urlImagen->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_categoriacanal_urlImagen" class="form-group categoriacanal_urlImagen">
<span<?php echo $categoriacanal_grid->urlImagen->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($categoriacanal_grid->urlImagen->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_urlImagen" name="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="x<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" value="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="categoriacanal" data-field="x_urlImagen" name="o<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" id="o<?php echo $categoriacanal_grid->RowIndex ?>_urlImagen" value="<?php echo HtmlEncode($categoriacanal_grid->urlImagen->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$categoriacanal_grid->ListOptions->render("body", "right", $categoriacanal_grid->RowIndex);
?>
<script>
loadjs.ready(["fcategoriacanalgrid", "load"], function() {
	fcategoriacanalgrid.updateLists(<?php echo $categoriacanal_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($categoriacanal->CurrentMode == "add" || $categoriacanal->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $categoriacanal_grid->FormKeyCountName ?>" id="<?php echo $categoriacanal_grid->FormKeyCountName ?>" value="<?php echo $categoriacanal_grid->KeyCount ?>">
<?php echo $categoriacanal_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($categoriacanal->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $categoriacanal_grid->FormKeyCountName ?>" id="<?php echo $categoriacanal_grid->FormKeyCountName ?>" value="<?php echo $categoriacanal_grid->KeyCount ?>">
<?php echo $categoriacanal_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($categoriacanal->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcategoriacanalgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($categoriacanal_grid->Recordset)
	$categoriacanal_grid->Recordset->Close();
?>
<?php if ($categoriacanal_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $categoriacanal_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($categoriacanal_grid->TotalRecords == 0 && !$categoriacanal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $categoriacanal_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$categoriacanal_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$categoriacanal_grid->terminate();
?>