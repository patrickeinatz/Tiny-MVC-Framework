<menu>
    <div id="logo"></div>
    <div class="navigation" id="navigationContainer">
        <a href="javascript:void(0);" style="font-size:18px;" class="icon-navigation" onclick="navbarResize()"><?php echo $page ?></a>
        <?php
			$menuRepository = $container->make("MenuRepository");
			$topMenuItems = $menuRepository->fetchMenuItems(0);
            foreach ($topMenuItems as $item)
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
        <a href="javascript:void(0);" style="font-size:18px;" class="icon" onclick="navbarResize()">&#9776;</a>
    </div>
</menu>
<hr>