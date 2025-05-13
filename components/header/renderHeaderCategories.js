


export async function renderHeaderCategories(categoriesList) {
    const container = document.getElementById("innerHeaderCategoriesList");

    categoriesList.forEach(element =>{
        const li = document.createElement("li");
        container.appendChild(li);
        li.innerHTML = `<a class='text-white text-decoration-none' href='category.html?id=${element.id}'>${element.name}</a>`;
        li.classList.add("btn", "btn-secondary");
    })
}