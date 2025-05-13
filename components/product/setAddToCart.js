import { fetchProductById } from "../../api/productsApi.js";
import {activeDropDownMenu} from "../../utils/dropDownMenu.js";
import { addToCart } from "../../storage/cartStorage.js";
import { loadHeaderCart } from "../cart/headerCart.js";
import {addToCartOverlay} from "./overlay.js";
import { insertResponse } from "../../utils/insertResponse.js";


export function setAddToCartForm(addToCartForm, productId) {

    activeDropDownMenu();

  
    addToCartForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const size = document.querySelector("#sizeOption").value;
        const colorTag = document.querySelector('input[name="option"]:checked');
        const quantity = document.querySelector("#quantity").value;

        if (!size || !colorTag || !quantity ) {
        insertResponse("Nejsou vyplněna všechna pole");
        return;
        }

        const color = colorTag.value;

        const productData = await fetchProductById(productId);

        const orderItem = {
            "productId" : productId,
            "productName" : productData["name"],
            "productPrice" : productData["price"],
            "productImage" : productData["image_name"],
            "productSize" : size,
            "productColor" : color,
            "quantity" : quantity,
            "calculateTotal" : quantity * productData["price"]
         }


         addToCart(orderItem);
         loadHeaderCart();
         addToCartOverlay(orderItem);
    })
}
