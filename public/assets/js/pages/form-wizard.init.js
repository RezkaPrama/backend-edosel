var currentTab = 0;
function showTab(e) {
  var t = document.getElementsByClassName("wizard-tab");
  (t[e].style.display = "block"),
    (document.getElementById("prevBtn").style.display =
      0 == e ? "none" : "inline"),
    e == t.length - 1
      ? (document.getElementById("nextBtn").innerHTML = "Submit")
      : (document.getElementById("nextBtn").innerHTML = "Next"),
    fixStepIndicator(e);
}
function nextPrev(e) {
  var t = document.getElementsByClassName("wizard-tab");
  (t[currentTab].style.display = "none"),
    (currentTab += e) >= t.length &&
      (t[(currentTab -= e)].style.display = "block"),
    showTab(currentTab);
}
function fixStepIndicator(e) {
  var t,
    n = document.getElementsByClassName("list-item");
  for (t = 0; t < n.length; t++)
    n[t].className = n[t].className.replace(" active", "");
  n[e].className += " active";
}
showTab(currentTab), flatpickr("#datepicker-basic");
