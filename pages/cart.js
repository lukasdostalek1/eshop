import { loadMainCart } from "../components/cart/mainCart.js";
import { loadHeader } from "../components/header/headerComponent.js";

document.addEventListener("DOMContentLoaded", () => {
loadHeader();
loadMainCart();
});