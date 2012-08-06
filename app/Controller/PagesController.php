<?php
App::uses('AppController', 'Controller');
class PagesController extends AppController 
{
    public function beforeFileter()
    {
        parent::beforeFilter();
    }

    /**
     * トップページ
     *
     * @access public
     */
    public function index()
    {
        $this->set('title_for_layout', TITLE);
        $this->set('title_for_page', TITLE);
    }

    /**
     * メンバー
     *
     * @access public
     */
    public function members()
    {
        $this->set('title_for_layout', TITLE . ' メンバー');
        $this->set('title_for_page', TITLE . ' メンバー');
    }

    /**
     * マップ
     *
     * @access public
     */
    public function map()
    {
        $this->set('title_for_layout', TITLE . ' マップ');
        $this->set('title_for_page', TITLE . ' マップ');
    }

    /**
     * 写真
     *
     * @access public
     */
    public function photos()
    {
        $this->set('title_for_layout', TITLE . ' 写真');
        $this->set('title_for_page', TITLE . ' 写真');
    }

    /**
     * イベント
     *
     * @access public
     */
    public function events()
    {
        $this->set('title_for_layout', TITLE . 'イベント');
        $this->set('title_for_page', TITLE . 'イベント');
    }

    /**
     * 本棚
     *
     * @access public
     */
    public function bookshelf()
    {
        $this->set('title_for_layout', TITLE . ' 本棚');
        $this->set('title_for_page', TITLE . ' 本棚');
    }
}
