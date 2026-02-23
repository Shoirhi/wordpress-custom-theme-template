/**
 * ビューポート調整
 *
 * 画面幅が指定値より小さい場合、viewportを固定幅に切り替える。
 * リサイズイベントにはdebounceを適用し、パフォーマンスを最適化する。
 *
 * @package WordPress_Custom_Theme_Template
 */

const adjustViewport = () => {
  const triggerWidth = 375;
  const viewport = document.querySelector('meta[name="viewport"]');
  const value =
    window.outerWidth < triggerWidth
      ? `width=${triggerWidth}`
      : "width=device-width, initial-scale=1";
  viewport.setAttribute("content", value);
};

const debouncedAdjustViewport = debounce(adjustViewport);
window.addEventListener("resize", debouncedAdjustViewport, false);
