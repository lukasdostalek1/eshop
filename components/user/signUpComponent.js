import { userRegister } from "../../api/userApi.js";
import { insertResponse } from "../../utils/insertResponse.js";

export function addSignUpEvListener() {


    document.querySelector("#registrationForm").addEventListener("submit", async(e) => {
     e.preventDefault();
    const name = document.getElementById("registrationName").value;
    const surname = document.getElementById("registrationSurname").value;
    const email = document.getElementById("registrationEmail").value;
    const password = document.getElementById("registrationPassword").value;
    const passwordAgain = document.getElementById("registrationPasswordAgain").value;

    if(password !== passwordAgain) {
        insertResponse("hesla se neshodují", true);
        return;
    }

    const data = {
        "name": name,
        "surname" : surname,
        "email": email,
        "password": password
    }
   
    const result = await userRegister(data);
    
    if(result.redirect) {
        window.location.href = "index.html";
    } else {
       insertResponse(result.error, true);
    }

    
})

}