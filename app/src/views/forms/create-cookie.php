<div class="cookie-create">
    <h1>CREATE COOKIE!!!!!!!!!!!!!!!!!!!</h1>
    <form action="" class="cookie-create-form">
        <input class="cookie-create-name" type="text" name="name" placeholder="set name">
        <input class="cookie-create-value" type="text" name="value" placeholder="set value">
        <input class="cookie-create-expire" type="text" name="expire" placeholder="set expire time">
        <button type="submit" class="cookie-create-btn">Set cookie</button>
    </form>
    <?php

    if (count($_COOKIE) > 0) {
        $cookies = $_COOKIE;
    }

    ?>
    <div class="cookie-list">
        <ul class="cookie-create-list">
            <?php if (isset($cookies)): ?>
                <?php foreach ($cookies as $name => $value): ?>
                    <?php require "src/views/items/cookiesItem.php" ?>
                <?php endforeach ?>
            <?php endif ?>
        </ul>
    </div>
</div>