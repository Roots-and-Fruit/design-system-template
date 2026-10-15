/**
 * Catalog sidebar. Each parent with children toggles only itself.
 */
(function () {
  document.querySelectorAll(".kit-nav__group").forEach(function (group) {
    var button = group.querySelector(":scope > .kit-nav__toggle");
    var sub = group.querySelector(":scope > .kit-nav__sub");
    if (!button || !sub) return;

    function sync(open) {
      group.classList.toggle("is-open", open);
      button.setAttribute("aria-expanded", open ? "true" : "false");
      if (open) sub.removeAttribute("inert");
      else sub.setAttribute("inert", "");
    }

    sync(group.classList.contains("is-open"));

    button.addEventListener("click", function () {
      sync(!group.classList.contains("is-open"));
    });
  });
})();
