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
$categoriacanal_list = new categoriacanal_list();

// Run the page
$categoriacanal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categoriacanal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$categoriacanal_list->isExport()) { ?>
<script>
var fcategoriacanallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcategoriacanallist = currentForm = new ew.Form("fcategoriacanallist", "list");
	fcategoriacanallist.formKeyCountName = '<?php echo $categoriacanal_list->FormKeyCountName ?>';
	loadjs.done("fcategoriacanallist");
});
var fcategoriacanallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcategoriacanallistsrch = currentSearchForm = new ew.Form("fcategoriacanallistsrch");

	// Dynamic selection lists
	// Filters

	fcategoriacanallistsrch.filterList = <?php echo $categoriacanal_list->getFilterList() ?>;
	loadjs.done("fcategoriacanallistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$categoriacanal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($categoriacanal_list->TotalRecords > 0 && $categoriacanal_list->ExportOptions->visible()) { ?>
<?php $categoriacanal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($categoriacanal_list->ImportOptions->visible()) { ?>
<?php $categoriacanal_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($categoriacanal_list->SearchOptions->visible()) { ?>
<?php $categoriacanal_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($categoriacanal_list->FilterOptions->visible()) { ?>
<?php $categoriacanal_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$categoriacanal_list->isExport() || Config("EXPORT_MASTER_RECORD") && $categoriacanal_list->isExport("print")) { ?>
<?php
if ($categoriacanal_list->DbMasterFilter != "" && $categoriacanal->getCurrentMasterTable() == "canal") {
	if ($categoriacanal_list->MasterRecordExists) {
		include_once "canalmaster.php";
	}
}
?>
<?php } ?>
<?php
$categoriacanal_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$categoriacanal_list->isExport() && !$categoriacanal->CurrentAction) { ?>
<form name="fcategoriacanallistsrch" id="fcategoriacanallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcategoriacanallistsrch-search-panel" class="<?php echo $categoriacanal_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="categoriacanal">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $categoriacanal_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($categoriacanal_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($categoriacanal_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $categoriacanal_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($categoriacanal_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($categoriacanal_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($categoriacanal_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($categoriacanal_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $categoriacanal_list->showPageHeader(); ?>
<?php
$categoriacanal_list->showMessage();
?>
<?php if ($categoriacanal_list->TotalRecords > 0 || $categoriacanal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($categoriacanal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> categoriacanal">
<form name="fcategoriacanallist" id="fcategoriacanallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categoriacanal">
<?php if ($categoriacanal->getCurrentMasterTable() == "canal" && $categoriacanal->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="canal">
<input type="hidden" name="fk_id_categoriaCanal" value="<?php echo $categoriacanal_list->id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_categoriacanal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($categoriacanal_list->TotalRecords > 0 || $categoriacanal_list->isGridEdit()) { ?>
<table id="tbl_categoriacanallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$categoriacanal->RowType = ROWTYPE_HEADER;

// Render list options
$categoriacanal_list->renderListOptions();

// Render list options (header, left)
$categoriacanal_list->ListOptions->render("header", "left");
?>
<?php if ($categoriacanal_list->id->Visible) { // id ?>
	<?php if ($categoriacanal_list->SortUrl($categoriacanal_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $categoriacanal_list->id->headerCellClass() ?>"><div id="elh_categoriacanal_id" class="categoriacanal_id"><div class="ew-table-header-caption"><?php echo $categoriacanal_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $categoriacanal_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $categoriacanal_list->SortUrl($categoriacanal_list->id) ?>', 1);"><div id="elh_categoriacanal_id" class="categoriacanal_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categoriacanal_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($categoriacanal_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categoriacanal_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categoriacanal_list->categoria->Visible) { // categoria ?>
	<?php if ($categoriacanal_list->SortUrl($categoriacanal_list->categoria) == "") { ?>
		<th data-name="categoria" class="<?php echo $categoriacanal_list->categoria->headerCellClass() ?>"><div id="elh_categoriacanal_categoria" class="categoriacanal_categoria"><div class="ew-table-header-caption"><?php echo $categoriacanal_list->categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="categoria" class="<?php echo $categoriacanal_list->categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $categoriacanal_list->SortUrl($categoriacanal_list->categoria) ?>', 1);"><div id="elh_categoriacanal_categoria" class="categoriacanal_categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categoriacanal_list->categoria->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($categoriacanal_list->categoria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categoriacanal_list->categoria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categoriacanal_list->descripcion->Visible) { // descripcion ?>
	<?php if ($categoriacanal_list->SortUrl($categoriacanal_list->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $categoriacanal_list->descripcion->headerCellClass() ?>"><div id="elh_categoriacanal_descripcion" class="categoriacanal_descripcion"><div class="ew-table-header-caption"><?php echo $categoriacanal_list->descripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $categoriacanal_list->descripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $categoriacanal_list->SortUrl($categoriacanal_list->descripcion) ?>', 1);"><div id="elh_categoriacanal_descripcion" class="categoriacanal_descripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categoriacanal_list->descripcion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($categoriacanal_list->descripcion->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categoriacanal_list->descripcion->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($categoriacanal_list->urlImagen->Visible) { // urlImagen ?>
	<?php if ($categoriacanal_list->SortUrl($categoriacanal_list->urlImagen) == "") { ?>
		<th data-name="urlImagen" class="<?php echo $categoriacanal_list->urlImagen->headerCellClass() ?>"><div id="elh_categoriacanal_urlImagen" class="categoriacanal_urlImagen"><div class="ew-table-header-caption"><?php echo $categoriacanal_list->urlImagen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="urlImagen" class="<?php echo $categoriacanal_list->urlImagen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $categoriacanal_list->SortUrl($categoriacanal_list->urlImagen) ?>', 1);"><div id="elh_categoriacanal_urlImagen" class="categoriacanal_urlImagen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $categoriacanal_list->urlImagen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($categoriacanal_list->urlImagen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($categoriacanal_list->urlImagen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$categoriacanal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($categoriacanal_list->ExportAll && $categoriacanal_list->isExport()) {
	$categoriacanal_list->StopRecord = $categoriacanal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($categoriacanal_list->TotalRecords > $categoriacanal_list->StartRecord + $categoriacanal_list->DisplayRecords - 1)
		$categoriacanal_list->StopRecord = $categoriacanal_list->StartRecord + $categoriacanal_list->DisplayRecords - 1;
	else
		$categoriacanal_list->StopRecord = $categoriacanal_list->TotalRecords;
}
$categoriacanal_list->RecordCount = $categoriacanal_list->StartRecord - 1;
if ($categoriacanal_list->Recordset && !$categoriacanal_list->Recordset->EOF) {
	$categoriacanal_list->Recordset->moveFirst();
	$selectLimit = $categoriacanal_list->UseSelectLimit;
	if (!$selectLimit && $categoriacanal_list->StartRecord > 1)
		$categoriacanal_list->Recordset->move($categoriacanal_list->StartRecord - 1);
} elseif (!$categoriacanal->AllowAddDeleteRow && $categoriacanal_list->StopRecord == 0) {
	$categoriacanal_list->StopRecord = $categoriacanal->GridAddRowCount;
}

// Initialize aggregate
$categoriacanal->RowType = ROWTYPE_AGGREGATEINIT;
$categoriacanal->resetAttributes();
$categoriacanal_list->renderRow();
while ($categoriacanal_list->RecordCount < $categoriacanal_list->StopRecord) {
	$categoriacanal_list->RecordCount++;
	if ($categoriacanal_list->RecordCount >= $categoriacanal_list->StartRecord) {
		$categoriacanal_list->RowCount++;

		// Set up key count
		$categoriacanal_list->KeyCount = $categoriacanal_list->RowIndex;

		// Init row class and style
		$categoriacanal->resetAttributes();
		$categoriacanal->CssClass = "";
		if ($categoriacanal_list->isGridAdd()) {
		} else {
			$categoriacanal_list->loadRowValues($categoriacanal_list->Recordset); // Load row values
		}
		$categoriacanal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$categoriacanal->RowAttrs->merge(["data-rowindex" => $categoriacanal_list->RowCount, "id" => "r" . $categoriacanal_list->RowCount . "_categoriacanal", "data-rowtype" => $categoriacanal->RowType]);

		// Render row
		$categoriacanal_list->renderRow();

		// Render list options
		$categoriacanal_list->renderListOptions();
?>
	<tr <?php echo $categoriacanal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$categoriacanal_list->ListOptions->render("body", "left", $categoriacanal_list->RowCount);
?>
	<?php if ($categoriacanal_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $categoriacanal_list->id->cellAttributes() ?>>
<span id="el<?php echo $categoriacanal_list->RowCount ?>_categoriacanal_id">
<span<?php echo $categoriacanal_list->id->viewAttributes() ?>><?php echo $categoriacanal_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($categoriacanal_list->categoria->Visible) { // categoria ?>
		<td data-name="categoria" <?php echo $categoriacanal_list->categoria->cellAttributes() ?>>
<span id="el<?php echo $categoriacanal_list->RowCount ?>_categoriacanal_categoria">
<span<?php echo $categoriacanal_list->categoria->viewAttributes() ?>><?php echo $categoriacanal_list->categoria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($categoriacanal_list->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion" <?php echo $categoriacanal_list->descripcion->cellAttributes() ?>>
<span id="el<?php echo $categoriacanal_list->RowCount ?>_categoriacanal_descripcion">
<span<?php echo $categoriacanal_list->descripcion->viewAttributes() ?>><?php echo $categoriacanal_list->descripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($categoriacanal_list->urlImagen->Visible) { // urlImagen ?>
		<td data-name="urlImagen" <?php echo $categoriacanal_list->urlImagen->cellAttributes() ?>>
<span id="el<?php echo $categoriacanal_list->RowCount ?>_categoriacanal_urlImagen">
<span<?php echo $categoriacanal_list->urlImagen->viewAttributes() ?>><?php echo $categoriacanal_list->urlImagen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$categoriacanal_list->ListOptions->render("body", "right", $categoriacanal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$categoriacanal_list->isGridAdd())
		$categoriacanal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$categoriacanal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($categoriacanal_list->Recordset)
	$categoriacanal_list->Recordset->Close();
?>
<?php if (!$categoriacanal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$categoriacanal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $categoriacanal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $categoriacanal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($categoriacanal_list->TotalRecords == 0 && !$categoriacanal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $categoriacanal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$categoriacanal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$categoriacanal_list->isExport()) { ?>
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
$categoriacanal_list->terminate();
?>