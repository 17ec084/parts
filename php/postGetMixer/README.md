# postGetMixer

postやgetで送られた値を連想配列として返す。  

`array $arr = postGetMixer(boolean $getPrioritized)`

## 例

postではb=3、c=4のみが、getではa=1、b=2のみが送信された場合を考える。

### 例1(post優先)

```php
$SEND = $_GET = $_POST = postGetMixer(false);
```
この例では `$_POST` も `$_GET` も `$SEND` も`array('a'=>1, 'b'=>3, 'c'=4)` となる。  

### 例2(get優先)

```php
$SEND = $_GET = $_POST = postGetMixer(true);
```
この例では `$_POST` も `$_GET` も `$SEND` も`array('a'=>1, 'b'=>2, 'c'=4)` となる。  

例1と例2を比較すると、引数として渡す真偽値によって、getが優先されるかpostが優先されるかが決定されていることがわかる。  

この真偽値 `$getPrioritized` は、getが優先されることの真偽値であるが、「urlパラメータによる、送信内容の書き換えを許可すること」の真偽値であるととらえたほうがわかりやすいかもしれない。
