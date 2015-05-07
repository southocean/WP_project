<?php
App::uses('AppModel', 'Model');
/**
 * Test Model
 *
 * @property Teacher $1
 * @property Subject $belongtoSubject
 */
class Test extends AppModel {
    var $name = "Test";
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'testID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'testID';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'testID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'uID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'time_stamp' => array(
			'datetime' => array(
				'rule' => array('datetime'),
			),
		),
		'sbID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'testLevel' => array(
            'number' => array(
                'rule' => array('range', -1, 11),
                'message' => 'Please enter a number from 0 to 10'
            )

		),
	);

    public function limit($check, $limit) {
        // $check will have value: array('promotion_code' => 'some-value')
        // $limit will have value: 25
        $existingPromoCount = $this->find('count', array(
            'conditions' => $check,
            'recursive' => -1
        ));
        return $existingPromoCount < $limit;
    }
	//The Associations below have been created with all possible keys, those that are not needed can be removed
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'uID'
        ),
		'Subject' => array(
			'className' => 'Subject',
			'foreignKey' => 'sbID',
		)
	);
    public $hasMany = array(
        'ExamQuestion' => array(
            'className' => 'ExamQuestion',
            'foreignKey' => 'eqID',
        )
    );

}
