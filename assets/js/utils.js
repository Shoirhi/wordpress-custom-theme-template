/**
 * ユーティリティ関数
 *
 * @package WordPress_Custom_Theme_Template
 */

/**
 * デバウンス関数
 *
 * 連続的なイベント発火を制御し、最後のイベントから指定時間経過後に
 * コールバックを1回だけ実行する。
 *
 * @param {Function} func - 実行する関数
 * @param {number} [timeout=300] - 遅延時間（ミリ秒）
 * @returns {Function} デバウンスされた関数
 */
function debounce(func, timeout) {
  let timer;
  timeout = timeout !== undefined ? timeout : 300;
  return function () {
    const context = this;
    const args = arguments;
    clearTimeout(timer);
    timer = setTimeout(() => {
      func.apply(context, args);
    }, timeout);
  };
}
