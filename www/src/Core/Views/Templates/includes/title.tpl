<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/src/Core/Views/styles/main.css" />
    <title>
        <?php
        if (isset($arguments["title"])) {
            echo $arguments["title"];
        } else {
            echo "default title";
        }
        ?>
    </title>
    <script type="text/javascript" src="/src/Core/Views/scripts/jquery-3.6.3.min.js"></script>
</head>