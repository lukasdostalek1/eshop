import { loadMainCart } from "./mainCart.js";
import { removeFromCart } from "../../storage/cartStorage.js";
import { loadHeaderCart } from "./headerCart.js";


export function addEventListenersToDeleteButtons() {
    const deleteButtons = document.querySelectorAll(".deleteFromMainCartBtn");
    deleteButtons.forEach(element => {
        element.addEventListener("click", ()=> {
            const index = element.dataset.index;
            removeFromCart(index);
            loadHeaderCart();

            //  kotrola zda jsme na strance cart.hbtml
            if (document.getElementById("mainCartList")) {
                loadMainCart(); 
            }
        })
    });
}





export function renderDeleteButton(booleanShowDeleteButtons, index) {
    if(booleanShowDeleteButtons){
    return `  <div class='my-auto'>
            <button data-index='${index}' class='btn-danger btn py-0 px-2 deleteFromMainCartBtn'>x</button>
        </div>`;
    }
    return ``;
}
