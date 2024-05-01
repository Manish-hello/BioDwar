<?php
if (isset($_POST['option'])) {
    $option = $_POST['option'];

    // Define content based on the selected option using a switch case
    switch ($option) {
        case 'dashboard':
            $content = include("../html/dashboard.php");
            break;
        case 'Addcostumer':
            $content =include("../data_insertion/insert_costumer_info.php");
            break;
        case 'Viewcostumer':
            $content=include("../data_retrival/load_costumer_info.php");
            break;
        case 'AddandEditMembership':
            $content=include("../data_insertion/insert_membership_info.php");
            break;
        case 'Addtrainer':
            $content = include("../data_insertion/insert_trainer_info.php");
            break;
        case 'Viewtrainerinfo':
            $content=include("../data_retrival/load_trainer_info.php");
            break;
        case 'contact':
            $content = include("../html/contact.php");
            break;
        default:
            $content = "hello";
    }

    // Send the generated content back to the JavaScript
    
}
?>