import { getLoggedData } from "../../api/userApi.js";
import { fillNameAndSurnameToInputs } from "../../utils/fillNameAndSurnameToInputs.js";
import { editOwnUserData } from "../../api/userApi.js";
import { insertResponse } from "../../utils/insertResponse.js";

export async function loadEditProfile() { 

    const loggedInUserData = await getLoggedData();
    fillNameAndSurnameToInputs(loggedInUserData);

    document.querySelector("#edit-user-info").addEventListener("submit", async (e)=>{
        e.preventDefault();
        const newName = document.querySelector("#edit-user-info-name").value;
        const newSurname = document.querySelector("#edit-user-info-surname").value;
        const password = document.querySelector("#edit-user-info-password").value;

        const userData = {
            "name": newName,
            "surname": newSurname,
            "password": password
        }

    const response = await editOwnUserData(userData);
        
    if(response["error"]) {
        insertResponse(response["error"], true);
    }
    if(response["succes"]) {
        insertResponse(response["message"], true);
        document.querySelector("#edit-user-info-password").value = "";
    }

    });


}

