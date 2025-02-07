<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('pedidos', function () {
    return true;
});
