<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
    <?php
        require_once(__DIR__ . "/includes/title.tpl");
    ?>
    <body>
        <?php
            $headerMenuDialog = $arguments['headerMenuDialog'];
            $headerMenuLogin = $arguments['headerMenuLogin'];
            $mainContent = $arguments['main'];
            require_once(__DIR__ . "/includes/header.tpl");
        ?>

        <main class="main container" id="main_content">
            <?=$mainContent;?>
        </main>

        <?php
            require_once(__DIR__ . "/includes/footer.tpl");
        ?>
    </body>
</html>

<script src="/src/Core/Views/scripts/script.js" type="module"></script>
