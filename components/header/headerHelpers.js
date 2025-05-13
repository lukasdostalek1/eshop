import { userLogOut } from "../../api/userApi.js";



export function addEventListenerToLogOutBtn() {
    const logOutButton = document.getElementById("logOut");
    if(logOutButton) {
        logOutButton.addEventListener("click", async () => {
            const response = await userLogOut();
            if(!response["true"]) {
                document.querySelector("#responseHeaderInfo").textContent = "Odlášení se nezdařilo, chyba na straně serveru.";
            }
            window.location.href = "index.html";

        })
    }
}
