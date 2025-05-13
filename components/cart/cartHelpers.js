
export function addStopPropagationToHeaderCart () {
    const headerCartDropDown =  document.getElementById("headerCartDropDown");
    headerCartDropDown.addEventListener("click", function (e) {
        e.stopPropagation();
      });
}