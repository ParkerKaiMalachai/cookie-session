<div class="session-create">
    <h1>CREATE SESSION!!!!!!!!!!!!!!!!!!!</h1>
    <form action="" class="session-create-form">
        <input class="session-create-name" type="text" name="name" placeholder="set name">
        <button type="submit" class="session-create-btn">Start session</button>
    </form>
    <div class="session-data">
        <?php if (isset($sessions['name'])) {
            $line = sprintf("<p>%s</p><button class='session-destroy-btn'>delete</button>", $sessions['name']);
            echo $line;
        } ?>
    </div>
</div>