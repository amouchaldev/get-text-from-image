// vars
let result = document.querySelector(".result"),
  img_result = document.querySelector(".img-result"),
  img_w = document.querySelector(".img-w"),
  img_h = document.querySelector(".img-h"),
  options = document.querySelector(".options"),
  save = document.querySelector(".save"),
  cropped = document.querySelector(".cropped"),
  convert = document.querySelector(".convert"),
  upload = document.querySelector("#file-input"),
  cropper = "";

// on change show image with crop options
if (upload) {
  upload.addEventListener("change", (e) => {
    if (e.target.files.length) {
      // start file reader
      const reader = new FileReader();
      reader.onload = (e) => {
        if (e.target.result) {
          // create new image
          let img = document.createElement("img");
          img.id = "image";
          img.src = e.target.result;
          // clean result before
          result.innerHTML = "";
          // append new image
          result.appendChild(img);
          // show save btn and options
          save.classList.remove("hide");
          // options.classList.remove('hide');
          // init cropper
          cropper = new Cropper(img);
        }
      };
      reader.readAsDataURL(e.target.files[0]);
      convert.classList.remove("d-none");
      document.querySelectorAll(".box-2")[0].classList.remove("d-none");

      save.classList.remove("d-none");
    }
  });
}
// save on click
if (save) {
  let counter = 1;
  save.addEventListener("click", (e) => {
    e.preventDefault();
    // get result to data uri
    let imgSrc = cropper
      .getCroppedCanvas({
        width: img_w.value, // input value
      })
      .toDataURL();
    // remove hide class of img
    img_result.classList.remove("hide");
    document.querySelectorAll(".box-2")[1].classList.remove("d-none");
    // Get a reference to our file input
    const fileInput = document.createElement("input");
    fileInput.type = "file";
    fileInput.name = "images[]";
    img_result.innerHTML += `
          <div class="position-relative cropped-img me-1 overflow-hidden">
              <img src="${imgSrc}" class="cropped w-100" />
              <input type="hidden" name="image-${counter++}" value="${imgSrc}" />
              <a href="${imgSrc}" download="image.png" class=" position-absolute dwn-icon"><i class="fa-solid fa-cloud-arrow-down text-dark"></i></a>
              <i class="fa-solid fa-trash text-dark position-absolute del-icon" onclick="this.parentElement.remove()"></i>
          </div>
        `;
  });
}
if (convert) {
  convert.addEventListener("click", (e) => {
    e.preventDefault();
    if (!img_result.children.length) return Swal.fire("there is no image !");
    document.querySelector("form").submit();
  });
}