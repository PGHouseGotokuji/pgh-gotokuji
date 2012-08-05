<?php
App::uses('AppController', 'Controller');
class AuthsController extends AppController 
{
    public $uses   = array('Admin');
    public $layout = 'admin_default';

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
    public function login()
    {
        if (!empty($this->request->data)) {
            $data = $this->request->data;
            $data['Admin']['password'] = Security::hash($this->request->data['Admin']['password'], 'sha256', true);
            $admin = $this->Admin->find('first', array(
                'conditions' => array(
                    'admin_name' => $data['Admin']['admin_name'],
                    'password'   => $data['Admin']['password']
                )
            ));
            if (!empty($admin)) {
                $this->Session->write('auth.admin', $admin);
                $this->Session->setFlash('ログインしました。', 'flash' . DS . 'success');
                $this->redirect('/admin/top');
            }
            $this->Session->setFlash('ユーザー名、もしくはパスワードが間違っています。', 'flash' . DS . 'error');
        }

        $this->set('title_for_layout', TITLE);
        $this->set('title_for_page', TITLE);
    }

    /**
     * ログアウト
     *
     * @access public
     */
    public function logout()
    {
        $this->Session->delete('auth.admin');
        $this->Session->setFlash('ログアウトしました', 'flash' . DS . 'success');
        $this->redirect('/login');

        $this->set('title_for_layout', TITLE);
        $this->set('title_for_page', TITLE);
    }
}
