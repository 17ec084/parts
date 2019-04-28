<?php

function postGetMixer($getPrioritized)
{
    $res=array();
    foreach($_GET as $get => $dummy)
    {
        if(isset($_POST[$get]))
        {
            $res+= array($get => ($getPrioritized ? $_GET[$get] : $_POST[$get]) );
        }
        else
        {
            $res+= array($get => $_GET[$get]);
        }
    }
    foreach($_POST as $post => $dummy)
    {
        if(isset($_GET[$post]))
        {
            //何もしない
        }
        else
        {
            $res+= array($post => $_GET[$post]);
        }
    }

    return $res;

}