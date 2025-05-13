


export async function check_sessions() {
    const response = await fetch("backend/userRouter.php/check_sessions", {
        method: "GET",
        credentials: "include"
    })
    const data = await response.json();
    return data;

}

export async function userLogOut() {
const response = await fetch("backend/userRouter.php/log_out", {
    method: "GET",
    credentials: "include"
});
const data = await response.json();
return data;
}

export async function userRegister(data) {

    const response = await fetch("backend/userRouter.php/register", {
        method: "POST",
        credentials: "include",
        headers: {"Content-Type" : "application/json"},
        body: JSON.stringify(data)
    });
return await response.json();

}


export async function userLogin(data) {
    const response = await fetch("backend/userRouter.php/sign_in", {
        method: "POST",
        credentials: "include",
        headers: { "Content-type" : "application/json"},
        body: JSON.stringify(data)
    })
 return await response.json();
}

export async function getLoggedData() {
    const response = await fetch("backend/userRouter.php/getLoggedData");
    const data = await response.json();
      return data;
}

export async function editOwnUserData(userData) {
    const response = await    fetch("backend/userRouter.php/editUserData", {
        method: "POST",
        headers: {"Content-type" : "application/json"},
        body: JSON.stringify(userData)
})
const data = await response.json();
return data;
}


export async function changePassword(userData) {
const response = await fetch("backend/userRouter.php/changePassword",{
    method: "POST",
    headers: {"Content-Type" : "application/json"},
    body: JSON.stringify(userData)
})
const data = await response.json();
return data;
}


