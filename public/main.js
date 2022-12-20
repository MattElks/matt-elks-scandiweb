//inserts product type-specific attributes via DOM
const form = document.querySelector("form");
const optionContainer = document.createElement("div");
optionContainer.classList.add("option-container");

const dvdOption = `
<div class="formWrapper">
<label for="size" form="product_form">Size(MB):</label>
<input
required
  class="number"
  type="number"
  form="product_form"
  id="size"
  name="size"
/>

<p>Please provide size in MB</p>
</div>`;

const furnitureOption = `
<div class="formWrapper">
<label for="height" form="product_form">Height(CM):</label>
<input
required
  class="number"
  type="number"
  form="product_form"
  id="height"
  name="height"
/>

</div>

<div class="formWrapper">
<label for="width" form="product_form">Width(CM):</label>
<input
required
  class="number"
  type="number"
  form="product_form"
  id="width"
  name="width"
/>

</div>

<div class="formWrapper">
<label for="length" form="product_form">Length(CM):</label>
<input
required
  class="number" 
  type="number"
  form="product_form"
  id="length"
  name="length"

<p>Please provide dimensions in HxWxL format</p>
</div>
`;

const bookOption = `
<div class="formWrapper">
<label for="weight" form="product_form">Weight(KG):</label>
<input
required
  class="number"
  type="number"
  form="product_form"
  id="weight"
  name="weight"
/>

<p>Please provide weight in KG</p>`;

const addInputField = (value) => {
  switch (value) {
    case "default":
      optionContainer.remove();
      break;
    case "DVD":
      optionContainer.innerHTML = dvdOption;
      optionContainer.setAttribute("id", "DVD");
      form.append(optionContainer);
      break;
    case "Furniture":
      optionContainer.innerHTML = furnitureOption;
      optionContainer.setAttribute("id", "Furniture");
      form.append(optionContainer);
      break;
    case "Book":
      optionContainer.innerHTML = bookOption;
      optionContainer.setAttribute("id", "Book");
      form.append(optionContainer);
      break;
  }
};

//Form validation
const skuInput = document.querySelector("#sku");
const nameInput = document.querySelector("#name");
const priceInput = document.querySelector("#price");

const optionInput = document.querySelector("#productType");

//checks if input is empty
const isRequired = (value) => (value === "" ? false : true);

//checks if name is A-Z only
const isNameValid = (name) => {
  const re = /^[a-zA-Z]+( [a-zA-Z]+)*$/; //
  return re.test(name);
};

//checks if amount is at least 0.01
const isMinAmount = (number) => (number < 0.01 ? false : true);

//checks if option has been selected
const isOptionSelected = (option) =>
  option == "DVD" || "Book" || "Furniture" ? true : false;

//Shows error
const showError = (input) => {
  input.classList.remove("success");
  input.classList.add("error");
};

//Shows success
const showSuccess = (input) => {
  input.classList.remove("error");
  input.classList.add("success");
};

//validates sku input
const checkSku = (sku) => {
  const re = /^[a-zA-Z0-9]+$/;
  if (re.test(sku.value)) {
    showSuccess(sku);
    sku.setCustomValidity("");
  } else {
    showError(sku);
    sku.setCustomValidity("Please, submit required data");
  }
};

//checks for unique sku need instant validation
const validateSku = (sku) => {
  fetch("/api/read-product")
    .then((response) => response.json())
    .then((data) => {
      let skuArr = data.map((e) => e.sku);
      if (skuArr.includes(sku.value)) {
        const message = sku.parentElement.querySelector("small");
        message.innerHTML = "SKU already exists";
        sku.setCustomValidity("SKU already exists");
        showError(sku);
      } else {
        const message = sku.parentElement.querySelector("small");
        message.innerHTML = "";
        sku.setCustomValidity("");
        showSuccess(sku);
      }
    });
};

//validates name
const checkName = (name) => {
  if (!isRequired(name.value)) {
    name.setCustomValidity("Please, submit required data");
    showError(name);
  } else if (!isNameValid(name.value)) {
    name.setCustomValidity("Name must consist of characters A-Z only");
    showError(name);
  } else {
    name.setCustomValidity("");
    showSuccess(name);
  }
};

//validates price, size, weight, height, length, width
let numberInput = document.getElementsByClassName("number");
const checkDigits = (arr) => {
  for (item of arr) {
    if (!isRequired(item.value)) {
      item.setCustomValidity("Please, submit required data");
      showError(item);
    } else if (!isMinAmount(item.value)) {
      item.setCustomValidity(`${item.id} must be at least 0.01`);
      showError(item);
    } else {
      item.setCustomValidity("");
      showSuccess(item);
    }
  }
};

//validates selected option
const checkOption = (option) => {
  let selectedOption = option.options[option.selectedIndex].value;
  if (selectedOption === "") {
    showError(option);
  } else {
    showSuccess(option);
  }
};

//validates number
const checkNumber = (id) => {
  const number = document.querySelector(`#${id}`);
  if (!isRequired(number.value)) {
    number.setCustomValidity("Please, submit required data");
    showError(number);
  } else if (!isMinAmount(number.value)) {
    number.setCustomValidity(`${id} must be at least 0.01`);
    showError(number);
  } else {
    number.setCustomValidity("");
    showSuccess(number);
  }
};

//instant input validation
form.addEventListener("input", (e) => {
  e.preventDefault();
  switch (e.target.id) {
    case "sku":
      checkSku(skuInput);
      validateSku(skuInput);
      break;
    case "name":
      checkName(nameInput);
      break;
    case "productType":
      checkOption(optionInput);
    case "price":
    case "size":
    case "height":
    case "width":
    case "length":
    case "weight":
      checkNumber(e.target.id);
      break;
  }
});

//validates form
form.addEventListener("submit", (e) => {
  if (!form.checkValidity()) {
    e.preventDefault();
    e.stopPropagation();
  }
});
