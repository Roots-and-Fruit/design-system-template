/**
 * Live WCAG 2 contrast matrix on Color. Reads computed --cds-* values so a
 * fork's brand.json shows up without hardcoding hex.
 * The pair list in scripts/contrast.mjs is the gate. This grid is the picture.
 */
(function () {
  var table = document.getElementById("kit-a11y-matrix");
  if (!table) return;

  var backgrounds = [
    "--cds-paper",
    "--cds-paper-deep",
    "--cds-surface",
    "--cds-panel",
    "--cds-primary-soft",
    "--cds-primary",
    "--cds-primary-deep",
    "--cds-accent",
    "--cds-surface-dark",
    "--cds-success",
    "--cds-warning",
    "--cds-danger",
  ];

  var foregrounds = [
    "--cds-ink-deep",
    "--cds-ink",
    "--cds-ink-muted",
    "--cds-ink-soft",
    "--cds-on-primary",
    "--cds-on-accent",
    "--cds-on-dark",
    "--cds-primary",
    "--cds-primary-deep",
    "--cds-accent",
  ];

  function shortName(token) {
    return token.replace(/^--cds-/, "");
  }

  function parseColor(value) {
    if (!value) return null;
    value = value.trim();
    var hex = value.match(/^#([0-9a-f]{3}|[0-9a-f]{6})$/i);
    if (hex) {
      var h = hex[1];
      if (h.length === 3) {
        h = h
          .split("")
          .map(function (c) {
            return c + c;
          })
          .join("");
      }
      return {
        r: parseInt(h.slice(0, 2), 16),
        g: parseInt(h.slice(2, 4), 16),
        b: parseInt(h.slice(4, 6), 16),
      };
    }
    var rgb = value.match(/^rgba?\(\s*([\d.]+)\s*,\s*([\d.]+)\s*,\s*([\d.]+)/i);
    if (rgb) return { r: +rgb[1], g: +rgb[2], b: +rgb[3] };
    return null;
  }

  function tokenColor(token) {
    var probe = document.createElement("span");
    probe.style.cssText =
      "position:absolute;width:0;height:0;overflow:hidden;pointer-events:none;color:var(" +
      token +
      ")";
    document.body.appendChild(probe);
    var parsed = parseColor(getComputedStyle(probe).color);
    probe.remove();
    return parsed;
  }

  function channel(c) {
    c = c / 255;
    return c <= 0.04045 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
  }

  function luminance(rgb) {
    return 0.2126 * channel(rgb.r) + 0.7152 * channel(rgb.g) + 0.0722 * channel(rgb.b);
  }

  function contrastRatio(fg, bg) {
    var lighter = Math.max(luminance(fg), luminance(bg));
    var darker = Math.min(luminance(fg), luminance(bg));
    return (lighter + 0.05) / (darker + 0.05);
  }

  function levelFor(ratio) {
    if (ratio >= 7) return { key: "aaa", label: "AAA" };
    if (ratio >= 4.5) return { key: "aa", label: "AA" };
    if (ratio >= 3) return { key: "large", label: "AA large" };
    return { key: "fail", label: "Fail" };
  }

  var thead = table.querySelector("thead");
  var tbody = table.querySelector("tbody");
  thead.innerHTML = "";
  tbody.innerHTML = "";

  var headRow = document.createElement("tr");
  var corner = document.createElement("th");
  corner.scope = "col";
  corner.textContent = "BG \\ Text";
  headRow.appendChild(corner);
  foregrounds.forEach(function (fgToken) {
    var th = document.createElement("th");
    th.scope = "col";
    th.textContent = shortName(fgToken);
    headRow.appendChild(th);
  });
  thead.appendChild(headRow);

  backgrounds.forEach(function (bgToken) {
    var bg = tokenColor(bgToken);
    var tr = document.createElement("tr");
    var th = document.createElement("th");
    th.scope = "row";
    var chip = document.createElement("span");
    chip.className = "kit-a11y__chip";
    chip.style.background = "var(" + bgToken + ")";
    th.appendChild(chip);
    th.appendChild(document.createTextNode(shortName(bgToken)));
    tr.appendChild(th);

    foregrounds.forEach(function (fgToken) {
      var td = document.createElement("td");
      var fg = tokenColor(fgToken);
      var cell = document.createElement("div");
      cell.className = "kit-a11y__cell";

      if (!bg || !fg) {
        cell.textContent = "—";
        td.appendChild(cell);
        tr.appendChild(td);
        return;
      }

      var ratio = contrastRatio(fg, bg);
      var level = levelFor(ratio);
      cell.dataset.level = level.key;
      cell.style.background = "var(" + bgToken + ")";
      cell.style.color = "var(" + fgToken + ")";
      cell.innerHTML =
        ratio.toFixed(2) + "<small>" + level.label + "</small>";
      cell.title =
        shortName(fgToken) +
        " on " +
        shortName(bgToken) +
        ": " +
        ratio.toFixed(2) +
        ":1 (" +
        level.label +
        ")";
      td.appendChild(cell);
      tr.appendChild(td);
    });

    tbody.appendChild(tr);
  });
})();
