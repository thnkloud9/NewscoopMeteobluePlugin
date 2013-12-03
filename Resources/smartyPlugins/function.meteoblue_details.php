<?php
/**
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Get weather
 *
 * @param array $params
 * @param Smarty_Internal_Template $smarty
 * @return string
 */
function smarty_function_meteoblue_details(array $params, Smarty_Internal_Template $smarty)
{
    return sprintf('<iframe src="http://www.meteoblue.com/de_DE/customer/tageswoche/index/%s" height="%d" width="%d" frameborder="0" scrolling="NO"></iframe><div><a href="http://www.meteoblue.com/de_DE/plugin/meteoblue/details/vorhersage/woche/%s?utm_source=tageswoche&utm_medium=linkus&utm_campaign=CustomWidget" title="Wetter Basel - meteoblue" target="_blank">meteoblue.com</a></div>', $params['citycode'], $params['height'], $params['width'], $params['citycode']);

}
