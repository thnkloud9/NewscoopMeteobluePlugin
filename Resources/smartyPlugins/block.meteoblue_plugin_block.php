<?php
/**
 * @package Newscoop
 * @author Mark Lewis <mark.lewis@sourcefabric.org>
 * @copyright 2012 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Newscoop twitter_plugin block plugin
 *
 * Type:     block
 * Name:     twitter_plugin
 * Purpose:  Displays latest tweets 
 *
 * @param string
 *     $params
 * @param string
 *     $p_smarty
 * @param string
 *     $content
 *
 * @return
 *
 */
function smarty_block_meteoblue_plugin_details_block($params, $content, &$smarty, &$repeat)
{
    if (!isset($content)) {
        return '';
    }

    $smarty->smarty->loadPlugin('smarty_shared_escape_special_chars');
    $context = $smarty->getTemplateVars('gimme');

    $html = "
        <iframe src='http://www.meteoblue.com/de_DE/customer/tageswoche/index/{{ $citycode }}' height='1900' width='650' frameborder='0' scrolling='NO'></iframe>
        <div>
            <a href='http://www.meteoblue.com/de_DE/wetter/vorhersage/woche/{{ $citycode }}?utm_source=tageswoche&utm_medium=linkus&utm_campaign=CustomWidget' title='Wetter Basel - meteoblue' target='_blank'>meteoblue.com</a>
        </div>";

    return $html;

}
