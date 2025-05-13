

export function prepareOrderData(isLoggedIn, preparedOrderItems, paymentMethodValue) {
    let guestInfo = null;
    let orderData = {};

    if(!isLoggedIn) {
         guestInfo = {
            "name" : document.getElementById("name").value,
            "surname" :  document.getElementById("surname").value,
            "email": document.getElementById("email").value
        }
        orderData.guestInfo = guestInfo;
    }

    const deliveryAddress = {
        "street": document.getElementById("street").value,
        "street_number" : document.getElementById("street_number").value,
        "city": document.getElementById("city").value,
        "zip_code": document.getElementById("zip_code").value
    }



    orderData.deliveryAddress = deliveryAddress;
    orderData.paymentMethodValue = paymentMethodValue;
    orderData.orderItems = preparedOrderItems;
    return orderData;
}




export function prepareOrderItemsData(orderItems) {
    const preparedOrderItems = [];

    orderItems.forEach(element => {
        preparedOrderItems.push(
            {
                "product_id": element.productId,
                "productColor": element.productColor,
                "productSize": element.productSize,
                "quantity": element.quantity
            }
        )
    });
    return preparedOrderItems;
}




export function getPaymentMethodNameFromId(input) {
    const parsedInput = parseInt(input);
    switch(parsedInput) {
        case 1:
        return "Platba kartou";
        case 2: 
        return "Dobírka";
        case 3: 
        return "Bankovní převod";
        default: 
        return "platba nebyla zvolena";
    } 
}



