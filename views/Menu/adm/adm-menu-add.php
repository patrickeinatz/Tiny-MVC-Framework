<?php
define("TITLE", "Patrick Einatz | Menu Add");
$page = 'Menu Add';
include __DIR__ . "/../../Layout/header.php";
?>
<a class='content-btn' id='backbtn' href='adm-menu-view'>&#8672; MENU ADMIN</a>
<h1>Menu add</h1>
<form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
	<input class="adm_input" type="text" placeholder="title" name="title"></input><br/>
	<input class="adm_input" type="text" placeholder="slug" name="slug"></input><br/>
	<input class="adm_input" type="text" placeholder="pos" name="pos"></input><br/>
	<label>[0 = top, 1 = bottom]</label><br/>
	<input class="adm_submit" type="submit"></input>
</form>
<?php
include __DIR__ . "/../../Layout/footer.php"; 
?>
