<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add routes
$app->get('/', function (Request $request, Response $response) {
    $version = getenv('APP_VERSION') ?: 'not defined';
    $html = <<<HTML
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <!-- CONFIGURATIONS -->
        <base href="/">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- DOCUMENT TITLE -->
        <title>documento</title>

        <!-- STYLES -->
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            html,
            body {
                width: 100%;
                height: 100%;
            }

            body {
                line-height: 1.15;
                font-family: sans-serif;
                font-size: 16px;
                background-color: #f0f0f0;
            }

            h1 {
                display: flex;
                position: absolute;
                top: 50%;
                left: 50%;
                align-items: center;
                justify-content: center;
                transform: translate(-50%, -90%);
                margin: 0 auto;
                border-radius: .7rem;
                background-color: purple;
                width: 50rem;
                height: 10rem;
                color: white;
                font-size: 2rem;
            }
        </style>
    </head>

    <body>
        <h1>Virtual Items</h1>
        <p>APP_VERSION ( $version )</p>
    </body>

    </html>
    HTML;

    $response->getBody()->write($html);
    return $response;
});

$app->run();
