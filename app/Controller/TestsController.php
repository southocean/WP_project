<?php
/**
 * Created by PhpStorm.
 * User: Huong
 * Date: 4/12/2015
 * Time: 10:18 AM
 */

class TestsController extends AppController{
    var $name = "Tests";
    public $components = array('Session');


    function add()
    {
        $Question = ClassRegistry::init('Question');
        if ($this->request->is('post')) {
            $this->Test->create();
            $data = $this->request->data;

            //Get question form table question base on Subject ID
            //$listQuestion = $Question->find('all');

            $listQuestion = $Question->find('all',
                array('conditions' => array('Question.sbID' => $data['Test']['sbID']),
                    'fields' => array('Question.qID', 'Question.qAns',)));
            // Number of question in test > Total question in database ==> return
            if ($data['Test']['numberQuestion'] > count($listQuestion)) {
                $this->Session->setFlash('ERROR: Number of question in your test too large!');
                return;
            } else {
                if ($this->Test->save($this->request->data)) {
                    $this->Session->setFlash('The test has been created!');
                    $testID = $this->Test->find('first', array('order' => array('Test.created DESC'), 'fields' => array('Test.testID')));
                    //Debugger::dump($testID);
                }
            }

            $listQuestion = array_values($listQuestion);
            shuffle($listQuestion);
            //Debugger::dump($listQuestion);

            $tempQues = array(); //Luu questions sau khi dao(random) cua 1 bai test
            $randAns = array(1, 2, 3, 4);
            //Debugger::dump($randAns);
            for ($i = 0; $i < $data['Test']['numberQuestion']; $i++) {
                shuffle($randAns); //tron dap an

                $tempQues[$i] = array(
                    'testID' => $testID['Test']['testID'],
                    'qID' => $listQuestion[$i]['Question']['qID'],
                    'A' => $randAns[0],
                    'B' => $randAns[1],
                    'C' => $randAns[2],
                    'D' => $randAns[3],
                    'index' => ($i + 1)
                );
            }
            $tempQues = array('ExamQuestion' => $tempQues);
            //Debugger::dump($tempQues);
            //Save questions into database.
            $this->Test->ExamQuestion->saveAll($tempQues['ExamQuestion']);

            $this->Session->setFlash('Init question for test have done!');

        }
    }

    public function index() {
        $listTest = $this->Test->find('all');
        $this->set('listTest', $listTest);
    }

    //Create file DOC
    function createDoc($listQuestion) {

        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=document_name.doc");

        echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
        echo "<body>";
        echo "<b>My first document</b>";
        echo "</body>";
        echo "</html>";

    }


} 