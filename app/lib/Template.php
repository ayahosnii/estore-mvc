<?php

namespace estore\app\lib;

class Template
{
    private $_templateParts;
    private $_action_view;
    private $_data;

    public function __construct(array $parts)
    {
        $this->_templateParts = $parts;
    }

    public function setActionViewFile($actionViewPath)
    {
        $this->_action_view = $actionViewPath;
    }

    public function setAppData($data)
    {
        $this->_data = $data;
    }

    private function renderTemplateHeaderStart()
    {
        require_once TEMPLATE_PATH . 'templateheaderstart.php';
    }

    private function renderTemplateHeaderEnd()
    {
        require_once TEMPLATE_PATH . 'templateheaderend.php';
    }

    private function renderTemplateFooter()
    {
        require_once TEMPLATE_PATH . 'templatefooter.php';
    }

    private function renderTemplateBlocks()
    {
        if (!array_key_exists('template', $this->_templateParts)) {
            trigger_error('Sorry you have to define the template blocks', E_USER_WARNING);
        } else {
            $parts = $this->_templateParts['template'];
            if (!empty($parts)) {
                extract($this->_data);
                foreach($parts as $partKey => $file) {
                    if ($partKey === ':view') {
                        require_once $this->_action_view;
                    } else {
                        require_once $file;
                    }
                }
            }
        }
    }

    public function renderHeaderResources()
    {
        $output = '';
        if (!array_key_exists('header_resources', $this->_templateParts)) {
            trigger_error('Sorry you have to define the header resources', E_USER_WARNING);
        } else {
            $resources = $this->_templateParts['header_resources'];

            //Generate Css Links
            $css = $resources['css'];
            if (!empty($css)) {
                foreach ($css as $cssKey => $path) {
                    $output .= '<link type="text/css" rel="stylesheet" href="' . $path .'" />';
                }
            }


            //Generate JS Links
            $js = $resources['js'];
            if (!empty($js)) {
                foreach($js as $jsKey => $path) {
                   $output .= '<script src="' . $path .'" > </script>';
                }
            }
        }
        echo $output;

    }
    public function renderFooterResources()
    {
        $output = '';
        if (!array_key_exists('footer_resources', $this->_templateParts)) {
            trigger_error('Sorry you have to define the template renderFooterResources', E_USER_WARNING);
        } else {
            $resources = $this->_templateParts['footer_resources'];

            //Generate JS Links
            if (!empty($resources)) {
                foreach($resources as $resourceKey => $path) {
                   $output .= '<script src="' . $path .'" > </script>';
                }
            }
        }
        echo $output;
    }

    public function renderApp()
    {
        $this->renderTemplateHeaderStart();
        $this->renderHeaderResources();
        $this->renderTemplateHeaderEnd();
        $this->renderTemplateBlocks();
        $this->renderFooterResources();
        $this->renderTemplateFooter();
    }
}