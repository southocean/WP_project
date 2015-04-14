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
        if($this->request->is('post')) {
            $this->Question->create();
            if($this->Question->save($this->request->data)){
                $this->Session->setFlash('The question has been created!');
                //$this->redirect('index');
            }
        }
        $this->set('topics', $this->Question->Topic->find("all"));

    }

    public function index() {
        $data = $this->Question->find("all");
        $this->set("questions", $data);
        Debugger::dump($data);
    }
}