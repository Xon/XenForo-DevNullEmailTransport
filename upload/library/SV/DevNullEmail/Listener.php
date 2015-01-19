<?php

class SV_DevNullEmail_Listener
{
    const AddonNameSpace = 'SV_DevNullEmail';

	public static function init_dependencies(XenForo_Dependencies_Abstract $dependencies, array $data)
	{
        $options = XenForo_Application::get('options');
        if ($options->sv_devnullemail_enable)
        {
            $transportClass = XenForo_Application::resolveDynamicClass("SV_DevNullEmail_Transport_DevNull");
            XenForo_Mail::setupTransport(new $transportClass);
        }
	}
}
