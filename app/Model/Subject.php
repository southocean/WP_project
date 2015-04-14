<?php
App::uses('AppModel', 'Model');
/**
 * Subject Model
 *
 */
class Subject extends AppModel {
    var $name = "Subject";
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'sbID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'sbID';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'sbID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'sbName' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
	);

    //var $hasMany = "Question";
    var $hasMany = array(
        'Question' => array(
            'className' => 'Question',
            'foreignKey' => 'sbID',
            'dependent' => false,
        ),
    );
}
