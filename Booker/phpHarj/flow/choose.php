<?php

    $view = isset($_GET['view'])
        ? $_GET['view']
        : '1';

    if ($view === '1') {
        $dataFromParent = 'abc';

        require_once 'view1.html';
    } else if ($view === '2') {
        $dataFromParent = 'def';

        require_once 'view2.html';
    } else {
        throw new RuntimeException('unknown view');
    }
