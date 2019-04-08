# ruby
ルビ(ふりがな)のON・OFFを簡単に切り替えるphpプログラム

## 仕様
変数名textでGET送信されたルビ付きhtmlタグを読み込み、  
GET変数rubyがtrueならルビを表示、falseならルビを表示しない

## 動作条件
次の2つ書式によるルビがふられている必要がある。  
他の書き方は認めない。(但し、インデントは可)  

### 1つめ(普通の書式)

```html
<ruby>
    <rb>女子</rb>
    <rp>(</rp>
        <rt>じょし</rt>
    <rp>)</rp>
</ruby>
よりも
<ruby>
    <rb>狭</rb>
    <rp>(</rp>
        <rt>せま</rt>
    <rp>)</rp>
</ruby>
い
<ruby>
    <rb>空間</rb>
    <rp>(</rp>
        <rt>くうかん</rt>
    <rp>)</rp>
</ruby>
を、女子よりも
<ruby>
    <rb>短</rb>
    <rp>(</rp>
        <rt>みじか</rt>
    <rp>)</rp>
</ruby>
い
<ruby>
    <rb>時間</rb>
    <rp>(</rp>
        <rt>じかん</rt>
    <rp>)</rp>
</ruby>
だけ
<ruby>
    <rb>生</rb>
    <rp>(</rp>
        <rt>い</rt>
    <rp>)</rp>
</ruby>
きる―それが
<ruby>
    <rb>男子</rb>
    <rp>(</rp>
        <rt>だんし</rt>
    <rp>)</rp>
</ruby>
です。

```

### 2つめ(特別に定義した書式)

```html
<hirata type="ruby">
[女子|じょし]よりも[狭|せま]い[空間|くうかん]を、
女子よりも[短|みじか]い[時間|じかん]だけ[生|い]きる―それが[男子|だんし]です。
</hirata>
```

この書き方の場合、 `<hirata>` タグはネストになってはいけない

## 仕組みの説明
2つめの書式は、str_replace関数により1つめの書式に書き換える。  
  
ルビを振らない場合、  
`<ruby>`、`</ruby>`、`<rb>`、`</rb>`、`<rp>～</rp>`、`<rt>～</rt>` を文字列中から削除する。  
  
ルビを振る場合、  
なにもしない

