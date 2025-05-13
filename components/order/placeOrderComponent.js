import { placeOrder } from "../../api/OrderApi.js";
import { check_sessions, getLoggedData } from "../../api/userApi.js";
import { prepareOrderData } from "./orderHelpers.js";
import { prepareOrderItemsData } from "./orderHelpers.js";
import { getCart, removeEverythingFromCart } from "../../storage/cartStorage.js";
import {  insertResponse } from "../../utils/insertResponse.js";
import { fillUpDeliveryInfo } from "./placeOrderHelpers.js";

export async function placeOrderComponent() {

        const orderItems = getCart();
        const sessionData = await check_sessions();

        if(sessionData["isLoggedIn"]) {
               const data = await getLoggedData();
               fillUpDeliveryInfo(data.name, data.surname, data.email);
        }

        
        document.getElementById("placeOrder").addEventListener("submit", async (e)=> {
            e.preventDefault();

            const paymentMethod = document.querySelector('input[name="payment"]:checked');
            if(!paymentMethod) {
                insertResponse("Vyberte způsob platby");
                return;
            }
            const paymentMethodValue = paymentMethod.value;
            const preparedOrderItems = prepareOrderItemsData(orderItems);
            const orderData = prepareOrderData(sessionData["isLoggedIn"], preparedOrderItems, paymentMethodValue);     
            
            const result = await placeOrder(orderData);        
            if(result["error"]) {
                insertResponse(result["error"]);
                return;
            }   

            window.location.href = `thank_you.html?id=${result}`;
            removeEverythingFromCart();
        })



}




