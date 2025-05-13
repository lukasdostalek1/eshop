import { loadHeader } from "../components/header/headerComponent.js";
import { loadEditProfile } from "../components/user/editProfile.js";
import { addChangePassEvListener } from "../components/user/addChangePassEvListener.js";


document.addEventListener("DOMContentLoaded", ()=> {
    loadHeader();
    loadEditProfile();
    addChangePassEvListener();
})