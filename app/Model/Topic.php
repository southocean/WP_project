<?php
App::uses('AppModel', 'Model');
/**
 * Topic Model
 *
 */
class Topic extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'topID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'topID';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'topID' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'topName' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
	);

    //var $hasMany = "Question";
    var $hasMany = array(
        'Question' => array(
            'className' => 'Question',
            'foreignKey' => 'topID',
            'dependent' => false,
        ),
    );
}
