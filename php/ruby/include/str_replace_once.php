<?php

function str_replace_once($before, $after, $content, $cnt)
{

    $pieceR=$content;
    $tmp=0;
    for($i=0;$i<=$cnt;$i++)
    {
        if(strpos($pieceR, $before)===false)
        {
            print "error: In str_replace_once.";
            return false;
        }
        $splitPos=strpos($pieceR, $before)+strlen($before);
        //$splitPosバイト目が、$content全体ではじめから$i番目にでてくる$beforeの「直後」
        $pieceR=substr($pieceR, $splitPos);
        $tmp+=$splitPos;
    }
    
    $splitPos=$tmp;
    //$content全体の$splitPosバイト目が、$cnt番目に出てくる$beforeの直後
    $pieceR=substr($content, $splitPos);
    $pieceL=substr($content, 0, -1*(strlen($pieceR)+strlen($before)));

    return $pieceL .$after. $pieceR;

}