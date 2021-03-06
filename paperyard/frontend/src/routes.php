<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', Paperyard\Controllers\Misc\Index::class);

$app->get('/archive[{path:.*}]', Paperyard\Controllers\Archive\Archive::class);

$app->get('/doc/{path}', \Paperyard\Controllers\Archive\Details::class);

$app->get('/thumbnail/{path}/{page}[/{resolution}]', \Paperyard\Controllers\Misc\Thumbnail::class);

$app->post('/setlang', function (Request $request, Response $response, array $args) {
    $langCode = $request->getParsedBody()['code'];
    $supportedCodes = array_map(function ($code) { return basename($code); }, glob("../locale/*", GLOB_ONLYDIR));
    if (in_array($langCode, $supportedCodes)) {
        $_SESSION["lang-code"] = $langCode;
        return $response;
    }
    return $response->withStatus(406);
});

$app->post('/upload', Paperyard\Controllers\Misc\Upload::class);

include 'confirm.archive.router.php';

include "senders.rules.router.php";

include "recipients.rules.router.php";

include "subjects.rules.router.php";

include "archive.rules.router.php";

include "log.shell.router.php";