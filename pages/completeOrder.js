import { loadHeader } from "../components/header/headerComponent.js";
import { hideHeaderCart } from "../utils/hideHeaderCart.js";
import { placeOrderComponent } from "../components/order/placeOrderComponent.js";
import { loadCompleteOrderCart } from "../components/cart/completeOrderCart.js";
import { bindOrderStepBtns } from "../components/order/placeOrderHelpers.js";

document.addEventListener("DOMContentLoaded", async () => {
    await loadHeader();
    hideHeaderCart();
    placeOrderComponent();
    bindOrderStepBtns();
    loadCompleteOrderCart();
})



