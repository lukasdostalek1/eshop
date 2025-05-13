import { fetchOrderDetails, fetchOrders } from "../../api/OrderApi.js";
import { renderOrderDetails, renderOrderItems } from "./renderOrderDetails.js";
import { renderOrders } from "./renderOrders.js";
import { getPaymentMethodNameFromId } from "./orderHelpers.js";
import { insertResponse } from "../../utils/insertResponse.js";
    

export async function loadUpOrders() {
    const orderList = await fetchOrders();
    if(orderList["error"]) {
        insertResponse(orderList["error"]);
        return;
    }
    if(orderList.length == 0) {
       insertResponse("Žádné objednávky nenalezeny.");
        return;
    }

    const ordersWrapper = document.getElementById("ordersWrapper");
    renderOrders(orderList, ordersWrapper);

}




export async function loadOrderDetails(orderId) {
    const result = await fetchOrderDetails(orderId);
    const paymentMethodName = getPaymentMethodNameFromId(result["orderDetails"]["payment_method"]);


    renderOrderDetails(result["orderDetails"], orderId, paymentMethodName);
    renderOrderItems(result["orderItems"]);
}