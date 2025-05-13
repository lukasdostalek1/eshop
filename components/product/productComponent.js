import { fetchAllProducts, fetchProductById } from "../../api/productsApi.js";
import { renderProducts } from "./renderProducts.js";
import { fetchCategoryById } from "../../api/categoriesApi.js";
import { renderCurrentCategoryBtn } from "../category/renderSingleCategory.js";
import { renderSingleProduct } from "./renderSingleProduct.js";
import { setAddToCartForm } from "./setAddToCart.js";
import { getParamsFromUrl } from "../../utils/url.js";
import { insertResponse } from "../../utils/insertResponse.js";

export async function loadUpProducts() {

    const products = await fetchAllProducts();
    if(products.error) {
        insertResponse(products.error);
        console.log(document.getElementById("#responseInfo"))
        return;
    }
    renderProducts(products);
}



export async function loadUpSingleProduct() {
    const productId = getParamsFromUrl("id");

    if (productId < 0) {
      window.location.href="index.html";
  }

  
      const productData = await fetchProductById(productId);
      renderSingleProduct(productData);
  
      const currentCategoryBtn = document.getElementById("categoryNameHyperlink");
      const categoryData = await fetchCategoryById(productData.category_id);
      renderCurrentCategoryBtn(currentCategoryBtn, categoryData);

      const addToCartForm = document.getElementById("addToCart");
      setAddToCartForm(addToCartForm, productId);
}

