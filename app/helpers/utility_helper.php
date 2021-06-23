<?php


function validatePostData($enteredData) {
    if(empty($enteredData['title'])) {
        $enteredData['title_err'] = 'Title shouldn\'t be empty';
    }
    if(empty($enteredData['comment'])) {
        $enteredData['comment_err'] = "Comment Shouldn't be empty";
    }
    return $enteredData;
}

function debug($enteredData){
    echo "<pre>";
    var_dump($enteredData);
    echo "</pre>";
}

function isPosted() {
    if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
        return true;
    }
    return false;
}
