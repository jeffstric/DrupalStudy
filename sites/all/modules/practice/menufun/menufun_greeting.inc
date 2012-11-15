<?php

/**
 *  author  :   jeffstric
 *  email   :   jeffstricg@gmail.com
 *  date    :   Oct 24, 2012
 *  time    :   4:44:08 PM
 * */
function menufun_greeting ( $first_name = 'jeff' , $last_name = 'fu' )
{
    return t ('Hello @first_name @last_name ' , array( '@first_name' => $first_name , '@last_name' => $last_name ));
}

function menufun_farewell ()
{
    return t ('Goodbye');
}