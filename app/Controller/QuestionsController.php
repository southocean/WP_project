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
        $topics = $this->Question->Topic->find('list', array('fields' => array('Topic.topName', 'Topic.topID')));
        $subjects = $this->Question->Subject->find('list', array('fields' => array('Subject.sbName', 'Subject.sbID')));
        $this->set('topics', $topics);
        $this->set('subjects', $subjects);

        if($this->request->is('post')) {
            $this->Question->create();
            $data = $this->request->data;
            $data['Question']['topID'] = $topics[$data['Question']['topics']];
            $data['Question']['sbID'] = $subjects[$data['Question']['subjects']];
            $data['Question']['uID'] = $this->Auth->user('uID');
            if($this->Question->save($data)){
                $this->Session->setFlash('The question has been created!');
                //$this->redirect('index');
            }
        }
        Debugger::dump($this->Question->Topic->find('list', array('fields' => array('Topic.topName', 'Topic.topID'))));

    }

    public function index() {
        $data = $this->Question->find("all", array(
            'order' => array('Question.qID DESC'),
            'conditions' => array('Question.uID' => $this->Auth->user('uID'))));
        $this->set("questions", $data);
        //Debugger::dump($data);
    }
}