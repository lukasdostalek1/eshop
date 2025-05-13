import { loadHeader } from "../components/header/headerComponent.js";
import { loadOrderDetails } from "../components/order/orderComponent.js";
import { denyAccesToNonUsers } from "../components/user/userHelpers.js";
import { getParamsFromUrl } from "../utils/url.js";

document.addEventListener("DOMContentLoaded", async () => {
    loadHeader();
    denyAccesToNonUsers(); 
    const id = getParamsFromUrl("id");
    loadOrderDetails(id);
})