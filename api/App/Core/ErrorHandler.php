<?php
function ErrorHandler($errno, $errstr, $errfile, $errline)
{
    header('Content-Type: application/json');

    $formated_error = array(
        "message" => "Ocorreu um erro na aplicação",
        "error" => $errstr,
        "file" => $errfile
    );

    http_response_code(500);

    echo json_encode($formated_error, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    exit();
}


set_error_handler("ErrorHandler");
