<?php

declare(strict_types=1);

?>

<li>
    <?php
    $line = sprintf('<p>%s</p>', isset($sessions) ? $sessions['name'] : '');
    echo $line;
    ?>
    <button class="session-destroy-btn">Delete</button>
</li>