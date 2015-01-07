<?php

class SV_DevNullEmail_Transport_DevNull extends Zend_Mail_Transport_Abstract
{
    protected function _sendMail()
    {
        $options = XenForo_Application::get('options');

        if ($options->sv_devnullemail_error)
        {
            throw new Zend_Mail_Transport_Exception($options->sv_devnullemail_failurereason);
        }
        return true;
    }
}