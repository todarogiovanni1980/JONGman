<?php
/**
* @package     JONGman Package
*
* @copyright   Copyright (C) 2005 - 2017 Prasit Gebsaap, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

/**
 * Legacy routing rules class from com_jongman
 *
 * @since       3.6
 * @deprecated  4.0
 */
class JongmanRouterRulesLegacy implements JComponentRouterRulesInterface
{
    /**
     * Constructor for this legacy router
     *
     * @param   JComponentRouterView $router The router this rule belongs to
     *
     * @since       3.6
     * @deprecated  4.0
     */
    public function __construct($router)
    {
        $this->router = $router;
    }

    /**
     * Preprocess the route for the com_content component
     *
     * @param   array &$query An array of URL arguments
     *
     * @return  void
     *
     * @since       3.6
     * @deprecated  4.0
     */
    public function preprocess(&$query)
    {
    }

    /**
     * Build the route for the com_jongman component
     *
     * @param   array  &$query     An array of URL arguments
     * @param   array  &$segments  The URL arguments to use to assemble the subsequent URL.
     *
     * @return  void
     *
     * @since       3.6
     * @deprecated  4.0
     */
    public function build(&$query, &$segments)
    {
        if (isset($query['view'])) {
            // not translate these query

            $segments[] = $query['view'];
            if ($query['view'] == 'schedule') {
                /* We should use slug for schedule id here? */
                if (isset($query['id'])) {
                    $segments[] = $query['id'];
                    unset($query['id']);
                }

                if (isset($query['layout'])) {
                    $segments[] = $query['layout'];
                    unset($query['layout']);
                }

                if (isset($query['sd'])) {
                    $segments[] = $query['sd'];
                    unset($query['sd']);
                }
            }else if ($query['view'] == 'reservation') {
                if (isset($query['id'])) {
                    $segments[] = $query['id'];
                    unset($query['id']);
                }

                if (isset($query['layout'])) {
                    $segments[] = $query['layout'];
                    unset($query['layout']);
                }

                if (isset($query['resource_id']))	{
                    $segments[] = $query['resource_id'];
                    unset($query['resource_id']);
                }

                if (isset($query['schedule_id']))	{
                    $segments[] = $query['schedule_id'];
                    unset($query['schedule_id']);
                }

                if (isset($query['start'])) {
                    $segments[] = $query['start'];
                    unset($query['start']);
                }

                if (isset($query['end'])) {
                    $segments[] = $query['end'];
                    unset($query['end']);
                }
            }else if ($query['view'] == 'reservations') {
                if (isset($query['id'])) {
                    $segments[] = $query['id'];
                    unset($query['id']);
                }
            }else if ($query['view'] == 'reservationitem') {
                $segments[] = $query['id'];
                unset($query['id']);
                if (isset($query['layout'])) {
                    $segments[] = $query['layout'];
                    unset($query['layout']);
                }
            }else if ($query['view'] == 'calendar') {
                if (isset($query['caltype'])) {
                    $segments[] = $query['caltype'];
                    unset($query['caltype']);
                }else{
                    $segments[] = 'month';
                }
                if (isset($query['yy']) && !empty($query['yy'])) {
                    if (isset($query['dd'])) {
                        $segments[] = $query['dd'];
                        unset($query['dd']);
                    }
                    if (isset($query['mm'])) {
                        $segments[] = $query['mm'];
                        unset($query['mm']);
                    }
                    if (isset($query['yy'])) {
                        $segments[] = $query['yy'];
                        unset($query['yy']);
                    }
                }
                if (isset($query['sid'])) {
                    $segments[] = $query['sid'];
                    unset($query['sid']);
                }
                if (isset($query['rid'])) {
                    $segments[] = $query['rid'];
                    unset($query['rid']);
                }
            }else if ($query['view'] == 'customer'){
                if (isset($query['id'])) {
                    $segments[] = $query['id'];
                    unset($query['id']);
                }else{
                    $segments[] = '0';
                }
                if (isset($query['layout'])) {
                    $segments[] = $query['layout'];
                    unset($query['layout']);
                }
                if (isset($query['tmpl'])) {
                    $segments[] = $query['tmpl'];
                    unset($query['tmpl']);
                }
                if (isset($query['modal'])) {
                    $segments[] = $query['modal'];
                    unset($query['modal']);
                }
            }
            unset($query['view']);
        }

    }

    /**
     * Parse the segments of a URL.
     *
     * @param   array  &$segments  The segments of the URL to parse.
     * @param   array  &$vars      The URL attributes to be used by the application.
     *
     * @return  void
     *
     * @since       3.6
     * @deprecated  4.0
     */
    public function parse(&$segments, &$vars)
    {
        $count	= count($segments);
        switch($segments[0]) {
            case 'schedule':
                $vars['view'] 	= 'schedule';
                $vars['id']		= (int)$segments[1];
                if (isset($segments[2])) {
                    $vars['layout'] = $segments[2];
                }

                if (isset($segments[3])) {
                    /** sd=2015-12-01 converted to 2015:12-01 **/
                    $vars['sd'] = str_replace(':', '-', $segments[3]);
                }
                break;
            case 'reservation':

                $vars['view'] = 'reservation';
                if ($count == 3) {
                    /** edit existing reservation or new reservation with only schedule id supplied**/
                    if ($segments[1] == 'edit') {
                        $vars['layout'] = $segments[1];
                        $vars['schedule_id'] = $segments[2];
                    }else {
                        $vars['id'] = $segments[1];
                        $vars['layout'] = $segments[2];
                    }
                }

                if ($count == 6) {
                    $vars['layout'] 		= $segments[1];
                    $vars['resource_id'] 	= $segments[2];
                    $vars['schedule_id'] 	= $segments[3];

                    list($sd, $st) = explode(' ',urldecode($segments[4]));
                    $vars['start'] 	= str_replace(':', '-', $sd) . ' ' . str_replace('-', ':', $st) ;

                    list($ed, $et) = explode(' ', urldecode($segments[5]));
                    $vars['end']	=  str_replace(':', '-', $ed) . ' ' . str_replace('-', ':', $et) ;
                }
                break;
            case 'reservations' :
                $vars['view'] = 'reservations';
                if ($count == 2) {
                    $vars['id'] = $segments[1];
                }
                break;
            case 'reservationitem' :
                $vars['view'] = 'reservationitem';
                $vars['id'] = $segments[1];
                if ($count == 3){
                    $vars['layout'] = $segments[2];
                }
                break;
            case 'calendar':
                $vars['view'] = 'calendar';
                $vars['caltype'] = $segments[1];

                if ($count == 3) {
                    $vars['sid'] = $segments[2];
                }
                if ($count == 4) {
                    $vars['sid'] = $segments[2];
                    $vars['rid'] = $segments[3];
                }

                if ($count >= 5) {
                    if (isset($segments[2])) $vars['dd'] = $segments[2];
                    if (isset($segments[3])) $vars['mm'] = $segments[3];
                    if (isset($segments[4])) $vars['yy'] = $segments[4];
                }
                if ($count == 6) {
                    $vars['sid'] = $segments[5];
                }
                if ($count == 7) {
                    $vars['sid'] = $segments[5];
                    $vars['rid'] = $segments[6];
                }
                break;
            case 'customer' :
                $vars['view'] = 'customer';
                if ($count == 2) {
                    $vars['id'] = $segments[1];
                }else if ($count == 3) {
                    $vars['id'] = $segments[1];
                    $vars['layout'] = $segments[2];
                }else if ($count >= 4) {
                    $vars['id'] = $segments[1];
                    $vars['layout'] = $segments[2];
                    $vars['tmpl'] = $segments[3];
                }
                if (isset($segments[4])) $vars['modal'] = $segments[4];
                break;
        }
    }
}