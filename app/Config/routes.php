<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/',          array('controller' => 'pages', 'action' => 'index', 'home'));
Router::connect('/members',   array('controller' => 'pages', 'action' => 'members'));
Router::connect('/map',       array('controller' => 'pages', 'action' => 'map'));
Router::connect('/photos',    array('controller' => 'pages', 'action' => 'photos'));
Router::connect('/events',    array('controller' => 'pages', 'action' => 'events'));
Router::connect('/social',    array('controller' => 'pages', 'action' => 'social'));
Router::connect('/bookshelf', array('controller' => 'pages', 'action' => 'bookshelf'));

Router::connect('/login',     array('controller' => 'auths', 'action' => 'login'));
Router::connect('/logout',    array('controller' => 'auths', 'action' => 'logout'));
Router::connect('/admin/top',             array('controller' => 'admins', 'action' => 'top'));
Router::connect('/admin/add',             array('controller' => 'admins', 'action' => 'top'));
Router::connect('/admin/view/:adminId',   array('controller' => 'admins', 'action' => 'view'), array(array('adminId' => '[0-9]+')));
Router::connect('/admin/edit/:adminId',   array('controller' => 'admins', 'action' => 'edit'), array(array('adminId' => '[0-9]+')));
Router::connect('/admin/delete/:adminId', array('controller' => 'admins', 'action' => 'top'),  array(array('adminId' => '[0-9]+')));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
