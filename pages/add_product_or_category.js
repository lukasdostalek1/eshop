import { loadHeader } from "../components/header/headerComponent.js";
import { addProductEvListener } from "../components/product/addProductEvListener.js";
import { AddNewCategoryEvListener } from "../components/category/AddNewCategoryEvListener.js";

document.addEventListener("DOMContentLoaded", () => {
    loadHeader();
    addProductEvListener();
    AddNewCategoryEvListener();
})