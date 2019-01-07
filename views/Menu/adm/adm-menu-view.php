<?php
define("TITLE", "Patrick Einatz | Menu Admin");
$page = 'Menu Admin';
include __DIR__ . "/../../Layout/header.php";
?>
<a class='content-btn' id='backbtn' href='dashboard'>&#8672; DASHBOARD</a>
<h1>Menu Admin</h1>
<br /><a href="adm-menu-add">&#43; ADD PAGE</a><br /><br />
<?php
foreach($menuItems as $menuItem)
{	
	echo "<div>
			<div>{$sec->e($menuItem->title)}</div>
			<a class='delete_link' href='adm-menu-delete?id={$menuItem->id}'>&#10007;</a>
			<a href='adm-menu-edit?id={$menuItem->id}'>&#9998;</a>
		</div>";
}
include __DIR__ . "/../../Layout/footer.php"; 
?>
