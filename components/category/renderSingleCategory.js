
// vytvoří odkaz na kategorii v DOMu | první atribut- tag, druhý data kategorie 

export async function renderCurrentCategoryBtn(htmlTag, category) {
    htmlTag.textContent = category["name"];
    htmlTag.setAttribute("href", `category.html?id=${category["id"]}`);
}