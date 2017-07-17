<?php
foreach ($league as $lg):
    echo '<li>';
    echo '<a href="#"><i class="fa fa-circle-o"></i>' . $lg['name'] . '</a>';
    echo '<ul class="sidebar-submenu">';
    echo '<li><a href="?action=getFixtures"><i class="fa fa-calendar"></i> Lịch thi đấu</a></li>';
    echo '<li><a href="#"><i class="fa fa-table"></i> Bảng xếp hạng</a></li>';
    echo '<li idparent="' . $lg['idL'] . '" class="team"><a href="#"><i class="fa fa-laptop"></i> Teams</a></li>';
    echo '</ul>';
    echo '</li>';
endforeach;
?>