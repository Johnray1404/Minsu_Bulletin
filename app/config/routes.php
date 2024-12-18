<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

$router->get('/', 'Minsu::login');
$router->post('/login', 'Minsu::login');
$router->get('/logout', 'Minsu::logout');
$router->get('/signup', 'Minsu::signup');
$router->post('/signup', 'Minsu::signup');
$router->get('/home', 'Minsu::home');
$router->get('/userNews', 'Minsu::userNews');
$router->get('/logout', 'Minsu::logout');
$router->get('/admin/dashboard', 'Minsu::admin_dashboard');
$router->get('/contact', 'Minsu::contact');
$router->get('/admin/news', 'Minsu::news'); 
$router->post('/admin/delete_news/{id}', 'Minsu::delete_news');
$router->get('/admin/view_news/{id}', 'Minsu::view_news');
$router->get('/admin/post_news', 'Minsu::postNews');         
$router->post('/admin/post_news', 'Minsu::submitNews');
$router->get('/userProfile', 'Minsu::userProfile');
$router->post('/userProfile', 'Minsu::userProfile');
$router->get('/post', 'Minsu::post_page');
$router->post('/post_comment', 'Minsu::post_comment');
$router->get('/get-post', 'Minsu::getPost');    
$router->post('/add-post', 'Minsu::addPost');  
$router->get('/delete-post/{id}', 'Minsu::deletePost');
$router->get('/gallery', 'Minsu::gallery');
$router->post('/minsu/toggle_like', 'Minsu::toggle_like');
$router->post('/minsu/toggle_post_like', 'Minsu::toggle_post_like');
$router->get('/admin/accounts', 'Minsu::accounts');
$router->post('/minsu/add_comment', 'Minsu::add_comment');















