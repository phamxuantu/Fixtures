<?php
echo '<h2>List News</h2>';
echo '<h4><a href="#" id="addNews">Add news</a></h4>';
echo '<table id="listNews">';
echo '<tr>';
echo '<th>Title</th>';
echo '<th>Content</th>';
echo '<th>Function</th>';
echo '</tr>';
foreach ($news as $n):
    echo '<tr>';
    $title = substr($n["title"], 0, 35);
    $content = substr($n["content"], 0, 50);
    echo '<td>'. $title . ' ...</td>';
    echo '<td>'. $content . ' ...</td>';
    echo '<td>
            <a href="#" class="detailNews" idNews="'. $n['id'] .'">Detail</a> |
            <a href="#" class="editNews" idNews="'. $n['id'] .'">Edit</a> |
            <a href="#" class="deleteNews" idNews="'. $n['id'] .'">Delete</a>
        </td>';
    echo '</tr>';
endforeach;
echo '</table>';
?>