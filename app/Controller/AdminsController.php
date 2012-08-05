<?php
App::uses('AppController', 'Controller');
class AdminsController extends AppController 
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
     * アドミントップ
     *
     * @access public
     */
    public function top()
    {
        $this->set('title_for_layout', TITLE);
        $this->set('title_for_page', TITLE);
    }

    /**
     * add
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->Admin->create();
            if ($this->Admin->save($data)) {
                $this->Session->setFlash('管理人登録が完了しました。', 'flash' . DS . 'success');
                $this->redirect(array('action' => 'top'));
            } else {
                $this->Session->setFlash('入力内容に不備があります。ご確認ください。', 'flash' . DS . 'error');
                $admin = $data;
                $this->set(compact('admin'));
            }
        }

        $this->set('title_for_layout');
        $this->set('title_for_page');
    }

    /**
     * view
     *
     * @return void
     */
    public function view()
    {
        $adminId = $this->params['adminId'];
        $this->Admin->id = $adminId;
        if (!$this->Admin->exists()) {
            throw new NotFoundException(__('Invalid admin'));
        }
        $admin = $this->Admin->read(null, $adminId);
        $this->set(compact('admin'));
        $this->set('title_for_layout', TITLE);
        $this->set('title_for_page', TITLE);
    }

    /**
     * edit
     *
     * @param  string $adminId
     * @return void
     */
    public function edit()
    {
        $adminId = $this->params['adminId'];
        $admin = $this->Admin->findById($adminId);
        if (empty($admin)) {
            $this->Session->setFlash('指定の管理人はいません。', 'flash' . DS . 'error');
            $this->redirect($this->referer());
        }
        $adminName = $admin['Admin']['admin_name'];

        if (!empty($this->data)) {
            try {
                $data = $this->data;
                $this->Admin->id = $adminId;
                if (!$this->Admin->save($data)) {
                    throw new Exception();
                }
                $this->Session->setFlash('管理人の編集が完了しました。', 'flash' . DS . 'success');
                $this->redirect(array('action' => 'top'));
            } catch (Exception $e) {
                $this->Session->setFlash('入力内容に不備があります。ご確認ください。', 'flash' . DS . 'error');
                $admin = am($admin , $data);
            }
        }

        unset($admin['Admin']['password']);
        $this->set(compact('admin'));
        $this->set('title_for_layout', TITLE);
        $this->set('title_for_page', TITlE);
    }

    /**
     * delete
     *
     * @param  string $id
     * @return void
     */
    public function delete()
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $adminId = $this->params['adminId'];
        $admin = $this->Admin->findById($adminId);
        if (empty($admin)) {
            $this->Session->setFlash('指定の管理人はいません。', 'flash' . DS . 'error');
            $this->redirect($this->referer());
        }
        $this->Admin->id = $adminId;
        if (!$this->Admin->exists()) {
            throw new NotFoundException('既に削除されているか、存在しない管理人情報です。');
        }
        if (!$this->Admin->delete()) {
            $this->Session->setFlash('管理人情報削除に失敗しました。再度お試しください。', 'flash' . DS . 'error');
        }
        $this->Session->setFlash('管理人情報を削除しました。', 'flash' . DS . 'success');
        $this->redirect(array('action' => 'top'));
    }
}
