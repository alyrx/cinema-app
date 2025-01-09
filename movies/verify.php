<?php
function verifyTitle($title) {
    if ($title == "") {
        return "<li>O campo \"título\" não pode estar vazio!</li>";
    } else {
        return;
    }
}

function verifySynopsis($synopsis) {
    if ($synopsis == "") {
        return "<li>O campo \"sinopse\" não pode estar vazio!</li>";
    } else {
        return;
    }
}

function verifyRating($rating) {
    if ($rating == "") {
        return "<li>O campo \"classificação\" não pode estar vazio!</li>";
    } else {
        return;
    }
}

function verifyDuration($duration) {
    if ($duration == "") {
        return "<li>O campo \"duração\" não pode estar vazio!</li>";
    } else {
        return;
    }
}