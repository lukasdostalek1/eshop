import { renderDeleteButton } from "./cartDeleteButtons.js";

//

export function renderExtendedCartValues(listOfOrderItems, ulTagForProducts, booleanShowDeleteButtons) {

    listOfOrderItems.forEach((element,index) => {
        const li = document.createElement("li");
        ulTagForProducts.appendChild(li);
        li.classList.add("d-flex", "my-2");
        li.innerHTML = `
            <div class='w-100 my-auto'>
                <a href='product.html?id=${element.productId}' class='my-auto text-decoration-none text-white row'>
                <div class="col-1"><img src='uploads/${element.productImage}' width="50px"></div>
            <p class="my-auto col-3" ><span >${element.productName}</span> - <span >${element.productSize}</span> <span>${element.productColor}</span></p>
            <p class="my-auto col-3" ><span >${element.quantity}</span> Ks</p>
            <p class="my-auto col-3"><span >${element.productPrice}</span> Kč</p>
            <p class="my-auto col text-end pe-5"><span>${element.calculateTotal}</span> Kč</p>
                </a>
            </div>
            ${renderDeleteButton(booleanShowDeleteButtons, index)}
         `;
    });
}



export function renderCartValues(listOfOrderItems, ulTagForProducts, booleanShowDeleteButtons) {
    listOfOrderItems.forEach((element,index) => {
        const li = document.createElement("li");
        ulTagForProducts.appendChild(li);
        li.classList.add("d-flex", "my-2");
        li.innerHTML = `
            <div class='w-100 my-auto'>
                <a href='product.html?id=${element.productId}' class='my-auto text-decoration-none text-white d-flex '>
                <div class="my-auto"><img src='uploads/${element.productImage}' width="40px"></div>
                <div class="ms-3 text-start row gap-1">
                      <p class="my-auto col-12" >${element.productName}asdasdasd</p>
                    <p class="my-auto col-auto" >${element.quantity} Ks</p>
                     <p class="my-auto col">${element.calculateTotal} Kč</p>
                </div>
                </a>
            </div>
            ${renderDeleteButton(booleanShowDeleteButtons, index)}
         `;
    });
}



