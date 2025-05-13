

export async function fetchHeader() {
    const res = await fetch("./templates/header.html");
     return await res.text();
}



