<?php
namespace PHPMaker2020\project1;
?>
<?php if ($canal->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_canalmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($canal->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $canal->TableLeftColumnClass ?>"><?php echo $canal->id->caption() ?></td>
			<td <?php echo $canal->id->cellAttributes() ?>>
<span id="el_canal_id">
<span<?php echo $canal->id->viewAttributes() ?>><?php echo $canal->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($canal->nombreCanal->Visible) { // nombreCanal ?>
		<tr id="r_nombreCanal">
			<td class="<?php echo $canal->TableLeftColumnClass ?>"><?php echo $canal->nombreCanal->caption() ?></td>
			<td <?php echo $canal->nombreCanal->cellAttributes() ?>>
<span id="el_canal_nombreCanal">
<span<?php echo $canal->nombreCanal->viewAttributes() ?>><?php echo $canal->nombreCanal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($canal->urlCanal->Visible) { // urlCanal ?>
		<tr id="r_urlCanal">
			<td class="<?php echo $canal->TableLeftColumnClass ?>"><?php echo $canal->urlCanal->caption() ?></td>
			<td <?php echo $canal->urlCanal->cellAttributes() ?>>
<span id="el_canal_urlCanal">
<span<?php echo $canal->urlCanal->viewAttributes() ?>><?php echo $canal->urlCanal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($canal->urlImage->Visible) { // urlImage ?>
		<tr id="r_urlImage">
			<td class="<?php echo $canal->TableLeftColumnClass ?>"><?php echo $canal->urlImage->caption() ?></td>
			<td <?php echo $canal->urlImage->cellAttributes() ?>>
<span id="el_canal_urlImage">
<span<?php echo $canal->urlImage->viewAttributes() ?>><?php echo $canal->urlImage->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($canal->id_categoriaCanal->Visible) { // id_categoriaCanal ?>
		<tr id="r_id_categoriaCanal">
			<td class="<?php echo $canal->TableLeftColumnClass ?>"><?php echo $canal->id_categoriaCanal->caption() ?></td>
			<td <?php echo $canal->id_categoriaCanal->cellAttributes() ?>>
<span id="el_canal_id_categoriaCanal">
<span<?php echo $canal->id_categoriaCanal->viewAttributes() ?>><?php echo $canal->id_categoriaCanal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>