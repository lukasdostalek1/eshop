

export async function fetchCategories() {
    const response = await fetch("backend/categoryRouter.php/getAllCategories");
    const data = await response.json();
    return data;
};


export async function fetchCategoryById(categoryId) {
    const response = await fetch(`backend/categoryRouter.php/getCategoryById?id=${categoryId}`);
    const data = await response.json();
    return data;
}


export async function addCategory(name) {
    const response = await fetch("backend/categoryRouter.php/addCategory", {
        method: "POST",
        body: JSON.stringify(name)
    })
    const data = await response.json();
    return data;
}