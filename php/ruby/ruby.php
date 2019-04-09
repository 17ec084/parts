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
    print 'error: textとrubyをGET送信してください。<br>rubyはfalseまたはtrueを値としてください。<br>サポートは<a href="https://github.com/17ec084/parts/tree/master/ruby">こちら</a>。'
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
        $text=str_replace(getTextFromTo($text,'<rp>','</rp>'),'',$text);//未実装(getTextFromTo)
        $text=str_replace(getTextFromTo($text,'<rt>','</rt>'),'',$text); 

        return $text;
    }


        function formatChangeRuby($text)
        {
            while(strpos($text,'<hirata type="ruby">')!==false)
            {
                $hirataText=getTextFromTo($test,'<hirata type="ruby">','</hirata>');//未実装
                //最初の<hirata>タグ内の文字列を抽出
                $kanji=getTextFromTo($test,)

            }
        }
