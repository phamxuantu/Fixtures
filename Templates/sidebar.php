<div id="sidebar">
    <ul class="sidebar-menu">
        <li>
            <a href="#">
                <span>League</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu" id="league">
                <?php foreach ($league as $lg):
                    if($lg['public'] == 1){?>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> <?php echo $lg['name'] ?></a>
                        <ul class="sidebar-submenu">
                            <li idparent="<?php echo $lg['idL'] ?>" class="fixtures"><a href="#"><i class="fa fa-calendar"></i> Fixtures</a></li>
                            <li><a href="#"><i class="fa fa-table"></i> Table</a></li>
                            <li idparent="<?php echo $lg['idL'] ?>" class="team"><a href="#"><i
                                            class="fa fa-laptop"></i>
                                    Teams</a></li>
                        </ul>
                    </li>
                <?php }
                endforeach; ?>
            </ul>
        </li>
        <li><a href="#" id="news"> News</a></li>
        <li><a href="#" id="users"> Users</a></li>
        <li>
            <a href="#" id="addLeague"> <span>Add league</span></a>
        </li>
    </ul>
</div>