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
$categoriacanal_add = new categoriacanal_add();

// Run the page
$categoriacanal_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categoriacanal_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcategoriacanaladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcategoriacanaladd = currentForm = new ew.Form("fcategoriacanaladd", "add");

	// Validate form
	fcategoriacanaladd.validate = function() {
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
			<?php if ($categoriacanal_add->categoria->Required) { ?>
				elm = this.getElements("x" + infix + "_categoria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_add->categoria->caption(), $categoriacanal_add->categoria->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categoriacanal_add->descripcion->Required) { ?>
				elm = this.getElements("x" + infix + "_descripcion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_add->descripcion->caption(), $categoriacanal_add->descripcion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categoriacanal_add->urlImagen->Required) { ?>
				elm = this.getElements("x" + infix + "_urlImagen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_add->urlImagen->caption(), $categoriacanal_add->urlImagen->RequiredErrorMessage)) ?>");
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
	fcategoriacanaladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcategoriacanaladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcategoriacanaladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $categoriacanal_add->showPageHeader(); ?>
<?php
$categoriacanal_add->showMessage();
?>
<form name="fcategoriacanaladd" id="fcategoriacanaladd" class="<?php echo $categoriacanal_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categoriacanal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$categoriacanal_add->IsModal ?>">
<?php if ($categoriacanal->getCurrentMasterTable() == "canal") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="canal">
<input type="hidden" name="fk_id_categoriaCanal" value="<?php echo $categoriacanal_add->id->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($categoriacanal_add->categoria->Visible) { // categoria ?>
	<div id="r_categoria" class="form-group row">
		<label id="elh_categoriacanal_categoria" for="x_categoria" class="<?php echo $categoriacanal_add->LeftColumnClass ?>"><?php echo $categoriacanal_add->categoria->caption() ?><?php echo $categoriacanal_add->categoria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categoriacanal_add->RightColumnClass ?>"><div <?php echo $categoriacanal_add->categoria->cellAttributes() ?>>
<span id="el_categoriacanal_categoria">
<input type="text" data-table="categoriacanal" data-field="x_categoria" name="x_categoria" id="x_categoria" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_add->categoria->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_add->categoria->EditValue ?>"<?php echo $categoriacanal_add->categoria->editAttributes() ?>>
</span>
<?php echo $categoriacanal_add->categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categoriacanal_add->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_categoriacanal_descripcion" for="x_descripcion" class="<?php echo $categoriacanal_add->LeftColumnClass ?>"><?php echo $categoriacanal_add->descripcion->caption() ?><?php echo $categoriacanal_add->descripcion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categoriacanal_add->RightColumnClass ?>"><div <?php echo $categoriacanal_add->descripcion->cellAttributes() ?>>
<span id="el_categoriacanal_descripcion">
<input type="text" data-table="categoriacanal" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_add->descripcion->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_add->descripcion->EditValue ?>"<?php echo $categoriacanal_add->descripcion->editAttributes() ?>>
</span>
<?php echo $categoriacanal_add->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categoriacanal_add->urlImagen->Visible) { // urlImagen ?>
	<div id="r_urlImagen" class="form-group row">
		<label id="elh_categoriacanal_urlImagen" for="x_urlImagen" class="<?php echo $categoriacanal_add->LeftColumnClass ?>"><?php echo $categoriacanal_add->urlImagen->caption() ?><?php echo $categoriacanal_add->urlImagen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categoriacanal_add->RightColumnClass ?>"><div <?php echo $categoriacanal_add->urlImagen->cellAttributes() ?>>
<span id="el_categoriacanal_urlImagen">
<input type="text" data-table="categoriacanal" data-field="x_urlImagen" name="x_urlImagen" id="x_urlImagen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_add->urlImagen->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_add->urlImagen->EditValue ?>"<?php echo $categoriacanal_add->urlImagen->editAttributes() ?>>
</span>
<?php echo $categoriacanal_add->urlImagen->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($categoriacanal_add->id->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_id" id="x_id" value="<?php echo HtmlEncode(strval($categoriacanal_add->id->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$categoriacanal_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $categoriacanal_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categoriacanal_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$categoriacanal_add->showPageFooter();
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
$categoriacanal_add->terminate();
?>