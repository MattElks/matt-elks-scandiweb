//inserts product type-specific attributes via DOM
const form = document.querySelector("form");
const optionContainer = document.createElement("div");
optionContainer.classList.add("option-container");

const dvdOption = `<label for="size" form="product_form">Size(MB):</label>
<input
  type="text"
  form="product_form"
  formmethod=""
  id="size"
  name="dvdInput"
/>
<p>Please provide size in MB</p>`;

const furnitureOption = `<label for="height" form="product_form">Height(CM):</label>
<input
  type="number"
  form="product_form"
  formmethod=""
  id="height"
  name="heightInput"
/>

<label for="width" form="product_form">Width(CM):</label>
<input
  type="number"
  form="product_form"
  formmethod=""
  id="width"
  name="widthInput"
/>

<label for="length" form="product_form">Length(CM):</label>
<input
  type="number"
  form="product_form"
  formmethod=""
  id="length"
  name="lengthInput"
/>
<p>Please provide dimensions in HxWxL format</p>
`;

const bookOption = `
<label for="weight" form="product_form">Weight(KG):</label>
<input
  type="number"
  form="product_form"
  formmethod=""
  id="weight"
  name="weightInput"
/>
<p>Please provide weight in KG</p>`;

const addAttribute = (value) => {
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
