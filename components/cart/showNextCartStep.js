



export function showNextCartStepBasedOnList(orderItems, nextStepDiv, listTag, itemsCountTag) {


    if(orderItems.length == 0) {
        nextStepDiv.classList.add("d-none");
        listTag.innerHTML = "<p class='my-5 text-white'>Košík je prázdný.</p>";
        if(itemsCountTag) {itemsCountTag.textContent = "0"; }
        return;
    }
    listTag.innerHTML = "";
    nextStepDiv.classList.remove("d-none");
    if(itemsCountTag) {itemsCountTag.textContent = orderItems.length; }
}