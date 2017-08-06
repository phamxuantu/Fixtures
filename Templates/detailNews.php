<div id="headNews" style="float: left;width: calc(100% - 100px);margin-bottom: 20px;padding: 20px 50px 0">
    <img src="<?php echo $news[0]['imgPost'] ?>?<?PHP echo uniqid(); ?>" id="imgPost" width="200" height="150" style="float: left;" onerror="errorImg(this)">
    <h3 id="titleNews" style="width: calc(100% - 220px);float: left;margin: 40px 0 0 20px;"><?php echo $news[0]['title'] ?></h3>
</div>
<div id="contentNews" style="padding: 0 50px 20px"><?php echo $news[0]['content'] ?></div>
<div style="padding-bottom: 50px">
    <a href="#" id="previousNews" style="
    border: 1px solid #6ab1e6;
    background-color: #6ab1e6;
    padding: 10px;
    border-radius: 15px;
    float: left;"><< Previous</a>
    <a href="#" id="nextNews" style="
    border: 1px solid #6ab1e6;
    background-color: #6ab1e6;
    padding: 10px;
    border-radius: 15px;
    float: right;">Next >></a>
</div>
<input type="text" id="currentNews" value="<?php echo $news[0]['id']?>" hidden>