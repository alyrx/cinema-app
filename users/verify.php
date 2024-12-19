<?php
function verifyName($name) {
    if ($name == "") {
        return "<li>O campo \"nome\" não pode estar vazio!</li>";
    } else {
        return;
    }
}

function verifyEmail($email) {
    if ($email == "") {
        return "<li>O campo \"email\" não pode estar vazio!</li>";
    } else {
        return;
    }
}

function verifyPassword($password) {
    if ($password == "") {
        return "<li>O campo \"password\" não pode estar vazio!</li>";
    } else {
        return;
    }
}