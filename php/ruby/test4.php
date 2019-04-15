<?php

$str='
    
	<ruby>
		<rb><rt>';    

//print preg_replace('/(\\\r\\\n|\\\r|\\\n|\\\t| )/', '', $str);

print preg_replace("/(\\\r\\\n|\\\r|\\\n|\\\t| )*<rb>/", '', $str);
