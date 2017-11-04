<?php

namespace Paperyard\Controllers\Rule;

use Paperyard\Controllers\BasicController;
use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;

class Subjects extends BasicController
{
    public function __construct(Twig $view, LoggerInterface $logger, Messages $flash)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->flash = $flash;

        $this->registerPlugin('clickable-row');
        $this->registerPlugin('bootstrap-notify.min');
    }

    public function __invoke(Request $request, Response $response, $args)
    {

        // show rule list
        $this->view->render($response, 'rule/subjects.twig', $this->render());
        return $response;
    }

    /**
     * render
     * @return array data to render the view
     */
    public function render()
    {
        return array(
            'plugins' => parent::getPlugins(),
            'rules' => \Paperyard\Models\Rule\Subjects::all(),
            'languageFlag' => parent::getLanguageFlag()
        );
    }
}
