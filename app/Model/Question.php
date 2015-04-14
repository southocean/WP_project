<?php
App::uses('AppModel', 'Model');
/**
 * Question Model
 *
 */
class Question extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'qID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'qID';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'qID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'qStatement' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'qAns' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'option_1' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'option_2' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'option_3' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'option_4' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'topID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'correctNum' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'totalNum' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'uID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
	);

    //relation
    public $belongsTo = array(
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'topID',
        ),
        'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'sbID',
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'uID',
        )
    );
    public $hasMany = array(
        'ExamQuestion' => array(
            'className' => 'ExamQuestion',
            'foreignKey' => 'eqID',
        )
    );
}
