<?php  
define("TITLE", "Patrick Einatz | {$post->title}");
$page = $post->title;
include __DIR__ . "/../Layout/header.php";
?>


<h1 id="headline"><?php echo $sec->e($post->title) ?></h1>
<?php echo $post->content; ?>
		

<?php include __DIR__ . "/../Layout/footer.php"; ?>