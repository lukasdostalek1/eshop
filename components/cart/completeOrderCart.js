import { getCart } from "../../storage/cartStorage.js";
import { printTotalCartPrice } from "../../utils/printTotalCartPrice.js";
import { renderCartValues } from "./renderCartValues.js";


export async function loadCompleteOrderCart() {
     const listTag =  document.getElementById("orderProductsList");
     const orderItems = getCart();
    
     renderCartValues(orderItems, listTag, false);
     printTotalCartPrice();
}

