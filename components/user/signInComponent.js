
import { userLogin } from "../../api/userApi.js";
import { insertResponse } from "../../utils/insertResponse.js";


export function addSignInEvListener() {


    document.querySelector("#loginForm").addEventListener("submit",async (e) => {
        e.preventDefault();
    
        const email = document.querySelector("#loginEmail").value;
        const password = document.querySelector("#loginPassword").value;
    
        const data = {
            "email": email,
            "password" : password
        }
        
        const result = await userLogin(data);
        if(result.redirect) {
            window.location.href = "index.html";
            return;
        } 
      insertResponse(result.error, true);
    
        
})
}

