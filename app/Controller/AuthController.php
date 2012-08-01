<?php
App::uses('AppController', 'Controller');
class AuthsController extends AppController 
{
    public function beforeFileter()
    {
        parent::beforeFilter();

        $this->loginAdmin = null;

        // アドミンがログインしていたら変数に格納
        if ($this->Session->check('auth.admin')) {
            $this->loginAdmin = $this->Session->read('auth.admin');
            $this->set('admin', $this->loginAdmin);
            $this->redirect('/admin/menu');
        }
    }

    /**
     * ログイン
     *
     * @access public
     */
    public function index()
    {
        $this->set('title_for_layout', TITLE);
        $this->set('title_for_page', TITLE);
    }

    /**
     * ログアウト
     *
     * @access public
     */
    public function members()
    {
        $this->Session->delete('auth.admin');
        $this->Session->setFlash('ログアウトしました', 'flash' . DS . 'success');
        $this->redirect('/admin/login');

        $this->set('title_for_layout', TITLE);
        $this->set('title_for_page', TITLE);
    }
}
