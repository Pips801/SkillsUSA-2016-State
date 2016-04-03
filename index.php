<?php 

/********************************************************
 *
 *  Project :  Phone Book
 *  File    :  index.php
 *  Name    :  [ NAME REDACTED ]
 *  Date    :  4/1/2016
 *
 *  Description : Main function that the browser requests when visiting a site.
 *
 ********************************************************/

include_once __DIR__ . '/BusinessContact.php';
include_once __DIR__ . '/ContactHandler.php';

$contactHandler = new ContactHandler(__DIR__ . '/contacts.json');

/****************************************************
 * Purpose    : Logic to figure out what kind of request was sent, and them preform it.
 *
 ****************************************************/

if(isset($_POST['action']))
{
    
    if($_POST['action'] == 'create')
    {
        
        $contactHandler->createContact($_POST['firstName'], $_POST['lastName'], $_POST['phoneNumber'], $_POST['emailAddress'], $_POST['company']);
        header("Location: ./");
        
    }
    else if ($_POST['action'] == 'delete')
    {
        
        $contactHandler->deleteContact($_POST['id']);
        header("Location: ./");
        
    }
    

    else if ($_POST['action'] == 'saveEdit')
    {
        
        $contactHandler->editContact($_POST['id'], $_POST['firstName'], $_POST['lastName'], $_POST['phoneNumber'], $_POST['emailAddress'], $_POST['company']);
        header("Location: ./");
    }
    
}

include_once  __DIR__ . '/templates/allContacts.php'; // load the page

?>