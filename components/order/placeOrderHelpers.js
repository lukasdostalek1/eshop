import { insertResponse } from "../../utils/insertResponse.js";


export function fillUpDeliveryInfo(name, surname, email) {
    document.getElementById("name").value = name;
   document.getElementById("surname").value = surname;
   document.getElementById("email").value = email;
}


export function bindOrderStepBtns() {


     const goToPaymentStepBtn = document.getElementById("goToPaymentStep");
        const deliveryInfoStepBack = document.getElementById("deliveryInfoStepBack");

        const deliveryInfoPart = document.getElementById("deliveryInformations");
        const paymentMethodPart = document.getElementById("paymentMethod");

        goToPaymentStepBtn.addEventListener("click", ()=> {
            if(!checkDeliveryInfoStep()) {
                return;
            }
            toggleOrderSteps(deliveryInfoPart, paymentMethodPart);
        });

        deliveryInfoStepBack.addEventListener("click", ()=> {
            toggleOrderSteps(deliveryInfoPart, paymentMethodPart);
        })


}





function checkDeliveryInfoStep() {
            const name = document.getElementById("name").value;
            const surname = document.getElementById("surname").value;
            const email = document.getElementById("email").value;
            const street = document.getElementById("street").value;
            const street_number = document.getElementById("street_number").value;
            const city = document.getElementById("city").value;
            const zip_code = document.getElementById("zip_code").value;
            const terms = document.getElementById("terms");


            if(!name || !surname ||!email || !street || !street_number || !city || !zip_code) {
                insertResponse("Nejsou vyplněna všechna povinná pole.");
                return;
            }
            if(!terms.checked) {
                insertResponse("Musíte souhlasit s podmínkami.");
                return;
            }
            return true;
}


function toggleOrderSteps(firstForm, secondForm) {
    firstForm.classList.toggle("d-none");
    secondForm.classList.toggle("d-none");

}

