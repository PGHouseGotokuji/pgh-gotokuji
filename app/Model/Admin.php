<?php
App::uses('AppModel', 'Model');
class Admin extends AppModel {

    var $name = 'Admin';

    // authority_level
    const authority_level_basic  = 0;
    const authority_level_master = 1;

    // register_status
    const admin_interim    = 0;
    const admin_registered = 1;
    const admin_withdraw   = 2;

    // admin_gender
    const admin_gender_man   = 0;
    const admin_gender_woman = 1;

    public static $authorityLevelList = array(
        self::authority_level_basic  => '通常',
        self::authority_level_master => 'マスター'
    );

    public static $registerStatusList = array(
        self::admin_interim    => '仮登録',
        self::admin_registered => '本登録',
        self::admin_withdraw   => '退会'
    );

    public static $genderList = array(
        self::admin_gender_man   => '男性',
        self::admin_gender_woman => '女性'
    );

    public $validate = array(
        'admin_name' => array(
            array('rule' => 'notEmpty', 'message' => '▲管理人名を入力してください'),
            array('rule' => array('maxLength', 20), 'message' => '▲管理人名は20文字以内にしてください'),
            array('rule' => array('checkExistedAdminName'), 'message' => '▲既に登録されています')
        ),
        'passwd_old' => array(
            array('rule' => 'notEmpty', 'message' => '▲旧パスワードを入力してください'),
            array('rule' => array('checkOldPassword'), 'message' => '▲古いパスワードが一致していません。')
        ),
        'passwd_first' => array(
            array('rule' => 'notEmpty', 'message' => '▲新パスワードを入力してください'),
            array('rule' => array('maxLength', 20), 'message' => '▲新パスワードは20文字以内にしてください')
        ),
        'passwd_confirm' => array(
            array('rule' => 'notEmpty', 'message' => '▲新パスワード(確認用)を入力してください'),
            array('rule' => array('maxLength', 20), 'message' => '▲新パスワード(確認用)は20文字以内にしてください'),
            array('rule' => array('confirmSamePassword'), 'message' => '▲新パスワード(確認用)と新パスワードが一致しません。')
        ),
        'email' => array(
            array('rule' => 'notEmpty', 'message' => '▲メールアドレスを入力してください'),
            array('rule' => array('maxLength', 180), 'message' => '▲メールアドレスは180文字以内にしてください')
        ),
        'authority_level' => array(
            array('rule' => 'notEmpty', 'message' => '▲権限レベルを入力してください')
        ),
        'register_status' => array(
            array('rule' => 'notEmpty', 'message' => '▲登録状況を入力してください')
        ),
        'admin_lname' => array(
            array('rule' => 'notEmpty', 'message' => '▲管理人(姓)を入力してください'),
            array('rule' => array('maxLength', 30), 'message' => '▲管理人(姓)は30文字以内にしてください')
        ),
        'admin_fname' => array(
            array('rule' => 'notEmpty', 'message' => '▲管理人(名)を入力してください'),
            array('rule' => array('maxLength', 30), 'message' => '▲管理人(名)は30文字以内にしてください')
        ),
        'admin_lname_kana' => array(
            array('rule' => 'notEmpty', 'message' => '▲管理人 姓(カナ)を入力してください'),
            array('rule' => array('maxLength', 30), 'message' => '▲管理人 姓(カナ)は30文字以内にしてください')
        ),
        'admin_fname_kana' => array(
            array('rule' => 'notEmpty', 'message' => '▲管理人 名(カナ)を入力してください'),
            array('rule' => array('maxLength', 30), 'message' => '▲管理人 名(カナ)は30文字以内にしてください')
        ),
        'admin_gender' => array(
            array('rule' => 'notEmpty', 'message' => '▲性別を入力してください')
        )
    );

    public function beforeSave() {
        // パスワードのhash化
        $this->data['Admin']['password'] = Security::hash($this->data['Admin']['passwd_confirm'], 'sha256', true);
        return true;
    }


    /**
     * 既に登録されている管理人名を確認
     *
     * @access public
     * @param  array   $this->request->data
     * @return boolean
     */
    public function checkExistedAdminName()
    {
        $admin = $this->findByAdminName($this->data['Admin']['admin_name']);
        if (empty($admin) || $this->data['Admin']['admin_name'] == $admin['Admin']['admin_name']) {
            return true;
        }
        return false;
    }

    /**
     * 現在のパスワード確認
     *
     * @access public
     * @param  array   $this->request->data
     * @return boolean
     */
    public function checkOldPassword()
    {
        $admin = $this->findById($this->data['Admin']['id']);
        $oldPassword = Security::hash($this->data['Admin']['passwd_old'], 'sha256', true);
        if ($oldPassword == $admin['Admin']['password']) {
            return true;
        }
        return false;
    }

    /**
     * 確認用パスワードと新パスワードが一致しているか確認
     *
     * @access public
     * @param  array   $this->data
     * @return boolean
     */
    public function confirmSamePassword()
    {
        if ($this->data['Admin']['passwd_first'] == $this->data['Admin']['passwd_confirm']) {
            return true;
        }
        return false;
    }
}
