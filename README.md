# ExperimentalFeatures
(しばらくの間PocketMine-MPには実装されないであろう)新しい要素を追加することを目的としたプラグイン。  
ワールドやプレイヤーデータが破損するため、必ずバックアップを取ってから使用してください。  
PocketMine-MP本体を変更しないのが原則なので(悪い意味で)素晴らしい実装がたくさん見られます。

## できること
ブロックに向きがないなどの単純な状態しか持たないブロックやアイテムの追加が簡単に行えるようになっている（はず）。  
完全に新しいアイテムやブロックを追加したい場合は `ExperimentalFeatures/feature` の実装を参考にしてみてください。

## 追加される予定/追加された機能のリスト
- [x] ボタン/感圧版: 周りのブロックが壊れたときに自身を壊す

### [洞窟と崖 (1.17)](https://minecraft.fandom.com/wiki/Caves_%26_Cliffs)
- [x] 鉄の原石 / 金の原石
  - [x] 鉱石ブロックのドロップ変更
  - [x] かまどのレシピ追加
- [x] 鉄の原石ブロック / 金の原石ブロック
  - [x] レシピの追加
- [x] 輝くイカスミ
  - [x] 光る看板
- [x] アメジストの欠片
- [x] アメジストブロック
  - [x] レシピ
- [x] 芽生えたアメジスト
- [x] アメジストの芽 / アメジストの塊
  - [ ] バウンディングボックス
- [ ] 深層岩
  - [ ] 深層岩の鉱石
- [ ] 方解石
- [ ] 凝灰岩
- [ ] 遮光ガラス
- [ ] 銅鉱石
  - [ ] 銅の原石
  - [ ] 銅の原石ブロック
  - [ ] 銅ブロック
    - [ ] 切り込み入りの銅ブロック
    - [ ] 銅の階段
    - [ ] 銅のハーフブロック

### [ネザーアップデート (1.16)](https://minecraft.fandom.com/wiki/Nether_Update)
- [ ] 魂の炎
- [ ] 魂の松明
- [ ] 魂のランタン
- [ ] 魂の焚き火
- [ ] 真紅のキノコ / 歪んだキノコ
- [x] 真紅の幹 / 歪んだ幹
  - [x] 表皮を剥いだ幹
  - [ ] 斧で表皮を剥ぐ (PocketMine-MPが対応していない)
- [x] 真紅の菌糸 / 歪んだ菌糸
  - [x] 樹皮を剥いだ菌糸
  - [ ] 斧で樹皮を剥ぐ (PocketMine-MPが対応していない)
- [x] 真紅の板材 / 歪んだ板材
  - [x] フェンス / フェンスゲート
  - [x] 階段
  - [ ] ドア (実装は無理ではないがめんどくさいor難しい)
  - [x] トラップドア
  - [x] ハーフブロック (ダブルハーフブロック)
  - [ ] 看板 (実装は無理ではないがめんどくさいor難しい)
  - [x] ボタン
    - [ ] ボタンを押したときの向きが正しくない
  - [x] 感圧版
- [x] 歪んだウォートブロック
- [ ] シュルームライト
- [ ] しだれツタ
- [ ] ねじれツタ
- [ ] 真紅のナイリウム / 歪んだナイリウム
- [ ] 真紅の根 / 歪んだ根
- [ ] ネザースプラウト
- [ ] ソウルソイル
- [ ] 玄武岩
- [ ] ブラックストーン
- [ ] ネザー金鉱石
- [ ] 泣く黒曜石
- [ ] 古代の残骸
- [ ] ネザライトブロック
- [ ] 的
- [ ] リスポーンアンカー
- [ ] ロードストーン
- [ ] 鎖
- [ ] ネザーレンガ (亜種)
- [ ] クォーツレンガ
- [ ] ネザライトの欠片
- [ ] ネザライトインゴット
- [ ] ネザライトの防具
- [ ] ネザライトの道具