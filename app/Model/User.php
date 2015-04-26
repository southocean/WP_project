<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {
    var $name = "User";
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'uID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'uID';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'username' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('between', 5, 15),
                'required' => true,
                'message' => 'Usernames must be between 5 to 15 characters'
            ),
            'unique' => array(
                'rule'    => array('isUniqueUsername'),
                'message' => 'This username is already in use'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'Username can only be letters, numbers and underscores'
            ),
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),
                'message' => 'Please provide a valid email address.'
            ),
            'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'This email is already in use',
            ),
            'between' => array(
                'rule' => array('between', 6, 60),
                'message' => 'Email must be between 6 to 60 characters'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Password must have a minimum of 6 characters'
            )
        ),

        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            ),
            'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Both passwords must match.'
            )
        ),
		'birthday' => array(
			'date' => array(
				'rule' => array('date'),
			),
		),
		'gender' => array(
			'boolean' => array(
				'rule' => array('boolean'),
			),
		),
		'avatar' => array(
			'url' => array(
				'rule' => array('url'),
			),
		),

        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'student', 'teacher')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        ),


        'password_update' => array(
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Password must have a mimimum of 6 characters',
                'allowEmpty' => true,
                'required' => false
            )
        ),
        'password_confirm_update' => array(
            'equaltofield' => array(
                'rule' => array('equaltofield','password_update'),
                'message' => 'Both passwords must match.',
                'required' => false,
            )
        )
	);
    /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    function isUniqueUsername($check) {

        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.uID',
                    'User.username'
                ),
                'conditions' => array(
                    'User.username' => $check['username']
                )
            )
        );

        if(!empty($username)){
            if($this->data[$this->alias]['uID'] == $username['User']['uID']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {

        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.uID'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
                )
            )
        );

        if(!empty($email)){
            if($this->data[$this->alias]['uID'] == $email['User']['uID']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    public function equaltofield($check,$otherfield)
    {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }

        // fallback to our parent
        return parent::beforeSave($options);
    }

    /*
     * Relation
     */
    var $hasOne = array (
        'UserLevel' => array(
            'className' => 'UserLevel',
            'foreignKey' => 'uID',
            'dependent' => false,
        ),
    );
    var $hasMany = array (
        'TestResult' => array(
            'className' => 'TestResult',
            'foreignKey' => 'uID',
            'dependent' => false,
        ),
        'Test' => array(
            'className' => 'Test',
            'foreignKey' => 'uID',
            'dependent' => false,
        ),
        'Question' => array(
            'className' => 'Question',
            'foreignKey' => 'uID',
            'dependent' => false,
        ),

    );


}
