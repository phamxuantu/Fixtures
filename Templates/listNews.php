<?php
echo '<h2>List News</h2>';
echo '<h4><a href="?action=formAddNews" id="addNews">Add news</a></h4>';
echo '<table id="listNews">';
echo '<tr>';
echo '<th style="text-align: start">Thumbnail</th>';
echo '<th style="text-align: start">Title</th>';
echo '<th style="text-align: start">Content</th>';
echo '<th style="text-align: start">Function</th>';
echo '</tr>';
foreach ($news as $n):
    echo '<tr>';
    $title = limit_text($n["title"], 10);
    $content = limit_text(strip_tags($n["content"]), 15);
    echo '<td style="text-align: start"><img src="'. $n['imgPost'] .'?'. uniqid() .'" width="30" height="30" onerror="errorImg(this)"/></td>';
    echo '<td style="text-align: start">'. $title . '</td>';
    echo '<td style="text-align: start">'. $content . '</td>';
    echo '<td style="text-align: start">
            <a href="#" class="detailNews" idNews="'. $n['id'] .'">Detail</a> |
            <a href="?action=editNews&id='. $n['id'] .'" class="editNews" idNews="'. $n['id'] .'">Edit</a> |
            <a href="#" class="deleteNews" idNews="'. $n['id'] .'">Delete</a>
        </td>';
    echo '</tr>';
endforeach;
echo '</table>';
echo '<div id="pagingNews">';
echo $page;
echo '</div>';

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}
?>