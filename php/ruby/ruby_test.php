<?php
//ここは随時書き換えの必要があり

include "include/getTextFromTo.php";
include "include/str_replace_once.php";

?>


<?php

$ready=isset($_GET['text']) && isset($_GET['ruby']);

$rubyReady=$_GET['ruby']=='false' || $_GET['ruby']=='true';

$ready=($ready && $rubyReady);

if($ready)
{
    $text=$_GET['text'];

    if(strpos($text,'<hirata type="ruby">')!==false)
    {
        $text=formatChangeRuby($text);
    }

    if($_GET['ruby']!='true')
    {
        $text=rubyCut($text);
    }
    print $text;
}
else
{
    print 'error: textとrubyをGET送信してください。<br>rubyはfalseまたはtrueを値としてください。<br>サポートは<a href="https://github.com/17ec084/parts/tree/master/php/ruby">こちら</a>。';
}


    function rubyCut($text)
    {
        $text=preg_replace("/(\\\r\\\n|\\\r|\\\n|\\\t| )*<ruby>(\\\r\\\n|\\\r|\\\n|\\\t| )*/", '', $text);
        $text=preg_replace("/(\\\r\\\n|\\\r|\\\n|\\\t| )*<\/ruby>(\\\r\\\n|\\\r|\\\n|\\\t| )*/", '', $text);
        $text=preg_replace("/(\\\r\\\n|\\\r|\\\n|\\\t| )*<rb>(\\\r\\\n|\\\r|\\\n|\\\t| )*/", '', $text);
        $text=preg_replace("/(\\\r\\\n|\\\r|\\\n|\\\t| )*<\/rb>(\\\r\\\n|\\\r|\\\n|\\\t| )*/", '', $text);
        $text=preg_replace("/(\\\r\\\n|\\\r|\\\n|\\\t| )*<rp>([^<]*)<\/rp>(\\\r\\\n|\\\r|\\\n|\\\t| )*/", '', $text);
        $text=preg_replace("/(\\\r\\\n|\\\r|\\\n|\\\t| )*<rt>([^<]*)<\/rt>(\\\r\\\n|\\\r|\\\n|\\\t| )*/", '', $text);
        return $text;
    }


    function formatChangeRuby($text)
    {
        while(strpos($text,'<hirata type="ruby">')!==false)
        {
            $hirataTextTmp=getTextFromTo($text,'<hirata type="ruby">','</hirata>',true);
            $hirataText=getTextFromTo($text,'<hirata type="ruby">','</hirata>',false);
            //最初の<hirata>タグ(及びそ)の内側の文字列を抽出

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
                //現在$yomiganaの中身の例は
                //"|もじ]"

                $replace=rtrim($yomigana, ']');
                $replace=ltrim($replace, '|');
                //"もじ"
                $replace=

            $replace.'</rt>
    <rp>)</rp>
</ruby>';
                $hirataText = str_replace_once($yomigana, $replace, $hirataText, 0);
            }   

            $text = str_replace_once($hirataTextTmp, $hirataText, $text, 0);

        }

        return $text;
    
    }
