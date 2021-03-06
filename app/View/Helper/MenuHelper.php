<?php
/**
 * Menu Helper class file
 *
 * Styles a list item link based on the currently active controller.
 *
 * Date: 2012 06 27
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @link          https://github.com/jordanvg/cakephp-menu-helper
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppHelper', 'View/Helper');
App::import('Utility', 'Xml');

class MenuHelper extends AppHelper {

    public $helpers = array('Html');

    /**
     * Creates a formatted list element
     *
     * ### Usage
     * Note: For CakePHP 2.x before 2.2, replace Hash::merge with Set::merge
     * `echo $this->Menu->item($html->link('Example Link', array('controller' => 'example', 'action' => 'view', 3)), array('class' => 'myListClass'));`
     *
     * @param string $link Link in the form <a href="" [...]>.
     * @param array $attributes Options to use for the list element.
     * @return string The passed link with list tags containing the applicable attributes.
     */
    function item($link, $attributes = array()) {
        // class to apply to the list element if the link routes to the current controller
        $activeClass = 'active';

        // pull href attribute from the <a> element, remove any base URL for proper controller and action mapping from Router::parse()
        $linkRoutes = Xml::toArray(Xml::build($link));
        $linkRoutes = str_replace($this->base, '', $linkRoutes['a']['@href']);
        $linkRoutes = Router::parse($linkRoutes);
        
        // if the current controller matches the one the link routes to, it is active
        if ($this->params['controller'] == $linkRoutes['controller'] && $this->params['action'] == $linkRoutes['action']) {
            if (isset($attributes['class'])) {
                $classes = explode(' ', $attributes['class']);
                $classes[] = $activeClass;
                $attributes['class'] = $classes;
            } else {
                $attributes['class'] = $activeClass;
            }
        }

        return $this->Html->tag('li', $link, $attributes);
    }
}
