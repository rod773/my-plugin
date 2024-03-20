<?php

namespace MyPlugin;

use Symfony\Component\HttpFoundation\Request;

class MyPlugin
{
    public function __construct()
    {
        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);
        add_action('init', [$this, 'init']);
    }

    public function activate()
    {
        // Add any activation code here
    }

    public function deactivate()
    {
        // Add any deactivation code here
    }

    public function init()
    {
        add_shortcode('my_plugin_shortcode', [$this, 'render_shortcode']);
    }

    public function render_shortcode()
    {
        $request = Request::createFromGlobals();
        $data = [
        'title' => 'My Plugin Title',
        'message' => $request->query->get('message'),
        ];
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../templates');
        $twig = new \Twig\Environment($loader);
        echo $twig->render('my-plugin.twig', $data);
    }
}