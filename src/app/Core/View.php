<?php
namespace App\Core;

class View
{
    public function render(string $template, array $params = [], string $layout = 'layouts/master'): void
    {
        extract($params, EXTR_SKIP);

        ob_start();
        include __DIR__ . "/../Resources/views/{$template}.php";
        $content = ob_get_clean();

        include __DIR__ . "/../Resources/views/{$layout}.php";
    }
}
