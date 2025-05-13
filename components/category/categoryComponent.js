import { fetchProductsByCategoryId } from "../../api/productsApi.js";
import { renderProductsInSingleCategory } from "../product/renderProductsInSingleCategory.js";
import { renderCategoryNameInSingleCategory } from "../category/renderCategoryNameInSingleCategory.js";
import { fetchCategoryById } from "../../api/categoriesApi.js";
import { getParamsFromUrl } from "../../utils/url.js";

export async function loadCategoryPage() {

      const categoryId = getParamsFromUrl("id");
    
      if (categoryId < 0) {
         window.location.href="index.html";
        }
    

        const productsFilteredByCategory = await fetchProductsByCategoryId(categoryId);
        renderProductsInSingleCategory(productsFilteredByCategory);
        const categoryData = await fetchCategoryById(categoryId);
        renderCategoryNameInSingleCategory(categoryData);

}