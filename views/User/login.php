<?php  
define("TITLE", "Patrick Einatz | Dashboard");
$page = 'Dashboard';
include __DIR__ . "/../Layout/header.php";
?>

<h1 id="headline">Dashboard</h1>
			<div id="login">
				<form method="post" action="<?php $_SERVER["PHP_SELF"] ?>" autocomplete="off">
					<label></label><input type="text" name="user" autocomplete="off"><br />
					<label></label><input type="password" name="pass" autocomplete="off" ><br />
					<input type="submit" value="Submit">
				</form>
				<?php 
				if(!empty($error)):
					echo "<div id='alert'>".$error."</div>";
				endif;
				?>
			</div>
			<?php 
include __DIR__ . "/../Layout/footer.php"; 
?>