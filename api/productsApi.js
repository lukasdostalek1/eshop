


export async function fetchAllProducts() {
    const response = await fetch("backend/productRouter.php/getAllProducts");
    const data = await response.json();
    return data;
}

export async function fetchProductById(productId) {
    const response = await fetch(`backend/productRouter.php/getProductById?id=${productId}`);
    const data = await response.json();
    return data;
}


export async function addProduct(formData) {
    const response = await fetch("backend/productRouter.php/addProduct", {
        method: "POST",
        body: formData
    })
    const data = response.json();
    return data;
}



export async function fetchProductsByCategoryId(categoryId) {
    const response = await fetch(`backend/productRouter.php/getProductsByCategoryId?id=${categoryId}`);
   const data = await response.json();
    return data;
}