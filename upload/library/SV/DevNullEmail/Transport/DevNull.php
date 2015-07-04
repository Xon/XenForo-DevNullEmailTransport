<?php

class SV_DevNullEmail_MailHack extends Zend_Mime_Part
{
    public static function getRawContent(Zend_Mime_Part $base)
    {
        return $base->_content;
    }
}

class SV_DevNullEmail_Transport_DevNull extends Zend_Mail_Transport_Abstract
{
    protected function _sendMail()
    {
        $options = XenForo_Application::get('options');

        if ($options->sv_devnullemail_print_html)
        {
            XenForo_Error::logException(new Exception(SV_DevNullEmail_MailHack::getRawContent($this->_mail->getBodyHtml())), false);
        }
        if ($options->sv_devnullemail_print_text)
        {
            XenForo_Error::logException(new Exception(SV_DevNullEmail_MailHack::getRawContent($this->_mail->getBodyText())), false);
        }
        if ($options->sv_devnullemail_error)
        {
            throw new Zend_Mail_Transport_Exception($options->sv_devnullemail_failurereason);
        }
        XenForo_Error::debug("Null routed email to " . $this->recipients);
        return true;
    }
}