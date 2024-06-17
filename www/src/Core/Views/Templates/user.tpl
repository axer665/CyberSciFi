<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta charset="UTF-8">
<?php
    //use Core\Views\Viewer;
    $headerMenuDialog = $arguments['headerMenuDialog'];
    $headerMenuLogin = $arguments['headerMenuLogin'];
    $mainContent = $arguments['main'];
    require_once(__DIR__ . "/includes/title.tpl");
?>
<style>
    .modal-container {
        position: fixed;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;

        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        flex-wrap: nowrap;

        background-color: rgba(0,0,0,0.4);
        color: red;

        z-index: 99;
    }

    .modal-block {
        position: relative;
        width: 300px;
        height: 300px;

        margin: auto;

        background-color: white;
        color: black;
    }
</style>
</head>
<body>
<?php
    require_once(__DIR__ . "/includes/header.tpl");
?>

<main class="main container" id="main_content">
    <?= $mainContent; ?>
    <?
        // схема рабочая, но использовать мы ее пока не будем
        //Viewer::getSubView("/includes/user/", "command", [])
    ?>
</main>


<?php
    require_once(__DIR__ . "/includes/footer.tpl");
?>

<script>
    /*
    class Modal {
        title;
        body;
        footer;
        container;

        constructor(title) {
            this.title = title;
            this.container = document.createElement('div');
            this.container.className = "modal-container";
            document.body.append(this.container);

            let block = document.createElement('div');
            block.className = "modal-block";
            block.innerHTML = "<p> Its block </p>";
            this.container.append(block);
        }

        setBody = (body) => {
            this.body = body;
        }

        show = () => {

        }

        hide = () => {

        }

        remove = () => {
            this.container.remove();
        }
    }

    const modalTest = new Modal("title");
    */
</script>

</body>
</html>