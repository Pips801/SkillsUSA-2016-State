<?php

/********************************************************
 *
 *  Project :  Phone Book
 *  File    :  ContactHandler.php
 *  Name    :  [ NAME REDACTED ]
 *  Date    :  4/1/2016
 *
 *  Description : Handles the saving, editing, creating, and deleting of contacts.
 *
 ********************************************************/

class ContactHandler {
    
    private $contacts;
    private $saveLocation;
    
    
/****************************************************
 * Method     : __construct
 *
 * Purpose    : Building the data array from file
 *
 * Parameters : $datafile - the location where the json data is stored.
 *
 ****************************************************/
    
    public function __construct($dataFile){
        
        $this->saveLocation = $dataFile;
        
        $file = file_get_contents($dataFile); // read the contents of the file.
        $jsonData = json_decode($file, true); // translate the file into readable data.
        
        foreach($jsonData as $id=>$contact){
            
            $firstName = $contact['firstName'];
            $lastName = $contact['lastName'];
            $phoneNumber = $contact['phoneNumber'];
            $emailAddress = $contact['emailAddress'];
            $company = $contact['company'];
            
            $this->createContact($firstName, $lastName, $phoneNumber, $emailAddress, $company);
            
        }
        
        
    }
    
/****************************************************
 * Method     : getContact
 *
 * Purpose    : Returning the contact at that array position.
 *
 * Parameters : $contactID - The ID (array position) of the contact.
 *
 * Returns    : This method returns the requested contact.
 *
 ****************************************************/
    
    public function getContact($contactID){
            
        return $this->contacts[$contactID];
        
    }
    
/****************************************************
 * Method     : getAllContacts
 *
 * Purpose    : returning all contacts.
 *
 * Returns    : This method returns all contacts.
 *
 ****************************************************/
    
    public function getAllContacts(){
        
        return $this->contacts;
        
    }
    
/****************************************************
 * Method     : createContact
 *
 * Parameters : contact information
 *
 * Purpose    : creates a contact.
 *
 ****************************************************/
    
    public function createContact($firstName, $lastName, $phoneNumber, $emailAddress, $company){
        
        $newContact = new BuisnessContact($firstName, $lastName, $phoneNumber, $emailAddress, $company);
        
        $this->contacts[count($this->contacts)] = $newContact; // add the contact to the array with an incrimenting ID
        
        $this->saveToDisk($this->saveLocation);
        
    }

/****************************************************
 * Method     : editContact
*
 * Parameters : contact information
 *
 * Purpose    : edits a contact.
 *
 ****************************************************/
    
    public function editContact($ID, $firstName, $lastName, $phoneNumber, $emailAddress, $company){
        
        $newContact = new BuisnessContact($firstName, $lastName, $phoneNumber, $emailAddress, $company);
        
        unset ($this->contacts[$ID]);
        
        $this->contacts[$ID] = $newContact;
        
        $this->saveToDisk($this->saveLocation);
        
    }
    
/****************************************************
 * Method     : deleteContact
 *
 * Purpose    : deletes a contact.
 *
 ****************************************************/
    
    public function deleteContact($ID){
        
        unset($this->contacts[$ID]);
        
        $this->saveToDisk($this->saveLocation);
        
    }
    
/****************************************************
 * Method     : saveToDisk
 *
 * Purpose    : saves the contacts to disk.
 *
 ****************************************************/
    
    private function saveToDisk($location){
        
        $saveableJson; // dictionary array to pass to the json_encode function.
        
        foreach ($this->contacts as $id=>$data){
            
            $data = $data->getContact(); // convert the object into an associative array of data.
            
            $saveableJson[$id]['firstName'] = $data['firstName'];
            $saveableJson[$id]['lastName'] = $data['lastName'];
            $saveableJson[$id]['phoneNumber'] = $data['phoneNumber'];
            $saveableJson[$id]['emailAddress'] = $data['emailAddress'];
            $saveableJson[$id]['company'] = $data['company'];
            
        }
        
        $saveableJson = json_encode($saveableJson, JSON_PRETTY_PRINT); //convert the array to json data (with the arg JSON_PRETTY_PRINT to make it human-readable).
        
        file_put_contents($location, $saveableJson); //save the file.
        
    }
    
}

?>