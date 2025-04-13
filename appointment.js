document.addEventListener("DOMContentLoaded", () => {
  const treatmentSelect = document.getElementById("treatment");
  const otherNameGroup = document.getElementById("other-name-group");

  treatmentSelect.addEventListener("change", () => {
    if (treatmentSelect.value === "someone") {
      otherNameGroup.style.display = "block";
      document.getElementById("other-name").required = true;
    } else {
      otherNameGroup.style.display = "none";
      document.getElementById("other-name").required = false;
      document.getElementById("other-name").value = "";
    }
  });
});
