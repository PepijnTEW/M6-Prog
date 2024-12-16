<?php


    $name = '';
    echo '<b>naam: </b>';
    if ( empty( $_POST['name']) ) {
        echo '<b style="color:#f00;">Je moet wel je naam invullen</b>';
    } else {
        $name = $_POST['name'];
    }
    echo $name;
    echo '<br>';


    $street = '';
    echo '<b>straat: </b>';
    if ( empty( $_POST['street']) ) {
        echo '<b style="color:#f00;">Je moet wel je straat invullen</b>';
    } else {
        $street = $_POST['street'];
    }
    echo $street;
    echo '<br>';


    $houseNumber = '';
    echo '<b>huisnummer: </b>';
    if ( empty( $_POST['houseNumber']) ) {
        echo '<b style="color:#f00;">Je moet wel je huisnummer invullen</b>';
    } else {
        $houseNumber = $_POST['houseNumber'];
    }
    echo $houseNumber;
    echo '<br>';


    $postalCode = '';
    echo '<b>postcode: </b>';
    if ( empty( $_POST['postalCode']) ) {
        echo '<b style="color:#f00;">Je moet wel je postcode invullen</b>';
    } else {
        $postalCode = $_POST['postalCode'];
    }
    echo $postalCode;
    echo '<br>';


    $email = '';
    echo '<b>email: </b>';
    if ( empty( $_POST['email']) ) {
        echo '<b style="color:#f00;">Je moet wel je email invullen</b>';
    } else {
        $email = $_POST['email'];
    }
    echo $email;
    echo '<br>';


?>