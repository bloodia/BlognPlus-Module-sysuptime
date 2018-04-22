# BlognPlus-Module-qrcode
[BlognPlus（ぶろぐん＋）](http://www.blogn.org "BlognPlus（ぶろぐん＋）")用の任意の文字列をQRコードに変換してスキン上に表示するモジュールです。  
プリインストールされていたカレンダーモジュールを参考に作成しました。  
BlognPlusの独自変数（{HOMELINK}や{LOGURL}等）に対応しています。  
このモジュールはGoogle社が提供している「Google Chart API」を利用しています。  
著作権表示部の削除、および二次配布以外は、特に制限等は設けません。ご自由にご使用ください。

## サンプル
![サンプル](https://www.bloodia.net/files/download/blognplus/module/module2.jpg)

## 動作環境
Windows環境上の以下のブラウザで正常表示を確認しています。
  - Internet Explorer 9
  - Firefox 10
  - Google Chrome 17

## 設定手順
1. BlognPlusインストールディレクトリ配下の"module"ディレクトリ配下に"qrcode"ディレクトリを配置。
2. BlognPlus管理画面内にある[モジュール管理]タブを選択し、画面下部に表示されている当該モジュールのインストールを選択。
3. BlognPlus管理画面内にある[モジュール管理]タブからモジュールの動作 ON/OFF（携帯）をONに変更。
4. スキン内の表示したい場所に独自タグ「{QRCODE}～{/QRCODE}（開始タグと終了タグ）」でURL、あるいは文字列を囲んで記述。 

## 動作要件
  - BlognPlus（ぶろぐん＋） 2.6.8で正常動作を確認しています。

## 製作者
[@bloodia](https://twitter.com/bloodiadotnet)
