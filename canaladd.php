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
$canal_add = new canal_add();

// Run the page
$canal_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$canal_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcanaladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcanaladd = currentForm = new ew.Form("fcanaladd", "add");

	// Validate form
	fcanaladd.validate = function() {
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
			<?php if ($canal_add->nombreCanal->Required) { ?>
				elm = this.getElements("x" + infix + "_nombreCanal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $canal_add->nombreCanal->caption(), $canal_add->nombreCanal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($canal_add->urlCanal->Required) { ?>
				elm = this.getElements("x" + infix + "_urlCanal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $canal_add->urlCanal->caption(), $canal_add->urlCanal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($canal_add->urlImage->Required) { ?>
				elm = this.getElements("x" + infix + "_urlImage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $canal_add->urlImage->caption(), $canal_add->urlImage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($canal_add->id_categoriaCanal->Required) { ?>
				elm = this.getElements("x" + infix + "_id_categoriaCanal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $canal_add->id_categoriaCanal->caption(), $canal_add->id_categoriaCanal->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fcanaladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcanaladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcanaladd.lists["x_id_categoriaCanal"] = <?php echo $canal_add->id_categoriaCanal->Lookup->toClientList($canal_add) ?>;
	fcanaladd.lists["x_id_categoriaCanal"].options = <?php echo JsonEncode($canal_add->id_categoriaCanal->lookupOptions()) ?>;
	loadjs.done("fcanaladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $canal_add->showPageHeader(); ?>
<?php
$canal_add->showMessage();
?>
<form name="fcanaladd" id="fcanaladd" class="<?php echo $canal_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="canal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$canal_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($canal_add->nombreCanal->Visible) { // nombreCanal ?>
	<div id="r_nombreCanal" class="form-group row">
		<label id="elh_canal_nombreCanal" for="x_nombreCanal" class="<?php echo $canal_add->LeftColumnClass ?>"><?php echo $canal_add->nombreCanal->caption() ?><?php echo $canal_add->nombreCanal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $canal_add->RightColumnClass ?>"><div <?php echo $canal_add->nombreCanal->cellAttributes() ?>>
<span id="el_canal_nombreCanal">
<input type="text" data-table="canal" data-field="x_nombreCanal" name="x_nombreCanal" id="x_nombreCanal" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($canal_add->nombreCanal->getPlaceHolder()) ?>" value="<?php echo $canal_add->nombreCanal->EditValue ?>"<?php echo $canal_add->nombreCanal->editAttributes() ?>>
</span>
<?php echo $canal_add->nombreCanal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($canal_add->urlCanal->Visible) { // urlCanal ?>
	<div id="r_urlCanal" class="form-group row">
		<label id="elh_canal_urlCanal" for="x_urlCanal" class="<?php echo $canal_add->LeftColumnClass ?>"><?php echo $canal_add->urlCanal->caption() ?><?php echo $canal_add->urlCanal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $canal_add->RightColumnClass ?>"><div <?php echo $canal_add->urlCanal->cellAttributes() ?>>
<span id="el_canal_urlCanal">
<input type="text" data-table="canal" data-field="x_urlCanal" name="x_urlCanal" id="x_urlCanal" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($canal_add->urlCanal->getPlaceHolder()) ?>" value="<?php echo $canal_add->urlCanal->EditValue ?>"<?php echo $canal_add->urlCanal->editAttributes() ?>>
</span>
<?php echo $canal_add->urlCanal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($canal_add->urlImage->Visible) { // urlImage ?>
	<div id="r_urlImage" class="form-group row">
		<label id="elh_canal_urlImage" for="x_urlImage" class="<?php echo $canal_add->LeftColumnClass ?>"><?php echo $canal_add->urlImage->caption() ?><?php echo $canal_add->urlImage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $canal_add->RightColumnClass ?>"><div <?php echo $canal_add->urlImage->cellAttributes() ?>>
<span id="el_canal_urlImage">
<input type="text" data-table="canal" data-field="x_urlImage" name="x_urlImage" id="x_urlImage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($canal_add->urlImage->getPlaceHolder()) ?>" value="<?php echo $canal_add->urlImage->EditValue ?>"<?php echo $canal_add->urlImage->editAttributes() ?>>
</span>
<?php echo $canal_add->urlImage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($canal_add->id_categoriaCanal->Visible) { // id_categoriaCanal ?>
	<div id="r_id_categoriaCanal" class="form-group row">
		<label id="elh_canal_id_categoriaCanal" for="x_id_categoriaCanal" class="<?php echo $canal_add->LeftColumnClass ?>"><?php echo $canal_add->id_categoriaCanal->caption() ?><?php echo $canal_add->id_categoriaCanal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $canal_add->RightColumnClass ?>"><div <?php echo $canal_add->id_categoriaCanal->cellAttributes() ?>>
<span id="el_canal_id_categoriaCanal">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($canal_add->id_categoriaCanal->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $canal_add->id_categoriaCanal->ViewValue ?></button>
		<div id="dsl_x_id_categoriaCanal" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $canal_add->id_categoriaCanal->radioButtonListHtml(TRUE, "x_id_categoriaCanal") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_id_categoriaCanal" class="ew-template"><input type="radio" class="custom-control-input" data-table="canal" data-field="x_id_categoriaCanal" data-value-separator="<?php echo $canal_add->id_categoriaCanal->displayValueSeparatorAttribute() ?>" name="x_id_categoriaCanal" id="x_id_categoriaCanal" value="{value}"<?php echo $canal_add->id_categoriaCanal->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$canal_add->id_categoriaCanal->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $canal_add->id_categoriaCanal->Lookup->getParamTag($canal_add, "p_x_id_categoriaCanal") ?>
</span>
<?php echo $canal_add->id_categoriaCanal->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("categoriacanal", explode(",", $canal->getCurrentDetailTable())) && $categoriacanal->DetailAdd) {
?>
<?php if ($canal->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("categoriacanal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "categoriacanalgrid.php" ?>
<?php } ?>
<?php if (!$canal_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $canal_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $canal_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$canal_add->showPageFooter();
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
$canal_add->terminate();
?>