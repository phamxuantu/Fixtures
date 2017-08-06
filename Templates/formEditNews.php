<html>
<head>
    <link rel="stylesheet" type="text/css" href="Styles/homeStyle.css">
    <link rel="stylesheet" href="Styles/sidebar-menu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#txtContent',
            height: 200,
            width: 673,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
</head>
<body>
<div id="formPost" style="width: 50%; margin: 0 auto; background-color: #F7F7F7; border-radius: 2px">
    <h2>Edit News</h2>
    <form method="post" enctype="multipart/form-data" action="?action=doEditNews">
        <input type="text" name="id" value="<?php echo $news[0]['id']?>" hidden>
        <div>
            <label for="txtTitle">Title:</label>
            <textarea id="txtTitle" name="txtTitle" style="width: 100%"><?php echo $news[0]['title']?></textarea><br>
            <label for="txtContent">Content:</label>
            <textarea id="txtContent" name="txtContent"><?php echo $news[0]['content']?></textarea>
        </div>
        <div style="width: 100%; display: inline-block">
            <p style="float: left">Choose image:</p>
            <label for="imgNews-upload" class="custom-file-upload">
                <img id="output" width="200px" height="100px" src="<?php echo $news[0]['imgPost']?>?<?PHP echo uniqid(); ?>"/>
            </label>
            <input type="file" id="imgNews-upload" name="imgNews" accept="image/jpeg,image/png"
                   onchange="loadFile(event)"/>
        </div>
        <input type="text" name="linkImg" value="<?php echo $news[0]['imgPost']?>" hidden>
        <input type="submit" name="confirmEdit" value="Cancel" class="submit" style="width: 45%;margin: 15px auto;display: inline-block;cursor: pointer">
        <input type="submit" name="confirmEdit" value="Edit News" class="submit" style="width: 45%;margin: 15px auto;display: inline-block;cursor: pointer;float: right">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script src="Js/sidebar-menu.js"></script>
<script src="Js/loadData.js"></script>
<script src="Js/validate.js"></script>

<script>
    $.sidebarMenu($('.sidebar-menu'))
</script>
</body>
</html>