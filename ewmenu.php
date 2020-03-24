<?php
namespace PHPMaker2020\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_canal", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "canallist.php", -1, "", IsLoggedIn() || AllowListMenu('{628FF872-8546-407C-9BA6-1F54D1486775}canal'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_categoriacanal", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "categoriacanallist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{628FF872-8546-407C-9BA6-1F54D1486775}categoriacanal'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>