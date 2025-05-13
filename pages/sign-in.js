import { loadHeader } from "../components/header/headerComponent.js";
import { addSignInEvListener } from "../components/user/signInComponent.js"; 


document.addEventListener("DOMContentLoaded", () =>{
    loadHeader();
    addSignInEvListener();
})