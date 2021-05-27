<?php

//TO DO
//create user validator class to handle validation
//check required fields to check input
//create methods to check each input field
//--methods for email,street,street number, city, zipcode, products??
//return array error after checks are done

class UserValidator
{

    private $data;
    // $data will come from $_POST
    private string $errors = [];
    //this will be the error array, initially it will be empty. if no errors, we push to it but it will remain empty.
    private static $fields = ['email', 'street', 'street number', 'city', 'zipcode'];
    //required fields we will check. if any of the POST info we get back is invalid we'll send an error. we make this static so we can do UserValidator::$fields to check instead of instanciating an object. Not necessary but useful.

    public function __construct($post_userData)
    {
        $this->data = $post_userData;
        //$post_userData will be an array with all the user data we get.

    }

    //make methods now : both public and private ones. private so we cant access said methods outside of the class UserValidator.

    public function validateFormView()
    {
        //foreach to cycle through every input field we wish to check.array_key_exists checks if smth exists in the data, and we say here that if it doesnt exist, so array_key_exists is not true, we wish to trigger an error for the field that's not correctly filled in.
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field is not correctly in the data");
                return;
            }
        }
        //the if condition only returns if true (or false in this scenario). if thats not the case we keep going.
        $this->validateEmail();
        $this->validateStreet();
        $this->validateStreetNumber();
        $this->validateZipcode();
    }


    private function validateEmail()
    {

        $val = trim($this->data["email"]);
        //we trim the value, whats we store whats left of the value post trim.
        if (empty($val)) {
            $this->addErrorToArray("email", "email adress cannot be empty.");
        }
    }


    private function validateStreet()
    {
        $val = trim($this->data["street"]);
        if (empty($val)) {
            $this->addErrorToArray("street", "street cannot be empty.");
        } else {
            //checks if username is letters or numbers and between 6-12 characters long. we check again for false.
            if (!preg_match('/^[a-zA-Z]{6-100}$/', $val)) {
                $this->addErrorToArray("street", "street can only contain letters");
            }
        }
    }


    private function validateStreetNumber()
    {
        $val = trim($this->data["streetnumber"]);
        if (empty($val)) {
            $this->addErrorToArray("street", "street cannot be empty.");
        } else {
            //checks if username is letters or numbers and between 6-12 characters long. we check again for false.
            if (!preg_match('/^[0-9]{6-12}$/', $val)) {
                $this->addErrorToArray("streetnumber", "streetnumber can only contain numbers");
            }
        }
    }

    private function validateCity()
    {
    }

    private function validateZipcode()
    {
    }

    // need a method to add errors to array.

    private function addErrorToArray($key, $value)
    {
        $this->errors[$key] = $value;
    }
}
