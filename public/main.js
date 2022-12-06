//inserts product type-specific attributes via DOM
const form = document.querySelector("form");
const optionContainer = document.createElement("div");
optionContainer.classList.add("option-container");

const dvdOption = `
<div class="formWrapper">
<label for="size" form="product_form">Size(MB):</label>
<input
  class="number"
  type="text"
  form="product_form"
  id="size"
  name="size"
/>
<small></small>
<p>Please provide size in MB</p>
</div>`;

const furnitureOption = `
<div class="formWrapper">
<label for="height" form="product_form">Height(CM):</label>
<input
  class="number"
  type="number"
  form="product_form"
  id="height"
  name="height"
/>
<small></small>
</div>

<div class="formWrapper">
<label for="width" form="product_form">Width(CM):</label>
<input
  class="number"
  type="number"
  form="product_form"
  id="width"
  name="width"
/>
<small></small>
</div>

<div class="formWrapper">
<label for="length" form="product_form">Length(CM):</label>
<input
  class="number" 
  type="number"
  form="product_form"
  id="length"
  name="length"
<small></small>
<p>Please provide dimensions in HxWxL format</p>
</div>
`;

const bookOption = `
<div class="formWrapper">
<label for="weight" form="product_form">Weight(KG):</label>
<input
  class="number"
  type="number"
  form="product_form"
  id="weight"
  name="weight"
/>
<small></small>
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
const isRequired = (value) =>
  value === "" || value === "default" ? false : true;

//checks if sku is A-Z0-9 with length of 6
const isSkuValid = (sku) => {
  const re = /^[a-zA-Z0-9]*$/;
  return re.test(sku) && sku.length === 6;
};

//checks if name is A-Z only
const isNameValid = (name) => {
  const re = /^[a-zA-Z\s]*$/;
  return re.test(name);
};

//checks if amount is at least 0.01
const isMinAmount = (number) => (number < 0.01 ? false : true);

//checks if option has been selected
const isOptionSelected = (option) =>
  option.value === "default" ? false : true;

//Shows error
const showError = (input, message) => {
  input.classList.remove("success");
  input.classList.add("error");
  const error = input.parentElement.querySelector("small");
  error.innerHTML = message;
};

//Shows success
const showSuccess = (input) => {
  input.classList.remove("error");
  input.classList.add("success");
  const error = input.parentElement.querySelector("small");
  error.innerHTML = "";
};

//validates sku
const checkSku = (sku) => {
  let valid = false;
  if (!isRequired(sku.value)) {
    showError(sku, "Please, submit required data");
  } else if (!isSkuValid(sku.value)) {
    showError(sku, "SKU must have a length of 6 characters");
  } else {
    showSuccess(sku);
    valid = true;
  }
  return valid;
};

//validates name
const checkName = (name) => {
  let valid = false;
  if (!isRequired(name.value)) {
    showError(name, "Please, submit required data");
  } else if (!isNameValid(name.value)) {
    showError(name, "Name must consist of characters A-Z");
  } else {
    showSuccess(name);
    valid = true;
  }
  return valid;
};

//validates price, size, weight, height, length, width
let numberInput = document.getElementsByClassName("number");
const checkDigits = (arr) => {
  let valid = false;
  for (item of arr) {
    if (!isRequired(item.value)) {
      showError(item, "Please, submit required data");
    } else if (!isMinAmount(item.value)) {
      showError(item, `${item.id} must be at least 0.01`);
    } else {
      showSuccess(item);
    }
  }
  valid = true;
  return valid;
};

//validates selected option
const checkOption = (option) => {
  let valid = false;
  if (!isRequired(option.value)) {
    showError(option, "Please, submit required data");
  } else {
    showSuccess(option);
    valid = true;
  }
  return valid;
};

//validates number input for instant validation
const checkNumber = (id) => {
  //get element from id
  const number = document.querySelector(`#${id}`);
  if (!isRequired(number.value)) {
    showError(number, "Please, submit required data");
  } else if (!isMinAmount(number.value)) {
    showError(number, `${id} must be at least 0.01`);
  } else {
    showSuccess(number);
  }
};

//instant input validation
form.addEventListener("input", (e) => {
  switch (e.target.id) {
    case "sku":
      checkSku(skuInput);
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
  e.preventDefault();
  //validate form
  let isSkuValid = checkSku(skuInput),
    isNameValid = checkName(nameInput),
    isMinAmount = checkDigits(numberInput),
    isOptionValid = checkOption(optionInput);

  let isFormValid = isSkuValid && isNameValid && isMinAmount && isOptionValid;

  //submit to the server if the form is valid
  if (isFormValid) {
    form.submit();
  }
});
