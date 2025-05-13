





export function renderOrders(orderList, ordersWrapper) {
    orderList.forEach(element => {
        const div = document.createElement("div");
        ordersWrapper.appendChild(div);
        div.innerHTML = `
        <a class='text-decoration-none text-white ' href='order.html?id=${element.id}'>
        <div class='d-flex justify-content-between'>
        <p class='fs-5 col-2'>#${element.id}</p>
          <p class='fs-5 col-3'>${element.date}</p>
          <p class='fs-5 col-2 text-end'>${element.price}</p>
          <p class='fs-5 col text-end'>${toggleUserOrGuestEmail(element)}</p>
          </div>
       </a>
    `;
    });
}
function toggleUserOrGuestEmail(order) {
if(order["email"] != null) {
return order["email"];
}

return `<span class='text-warning' style='font-size: 0.75em'>(Nepřihlášený)</span> ${order["guest_email"]}`;

}