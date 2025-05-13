


export async function renderProductsInSingleCategory(data) {
    const container = document.getElementById("product_container");
    if(data.error) {
        container.innerHTML = `<p class='text-white fs-5 text-start'>${data.error}</p>`
        };


    data.forEach(element => {
        const div = document.createElement("div");
        container.appendChild(div);
        div.classList.add("col-3");
        div.innerHTML = `<div class='bg-custom-product rounded'>
        <a class='text-decoration-none text-white ' href='product.html?id=${element.id}'>
        <img src='uploads/${element.image_name}' width='100%'>
        <p class='fs-5 pt-2 m-0'>${element.name}</p>
        <p class='fs-6 pb-4'>${element.price}</p>
       </a></div>`;
    });
}