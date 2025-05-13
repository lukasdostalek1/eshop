

export function renderHeaderUserArea(isLoggedIn, role) {
    const innerHeaderSection = document.getElementById("innerHeaderSection");

    if(!isLoggedIn) {
    innerHeaderSection.innerHTML = `  <a class="btn btn-primary" href="sign-up.html" class="my-auto">REGISTRACE</a>
            <a class="btn btn-primary" href="sign-in.html" class="my-auto">PŘIHLÁŠENÍ</a>
            ${cartDropDown()}`;
    }
    if(isLoggedIn && role == 0) {
        innerHeaderSection.innerHTML = `  <div id="responseHeaderInfo"></div>
           <a class='btn btn-success' href='admin_orders.html'>OBJEDNÁVKY <span id='orderCounter'></span></a>
            <a class="btn btn-primary" href="edit-profile.html">UPRAVIT PROFIL</a>
             <button class="btn btn-primary" id="logOut">ODHLÁSIT SE</button>
             ${cartDropDown()}`;
    }
    if (isLoggedIn && role == 1) {
        innerHeaderSection.innerHTML =  ` <div id="responseHeaderInfo"></div>
        <a class='btn btn-success' href='admin_orders.html'>OBJEDNÁVKY <span id='orderCounter'></span></a>
        <a class='btn btn-primary  mx-1 btn-primary' href="add_product_or_category.html">PŘIDAT PRODUKT/KATEGORII</a>
         <a  class='btn btn-primary mx-1  btn-primary'href="edit-profile.html">UPRAVIT PROFIL</a>
         <button class='btn mx-1  btn-primary' id="logOut">ODHLÁSIT SE</button>`;
    }

    function cartDropDown() {
        return ` <div class="dropdown" id="headerCart">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
            data-bs-toggle="dropdown" aria-expanded="false">
            KOŠÍK (<span id="itemsCount"></span>)
            </button>
            <div aria-labelledby="dropdownMenuButton" class="dropdown-menu bg-custom-product p-3 text-center mt-4">
            <ul class="list-unstyled" id="headerCartDropDown" style="width: 15em;"> 
            </ul>
            <a href='cart.html' id='moveToCartBtn' class='btn btn-primary d-none'>Přejít do košíku</a>
            </div>
        </div>`;
    }

    }


