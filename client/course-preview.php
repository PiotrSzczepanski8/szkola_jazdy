<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="shortcut icon" href="../public/logo.svg" type="image/x-icon">
    <title>LimoAuto</title>
</head>
<body>
    <div class="container">
        <?php
            include "../public/components/header.shtml";
        ?>
        <main>
            <?php        
                include_once "../includes/course-preview.php";
            ?>
        </main>
    </div>
        <?php
            include "../public/components/footer.shtml";
        ?>
    <script src="../public/text_cutter.js" defer></script>
</body>
</html>