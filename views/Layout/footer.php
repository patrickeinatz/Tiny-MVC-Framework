            </article>
            <hr>
            <div id="footer">
            <?php
				$menuRepository = $container->make("MenuRepository");
				$bottomMenuItems = $menuRepository->fetchMenuItems(1);
                    
				foreach ($bottomMenuItems as $item)          
				{
               		$classname = "";
                    if($page == $item["title"])
                    {
                        $classname = "active";
                    }
                    else
                    {
                        $classname = "inactive";
                    }
                    if(!empty($item["slug"]))
					{
						echo "<a class='{$classname}' href='{$item["slug"]}'>{$item["title"]}</a>";
					}
					else
					{
						echo "<a class='{$classname}' href='index.php?id={$item["id"]}'>{$item["title"]}</a>";
					}
				}
                ?>
				<div id="copyright">&copy; Patrick Einatz&#8482; 1984 - <?php echo date("Y"); ?></div>
        </div>
    </body>
</html>