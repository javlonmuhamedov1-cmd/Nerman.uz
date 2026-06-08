<?php
$icons = ['headphones.png', 'speech.png', 'folder.png', 'palette.png'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sidebar Icon Test</title>
    <style>
        body {
            background: #156BF0;
            color: white;
            font-family: sans-serif;
            display: flex;
            gap: 20px;
            padding: 50px;
        }

        .icon-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 20px;
            text-align: center;
            width: 150px;
        }

        img {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <?php foreach ($icons as $icon): ?>
        <div class="icon-box">
            <img src="/static/img/sidebar/<?php echo $icon; ?>?v=<?php echo time(); ?>" alt="<?php echo $icon; ?>">
            <p>
                <?php echo $icon; ?>
            </p>
            <p style="font-size: 10px; opacity: 0.7;">Path: /static/img/sidebar/
                <?php echo $icon; ?>
            </p>
        </div>
    <?php endforeach; ?>
</body>

</html>