



export async function renderSingleProduct(data) {
    document.querySelector("#productImg").setAttribute("src", `uploads/${data["image_name"]}`);
    document.querySelector("#productName").textContent = data["name"];
    document.querySelector("#description").textContent = data["description"];
    document.querySelector("#price").textContent = data["price"];
    document.querySelector("#productNameHyperlink").textContent = data["name"];
 
}