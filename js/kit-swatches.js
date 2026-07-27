/**
 * Fill [data-swatch="--cds-token"] chips with the computed colour value.
 * Specimens stay honest after brand.json changes without hardcoding hex in HTML.
 */
(function () {
  function toHex(color) {
    if (!color) return "";
    color = color.trim();
    if (color.startsWith("#")) return color.toLowerCase();
    const m = color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*([\d.]+))?\)$/i);
    if (!m) return color;
    const r = Number(m[1]);
    const g = Number(m[2]);
    const b = Number(m[3]);
    const a = m[4] === undefined ? 1 : Number(m[4]);
    if (a < 1) {
      return `rgba(${r}, ${g}, ${b}, ${a})`;
    }
    return (
      "#" +
      [r, g, b]
        .map((n) => n.toString(16).padStart(2, "0"))
        .join("")
    );
  }

  document.querySelectorAll("[data-swatch]").forEach(function (el) {
    const token = el.getAttribute("data-swatch");
    if (!token) return;
    const probe = document.createElement("span");
    probe.style.cssText =
      "position:absolute;width:0;height:0;overflow:hidden;pointer-events:none;color:" +
      "var(" +
      token +
      ")";
    document.body.appendChild(probe);
    const value = toHex(getComputedStyle(probe).color);
    probe.remove();
    if (value) el.textContent = value;
  });
})();
