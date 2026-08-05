/**
 * Copy buttons for .kit-code blocks (Media Kit pasteables, DESIGN.md embed).
 */
(function () {
  function codeTextFrom(block) {
    var code =
      block.querySelector(".kit-code__body code") ||
      block.querySelector(".cds-code code") ||
      block.querySelector("code");
    return code ? (code.textContent || "").trim() : "";
  }

  function writeClipboard(text) {
    if (navigator.clipboard && typeof navigator.clipboard.writeText === "function") {
      return navigator.clipboard.writeText(text).catch(function () {
        return legacyCopy(text);
      });
    }
    return legacyCopy(text);
  }

  function legacyCopy(text) {
    return new Promise(function (resolve, reject) {
      var ta = document.createElement("textarea");
      ta.value = text;
      ta.setAttribute("readonly", "");
      ta.style.cssText =
        "position:fixed;top:0;left:0;width:1px;height:1px;opacity:0;border:0;padding:0;";
      document.body.appendChild(ta);
      ta.focus();
      ta.select();
      ta.setSelectionRange(0, ta.value.length);
      var ok = false;
      try {
        ok = document.execCommand("copy");
      } catch (err) {
        ok = false;
      }
      document.body.removeChild(ta);
      if (ok) resolve();
      else reject(new Error("copy failed"));
    });
  }

  function defaultCopyLabel(btn) {
    return btn.getAttribute("data-kit-copy-label") || btn.getAttribute("aria-label") || "Copy";
  }

  function markCopied(btn) {
    var prev = defaultCopyLabel(btn);
    btn.setAttribute("data-kit-copy-label", prev);
    btn.setAttribute("data-copied", "true");
    btn.setAttribute("aria-label", "Copied");
    clearTimeout(btn._kitCopyTimer);
    btn._kitCopyTimer = setTimeout(function () {
      btn.removeAttribute("data-copied");
      btn.setAttribute("aria-label", prev);
    }, 1600);
  }

  function resolveCopyText(block) {
    if (block.id === "design-md-block") {
      return fetch("DESIGN.md", { cache: "no-cache" })
        .then(function (res) {
          if (!res.ok) throw new Error("DESIGN.md fetch failed");
          return res.text();
        })
        .catch(function () {
          return codeTextFrom(block);
        });
    }
    return Promise.resolve(codeTextFrom(block));
  }

  document.querySelectorAll("[data-kit-copy]").forEach(function (btn) {
    btn.setAttribute("data-kit-copy-label", defaultCopyLabel(btn));
    btn.addEventListener("click", function () {
      var block = btn.closest(".kit-code");
      if (!block) return;
      resolveCopyText(block)
        .then(function (text) {
          if (!text) return Promise.reject(new Error("empty"));
          return writeClipboard(text);
        })
        .then(function () {
          markCopied(btn);
        })
        .catch(function () {
          btn.setAttribute("aria-label", "Copy failed");
          clearTimeout(btn._kitCopyTimer);
          btn._kitCopyTimer = setTimeout(function () {
            btn.setAttribute("aria-label", defaultCopyLabel(btn));
          }, 1600);
        });
    });
  });
})();
