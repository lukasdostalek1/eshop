


export function getCart() {
    const cart = JSON.parse(localStorage.getItem("cart"));
    if(cart) {
        return cart;
    }
    return [];
}

export function addToCart(orderItem) {
    const cart = getCart();
    cart.push(orderItem);
    localStorage.setItem("cart", JSON.stringify(cart));
}



export function removeFromCart(index) {
    const cart = getCart();
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
}

export function removeEverythingFromCart() {
    localStorage.removeItem("cart");
}

