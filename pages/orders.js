import { loadHeader } from "../components/header/headerComponent.js";
import { denyAccesToNonUsers } from "../components/user/userHelpers.js";
import { loadUpOrders } from "../components/order/orderComponent.js";

document.addEventListener("DOMContentLoaded", async () => {
    loadHeader();
    denyAccesToNonUsers();
    loadUpOrders();
})