let check = document.querySelector("#check");
let password = document.querySelector("#password");

check.addEventListener("change", () => {
   if(check.checked) {
      password.type = "text";
   } else {
    password.type = "password";
   }
});