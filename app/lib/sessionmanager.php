<?php
namespace estore\app\lib;

class SessionManager extends \SessionHandler
{
    public function start()
    {
        if('' === session_id()) {
            if(session_start()) {
                $this->setSessionStartTime();
                $this->checkSessionValidity();
            }
        }
    }
}