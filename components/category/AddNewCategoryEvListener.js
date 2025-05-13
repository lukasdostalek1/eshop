import { addCategory } from "../../api/categoriesApi.js";
import { insertResponse } from "../../utils/insertResponse.js";
import { loadHeader } from "../header/headerComponent.js";


export async function AddNewCategoryEvListener() {

    document.querySelector("#addCategory").addEventListener("submit", async (e)=> {
        e.preventDefault();
        const name = document.getElementById("catName").value;
    

        const result = await addCategory(name);
        if(result["error"]) {
            insertResponse(result["error"])
            return;
        }
        if(result["succes"]) {
           insertResponse(result["succes"]);
           document.getElementById("catName").value = "";
           loadHeader();
            }
        })
    
    
    }


