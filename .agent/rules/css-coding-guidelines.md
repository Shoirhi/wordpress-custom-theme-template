---
trigger: always_on
---

# モダンCSSスタイリング規約

## 1. カスケードレイヤーの厳格化（Strict Cascade Layers）

- すべてのCSSルールセットは、必ず `@layer` ブロック内に記述すること。無名レイヤー（Unlayered）への記述は、サードパーティ製プラグインの強制上書きなど、特段の理由がない限り禁止する。
- エントリーポイントにおけるレイヤー宣言順序は以下の通りとする。
  `@layer reset, base, layout, components, utilities;`

```css
/* 実装例: 必ずレイヤーを指定する */
@layer components {
  /* スタイル定義 */
}
```

## 2. デザイントークンのSSOT強制（Single Source of Truth）

- カラーコード（Hex、RGB）、フォントサイズ（px、rem）、余白（px、rem）、フォントファミリーなどの生の値（Primitive values）をCSSファイル内に直接記述（ハードコード）することを厳格に禁止する。
- すべてのデザイン変数は、WordPressコアが`theme.json`から生成するCSSカスタムプロパティ（`--wp--preset--*`または`--wp--custom--*`）を参照すること。

```css
/* 実装例: theme.json由来の変数のみを使用する */
@layer components {
  .card-surface {
    background-color: var(--wp--preset--color--surface);
    padding-block: var(--wp--custom--spacing--medium);
  }
}
```

## 3. @scopeによるブロックカプセル化（Component Encapsulation）

- BEM（Block Element Modifier）のようなプレフィックスを用いた冗長な命名規則、およびグローバルスコープでの単一クラス（例: .title, .wrapper）の定義を禁止する。
- WordPressブロック（.wp-block-*）のスタイリングを行う際は、必ず @scope を使用してスタイルの影響範囲を当該DOMサブツリー内に限定すること。

```css
/* 実装例: ブロッククラスをルートとしたスコープの形成 */
@layer components {
  @scope (.wp-block-custom-feature) {
    /* スコープ内でのみ有効な簡潔なクラス名 */
    .title {
      color: var(--wp--preset--color--primary);
    }
  }
}
```

## 4. 論理プロパティの強制（Enforce Logical Properties）

- 物理的な方向や寸法を示すプロパティ（`margin-top`, `padding-left`, `width`, `height`, `top`, `left`など）の使用を完全に禁止する。
- 国際化（RTL/LTR）およびレイアウト抽象化のため、必ず論理プロパティ（`margin-block-start`, `padding-inline-end`, `inline-size`, `block-size`, `inset-block-start`など）を使用すること。

```css
/* 実装例: 論理プロパティによる記述 */
@layer layout {
  .site-header {
    inline-size: 100%;
    max-inline-size: 1200px;
    margin-inline: auto;
  }
}
```

## 5. コンテナ主導のレスポンシブ設計（Container-Driven Responsiveness）

- コンポーネント（WordPressブロック）内部のレイアウト変更において、ビューポート幅に依存する`@media (min-width: ...)`の使用を原則禁止する。
- ブロックのルート要素に対して`container-type: inline-size;`を定義し、内部要素のレイアウト変更は`@container`を用いて、親要素の幅を基準に自己完結させること。

```css
/* 実装例: コンテナクエリの利用 */
@layer components {
  @scope (.wp-block-custom-grid) {
    :scope {
      container-type: inline-size;
    }

    @container (min-width: 600px) {
      .grid-layout {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
      }
    }
  }
}
```

## 6. 状態管理のセマンティック化（Semantic State Management）

- ホバー、フォーカス、アクティブ、無効化などの動的な状態変化を表すために、視覚的なクラス名（例: `.is-active`, `.is-disabled`, `.is-hidden`）を新規に作成・付与することを禁止する。
- 状態のスタイリングは、WAI-ARIA属性（`[aria-expanded="true"]`等）またはHTML標準の属性（`[hidden]`, `[disabled]`）をセレクタとして使用し、アクセシビリティとスタイリングを同期させること。

```css
/* AI実装例: ARIA属性による状態定義 */
@layer components {
  .accordion-content {
    display: none;
  }

  .accordion-trigger[aria-expanded="true"] + .accordion-content {
    display: block;
  }
}
```

## 7. ネスト深度の制限（Limit Nesting Depth）

- W3C標準のCSS Nestingを使用すること。
- セレクタのネスト深度は最大2階層までとする（擬似クラス`:hover`や、アットルール`@media`, `@container`は階層に含めない）。詳細度の過剰な上昇を避けるため、フラットな構造を維持すること。

## 8. ビューポート単位の厳格化（Strict Viewport Units）

- 画面全体を覆う要素（フルハイト）の高さ指定において、従来の `vh` 単位の使用を禁止する。
- 常にスモールビューポート単位（`svh`）を使用し、純粋な可視領域の高さを取得すること。また、以前定義した「論理プロパティの強制」ルールに従い、`height` ではなく `block-size` を使用すること。

```css
/* 実装例: svh単位と論理プロパティの併用 */
@layer components {
  .main-visual {
    block-size: 100svh;
  }
}
```

## 9. 境界半径におけるマジックナンバーの排除（Elimination of Magic Numbers in Border Radius）

- ピル形状（完全な角丸）のUIコンポーネント（ボタンやバッジ等）を実装する際、`border-radius`プロパティに`9999px`などの根拠のない巨大な絶対値（マジックナンバー）を指定することを禁止する。
- 常に相対的な最大値である`100vmax`を使用すること。

```css
/* 実装例: vmax単位を用いたピル形状の定義 */
@layer components {
  .button-pill {
    border-radius: 100vmax;
  }
}
```

## 10. インタラクションメディア特性によるホバー制御（Interaction Media Features for Hover States）

- ホバー効果（`:hover`）を定義する際は、画面幅（`min-width`等）を基準としたブレイクポイントによるデバイス判定を厳格に禁止する。
- 常に `@media (any-hover: hover)` ブロック内で `:hover` 擬似クラスを定義すること。

```css
/* 実装例: インタラクション判定に基づくホバー処理 */
@layer components {
  .action-button {
    background-color: var(--wp--preset--color--base);
  }

  @media (any-hover: hover) {
    .action-button:hover {
      background-color: var(--wp--preset--color--primary);
    }
  }
}
```