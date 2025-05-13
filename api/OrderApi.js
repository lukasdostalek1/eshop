






export async function placeOrder(orderData) {
    const response = await fetch("backend/orderRouter.php/placeOrder", {
        method: "POST",
        body: JSON.stringify(orderData)
    })
    const data = response.json();
    return data;
}




export async function fetchOrders() {
    const response = await fetch("backend/orderRouter.php/getOrders");
    const data = await response.json();
    return data;
}



export async function fetchOrderDetails(orderId) {
    const response = await fetch(`backend/orderRouter.php/getOrderDetails?id=${orderId}`);
    const data = await response.json();
    return data;
}