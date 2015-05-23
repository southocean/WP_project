<?php
App::uses('Sanitize',  'Utility', 'CakeEmail', 'Network/Email');

class UsersController extends AppController {
    var $components = array('Email','Auth');
    var $helpers = array('Html', 'Form', 'Gravatar');

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.username' => 'asc' ) 
    );
	
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('login','add');
        $this->Email->delivery = 'debug'; /* used to debug email message */
        $this->Auth->autoRedirect = false; /* this allows us to run further checks on login() action.*/
        //$this->Auth->allow("*");
        $this->Auth->allow('register', 'thanks', 'confirm', 'logout', 'activate', 'reactivation');
        $this->Auth->userScope = array('User.is_banned' => 0); /* admin can ban a user by updating `is_banned` field of users table to '1' */
    }

	public function login() {
		
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));		
		}
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
                
                $results = $this->User->find('all', array(
                        'conditions' => array('User.username' => $this->request->data['User']['username']),
                        'fields' => array('User.active')
                    ));
                //Debugger::dump($results);
                // Check to see if the User's account isn't active
                if ($results[0]['User']['active'] == 0) {
                    // Uh Oh!
                    $this->Session->setFlash('Your account has not been activated yet!');
                    $this->Auth->logout();
                    $this->redirect('/users/login');
                }
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
			// 'limit' => 6,
			'order' => array('User.username' => 'asc')
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
    }

    //Get code and active account
    function activate($user_id = null, $in_hash = null) {
        
        $this->User->id = $user_id;
        $user = $this->User->findByUid($user_id);
        if ( isset($user) && ($in_hash == $this->User->getActivationHash())) {
                $update['User'] = $dataUpdate = array(
                    'uID' => $user['User']['uID'],
                    'username' => $user['User']['username'],
                    'active' => 1);
                $this->User->save($update);
                $this->Session->setFlash('Your account has been activated, please log in below.');
                    $this->redirect('login');
            
        }
       
           // Activation failed, render '/views/user/activate.ctp' which should tell the user.
     }

    //Sent acctive link to email of user
    function __sendActivationEmail($user_id) {
        $user = $this->User->findByUid($user_id);
        if ($user === false) {
            debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");
            return false;
        }
        Debugger::dump($user);
        // Set data for the "view" of the Email
        $message = 'http://' . env('SERVER_NAME') . '/WP_project/Users/activate/' . $user['User']['uID'] . '/' . $this->User->getActivationHash();
        
        //Hey there <?= $username, we will have you up and running in no time, but first we just need you to confirm your user account by clicking the link below:
        $message = "Chào ".$user['User']['username'].", Chào mừng bạn đến với ThiTracNghiem.com Click vào link dưới đây để hoàn tất thủ tục đăng kí: ". $message;

        $this->set('activate_url', $message);
        $this->set('username', $user['User']['username']);
        $Email = new CakeEmail();
        $Email->config('gmail');
        $Email->from(array('me@example.com' => 'My Site'));
        $Email->to($user['User']['email']);
        $Email->subject(env('SERVER_NAME').' – Please confirm your email address');
        $Email->send($message);
    }

    // Resent active link 
    public function reactivation() {
        if($this->request->is('post')) {
            $email = $this->request->data['reactivation']['email'];
            $userInfo = $this->User->findByEmail($email);
            Debugger::dump($userInfo);
            $this->__sendActivationEmail($userInfo['User']['uID']);
        }

    }

    // Create account
    public function register() {
        if ($this->request->is('post')) {
            //Debugger::dump($this->request->data);
            
            $this->User->data = Sanitize::clean($this->request->data);

            // Successfully created account – send activation email     
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->__sendActivationEmail($this->User->getLastInsertID());

                $this->redirect(array('controller' => 'Users', 'action' => 'thanks'));
            }
            // Failed, clear password field
            else {
                //$this->request->data['User']['password'] = null;
                //$this->request->data['User']['password_confirm'] = null;
            }
        }
    }

    public function thanks()
    {
        
    }
        
    public function edit($uID = null) {

		    if (!$uID) {
				$this->Session->setFlash('Please provide a user id');
				$this->redirect(array('action'=>'index'));
			}

			$user = $this->User->findByUid($uID);
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
	

    public function viewProfile() {
        $UserLevel = ClassRegistry::init('UserLevel');
        $userlevel = $UserLevel->find('all', array(
            'conditions' => array('UserLevel.uID' => $this->Auth->user('uID')),
            'fields' => array('UserLevel.*', 'Subject.*'),
            'order' =>  array('Subject.sbName' => 'asc')
        ));

        //Debugger::dump($userlevel);
        $userInfo = $this->Session->read('Auth.User');
        //Debugger::dump($userInfo);
        $this->set('userlevel', $userlevel);
        $this->set('userInfo', $userInfo);
        //$this->render("view_profile");
        if($this->request->is('post')) {
            $data = $this->request->data;
            Debugger::dump($data);
        }
    }

    /*
     * Làm bài test
     */
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

    /*
     * Lấy ID bài test
     * phục vụ cho function examiner
     */
    public function getTestId() {
            if($this->request->is('post')) {
            $Test = ClassRegistry::init('Test');
            $data = $Test->findByTestid($this->request->data['TestID']['testID']);
            //Debugger::dump($data);
            if(!$data) {
                $this->Session->setFlash(__('TestID not exist.'));
            } else {
                $this->Session->write('getTestId', $this->request->data['TestID']['testID']);
                $this->redirect('examiner');
            }
            //Debugger::dump($data);
        }
    }

    /*
     * Chấm thi
     */
    public function examiner() {
        if($this->Auth->user('role') == "student") {
            $this->Session->setFlash(__('Bạn không có quyền chấm thi.'));
            return;
        }
        $Test = ClassRegistry::init('Test');

        if($this->request->is('post')) {
            //Debugger::dump($this->request->data);
            $postData['chamthi'] = 1;
            $postData['testID'] = 1;
            $postData['result'] = $this->request->data;
            $postData['uID'] = $this->Auth->user('uID');
            $this->Session->write('testAns', $postData);
            $this->redirect(array('controller' => 'tests','action' => 'getResult'));

        }

        $testID = $this->Session->read('getTestId');
        if($testID == null) $this->redirect('getTestId');

        $testInfo = $Test->findByTestid($testID);
        $listQues = $Test->ExamQuestion->find('all', array(
            'conditions' => array('ExamQuestion.testID' => $testID),
            'fields' => array('ExamQuestion.*', 'Question.*'),
            'order' => array('ExamQuestion.index ASC')
        ));
        $this->Session->delete('getTestId');
        //Debugger::dump($testInfo);
        //Debugger::dump($listQues);
        $this->set('testInfo', $testInfo);
        $this->set('listQues', $listQues);
    }

    /*
     * Luyện tập
     * Trả lời từng câu, hiển thị ngay kết quả.
     */
    public function training() {
        $Question = ClassRegistry::init('Question');
        $totalQues = array_values($Question->find('list'));
        $qID = $totalQues[rand(0,count($totalQues)-1)];
        //Debugger::dump($Question->findByQid($qID));
        $this->set('question', $Question->findByQid($qID));
        if($this->request->is('post')) {
            $this->Session->write('trainingAns', $this->request->data);
            $this->redirect(array('controller' => 'tests','action' => 'trainingResult'));
        }
    }
}

?>