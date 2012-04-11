<?php

class Reader extends NewsreadersAppModel {

    var $useTable = 'reader';
    var $name = 'reader';
    var $primaryKey = 'id';
    var $useDbConfig = 'json';
    public $validate = array(
        'email' => array(
            'Rule-email' => array(
                'rule' => 'email',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'This field should be valid email adress'
            ),
            'Rule-isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This email is already in our readers list.'
            ),
            'Rule-maxLength' => array(
                'rule' => array('maxLength', 64),
                'message' => 'Maximum length of 64 characters'
            ),
        ),
        'username' => array(
            'Rule-alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Only alphabets and numbers allowed',
                'last' => true
            ),
            'Rule-minLength' => array(
                'rule' => array('minLength', 3),
                'message' => 'Minimum length of 3 characters'
            ),
        ),
        'news' => array(
            'Rule-multiple' => array(
                'rule' => array('multiple', array('min' => 1)),
                'message' => 'You have to choose at least one category'
            ),
        )
    );

}
