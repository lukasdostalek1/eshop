import { fetchHeader } from "../../api/headerApi.js";
import { fetchCategories } from "../../api/categoriesApi.js";
import { renderHeaderCategories } from "./renderHeaderCategories.js";
import { check_sessions } from "../../api/userApi.js";
import { renderHeaderUserArea } from "./renderHeaderUserArea.js";
import { loadHeaderCart } from "../cart/headerCart.js";
import { addEventListenerToLogOutBtn } from "./headerHelpers.js";

export async function loadHeader() {
    const headerContainer = document.querySelector("#headerContainer");
    
    const headerHTML = await fetchHeader();
    headerContainer.innerHTML = headerHTML;

    const categoriesList = await fetchCategories();
    renderHeaderCategories(categoriesList);

    const sessionData = await check_sessions();

    renderHeaderUserArea(sessionData["isLoggedIn"], sessionData["role"]);

    if(sessionData["isLoggedIn"]) {
        addEventListenerToLogOutBtn();
    }

    if(sessionData["role"] == 1) {
        return;
    }
    loadHeaderCart();

}




