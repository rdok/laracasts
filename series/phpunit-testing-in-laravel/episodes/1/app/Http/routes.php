<?php

$this->get('/', function () {
    return view('welcome');
});

$this->get('click-me', function () {
    return 'You\'ve been clicked, punk.';
});
