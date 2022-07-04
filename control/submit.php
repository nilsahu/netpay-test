<?php

class MyValidator
{
    /**
     * Is form valid;
     *
     * @var bool
     */
    private $isValid = true;
    /**
     * List of errors, assoc array with error messages one per fieldName
     *
     * @var array
     */
    private $errors = [];

    /**
     * Check if form is valid
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * Get error message
     *
     * @param $fieldName
     * @return mixed|string
     */
    public function getError($fieldName)
    {
        return isset($this->errors[$fieldName]) ? $this->errors[$fieldName] : '';
    }

    /**
     * @param array $rules list of rules
     * @param array $payload list of form parameters
     * @return bool Return validation result, same as isValid
     */
    public function validate(array $rules, array $payload)
    {
        foreach ($rules as $rule) {
            if (!$this->validateRequired($rule, $payload)) {
                continue;
            }
            switch ($rule['type']) {
                case 'string':
                    $this->validateString($rule, $payload);
                    break;
                case 'email':
                    $this->validateEmail($rule, $payload);
                    break;
                case 'number':
                    $this->validateNumber($rule, $payload);
                    break;
                    //extend with other validation rules as needed
            }
        }

        return $this->isValid();
    }

    public function validateRequired(array $rule, array $payload)
    {
    	foreach ($payload[$rule['fieldName']] as $value) {
	        if (true === $rule['required'] && $value == '') {
	            $this->isValid = false;
	            $this->errors[$rule['fieldName']] = $rule['title'].' field is required';
	            return false;
	        }
        }
        return true;
    }

    public function validateString($rule, $payload)
    {
        // Checkup logic, set $this->isValid to false if not valid, add
        // See add $this->errors[$rule['fieldname']] = 'your message';
        foreach ($payload[$rule['fieldName']] as $value) {
	        if (is_numeric($value)) {
	            $this->isValid = false;
	            $this->errors[$rule['fieldName']] = 'Invalid '.$rule['title'];
	            return false;
	        }
        }
        return true;
    }

    public function validateNumber($rule, $payload)
    {
        // Checkup logic, set $this->isValid to false if not valid, add
        // See add $this->errors[$rule['fieldname']] = 'your message';
        foreach ($payload[$rule['fieldName']] as $value) {
	        if (!is_numeric($value) || (strlen($value) != $rule['length'])) {
	            $this->isValid = false;
	            $this->errors[$rule['fieldName']] = 'Invalid '.$rule['title'];
	            return false;
	        }
        }
        return true;
    }

    public function validateEmail($rule, $payload)
    {
        // Checkup logic, set $this->isValid to false if not valid, add
        foreach ($payload[$rule['fieldName']] as $value) {
            if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $value)) {
        	//if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
	            $this->isValid = false;
	            $this->errors[$rule['fieldName']] = 'Invalid '.$rule['title'];
	            return false;
	        }
        }
        return true;
       
        // See add $this->errors[$rule['fieldname']] = 'your message';
    }

}

// Call validator by giving validator ruleset in the format

$rules = [
    [
        'fieldName' => 'nameInput',
        'title' => 'Name',
        'type' => 'string',
        'required' => true,
    ],
    [
        'fieldName' => 'emailInput',
        'title' => 'Email',
        'type' => 'email',
        'required' => true,
    ],
	[
        'fieldName' => 'contactInput',
        'title' => 'Contact Number',
        'type' => 'number',
        'length' => 10,
        'required' => true,
    ],
];

$validator = new MyValidator();
$isValid = $validator->validate($rules, $_POST);

if($isValid) {
	unlink('db/data.txt');
	$fp = fopen('db/data.txt', 'a');
	fwrite($fp, serialize($_POST));
	fclose($fp);
	$success['message'] = 'Record saved successfully';
} else {
	$message['nameInput'] = $validator->getError('nameInput');
	$message['emailInput'] = $validator->getError('emailInput');
	$message['contactInput'] = $validator->getError('contactInput');
}