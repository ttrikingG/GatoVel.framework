<?php
// app/protons/middlewares/LoadMiddleware.php

return [
    'AppController' => [
        'index' => ['session'],          // só inicia sessão
        'store' => ['session', 'csrf'],  // precisa validar CSRF
        'admin' => ['session', 'auth'],  // precisa estar logado
    ],
];

