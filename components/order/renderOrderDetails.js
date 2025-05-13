


export function renderOrderDetails(data, orderId, paymentMethodName) {
document.getElementById("orderNumber").textContent = orderId;
document.getElementById("orderDate").textContent = data.date;
document.getElementById("paymentMethod").textContent = paymentMethodName;
document.getElementById("orderPrice").textContent = data.price;
document.getElementById("name").textContent = data.name;
document.getElementById("surname").textContent = data.surname;
document.getElementById("email").textContent = data.email;
document.getElementById("street").textContent = data.street;
document.getElementById("street_number").textContent = data.street_number;
document.getElementById("city").textContent = data.city;
document.getElementById("zip_code").textContent = data.zip_code;

    if(data.guest_email != null) {
        document.getElementById("name").textContent = data.guest_name;
        document.getElementById("surname").textContent = data.guest_surname;
        document.getElementById("email").textContent = data.guest_email;
    }
}


export function renderOrderItems(data) {
    const orderItemsUl = document.getElementById("orderItemsUl");
    data.forEach((element,index) => {
        const li = document.createElement("li");
        li.classList.add("row", "my-3");
        orderItemsUl.appendChild(li);

        li.innerHTML = `<div class='col-auto my-auto'>${index+1}</div><div class='col  my-auto'><img src='uploads/${element.image_name}' width='50px'></div>
        <div class='col  my-auto'>${element.name}</div>
        <div class='col  my-auto'>${element.order_item_price}</div>
        
        
        `
    });
}

