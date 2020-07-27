<?php
/**
 * Method to secure the string passed in param
 * @param String
 * @return String
 */
function str_secure($str, $value = null)
{

    if($value != null)
    {
        return $value(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));

    } else
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * More visible for test 
 * @param $var(String , Table )
 */
function debug($var)
{
    echo '<pre class="text-white">';
    var_dump($var);
    echo '</pre>';
}

/**
 * Check valid date with sql format 
 * @param $date
 * @param $format - modifiable if needed
 * @return sql date format : Boolean
 */

function validateDate($date, $format = 'Y-m-d'):bool
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

/**
 * Convert date from date sql format 
 * @param $date - date format
 * @param $format - modifiable
 * @return date with EU format (in sql date out eu date)
 */
function dateConvert($date)
{
    return date("d/m/Y  H:i", strtotime($date));
}

/**
 * Verification for string with regex (only alphanumeric)
 * @param $str - String
 * @return (true or false) 
 */
function validNameInput($str):bool
{
    return preg_match('/^[A-Za-z\' ]+$/',$str);
}

/**
 * Verification for string with regex (only alphanumeric)
 * @param $str - String
 * @return (true or false) 
 */
function validNameMediaInput($str):bool
{
    return preg_match('/^[A-Za-z0-9\': ]+$/',$str);
}

/**
 * Verification for string with regex (only number)
 * @param $str - String
 * @return (true or false) 
 */
function validYearInput($str)
{
    return preg_match ('/^([1-2]{1})([0-9]{3})$/', $str);
}


/**
 * Verification for string with regex (only number)
 * @param $str - String
 * @return (true or false) 
 */
function validIsbnInput($str)
{
    return preg_match ('/^([0-9]{10,13})$/', $str);
}

/**
 * Verification for password strong
 * 8 characters string with at least one digit, one upper case letter, one lower case letter and one special symbol
 * @param $str - String
 * @return (true or false) 
 */
function validPassword($password)
{
    return preg_match_all('$S*(?=S{8,})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$', $password) ? TRUE : FALSE;
}


// function paginationLink($current_page, $total_pages, $url)
// {
//     $links = "";
//     if ($total_pages >= 1 && $current_page <= $total_pages) {
//         $links .= "<a href=\"{$url}?page=1\">1</a>";
//         $i = max(2, $current_page - 5);
//         if ($i > 2)
//             $links .= " ... ";
//         for (; $i < min($current_page + 6, $total_pages); $i++) {
//             $links .= "<a href=\"{$url}?page={$i}\">{$i}</a>";
//         }
//         if ($i != $total_pages)
//             $links .= " ... ";
//         $links .= "<a href=\"{$url}?page={$total_pages}\">{$total_pages}</a>";
//     }
//     return $links;
// }

function redirectHeaderURI()
{
    $url = filter_input(INPUT_SERVER , 'REQUEST_URI' , FILTER_SANITIZE_URL );
    if(isset($_GET['success']) && filter_input(INPUT_GET, 'success', FILTER_VALIDATE_INT))
    {
        return header('location:'.$url);
    } 
    else
    {
        return header('location:'.$url.'&success=1');
    }
    exit();
}