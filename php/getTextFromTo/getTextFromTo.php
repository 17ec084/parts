<?php

function getTextFromTo($text, $start, $end, $printStartEnd)
{
    $startLen = strlen($start);
    $endLen = strlen($end);

    if( ($pos=strpos($text, $start))===false )
    {
        print "error: In getTextFromTo, wrong input has been detected.";
        return false;
    }
    $startPos=$pos+$startLen;
    //$startPosバイト目から開始

    if( ($pos=strpos($text, $end))===false )
    {
        print "error: In getTextFromTo, wrong input has been detected.";
        return false;
    }
    $stopPos=$pos-1;
    //$stopPosバイト目で終了

    $len=$stopPos-$startPos+1;
    //取り出すバイト長

    $result=substr($text, $startPos, $len);

    if($printStartEnd)
    {
        $result=$start.$result.$end;
    }
    return $result;
}