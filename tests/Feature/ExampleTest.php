<?php

it('redirects the home page to the shop', function () {
    $this->get('/')->assertRedirect('/index');
});
