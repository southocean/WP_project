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
        if($this->Auth->user('role') == "student") {
            $this->Session->setFlash(__('Bạn không có quyền tạo test.'));
            return;
        }
        $subjects = $this->Test->Subject->find('list', array('fields' => array( 'Subject.sbID','Subject.sbName')));
        $this->set('subjects', $subjects);
        //Debugger::dump($subjects);
        $Question = ClassRegistry::init('Question');
        if ($this->request->is('post')) {
            $this->Test->create();
            $data = $this->request->data;
            $data['Test']['sbID'] = $data['Test']['subjects'];
            //Debugger::dump($data);
            //Get question form table question base on Subject ID
            //$listQuestion = $Question->find('all');

            $listQuestion = $Question->find('all',
                array('conditions' => array('Question.sbID' => $data['Test']['sbID']),
                    'fields' => array('Question.qID', 'Question.qAns',)));
            //Number of question in test > Total question in database ==> return
            //Debugger::dump($listQuestion);
            if ($data['Test']['numberQuestion'] > count($listQuestion)) {
                $this->Session->setFlash('ERROR: Number of question in your test too large!');
                return;
            } else {
                $data['Test']['uID'] = $this->Auth->user('uID');
                if ($this->Test->save($data)) {
                    $testID = $this->Test->find('first', array('order' => array('Test.created DESC'), 'fields' => array('Test.testID')));
                } else {
                    $this->Session->setFlash('ERROR!');
                    return;
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
            unset($this->request->data);
            $this->Session->setFlash('The test has been created!');
            $this->redirect('index');
        }


    }
    //List all tests
    public function index() {
        $listTest = $this->Test->find('all');
        //Debugger::dump($listTest);
        $this->paginate = array(
            'Test' => array(
                'limit' => 100,
                'recursive' => 0
            )
        );

        $listTest = $this->paginate('Test');
        //Debugger::dump($listTest);
        $this->set('listTest', $listTest);
    }

    public function view($id) {
        $test = $this->Test->findByTestid($id);
        $listQues = $this->Test->ExamQuestion->find('all', array(
            'conditions' => array('ExamQuestion.testID' => $id),
            'fields' => array('ExamQuestion.*', 'Question.*'),
            'order' => array('ExamQuestion.index ASC')
        ));
        $this->set('test', $test);
        $this->set('listQues', $listQues);
        //Debugger::dump($test);
        //Debugger::dump($listQues);
    }

    //Get result from test
    public function getResult()
    {
        $TestResult = ClassRegistry::init('TestResult');
        $Question = ClassRegistry::init('Question');

        $testAns = $this->Session->read('testAns');

        $testInfo = $this->Test->findByTestid($testAns['testID']);
        $listQues = $this->Test->ExamQuestion->find('all', array(
            'conditions' => array('ExamQuestion.testID' => $testAns['testID']),
            'fields' => array('ExamQuestion.*', 'Question.*'),
            'order' => array('ExamQuestion.index ASC')
        ));
        //Debugger::dump($testAns);
        $index = 0;
        $trueAns = 0;
        if (isset($testAns['result'])) {
            foreach ($testAns['result']['TestResult'] as $QuestionResult) {
                if (isset($listQues[$index]['Question']['qAns']) && isset($listQues[$index]['ExamQuestion'][$QuestionResult])) {
                    if (strcmp($listQues[$index]['ExamQuestion'][$QuestionResult], $listQues[$index]['Question']['qAns']) == 0) {
                        $listQues[$index]['state'] = 'true';
                        $trueAns++;
                    } else {
                        $listQues[$index]['state'] = 'false';
                        $listQues[$index]['uAns'] = $QuestionResult;
                    }
                } else {
                    $listQues[$index]['state'] = 'false';
                }
                //Update
                if($listQues[$index]['state'] == 'true')
                    $dataUpdate = array(
                        'qID' => $listQues[$index]['Question']['qID'],
                        'correctNum' => $listQues[$index]['Question']['correctNum']+1,
                        'totalNum' => $listQues[$index]['Question']['totalNum']+1);
                else
                    $dataUpdate = array(
                        'qID' => $listQues[$index]['Question']['qID'],
                        'totalNum' => $listQues[$index]['Question']['totalNum']+1);
                //Debugger::dump($dataUpdate);
                $Question->save($dataUpdate);
                $index++;
            }
        }
        //Debugger::dump($listQues);
        if(!isset($testAns['chamthi'])) {
            $saveResult['TestResult']['uID'] = $this->Auth->user('uID');
            if (isset($testInfo['Test'])) {
                $saveResult['TestResult']['testID'] = $testInfo['Test']['testID'];
                if (count($listQues) > 0)
                    $saveResult['TestResult']['score'] = round(10 * $trueAns / count($listQues), 2);
                try {
                    $TestResult->save($saveResult);
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
            }
        }
        else {
            $this->Session->setFlash(__('Chấm thi'));
        }
        $this->set('testInfo', $testInfo);
        $this->set('listQues', $listQues);
        $this->set('trueAns', $trueAns);
        $this->Session->delete('testAns');

        //$this->Session->destroy();
        //Debugger::dump($listQues);
        //Debugger::dump($trueAns);
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