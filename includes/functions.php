<?php
// I died here twice . damn native php :(

function redirect($to, $external = false)
{
    if ($external)
        $str = "Location: $to";
    else {
        if (substr($to, 0, 1) === '/') $to = substr($to, 1);
        $str = "Location: http://" . DNSURL . "/$to";
    }
    header($str);
    exit;
}

function _404()
{
    header("HTTP/1.0 404 Not Found");
    include $_SERVER['DOCUMENT_ROOT'] . "/errors/404.php"; //todo: implement 404.php error
    exit;
}

function _403()
{
    header("HTTP/1.0 403 Forbidden");
    include $_SERVER['DOCUMENT_ROOT'] . "/errors/perm_err.php"; //todo: implement 403.php error
    exit;
}


/**
 * @return array|bool|int
 */
function upload_file($file_arr,$targetPath)
{
    global $uploadErrors;

    // file name
    $originalName = basename($file_arr["name"]);
    $fileType = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    $new_filename = md5($originalName . time()) . '.' . $fileType;

//    echo "above : ".$fileType."<br>";

    // file absolute path
    $target_dir = DOC_ROOT . '/'.$targetPath;// ex: "/uploads/"
    $target_file = $target_dir . $new_filename;

    // file link
    $file_link = $targetPath. $new_filename;

    // 0 => ok , other number means error
    $return = 0;

//    echo $fileType;
    $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    if (!in_array($fileType, $allowedExtensions)) {
//
//        print_r($allowedExtensions);
//        exit;
        $return = 1;
    }
    $fileSize = $file_arr['size'];
    $sizeLimit = 20 * 1024 * 1024; //20 MB
    if ($fileSize > $sizeLimit)
        $return = 2;

    if ($return) return [
        'success' => false,
        'message' => $uploadErrors[$return - 1],
    ];

    if (!file_exists($target_dir)) {
        mkdir($target_dir);
    }

    if (move_uploaded_file($file_arr['tmp_name'], $target_file))
        return [
            'success'   => true,
            'file_link' => $file_link,
            'file_name' => $originalName
        ];

    return false;
}

function rearrangeFiles( $arr ){
    $new = [];
    foreach( $arr as $key => $all ){
        foreach( $all as $i => $val ){
            $new[$i][$key] = $val;
        }
    }
    return $new;
}

function logfile($string)
{
    file_put_contents('logging', $string . "\n", FILE_APPEND);
}


function br2nl($string)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}

