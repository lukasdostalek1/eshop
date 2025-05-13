



export function addToCartOverlay(orderItem) {
    const overlay = document.getElementById("overlay");
    overlay.classList.remove("d-none");
    
document.getElementById("overlay-product-name").textContent = orderItem["productName"];
document.getElementById("overlay-product-price").textContent = orderItem["productprice"];
document.getElementById("overlay-product-image").setAttribute("src", `uploads/${orderItem["productImage"]}`)
document.getElementById("overlay-product-color").textContent = orderItem["productColor"];
document.getElementById("overlay-product-size").textContent = orderItem["productSize"];
document.getElementById("overlay-product-quantity").textContent = orderItem["quantity"];
document.getElementById("overlay-product-calculateTotal").textContent = orderItem["calculateTotal"];

const closeBtns = document.querySelectorAll(".closeOverlayBtn");
closeBtns.forEach(element => {
    element.addEventListener("click", () =>{
        overlay.classList.add("d-none");
    })
});
}