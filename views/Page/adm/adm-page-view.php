<?php
define("TITLE", "Patrick Einatz | Page Admin");
$page = 'Page Admin';
include __DIR__ . "/../../Layout/header.php";
?>
<a class='content-btn' id='backbtn' href='dashboard'>&#8672; DASHBOARD</a>
<h1>Page Admin</h1>
<br /><a href="adm-page-add">&#43; ADD PAGE</a><br /><br />
<?php
foreach($pageItems as $pageItem)
{	
	echo "<div>
			<div>{$sec->e($pageItem->title)}</div>
			<a class='delete_link' href='adm-page-delete?id={$pageItem->id}'>&#10007;</a>
			<a href='adm-page-edit?id={$pageItem->id}'>&#9998;</a>
		</div>";
}
include __DIR__ . "/../../Layout/footer.php"; 
?>
