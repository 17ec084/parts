<?php

function indentEraser()
{

    $args=func_get_args();

    $areaArr=[];
    $cutCharArr=[];

    $text=$args[0];

    for($i=1; $i<strlen($args); $i++)
    {
        if($args[$i]=="|hirata|")
        {
            $i--;
            break;
        }
    }
    $areaStart=1;
    $areaEnd=$i;

    $isExistArea=($areaEnd!=0);
    if($isExistArea)
    //領域指定が存在する場合実行
    {
        $areaArr=array_slice($args, $areaStart, $areaEnd-$areaStart+1);

    }
    else
    {
        array_push($areaArr, '>~<');
    }

    $hirata=$areaEnd+1;
    //文字列"|hirata|"のインデックス

    $cutCharStart=$hirata+1;
    $cutCharEnd=strlen($args)-1;

    $isExistCutChar=($hirata!=strlen($args)-1);
    if($isExistCutChar)
    //取り除かれる文字が指定されている場合実行
    {
        $cutCharArr=array_slice($args, $cutCharStart, $cutCharEnd-$cutCharStart+1);
    }
    else
    {
        array_push($cutCharArr, "\\\r\\\t", "\\\r", "\\\n", "\\\t", " ");
    }

    while($fao=findAreaOnce($text, $areaArr)!==false)
    {
        $text=cutChar($fao, $text, $cutCharArr);//未実装
    }
    

}

    function findAreaOnce($text, $areaArr)
    //$textの中に、領域指定に一致する領域があるか、ある場合は何バイト目なのか(開始,終了)
    {
        foreach ($areaArr as $area)
        {
            if($boundary=strpos($area, '~')===false)
            {
                print "error in findAreaOnce\n";
                continue;
            }
            $startChars=substr($area, 0, $boundary);
            $endChars=substr($area, $boundary+1);
            //$startCharsと$endCharsに囲まれた部分が「領域」となる。

            $areaStart=strpos($text, $startChars);
            $areaEnd=strpos($text, $endChars);
            if($areaStart!==false && $areaEnd!=false)
            {
                $arr=();
                array_push($arr, $areaStart, $areaEnd);
                return $arr;
            }
            else
            {
                continue;
            }
        }
        return false;
    }

    function cutChar($cnt, $text, $cutCharArr)
    //$textの$cnt[0]byte目から$cnt[1]byte目の間に、$cutCharArr配列の要素と
    //一致する文字があればすべて取り除く
    {
        $areaStart=$cnt[0];
        $areaEnd=$cnt[1];

        $left=substr($text, 0, $areaStart);
        $str=substr($text, $areaStart, $areaEnd-$areaStart+1);
        $right=substr($text, $areaEnd+1);
        //$textを$left,$str,$rightに3分割

        foreach($cutCharArr as $cutChar)
        {
            while(strpos($str, $cutChar)===false);
            $str=str_replace($cutChar, '', $str);
        }
        return $left.$str.$right;
    }