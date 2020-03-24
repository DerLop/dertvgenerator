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
$categoriacanal_edit = new categoriacanal_edit();

// Run the page
$categoriacanal_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$categoriacanal_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcategoriacanaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcategoriacanaledit = currentForm = new ew.Form("fcategoriacanaledit", "edit");

	// Validate form
	fcategoriacanaledit.validate = function() {
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
			<?php if ($categoriacanal_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_edit->id->caption(), $categoriacanal_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categoriacanal_edit->categoria->Required) { ?>
				elm = this.getElements("x" + infix + "_categoria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_edit->categoria->caption(), $categoriacanal_edit->categoria->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categoriacanal_edit->descripcion->Required) { ?>
				elm = this.getElements("x" + infix + "_descripcion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_edit->descripcion->caption(), $categoriacanal_edit->descripcion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($categoriacanal_edit->urlImagen->Required) { ?>
				elm = this.getElements("x" + infix + "_urlImagen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $categoriacanal_edit->urlImagen->caption(), $categoriacanal_edit->urlImagen->RequiredErrorMessage)) ?>");
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
	fcategoriacanaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcategoriacanaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcategoriacanaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $categoriacanal_edit->showPageHeader(); ?>
<?php
$categoriacanal_edit->showMessage();
?>
<form name="fcategoriacanaledit" id="fcategoriacanaledit" class="<?php echo $categoriacanal_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="categoriacanal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$categoriacanal_edit->IsModal ?>">
<?php if ($categoriacanal->getCurrentMasterTable() == "canal") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="canal">
<input type="hidden" name="fk_id_categoriaCanal" value="<?php echo $categoriacanal_edit->id->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($categoriacanal_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_categoriacanal_id" class="<?php echo $categoriacanal_edit->LeftColumnClass ?>"><?php echo $categoriacanal_edit->id->caption() ?><?php echo $categoriacanal_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categoriacanal_edit->RightColumnClass ?>"><div <?php echo $categoriacanal_edit->id->cellAttributes() ?>>
<span id="el_categoriacanal_id">
<span<?php echo $categoriacanal_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($categoriacanal_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="categoriacanal" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($categoriacanal_edit->id->CurrentValue) ?>">
<?php echo $categoriacanal_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categoriacanal_edit->categoria->Visible) { // categoria ?>
	<div id="r_categoria" class="form-group row">
		<label id="elh_categoriacanal_categoria" for="x_categoria" class="<?php echo $categoriacanal_edit->LeftColumnClass ?>"><?php echo $categoriacanal_edit->categoria->caption() ?><?php echo $categoriacanal_edit->categoria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categoriacanal_edit->RightColumnClass ?>"><div <?php echo $categoriacanal_edit->categoria->cellAttributes() ?>>
<span id="el_categoriacanal_categoria">
<input type="text" data-table="categoriacanal" data-field="x_categoria" name="x_categoria" id="x_categoria" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_edit->categoria->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_edit->categoria->EditValue ?>"<?php echo $categoriacanal_edit->categoria->editAttributes() ?>>
</span>
<?php echo $categoriacanal_edit->categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categoriacanal_edit->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_categoriacanal_descripcion" for="x_descripcion" class="<?php echo $categoriacanal_edit->LeftColumnClass ?>"><?php echo $categoriacanal_edit->descripcion->caption() ?><?php echo $categoriacanal_edit->descripcion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categoriacanal_edit->RightColumnClass ?>"><div <?php echo $categoriacanal_edit->descripcion->cellAttributes() ?>>
<span id="el_categoriacanal_descripcion">
<input type="text" data-table="categoriacanal" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_edit->descripcion->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_edit->descripcion->EditValue ?>"<?php echo $categoriacanal_edit->descripcion->editAttributes() ?>>
</span>
<?php echo $categoriacanal_edit->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($categoriacanal_edit->urlImagen->Visible) { // urlImagen ?>
	<div id="r_urlImagen" class="form-group row">
		<label id="elh_categoriacanal_urlImagen" for="x_urlImagen" class="<?php echo $categoriacanal_edit->LeftColumnClass ?>"><?php echo $categoriacanal_edit->urlImagen->caption() ?><?php echo $categoriacanal_edit->urlImagen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $categoriacanal_edit->RightColumnClass ?>"><div <?php echo $categoriacanal_edit->urlImagen->cellAttributes() ?>>
<span id="el_categoriacanal_urlImagen">
<input type="text" data-table="categoriacanal" data-field="x_urlImagen" name="x_urlImagen" id="x_urlImagen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($categoriacanal_edit->urlImagen->getPlaceHolder()) ?>" value="<?php echo $categoriacanal_edit->urlImagen->EditValue ?>"<?php echo $categoriacanal_edit->urlImagen->editAttributes() ?>>
</span>
<?php echo $categoriacanal_edit->urlImagen->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$categoriacanal_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $categoriacanal_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $categoriacanal_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$categoriacanal_edit->showPageFooter();
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
$categoriacanal_edit->terminate();
?>