import { loadHeader } from "../components/header/headerComponent.js";
import {getParamsFromUrl} from "../utils/url.js";

document.addEventListener("DOMContentLoaded", async () =>{
    loadHeader();
    document.getElementById("orderNumber").textContent =  getParamsFromUrl("id");


})