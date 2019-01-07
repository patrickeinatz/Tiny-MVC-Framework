<?php
define("TITLE", "Patrick Einatz | Page Add");
$page = 'Page Add';
include __DIR__ . "/../../Layout/header.php";
?>
<a class='content-btn' id='backbtn' href='adm-page-view'>&#8672; PAGE ADMIN</a>
<h1>Page add</h1>
<form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
	<input class="adm_input" type="text" placeholder="title" name="title" ></input><br/>
	<textarea placeholder="content" class="adm_text" name="content"></textarea><br/>
	<input class="adm_input" type="text" placeholder="slug" name="slug" ></input><br/>
	<input class="adm_submit" type="submit"></input>
</form>
<?php
include __DIR__ . "/../../Layout/footer.php"; 
?>
