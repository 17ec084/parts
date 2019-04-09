# str_replace_once
文字列の置き換えを、一度のみ行う

## 書式と説明
```php
string $result = str_replace_once(string $before, string $after, string $content, int $cnt);
```
 `$content` 中に、左から(0オリジン) `$cnt` 番目に出てくる `$before` のみを `$after` に書き換える。

