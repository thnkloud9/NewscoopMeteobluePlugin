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
function smarty_block_twitter_plugin_block($params, $content, &$smarty, &$repeat)
{
    if (!isset($content)) {
        return '';
    }

    $smarty->smarty->loadPlugin('smarty_shared_escape_special_chars');
    $context = $smarty->getTemplateVars('gimme');

    $html = "
        <div class='js-twitter-widget-container'></div>
        <script type='text/javascript'>
        $.ajax({
            type: 'POST',
            url: '/plugin/twitter/latesttweet',
            dataType: 'html',
            success: function(msg){
                $('.js-twitter-widget-container').html(msg);
            }
        });
        </script>";

    return $html;

}
