<?php
App::uses('AppModel', 'Model');
/**
 * UserLevel Model
 *
 */
class UserLevel extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'ulID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'ulID';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'ulID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'uID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
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
	);

    var $belongsTo = array (
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'uID'
        ),
        'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'sbID'
        )
    );
}
