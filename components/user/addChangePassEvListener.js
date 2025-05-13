import { changePassword } from "../../api/userApi.js";
import { insertResponse } from "../../utils/insertResponse.js";


export async function addChangePassEvListener() {

    document.querySelector("#change-password").addEventListener("submit", async (e) => {
    e.preventDefault();
    const oldPassword = document.querySelector("#old-password").value;
    const newPassword = document.querySelector("#new-password").value;
    const newPasswordAgain = document.querySelector("#new-password-again").value;


    if(newPassword !== newPasswordAgain) {
        insertResponse("Nová hesla nejsou stejná");
        return;
    }
    
    const data = {
        "oldPassword" : oldPassword,
        "newPassword" : newPassword
    }

    const response = await changePassword(data);
    if(response["error"]) {
       insertResponse("Nová hesla nejsou stejná");
    }
    if(response["succes"]) {
        insertResponse("Nová hesla nejsou stejná");
        document.querySelector("#old-password").value = "";
        document.querySelector("#new-password").value = "";
        document.querySelector("#new-password-again").value = "";
    }
    

})

}