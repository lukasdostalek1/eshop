
import { getCart } from "../../storage/cartStorage.js";
import { renderCartValues } from "./renderCartValues.js";
import { showNextCartStepBasedOnList } from "./showNextCartStep.js";
import { addEventListenersToDeleteButtons } from "./cartDeleteButtons.js";
import { addStopPropagationToHeaderCart } from "./cartHelpers.js";

export async function loadHeaderCart() {
    const itemsCountTag = document.getElementById("itemsCount");
    const listTag = document.getElementById("headerCartDropDown");
    const moveToCartBtn = document.getElementById("moveToCartBtn");
    const orderItems = getCart();

    showNextCartStepBasedOnList(orderItems, moveToCartBtn, listTag, itemsCountTag);

    if(orderItems.length == 0) {
        return;
    }
    renderCartValues(orderItems, listTag, true);
    addEventListenersToDeleteButtons();
    addStopPropagationToHeaderCart();
    }


