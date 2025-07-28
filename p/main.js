// const products = [
//   {
//     title: "Rajan Khalifa",
//     description: "Used rajan can be reusable. It is one of the most important things in the world. Mia Khalifa is a Lebanese-American media personality and former adult film actress who gained significant attention in 2014. Despite having a brief career, she became one of the most searched figures online due to a controversial video involving a hijab.",
//     price: 500,
//     images: ["images/rajan khalifa.jpg", "images/rajan beti.jpg"]
//   },
//   {
//     title: "NOTHING",
//     description: "5 STAR.",
//     price: 300,
//     images: ["images/CHACHA.jpg", "images/Andhera kayam ho.jpg"]
//   }
// ];




let xhr = new XMLHttpRequest();
xhr.open("GET", "/src/index.php/explore");
xhr.setRequestHeader("Content-Type", "application/json");

// let data = JSON.stringify(obj);

xhr.send();

xhr.onload = (ev) => {
    let resp=  JSON.parse(ev.target.response);
  console.log(resp);
    // console.log(ev.target.response);
if (Array.isArray(resp)) {
  resp.forEach(renderProductCard);  
}
};





// Add product cards to the page
const productList = document.getElementById('product-list');

function renderProductCard(product) {
  const card = document.createElement('div');
  card.className = 'card';
  console.log(product);
//new line added
  // card.href = `product-detail.html?title=${encodeURIComponent(product.title)}&description=${encodeURIComponent(product.description)}&price=${product.price}&image=${encodeURIComponent(product.images[0])}`;
//upto here
  // const imagesHTML = product.img.map(src => `<img src="${src}" alt="Product Image">`).join('');
  const imagesHTML=`<img src="${product.img[0]}" alt="Product Image">`;

  card.innerHTML = `
    <div class="card-images">
      ${imagesHTML}
    </div>
    <div class="card-content">
      <h3>${product.title}</h3>
      <p class="description">${product.description}</p>
      <div class="price">NPR ${product.price}</div>
    </div>
  `;
  productList.appendChild(card);
}

// Render initial products
// products.forEach(renderProductCard);









// Toggle form visibility
function toggleForm() {
  const form = document.getElementById('create-form');
  form.style.display = form.style.display === 'none' ? 'block' : 'none';
}



//form upload


document.getElementById("uploadform").addEventListener("submit", function (e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);



  formData.append('sellerid',localStorage.getItem("sellerid"));
  formData.append('contact',localStorage.getItem("contact"));


  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../src/index.php", true);

  xhr.onload = function () {
    try {
      const res = JSON.parse(xhr.responseText);
      console.log("Response from PHP:", res);
    } catch (err) {
      console.error("Error parsing JSON:", err, xhr.responseText);
    }
  };

  xhr.send(formData);
});


















// Create new product
function createProduct() {
  const title = document.getElementById('title').value.trim();
  const description = document.getElementById('description').value.trim();
  const price = parseFloat(document.getElementById('price').value);
  const imageFiles = document.getElementById('images').files;

  if (!title || !description || isNaN(price) || imageFiles.length === 0) {
    alert("Please fill in all fields and upload at least one image.");
    return;
  }

  // const imageReaders = [];
  // for (let i = 0; i < imageFiles.length; i++) {
  //   const reader = new FileReader();
  //   imageReaders.push(new Promise((resolve) => {
  //     reader.onload = () => resolve(reader.result);
  //     reader.readAsDataURL(imageFiles[i]);
  //   }));
  // }

  // Promise.all(imageReaders).then(imageData => {
  //   const newProduct = {
  //     title,
  //     description,
  //     price,
  //     images: imageData
  //   };
  //   renderProductCard(newProduct);

  //   // Clear form
  //   document.getElementById('title').value = '';
  //   document.getElementById('description').value = '';
  //   document.getElementById('price').value = '';
  //   document.getElementById('images').value = '';
  //   toggleForm();
  // });
}
