<?php
//ここは随時書き換えの必要があり

include "include/getTextFromTo.php";
include "include/str_replace_once.php";

?>


<?php

$ready=isset($_GET['text']) && isset($_GET['ruby']);

$rubyReady=$_GET['ruby']=='false' || $_GET['ruby']=='true'

$ready=$ready && $rubyReady;

if($ready)
{
    $text=$_GET['text'];

    if($_GET['ruby']=='false')
    {
        $text=rubyCut($text);//未実装
    }
    print $text;
}
else
{
    print 'error: textとrubyをGET送信してください。<br>rubyはfalseまたはtrueを値としてください。<br>サポートは<a href="https://github.com/17ec084/parts/tree/master/php/ruby">こちら</a>。'
}


    function rubyCut($text)
    {
        if(strpos($text,'<hirata type="ruby">')!==false)
        {
            $text=formatChangeRuby($text);//未実装
        }

        $text=str_replace('<ruby>','',$text);
        $text=str_replace('</ruby>','',$text);
        $text=str_replace('<rb>','',$text);
        $text=str_replace('</rb>','',$text);
        $text=str_replace(getTextFromTo($text,'<rp>','</rp>',true),'',$text);
        $text=str_replace(getTextFromTo($text,'<rt>','</rt>',true),'',$text); 

        return $text;
    }


        function formatChangeRuby($text)
        {
            while(strpos($text,'<hirata type="ruby">')!==false)
            {
                $hirataText=getTextFromTo($text,'<hirata type="ruby">','</hirata>',true);
                //最初の<hirata>タグ内の文字列を抽出

                while(strpos($hirataText, '[')!==false)
                {
                    $kanji=getTextFromTo($hirataText,'[','|',true);
                    $kanji=rtrim($kanji, '|');
                    //現在$kanjiの中身の例は
                    //"[文字"

                    $replace=ltrim($kanji, '[');
                    //"文字"
                    $replace=

'<ruby>
    <rb>'.$replace.'</rb>
    <rp>(</rp>
        <rt>';

                    $hirataText = str_replace_once($kanji, $replace, $hirataText, 0);

                    $yomigana=getTextFromTo($hirataText,'|',']',true);
                    $yomigana=ltrim($yomigana, '|');
                    //現在$yomiganaの中身の例は
                    //"もじ]"

                    $replace=rtrim($yomigana, ']');
                    //"もじ"
                    $replace=

            $replace.'</rt>
    <rp>)</rp>
</ruby>';
                    $hirataText = str_replace_once($yomigana, $replace, $hirataText, 0);
                }   

                $text = str_replace_once(

            }
        }
