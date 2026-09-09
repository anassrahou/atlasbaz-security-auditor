(function () {
  "use strict";

  const dashboard = document.querySelector(".atlasbaz-dashboard");

  if (!dashboard) {
    return;
  }

  const auditHeadings = dashboard.querySelectorAll("h2");

  auditHeadings.forEach(function (heading) {
    const table = heading.nextElementSibling;

    if (!table || "TABLE" !== table.tagName) {
      return;
    }

    const button = document.createElement("button");
    button.type = "button";
    button.className = "atlasbaz-section-toggle";
    button.setAttribute("aria-expanded", "true");
    button.innerHTML =
      "<span>" +
      heading.textContent.trim() +
      '</span><span class="atlasbaz-section-icon" aria-hidden="true">-</span>';

    heading.textContent = "";
    heading.appendChild(button);

    button.addEventListener("click", function () {
      const isExpanded = "true" === button.getAttribute("aria-expanded");
      button.setAttribute("aria-expanded", String(!isExpanded));
      table.hidden = isExpanded;
      button.querySelector(".atlasbaz-section-icon").textContent = isExpanded
        ? "+"
        : "-";
    });
  });

  const findingsTable = dashboard.querySelector(".atlasbaz-findings-table");

  if (!findingsTable) {
    return;
  }

  const filterBar = document.createElement("div");
  filterBar.className = "atlasbaz-finding-filters";
  filterBar.setAttribute("aria-label", "Filter security findings");

  ["all", "high", "medium", "low"].forEach(function (severity) {
    const button = document.createElement("button");
    button.type = "button";
    button.className =
      "atlasbaz-filter-button" + ("all" === severity ? " is-active" : "");
    button.dataset.severity = severity;
    button.setAttribute("aria-pressed", "all" === severity ? "true" : "false");
    button.textContent =
      "all" === severity
        ? "All findings"
        : severity.charAt(0).toUpperCase() + severity.slice(1);
    filterBar.appendChild(button);
  });

  findingsTable.parentNode.insertBefore(filterBar, findingsTable);

  filterBar.addEventListener("click", function (event) {
    const selectedButton = event.target.closest(".atlasbaz-filter-button");

    if (!selectedButton) {
      return;
    }

    const selectedSeverity = selectedButton.dataset.severity;
    const rows = findingsTable.querySelectorAll("tbody tr[data-severity]");

    filterBar
      .querySelectorAll(".atlasbaz-filter-button")
      .forEach(function (button) {
        const isSelected = button === selectedButton;
        button.classList.toggle("is-active", isSelected);
        button.setAttribute("aria-pressed", String(isSelected));
      });

    rows.forEach(function (row) {
      row.hidden =
        "all" !== selectedSeverity && row.dataset.severity !== selectedSeverity;
    });
  });
})();
