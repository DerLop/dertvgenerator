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
$canal_list = new canal_list();

// Run the page
$canal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$canal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$canal_list->isExport()) { ?>
<script>
var fcanallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcanallist = currentForm = new ew.Form("fcanallist", "list");
	fcanallist.formKeyCountName = '<?php echo $canal_list->FormKeyCountName ?>';
	loadjs.done("fcanallist");
});
var fcanallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcanallistsrch = currentSearchForm = new ew.Form("fcanallistsrch");

	// Dynamic selection lists
	// Filters

	fcanallistsrch.filterList = <?php echo $canal_list->getFilterList() ?>;
	loadjs.done("fcanallistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$canal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($canal_list->TotalRecords > 0 && $canal_list->ExportOptions->visible()) { ?>
<?php $canal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($canal_list->ImportOptions->visible()) { ?>
<?php $canal_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($canal_list->SearchOptions->visible()) { ?>
<?php $canal_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($canal_list->FilterOptions->visible()) { ?>
<?php $canal_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$canal_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$canal_list->isExport() && !$canal->CurrentAction) { ?>
<form name="fcanallistsrch" id="fcanallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcanallistsrch-search-panel" class="<?php echo $canal_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="canal">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $canal_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($canal_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($canal_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $canal_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($canal_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($canal_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($canal_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($canal_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $canal_list->showPageHeader(); ?>
<?php
$canal_list->showMessage();
?>
<?php if ($canal_list->TotalRecords > 0 || $canal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($canal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> canal">
<form name="fcanallist" id="fcanallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="canal">
<div id="gmp_canal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($canal_list->TotalRecords > 0 || $canal_list->isGridEdit()) { ?>
<table id="tbl_canallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$canal->RowType = ROWTYPE_HEADER;

// Render list options
$canal_list->renderListOptions();

// Render list options (header, left)
$canal_list->ListOptions->render("header", "left");
?>
<?php if ($canal_list->id->Visible) { // id ?>
	<?php if ($canal_list->SortUrl($canal_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $canal_list->id->headerCellClass() ?>"><div id="elh_canal_id" class="canal_id"><div class="ew-table-header-caption"><?php echo $canal_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $canal_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $canal_list->SortUrl($canal_list->id) ?>', 1);"><div id="elh_canal_id" class="canal_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $canal_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($canal_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($canal_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($canal_list->nombreCanal->Visible) { // nombreCanal ?>
	<?php if ($canal_list->SortUrl($canal_list->nombreCanal) == "") { ?>
		<th data-name="nombreCanal" class="<?php echo $canal_list->nombreCanal->headerCellClass() ?>"><div id="elh_canal_nombreCanal" class="canal_nombreCanal"><div class="ew-table-header-caption"><?php echo $canal_list->nombreCanal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombreCanal" class="<?php echo $canal_list->nombreCanal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $canal_list->SortUrl($canal_list->nombreCanal) ?>', 1);"><div id="elh_canal_nombreCanal" class="canal_nombreCanal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $canal_list->nombreCanal->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($canal_list->nombreCanal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($canal_list->nombreCanal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($canal_list->urlCanal->Visible) { // urlCanal ?>
	<?php if ($canal_list->SortUrl($canal_list->urlCanal) == "") { ?>
		<th data-name="urlCanal" class="<?php echo $canal_list->urlCanal->headerCellClass() ?>"><div id="elh_canal_urlCanal" class="canal_urlCanal"><div class="ew-table-header-caption"><?php echo $canal_list->urlCanal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="urlCanal" class="<?php echo $canal_list->urlCanal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $canal_list->SortUrl($canal_list->urlCanal) ?>', 1);"><div id="elh_canal_urlCanal" class="canal_urlCanal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $canal_list->urlCanal->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($canal_list->urlCanal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($canal_list->urlCanal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($canal_list->urlImage->Visible) { // urlImage ?>
	<?php if ($canal_list->SortUrl($canal_list->urlImage) == "") { ?>
		<th data-name="urlImage" class="<?php echo $canal_list->urlImage->headerCellClass() ?>"><div id="elh_canal_urlImage" class="canal_urlImage"><div class="ew-table-header-caption"><?php echo $canal_list->urlImage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="urlImage" class="<?php echo $canal_list->urlImage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $canal_list->SortUrl($canal_list->urlImage) ?>', 1);"><div id="elh_canal_urlImage" class="canal_urlImage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $canal_list->urlImage->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($canal_list->urlImage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($canal_list->urlImage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($canal_list->id_categoriaCanal->Visible) { // id_categoriaCanal ?>
	<?php if ($canal_list->SortUrl($canal_list->id_categoriaCanal) == "") { ?>
		<th data-name="id_categoriaCanal" class="<?php echo $canal_list->id_categoriaCanal->headerCellClass() ?>"><div id="elh_canal_id_categoriaCanal" class="canal_id_categoriaCanal"><div class="ew-table-header-caption"><?php echo $canal_list->id_categoriaCanal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_categoriaCanal" class="<?php echo $canal_list->id_categoriaCanal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $canal_list->SortUrl($canal_list->id_categoriaCanal) ?>', 1);"><div id="elh_canal_id_categoriaCanal" class="canal_id_categoriaCanal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $canal_list->id_categoriaCanal->caption() ?></span><span class="ew-table-header-sort"><?php if ($canal_list->id_categoriaCanal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($canal_list->id_categoriaCanal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$canal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($canal_list->ExportAll && $canal_list->isExport()) {
	$canal_list->StopRecord = $canal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($canal_list->TotalRecords > $canal_list->StartRecord + $canal_list->DisplayRecords - 1)
		$canal_list->StopRecord = $canal_list->StartRecord + $canal_list->DisplayRecords - 1;
	else
		$canal_list->StopRecord = $canal_list->TotalRecords;
}
$canal_list->RecordCount = $canal_list->StartRecord - 1;
if ($canal_list->Recordset && !$canal_list->Recordset->EOF) {
	$canal_list->Recordset->moveFirst();
	$selectLimit = $canal_list->UseSelectLimit;
	if (!$selectLimit && $canal_list->StartRecord > 1)
		$canal_list->Recordset->move($canal_list->StartRecord - 1);
} elseif (!$canal->AllowAddDeleteRow && $canal_list->StopRecord == 0) {
	$canal_list->StopRecord = $canal->GridAddRowCount;
}

// Initialize aggregate
$canal->RowType = ROWTYPE_AGGREGATEINIT;
$canal->resetAttributes();
$canal_list->renderRow();
while ($canal_list->RecordCount < $canal_list->StopRecord) {
	$canal_list->RecordCount++;
	if ($canal_list->RecordCount >= $canal_list->StartRecord) {
		$canal_list->RowCount++;

		// Set up key count
		$canal_list->KeyCount = $canal_list->RowIndex;

		// Init row class and style
		$canal->resetAttributes();
		$canal->CssClass = "";
		if ($canal_list->isGridAdd()) {
		} else {
			$canal_list->loadRowValues($canal_list->Recordset); // Load row values
		}
		$canal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$canal->RowAttrs->merge(["data-rowindex" => $canal_list->RowCount, "id" => "r" . $canal_list->RowCount . "_canal", "data-rowtype" => $canal->RowType]);

		// Render row
		$canal_list->renderRow();

		// Render list options
		$canal_list->renderListOptions();
?>
	<tr <?php echo $canal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$canal_list->ListOptions->render("body", "left", $canal_list->RowCount);
?>
	<?php if ($canal_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $canal_list->id->cellAttributes() ?>>
<span id="el<?php echo $canal_list->RowCount ?>_canal_id">
<span<?php echo $canal_list->id->viewAttributes() ?>><?php echo $canal_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($canal_list->nombreCanal->Visible) { // nombreCanal ?>
		<td data-name="nombreCanal" <?php echo $canal_list->nombreCanal->cellAttributes() ?>>
<span id="el<?php echo $canal_list->RowCount ?>_canal_nombreCanal">
<span<?php echo $canal_list->nombreCanal->viewAttributes() ?>><?php echo $canal_list->nombreCanal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($canal_list->urlCanal->Visible) { // urlCanal ?>
		<td data-name="urlCanal" <?php echo $canal_list->urlCanal->cellAttributes() ?>>
<span id="el<?php echo $canal_list->RowCount ?>_canal_urlCanal">
<span<?php echo $canal_list->urlCanal->viewAttributes() ?>><?php echo $canal_list->urlCanal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($canal_list->urlImage->Visible) { // urlImage ?>
		<td data-name="urlImage" <?php echo $canal_list->urlImage->cellAttributes() ?>>
<span id="el<?php echo $canal_list->RowCount ?>_canal_urlImage">
<span<?php echo $canal_list->urlImage->viewAttributes() ?>><?php echo $canal_list->urlImage->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($canal_list->id_categoriaCanal->Visible) { // id_categoriaCanal ?>
		<td data-name="id_categoriaCanal" <?php echo $canal_list->id_categoriaCanal->cellAttributes() ?>>
<span id="el<?php echo $canal_list->RowCount ?>_canal_id_categoriaCanal">
<span<?php echo $canal_list->id_categoriaCanal->viewAttributes() ?>><?php echo $canal_list->id_categoriaCanal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$canal_list->ListOptions->render("body", "right", $canal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$canal_list->isGridAdd())
		$canal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$canal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($canal_list->Recordset)
	$canal_list->Recordset->Close();
?>
<?php if (!$canal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$canal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $canal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $canal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($canal_list->TotalRecords == 0 && !$canal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $canal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$canal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$canal_list->isExport()) { ?>
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
$canal_list->terminate();
?>