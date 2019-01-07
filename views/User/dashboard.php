<?php  
define("TITLE", "Patrick Einatz | Dashboard");
$page = 'Dashboard';
include __DIR__ . "/../Layout/header.php";
?>
<a class='content-btn' id='backbtn' href='lgt'>&#8672; LOGOUT</a>
<h1 id="headline">Dashboard</h1>
<br />
<div id="dash_ele">
	<a href="adm-page-view"><img src="/../../img/icons/adm_pages.svg"/><br />manage pages</a>
	<a href="adm-menu-view"><img src="/../../img/icons/adm_menu.svg"/><br />manage menues</a><br />
	<a href="create-post"><img src="/../../img/icons/adm_writeblog.svg"/><br />create blog</a>
	<a href="blog-adm"><img src="/../../img/icons/adm_editblog.svg"/><br />edit/delete blog</a>
	<a href="cat-adm"><img src="/../../img/icons/adm_category.svg"/><br />blog categories</a>
	<a href="adm-comment-edit"><img src="/../../img/icons/adm_comments.svg"/><br />approve comments</a><br />
	<a href="adm-work-view"><img src="/../../img/icons/adm_work.svg"/><br />manage work</a><br />
	<!---<a href="#"><img src="/../../img/icons/adm_projects.svg"/><br />manage projects</a>-->
</div>
<?php include __DIR__ . "/../Layout/footer.php"; ?>