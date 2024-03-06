<?php session_start()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bees</title>
    <link rel="stylesheet" href="/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
<div id="app" data-session-id="<?=session_id()?>">
    <template id="bee-template">
        <div class="bee">
            <div class="flex">
                <div class="title"></div>
                <div class="life-span"></div>
            </div>
            <div class="image">
                <img src="/bee.jpeg" alt="bee">
            </div>
        </div>
    </template>
    <div class="bees"></div>
    <button>Hit!</button>
</div>
<script src="/script.js"></script>
</body>
</html>