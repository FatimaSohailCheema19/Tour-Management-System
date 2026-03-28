<?php
if (isset($_GET['country']) && isset($_GET['budget'])) {
    $country = $_GET['country'];
    $budget = $_GET['budget'];
 
    switch ($country) {
        case 'Greece':
            if ($budget == 'low' ) {
                include_once('greece_low_short.php');
            }elseif ($budget == 'medium') {
                include_once('greece_medium.php');
            } elseif ($budget == 'high') {
                include_once('greece_high_long.php');
            }
            break;
        case 'Spain':
            if ($budget == 'low') {
                include_once('spain_low_short.php');
            } elseif ($budget == 'medium') {
                include_once('spain_medium.php');
            } elseif ($budget == 'high') {
                include_once('spain_high_long.php');
            }
            break;
        case 'Italy':
            if ($budget == 'low') {
                include_once('italy_low_short.php');
            } elseif ($budget == 'medium') {
                include_once('italy_medium.php');
            } elseif ($budget == 'high') {
                include_once('italy_high_long.php');
            }
            break;
            case 'Japan':
                if ($budget == 'low') {
                    include_once('japan_low_short.php');
                } elseif ($budget == 'medium') {
                    include_once('japan_medium.php');
                } elseif ($budget == 'high') {
                    include_once('japan_high_long.php');
                }
                break;
            case 'Turkey':
                    if ($budget == 'low') {
                        include_once('turkry_low_short.php');
                    } elseif ($budget == 'medium') {
                        include_once('turkey_medium.php');
                    } elseif ($budget == 'high') {
                        include_once('turkey_high_long.php');
                    }
                break;
                case 'England':
                    if ($budget == 'low') {
                            include_once('england_low_short.php');
                    } elseif ($budget == 'medium') {
                       include_once('england_medium.php');
                    } elseif ($budget == 'high') {
                        include_once('englan_high_long.php');
                    }
                        break;
       
    }
}
?>