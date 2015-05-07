<?php

class UsersController extends AppController {

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.username' => 'asc' ) 
    );
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add'); 
    }

	public function login() {
		
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));		
		}
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Invalid username or password'));
			}
		} 
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

    public function index() {
		$this->paginate = array(
			'limit' => 6,
			'order' => array('User.username' => 'asc' )
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
    }

    public function add() {
        if ($this->request->is('post')) {
				
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been created'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be created. Please, try again.'));
			}	
        }
    }

    public function edit($uID = null) {

		    if (!$uID) {
				$this->Session->setFlash('Please provide a user id');
				$this->redirect(array('action'=>'index'));
			}

			$user = $this->User->findById($uID);
			if (!$user) {
				$this->Session->setFlash('Invalid User ID Provided');
				$this->redirect(array('action'=>'index'));
			}

			if ($this->request->is('post') || $this->request->is('put')) {
				$this->User->uID = $uID;
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been updated'));
					$this->redirect(array('action' => 'edit', $uID));
				}else{
					$this->Session->setFlash(__('Unable to update your user.'));
				}
			}

			if (!$this->request->data) {
				$this->request->data = $user;
			}
    }

    public function delete($uID = null) {
		
		if (!$uID) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		
        $this->User->uID = $uID;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
			$this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
	
	public function activate($uID = null) {
		
		if (!$uID) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		
        $this->User->uID = $uID;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
			$this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }

    public function makeTest($testID){
        $Test = ClassRegistry::init('Test');
        $testInfo = $Test->findByTestid($testID);
        $listQues = $Test->ExamQuestion->find('all', array(
            'conditions' => array('ExamQuestion.testID' => $testID),
            'fields' => array('ExamQuestion.*', 'Question.*'),
            'order' => array('ExamQuestion.index ASC')
        ));
        //
        $this->set('testInfo', $testInfo);
        $this->set('listQues', $listQues);

        //Nhan ket qua va tinh diem
        if($this->request->is('post')) {
            $this->User->create();
            $postData['testID'] = $testID;
            $postData['result'] = $this->request->data;
            $postData['uID'] = $this->Auth->user('uID');
            $this->Session->write('testAns', $postData);
            $this->redirect(array('controller' => 'tests','action' => 'getResult'));
        }
    }

    public function getTestId() {
            if($this->request->is('post')) {
            $Test = ClassRegistry::init('Test');
            $data = $Test->findByTestid($this->request->data['TestID']['testID']);
            Debugger::dump($data);
            if(!$data) {
                $this->Session->setFlash(__('TestID not exist.'));
            } else {
                $this->Session->write('getTestId', $this->request->data['TestID']['testID']);
                $this->redirect('examiner');
            }
            //Debugger::dump($data);

        }

    }

    public function examiner() {
        $Test = ClassRegistry::init('Test');

        $testID = $this->Session->read('getTestId');
        if($testID == null) $this->redirect('getTestId');

        $testInfo = $Test->findByTestid($testID);
        $listQues = $Test->ExamQuestion->find('all', array(
            'conditions' => array('ExamQuestion.testID' => $testID),
            'fields' => array('ExamQuestion.*', 'Question.*'),
            'order' => array('ExamQuestion.index ASC')
        ));
        $this->Session->delete('getTestId');

        if($this->request->is('post')) {

        }
        Debugger::dump($testInfo);
        Debugger::dump($listQues);
    }


}

?>