import { getCart } from "../../storage/cartStorage.js";
import { printTotalCartPrice } from "../../utils/printTotalCartPrice.js";
import { renderExtendedCartValues } from "./renderCartValues.js";
import { addEventListenersToDeleteButtons } from "./cartDeleteButtons.js";
import { showNextCartStepBasedOnList } from "./showNextCartStep.js";


export async function loadMainCart() {
    const listTag = document.getElementById("mainCartList");
    const moveTonextSectionDiv = document.getElementById("cartNextStep");
    const orderItems = getCart();


    showNextCartStepBasedOnList(orderItems, moveTonextSectionDiv, listTag);

    renderExtendedCartValues(orderItems, listTag, true);
    addEventListenersToDeleteButtons();
    printTotalCartPrice();
}

