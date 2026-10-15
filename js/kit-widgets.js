/**
 * Catalog behaviors for specimens: stepper, toggle label, slider readout,
 * folder tabs, dialog, toast, gallery, and the code-window copy control.
 * No-ops when the matching markup is absent.
 */
(function () {
  document.querySelectorAll("[data-cds-step]").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var wrap = btn.closest(".cds-number");
      var input = wrap && wrap.querySelector("input");
      if (!input) return;
      var step = Number(btn.getAttribute("data-cds-step")) || 0;
      var next = Number(input.value || 0) + step;
      var min = input.min === "" ? -Infinity : Number(input.min);
      var max = input.max === "" ? Infinity : Number(input.max);
      input.value = String(Math.min(max, Math.max(min, next)));
    });
  });

  document.querySelectorAll(".cds-toggle__input").forEach(function (input) {
    var state = input.parentElement.querySelector(".cds-toggle__state");
    function sync() {
      if (!state) return;
      state.textContent = input.checked
        ? state.getAttribute("data-enabled") || "On"
        : state.getAttribute("data-disabled") || "Off";
    }
    input.addEventListener("change", sync);
    sync();
  });

  document.querySelectorAll(".cds-slider").forEach(function (input) {
    var output = input.parentElement.querySelector(".cds-slider__value");
    if (!output) return;
    input.addEventListener("input", function () {
      output.textContent = input.value;
    });
  });

  document.querySelectorAll(".cds-tabs").forEach(function (root) {
    var tabs = Array.prototype.slice.call(root.querySelectorAll("[data-cds-tab]"));
    var panels = Array.prototype.slice.call(root.querySelectorAll("[data-cds-panel]"));
    tabs.forEach(function (tab) {
      tab.addEventListener("click", function () {
        var id = tab.getAttribute("data-cds-tab");
        tabs.forEach(function (item) {
          var on = item === tab;
          item.classList.toggle("is-current", on);
          item.setAttribute("aria-selected", on ? "true" : "false");
          item.tabIndex = on ? 0 : -1;
        });
        panels.forEach(function (panel) {
          panel.hidden = panel.getAttribute("data-cds-panel") !== id;
        });
      });
    });
  });

  document.querySelectorAll("[data-cds-dialog-open]").forEach(function (btn) {
    btn.addEventListener("click", function (event) {
      var dialog = document.getElementById(btn.getAttribute("data-cds-dialog-open"));
      if (!dialog || !dialog.showModal) return;
      event.preventDefault();
      dialog.showModal();
    });
  });

  document.querySelectorAll("form.cds-form").forEach(function (form) {
    form.addEventListener("submit", function (event) {
      var action = form.getAttribute("action") || "";
      if (action === "" || action === "#") event.preventDefault();
    });
  });

  document.querySelectorAll("[data-cds-toast]").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var stage = btn.closest(".cds-toast-stage");
      var toast = stage && stage.querySelector(".cds-toast");
      if (!toast) return;
      var text = toast.querySelector("p");
      if (text) text.textContent = btn.getAttribute("data-cds-toast") || "";
      toast.hidden = false;
      clearTimeout(toast._cdsTimer);
      toast._cdsTimer = setTimeout(function () {
        toast.hidden = true;
      }, 4000);
    });
  });

  document.querySelectorAll(".cds-toast__close").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var toast = btn.closest(".cds-toast");
      if (toast) toast.hidden = true;
    });
  });

  document.querySelectorAll("[data-cds-copy]").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var root = btn.closest(".cds-code-window");
      var code = root && root.querySelector("code");
      if (!code || !navigator.clipboard) return;
      navigator.clipboard.writeText(code.textContent || "").then(function () {
        btn.setAttribute("data-copied", "true");
        setTimeout(function () {
          btn.removeAttribute("data-copied");
        }, 1500);
      });
    });
  });

  document.querySelectorAll(".cds-gallery").forEach(function (root) {
    var thumbs = Array.prototype.slice.call(root.querySelectorAll(".cds-gallery__thumb"));
    var stage = root.querySelector(".cds-gallery__img");
    var caption = root.querySelector(".cds-gallery__caption");
    var count = root.querySelector(".cds-gallery__count");
    var dialog = root.querySelector("dialog");
    var dialogImg = dialog && dialog.querySelector("img");
    var dialogCaption = dialog && dialog.querySelector(".cds-gallery__dialog-caption");
    var index = 0;

    function show(next) {
      if (!thumbs.length) return;
      index = (next + thumbs.length) % thumbs.length;
      var img = thumbs[index].querySelector("img");
      if (!img) return;
      var src = img.getAttribute("src");
      var alt = img.getAttribute("alt") || "";
      if (stage) {
        stage.src = src;
        stage.alt = alt;
      }
      if (caption) caption.textContent = alt;
      if (count) count.textContent = index + 1 + " of " + thumbs.length;
      if (dialogImg) {
        dialogImg.src = src;
        dialogImg.alt = alt;
      }
      if (dialogCaption) dialogCaption.textContent = alt;
      thumbs.forEach(function (thumb, i) {
        thumb.setAttribute("aria-current", i === index ? "true" : "false");
      });
    }

    thumbs.forEach(function (thumb, i) {
      thumb.addEventListener("click", function () {
        show(i);
      });
    });

    root.querySelectorAll("[data-cds-gallery='prev']").forEach(function (btn) {
      btn.addEventListener("click", function () { show(index - 1); });
    });
    root.querySelectorAll("[data-cds-gallery='next']").forEach(function (btn) {
      btn.addEventListener("click", function () { show(index + 1); });
    });
    if (dialog && dialog.showModal) {
      root.querySelectorAll("[data-cds-gallery='open']").forEach(function (btn) {
        btn.addEventListener("click", function () { dialog.showModal(); });
      });
    }
    show(0);
  });
})();
