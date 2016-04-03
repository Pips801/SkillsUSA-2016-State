<?php

/********************************************************
 *
 *  Project :  Phone Book
 *  File    :  BusinessContact.php
 *  Name    :  [ NAME REDACTED ]
 *  Date    :  4/1/2016
 *
 *  Description : Object class for contacts.
 *
 ********************************************************/

class BuisnessContact {
    
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $emailAddress;
    private $company;

/****************************************************
 * Method     : __construct
 *
 * Purpose    : Building the object from the parameters
 *
 * Parameters : Information for the contact.
 *
 ****************************************************/
    
    public function __construct($firstName, $lastName, $phoneNumber, $emailAddress, $company){
     
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->emailAddress = $emailAddress;
        $this->company = $company;
        
    }
    
/****************************************************
 * Method     : getContact
 *
 * Purpose    : returns an associative array of the contact's data.
 *
 ****************************************************/
    
    public function getContact(){
        
        $contact;
    
        $contact['firstName'] = $this->firstName;
        $contact['lastName'] = $this->lastName;
        $contact['phoneNumber'] = $this->phoneNumber;
        $contact['emailAddress'] = $this->emailAddress;
        $contact['company'] = $this->company;
        
        return $contact;
        
    }
    
}


?>