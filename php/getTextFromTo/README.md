# getTextFromTo
テキストに含まれる開始文字列と終了文字列を指定し、テキスト中で開始文字列と終了文字列に囲まれた最初の文字列を取り出す  
開始文字列と終了文字列はマルチバイト未対応

## 例

例1

```php
<?php
print getTextFromTo("I have a pen, I have a pineapple, uh, PPAP","have a",",",true);
```

このプログラムを実行すると、次のように出力される。

```
have a pen,
```

例2

```php
<?php
print getTextFromTo("I have a pen, I have a pineapple, uh, PPAP","have a",",",false);
```

このプログラムを実行すると、次のように出力される。

```
pen
```

両者の違いは、開始文字列や終了文字列が表示されるか否かである。即ち、第4引数は開始文字列および終了文字列の出力の有無を示す。

## 使用方法
この同ディレクトリのgetTextFromTo.phpをインクルードすると、getTextFromTo関数が利用可能になる。