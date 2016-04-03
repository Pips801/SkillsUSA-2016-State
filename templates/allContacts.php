<?php 

/********************************************************
 *
 *  Project :  Phone Book
 *  File    :  allContacts.php
 *  Name    :  [ NAME REDACTED ]
 *  Date    :  4/1/2016
 *
 *  Description : Display all the contacts and give options to edit, add, and delete.
 *
 ********************************************************/

$contactHandler = new ContactHandler(__DIR__ . '/../contacts.json'); 

?>



<head>

    <link rel="stylesheet" type="text/css" href="css/ink-flex.min.css">
    <script type="text/javascript" src="js/holder.js"></script>
    <script type="text/javascript" src="js/ink-all.min.js"></script>
    <style type="text/css">
        body {
            background: #ededed;
        }
        
        header {
            padding: 2em 0;
            margin-bottom: 2em;
        }
        
        header h1 {
            font-size: 2em;
        }
        
        header h1 small:before {
            content: "|";
            margin: 0 0.5em;
            font-size: 1.6em;
        }
        
        footer {
            background: #ccc;
        }
        
        form {
            
            display: inline;
            margin-bottom: 0;
            margin-top: 0;
            
        }
    </style>
</head>

<body>

    <div class="ink-grid">

        <header>
            <h1>SkillsUSA 2016<small>[ NAME REDACTED ]</small></h1>
            <nav class="ink-navigation">
                <ul class="menu horizontal black">
                    <br>
                </ul>
            </nav>
        </header>
        
        <div>
        
            <table class="ink-table alternating">
                
                <?php if (empty($_POST)){ ?>
                
                <tr>
                    <th>First</th>
                    <th>Last</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Options</th>
                </tr>
                
                <?php
                
                
                
                foreach ($contactHandler->getAllContacts() as $id=>$data){
                    
                    $contactData = $data->getContact();
                    
                    echo "<tr id='data_$id'>";
                    echo "  <td>" . $contactData['firstName'] . "</td>";
                    echo "  <td>" . $contactData['lastName'] . "</td>";
                    echo "  <td>" . $contactData['phoneNumber'] . "</td>";
                    echo "  <td>" . $contactData['emailAddress'] . "</td>";
                    echo "  <td>" . $contactData['company'] . "</td>";
                    echo "  <td class='align-center'><form method='post' action='./'><input type='image' src='img/edit.png'><input type='hidden' name='action' value='edit'><input type='hidden' name='id' value='$id'></form>&nbsp;&nbsp;&nbsp;<form method='post' action='./'><input type='image' src='img/delete.png'><input type='hidden' name='action' value='delete'><input type='hidden' name='id' value='$id'></form></td>";
                    echo "</tr>";
                }
                
                ?>
                <form method="POST" action="./">
                <tr>
                    
                        <td><input name="firstName" type="text" placeholder="First name"></td>
                        <td><input name="lastName" type="text" placeholder="Last name"></td>
                        <td><input name="phoneNumber" type="text" placeholder="Phone number"></td>
                        <td><input name="emailAddress" type="text" placeholder="Email"></td>
                        <td><input name="company" type="text" placeholder="Company"></td>
                    <td class='align-center'><input type="image" src="img/add.png"></td>
                        <input type="hidden" name="action" value="create">
                    
                </tr>
                </form>
                
                <?php 
                }
                
                elseif ($_POST['action'] == 'edit')
                    
                { 
                
                    $contact = $contactHandler->getContact($_POST['id']);
                    $contact = $contact->getContact();
                    
                ?>
                    
                <tr>
                    <form method="post" action="./">
                        <td><input name="firstName" type="text" value="<?php echo $contact['firstName'] ?>"></td>
                        <td><input name="lastName" type="text" value="<?php echo $contact['lastName'] ?>"></td>
                        <td><input name="phoneNumber" type="text" value="<?php echo $contact['phoneNumber'] ?>"></td>
                        <td><input name="emailAddress" type="text" value="<?php echo $contact['emailAddress'] ?>"></td>
                        <td><input name="company" type="text" value="<?php echo $contact['company'] ?>"></td>
                        <td class='align-center'><input type="image" src="img/edit.png"></td>
                        <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
                        <input type="hidden" name="action" value="saveEdit">
                    </form>
                </tr>
                <?php } ?>            
            </table>
            
        </div>
        
    </div>

</body>