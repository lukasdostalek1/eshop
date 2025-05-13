import { loadHeader } from "../components/header/headerComponent.js";
import { addSignUpEvListener} from "../components/user/signUpComponent.js";


document.addEventListener("DOMContentLoaded", () => {
    loadHeader();
    addSignUpEvListener();
})



