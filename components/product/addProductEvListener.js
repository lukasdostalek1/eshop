import { fetchCategories } from "../../api/categoriesApi.js";
import { fillCategoriesToInput } from "../../utils/fillCategoriesToInput.js";
import { addProduct } from "../../api/productsApi.js";
import { insertResponse } from "../../utils/insertResponse.js";


export async function addProductEvListener() {
    const result = await fetchCategories();
    fillCategoriesToInput(result);


document.querySelector("#addProduct").addEventListener("submit", async (e)=> {
    e.preventDefault();
    const dropDownToggle =  document.querySelector(".dropdown-toggle");

    const name = document.getElementById("name").value;
    const description = document.getElementById("description").value;
    const price = document.getElementById("price").value;
    const image = document.getElementById("image").files[0];
    const categoryId =  dropDownToggle.getAttribute("id");


    const formData = new FormData();
    formData.append("name", name);
    formData.append("description", description);
    formData.append("price", price);
    formData.append("image", image);
    formData.append("categoryId", categoryId);


    const result = await addProduct(formData);
    if(result["error"]) {
       insertResponse(result["error"]);
    }
     if(result["succes"]) {
      insertResponse(result["succes"]);
        document.getElementById("name").value = "";
        document.getElementById("description").value = "";
        document.getElementById("price").value = "";
        document.getElementById("image").value = null;
        dropDownToggle.value = "";
        dropDownToggle.setAttribute("id", "");
        }
    })

}
