const alert = document.getElementById("alert");

if (alert) {
    setTimeout(function() {
        alert.style.display = 'none';
    }, 6000);
}

document.addEventListener("DOMContentLoaded", function () {
    let busId = document.getElementById("business-id");

    function owner () {
        let busIdValue = busId.value;
        let business = new XMLHttpRequest();

        let url = "./json_response/business.php?bus_id=" + busIdValue;
    
        
        business.open("GET", url, true);
        business.onreadystatechange = function () {
            if (business.readyState === 4 && business.status === 200) {
                
                let ownerDetails = JSON.parse(business.responseText);
            
                let ownerId = document.getElementById("owner-id");
                ownerId.value = ownerDetails.owner_id;

                let ownerName= document.getElementById("owner-name");
                ownerName.value = ownerDetails.owner_name;

                let busType = document.getElementById("bus-type");
                busType.value = ownerDetails.bus_type;

                let busAddress = document.getElementById("bus-address");
                busAddress.value = ownerDetails.bus_address;

                let busContactNumber = document.getElementById("bus-contact-number");
                busContactNumber.value = ownerDetails.bus_contact_number;

                let floorArea = document.getElementById("floor-area");
                floorArea.value = ownerDetails.floor_area;

                let signageArea = document.getElementById("signage-area");
                signageArea.value = ownerDetails.signage_area;

                let carouselItemContainer = document.querySelector(".carousel-item");
                let hiddenElements = carouselItemContainer.querySelectorAll(".d-none");

                hiddenElements.forEach(function(element) {
                    element.classList.remove("d-none");
                });

                
            }
        }
        business.send();
    }

    busId.addEventListener("change", owner);
  
});


// $('#inspectionCarousel').on('slid', '', checkitem);  // on caroussel move
// $('#inspectionCarousel').on('slid.bs.carousel', '', checkitem); // on carousel move


// function checkitem() {
//     var $this = $('#inspectionCarousel');
//     if ($('.carousel-inner .carousel-item:first').hasClass('active')) {
//         // Hide next arrow
//         $this.children('.previous').hide();
//         // But show previous arrow
//         $this.children('.next').show();
//     } else if ($('.carousel-inner .carousel-item:last').hasClass('active')) {
//         // Hide next arrow
//         $this.children('.next').hide();
//         // But show previous arrow
//         $this.children('.previous').show();
//     } else {
//         $this.children('.carousel-button').show();
//     }
// }


document.addEventListener("DOMContentLoaded", function () {
  let wrapper = document.getElementById("item-list");
  let selectItemButtons = document.querySelectorAll(".select-item");
  let deleteItemButton = document.getElementById("delete-item");
  let totalItem = document.getElementById("total-item");
  let counter = parseInt(totalItem.innerText) || 0; // Initialize counter

  for (let i = 0; i < selectItemButtons.length; i++) {
      selectItemButtons[i].addEventListener("click", function (event) {
          event.preventDefault();
  
          let itemId = this.getAttribute("data-item-id");
  
          // Make an AJAX request to fetch the item details
          let item = new XMLHttpRequest();
          item.open("GET", `./json_response/item.php?item_id=${itemId}`, true);
          item.onreadystatechange = function () {
              if (item.readyState === 4 && item.status === 200) {
                  let itemDetails = JSON.parse(item.responseText);
  
                  // Increment counter for each click
                  counter++;
  
                  //Item Container
                  let itemContainer = document.getElementById('item-container');
                  
                  //Item Content Container
                  let itemContent = createContainerDiv('shadow-sm bg-white rounded p-3 mb-2', `item-content-${counter}`);
                  itemContainer.appendChild(itemContent);

                  let itemTitle = createTitle(`Item ${counter}`, `item-title-${counter}`);
                  itemContent.appendChild(itemTitle);
                  // Create and append item name container div
                  let itemNameContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                  itemContent.appendChild(itemNameContainer);
  
                  // Create and append item name label
                  let itemNameLabel = createLabel(`Item Name`);
                  itemNameContainer.appendChild(itemNameLabel);
  
                  // Create and append input field with unique identifier
                  let itemNameInputField = createInputField('text', `item-name-${counter}`, `item_name[]`);
                  itemNameContainer.appendChild(itemNameInputField);
                  itemNameInputField.value = itemDetails.item_name;

                  // Category Field 
                  let categoryNameContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                  itemContent.appendChild(categoryNameContainer); 

                  let categoryName = createLabel(`Category`);
                  categoryNameContainer.appendChild(categoryName);
  
                  // Create and append input field with unique identifier
                  let categoryNameInputField = createInputField('text', `category-name-${counter}`, `category_name[]`);
                  categoryNameContainer.appendChild(categoryNameInputField);
                  categoryNameInputField.value = itemDetails.category_name;

                  //Quantity Field
                  let quantityContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                  itemContent.appendChild(quantityContainer);

                  let quantityLabel = createLabel('Quantity');
                  quantityContainer.appendChild(quantityLabel);

                  let quantityInputField = createInputField('number', `quantity-${counter}`, `quantity[]`, false);
                  quantityContainer.append(quantityInputField);

                  // Power Rating
                  let powerRatingContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                  itemContent.appendChild(powerRatingContainer);

                  let powerRatingLabel = createLabel('Power Rating');
                  powerRatingContainer.appendChild(powerRatingLabel);

                  let powerRatingInputField = createInputField('number', `power-rating-${counter}`, `power_rating[]`, false);
                  powerRatingContainer.appendChild(powerRatingInputField);
  
                  // Item Fee
                  let feeContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                  itemContent.appendChild(feeContainer);

                  let feeLabel = createLabel('Fee');
                  feeContainer.appendChild(feeLabel);

                  let feeInputField = createInputField('number', `fee-${counter}`, `fee[]`, false);
                  feeContainer.appendChild(feeInputField);
  

                  // Create and append hidden input elements with unique identifiers
                  itemContent.appendChild(createHiddenInput("item_id[]", `item-id-${counter}`, true));
                  // Update input field values with unique identifiers
                  document.getElementById(`item-id-${counter}`).value = itemDetails.item_id;
  
                  // Update the displayed count of added items
                  updateItemCount(counter);

                  // Close the modal
                  let modal = bootstrap.Modal.getInstance(wrapper);
                  modal.hide();

                  // Add event listener to item title for toggling visibility
                  // itemTitle.addEventListener("click", function () {
                  //     itemNameInputField.style.display = (itemNameInputField.style.display === "none") ? "block" : "none";
                  //     categoryNameInputField.style.display = (categoryNameInputField.style.display === "none") ? "block" : "none";
                  //     quantityInputField.style.display = (quantityInputField.style.display === "none") ? "block" : "none";
                  // });
              }
          };
          item.send();
      });
  }

  if (deleteItemButton) {
      deleteItemButton.addEventListener("click", function () {
      // Remove the last added item field
      let lastItemTitle = document.getElementById( `item-title-${counter}`)
      let lastItem = document.getElementById(`item-name-${counter}`);
      let lastCategory = document.getElementById(`category-name-${counter}`);
      let lastQuantity = document.getElementById(`quantity-${counter}`);
      let lastPowerRating = document.getElementById(`power-rating-${counter}`);
      let lastFee = document.getElementById(`fee-${counter}`);
      if (lastItem && lastCategory && lastQuantity && lastPowerRating && lastFee) {
        lastItemTitle.parentElement.remove();
        lastItem.parentElement.remove(); // Remove the container div
        lastCategory.parentElement.remove(); // Remove the container div
        lastQuantity.parentElement.remove(); // Remove the container div
        lastPowerRating.parentElement.remove(); // Remove the container div
        lastFee.parentElement.remove(); // Remove the container div
        counter--;

        // Update the displayed count of added items
        updateItemCount(counter);
      }
    });
  }

  // Function to update the count of added items
  function updateItemCount(count) {
    if (totalItem) {
      totalItem.innerHTML = count;
    }
  }
});

function createContainerDiv(className, id = "") {
  const div = document.createElement('div');
  div.className = className;
  div.id = id
  return div;
}

function createLabel(text) {
  const label = document.createElement('label');
  label.textContent = text;
  label.innerHTML += ' <strong style="color:red;">*</strong>';
  return label;
}

function createInputField(type, id, name, readOnly = true, required = true) {
  const input = document.createElement('input');
  input.type = type;
  input.name = name;
  input.id = id;
  input.className = 'form-control p-4';
  input.readOnly = readOnly;
  input.required = required;

  if (type === "number") {
    if (name === "quantity[]") {
      input.value = 1;
      input.step = 1;
    } else if (name === "power_rating[]" || name === "fee[]") {
      input.value = parseFloat(1.00).toFixed(2);
      input.step = 0.01;
    }
  
  }
  return input;
}

function createTitle(itemTitle, id) {
  const title = document.createElement("a");
  title.innerHTML = itemTitle;
  title.id = id;
  title.className = "text"; // class assignment
  title.style.cursor = "pointer";
  title.style.textDecorationStyle = "none";
  title.style.fontWeight = 700;
  return title;
}

function createHiddenInput(name, id, required = false) {
  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = name;
  input.id = id;
  if (required) {
    input.required = true;
  }
  return input;
}


// document.addEventListener('DOMContentLoaded', function () {
//     // Get reference to the carousel
//     var carousel = document.getElementById('inspectionCarousel');

//     // Get references to the previous and next buttons
//     var prevButton = carousel.querySelector('.carousel-button.previous');
//     var nextButton = carousel.querySelector('.carousel-button.next');

//     // Add event listener to the carousel
//     carousel.addEventListener('slid.bs.carousel', function (event) {
//         var currentIndex = event.to; // Get the index of the current slide

//         // Show/hide previous button based on current slide
//         if (currentIndex === 0) {
//             prevButton.style.display = 'none';
//         } else {
//             prevButton.style.display = 'block';
//         }

//         // Show/hide next button based on current slide
//         if (currentIndex === event.relatedTarget.length - 1) {
//             nextButton.style.display = 'none';
//         } else {
//             nextButton.style.display = 'block';
//         }
//     });

//     // Trigger the event to initially hide/show the buttons
//     carousel.dispatchEvent(new Event('slid.bs.carousel'));
// });