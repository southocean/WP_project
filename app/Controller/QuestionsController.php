<?php
/**
 * Created by PhpStorm.
 * User: Huong
 * Date: 4/12/2015
 * Time: 10:17 AM
 */

class QuestionsController extends AppController {
    var $name = "Questions";
    public $components = array('Session');

    public function add() {
        if($this->Auth->user('role') == "student") {
            $this->Session->setFlash(__('Bạn không có quyền tạo câu hỏi.'));
            return;
        }
        $topics = $this->Question->Topic->find('list', array('fields' => array('Topic.topID','Topic.topName')));
        $subjects = $this->Question->Subject->find('list', array('fields' => array('Subject.sbID','Subject.sbName')));

        $this->set('topics', $topics);
        $this->set('subjects', $subjects);

        if($this->request->is('post')) {
            $this->Question->create();
            $data = $this->request->data;
            Debugger::dump($data);
            $data['Question']['topID'] = $data['Question']['topics'];
            $data['Question']['sbID'] = $data['Question']['subjects'];
            $data['Question']['uID'] = $this->Auth->user('uID');
            $data['Question']['correctNum'] = 0;
            $data['Question']['totalNum'] = 0;
            Debugger::dump($data);
            if($this->Question->save($data)){
                $this->Session->setFlash('The question has been created!');
                //$this->redirect('index');
            }
        }
        //Debugger::dump($this->Question->Topic->find('list', array('fields' => array('Topic.topName', 'Topic.topID'))));

    }

    public function index() {
        $data = $this->Question->find("all", array(
            'order' => array('Question.qID DESC'),
            'conditions' => array('Question.uID' => $this->Auth->user('uID'))));
        $this->set("questions", $data);
        //Debugger::dump($data);
    }
}