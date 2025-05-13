import { loadHeader } from "../components/header/headerComponent.js";
import { loadUpProducts } from "../components/product/productComponent.js";

document.addEventListener("DOMContentLoaded", async () => {
    loadHeader();
    loadUpProducts();
})