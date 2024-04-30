const alert = document.getElementById("alert");

if (alert) {
    setTimeout(function() {
        alert.style.display = 'none';
    }, 6000);
}

document.addEventListener("DOMContentLoaded", function () {
  if (document.getElementById("business-id")) {
    let busId = document.getElementById("business-id");

    function owner () {
        let busIdValue = busId.value;
        let business = new XMLHttpRequest();

        let url = "./json_response/business.php?bus_id=" + busIdValue;
    
        business.open("GET", url, true);
        business.onreadystatechange = function () {
            if (business.readyState === 4 && business.status === 200) {
                
                let businessDetails = JSON.parse(business.responseText);
            
                let ownerId = document.getElementById("owner-id");
                ownerId.value = businessDetails.owner_id;

                let ownerName= document.getElementById("owner-name");
                ownerName.value = businessDetails.owner_name;

                let busName = document.getElementById("bus-name");
                busName.value = businessDetails.bus_name;

                let busType = document.getElementById("bus-type");
                busType.value = businessDetails.bus_type;

                let busAddress = document.getElementById("bus-address");
                busAddress.value = businessDetails.bus_address;

                let busContactNumber = document.getElementById("bus-contact-number");
                busContactNumber.value = businessDetails.bus_contact_number;

                let floorArea = document.getElementById("floor-area");
                floorArea.value = businessDetails.floor_area;

                let signageArea = document.getElementById("signage-area");
                signageArea.value = businessDetails.signage_area;

                let busImg = document.getElementById("bus-img");
                busImg.src = `./../business/images/${businessDetails.bus_img_url??'no-image.png'}`;

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
  }
});

document.addEventListener("DOMContentLoaded", () => {
  let equipmentCategory = document.getElementById("category-id");
  let electricalSection = document.getElementById("electrical-section");
  let mechanicalSection = document.getElementById("mechanical-section");
  let electronicSection = document.getElementById("electronic-section");

  equipmentCategory.addEventListener("change", () => {
    let selectedOption = equipmentCategory.options[equipmentCategory.selectedIndex];
    let equipmentCategoryText = selectedOption.innerText.trim();


    if (equipmentCategoryText === 'Electrical') {
      electricalSection.classList.replace('d-none', 'd-flex');
      electricalSection.querySelector('select').removeAttribute("disabled");
      electricalSection.querySelector('select').setAttribute('required', 'required');

      mechanicalSection.classList.replace('d-flex', 'd-none');
      mechanicalSection.querySelector('select').removeAttribute("required");
      mechanicalSection.querySelector('select').setAttribute('disabled', 'disabled');

      electronicSection.classList.replace('d-flex', 'd-none');
      electronicSection.querySelector('select').removeAttribute("required");
      electronicSection.querySelector('select').setAttribute('disabled', 'disabled');
    } else if (equipmentCategoryText === 'Mechanical') {
      mechanicalSection.classList.replace('d-none', 'd-flex');
      mechanicalSection.querySelector('select').removeAttribute("disabled");
      mechanicalSection.querySelector('select').setAttribute('required', 'required');

      electricalSection.classList.replace('d-flex', 'd-none');
      electricalSection.querySelector('select').removeAttribute("required");
      electricalSection.querySelector('select').setAttribute('disabled', 'disabled');

      electronicSection.classList.replace('d-flex', 'd-none');
      electronicSection.querySelector('select').removeAttribute("required");
      electronicSection.querySelector('select').setAttribute('disabled', 'disabled');
    } else if (equipmentCategoryText === 'Electronic') {
      electronicSection.classList.replace('d-none', 'd-flex');
      electronicSection.querySelector('select').removeAttribute("disabled");
      electronicSection.querySelector('select').setAttribute('required', 'required');

      electricalSection.classList.replace('d-flex', 'd-none');
      electricalSection.querySelector('select').removeAttribute("required");
      electricalSection.querySelector('select').setAttribute('disabled', 'disabled');

      mechanicalSection.classList.replace('d-flex', 'd-none');
      mechanicalSection.querySelector('select').removeAttribute("required");
      mechanicalSection.querySelector('select').setAttribute('disabled', 'disabled');
    }
  });
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

  // Inside the loop where you're adding event listeners for select item buttons
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

                let itemNameInputField = createInputField('text', `item-name-${counter}`, `item_name[]`);
                itemNameContainer.appendChild(itemNameInputField);
                itemNameInputField.value = itemDetails.item_name;

                // Category Field 
                let categoryNameContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                itemContent.appendChild(categoryNameContainer);

                let categoryName = createLabel(`Category`);
                categoryNameContainer.appendChild(categoryName);

                let categoryNameInputField = createInputField('text', `category-name-${counter}`, `category_name[]`);
                categoryNameInputField.readOnly = true; // Disabled
                categoryNameContainer.appendChild(categoryNameInputField);
                categoryNameInputField.value = itemDetails.category_name;

                // Section Field
                let sectionContainer = createContainerDiv('form-group d-flex flex-column flex-md-grow-1');
                itemContent.appendChild(sectionContainer);

                let sectionLabel = createLabel(`Section`);
                sectionContainer.appendChild(sectionLabel);

                let sectionFieldContainer = createContainerDiv('d-flex align-items-center justify-content-center select-container');
                sectionContainer.appendChild(sectionFieldContainer);

                let sectionSelect = document.createElement('select');
                sectionSelect.classList.add('form-control');
                sectionSelect.id = `section-${counter}`;
                sectionSelect.name = 'section[]';
                sectionFieldContainer.appendChild(sectionSelect);

                // Capacity Field
                let capacityContainer = createContainerDiv('form-group d-none flex-column flex-md-grow-1');
                itemContent.appendChild(capacityContainer);

                let capacityLabel = createLabel(`Capacity`);
                capacityContainer.appendChild(capacityLabel);

                let capacityFieldContainer = createContainerDiv('d-flex align-items-center justify-content-center select-container');
                capacityContainer.appendChild(capacityFieldContainer);

                let capacitySelect = document.createElement('select');
                capacitySelect.classList.add('form-control');
                capacitySelect.id = `capacity-${counter}`;
                capacitySelect.name = 'capacity[]';
                capacityFieldContainer.appendChild(capacitySelect);
                

                function updateSections() {
                  var selectedCategory = categoryNameInputField.value;
                  // Make an AJAX request to fetch sections
                  let xhr = new XMLHttpRequest();
                  xhr.open("POST", "./json_response/sections.php", true);
                  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                  xhr.onreadystatechange = function () {
                      if (xhr.readyState === 4 && xhr.status === 200) {
                          let response = JSON.parse(xhr.responseText);

                          // Section Default option
                          let sectionDefaultOption = document.createElement("option");
                          sectionDefaultOption.value = "";
                          sectionDefaultOption.text = "Select";
                          sectionDefaultOption.selected = true;
                          sectionDefaultOption.disabled = true;
                          sectionDefaultOption.hidden = true;
                          sectionSelect.appendChild(sectionDefaultOption);

                   
                          // Populate section select field with fetched sections
                          response.sections.forEach(section => {
                              let option = document.createElement("option");
                              option.value = section;
                              option.text = section;
                              sectionSelect.appendChild(option);
                          });
                      }
                  };
                  // Send selected category as parameter
                  xhr.send(`category=${selectedCategory}`);
                }

                // Call updateSections to populate sections initially
                updateSections();
                
                // Add event listener for section change event
                sectionSelect.addEventListener("change", function () {
                    updateCapacities();
                });

                capacitySelect.addEventListener("change", function () {
                    updateFee();
                });
                
                
                // Quantity and Power Rating Container
                let quantityPowerContainer = createContainerDiv('d-md-flex align-items-center justify-content-center p-0');
                itemContent.appendChild(quantityPowerContainer);

                //Quantity Field
                let quantityContainer = createContainerDiv('col col-md-6 p-0 form-group mb-1 flex-md-grow-1');
                quantityPowerContainer.appendChild(quantityContainer);

                let quantityLabel = createLabel('Quantity');
                quantityContainer.appendChild(quantityLabel);

                let quantityInputField = createInputField('number', `quantity-${counter}`, `quantity[]`, false);
                quantityContainer.append(quantityInputField);

                // Power Rating
                let powerRatingContainer = createContainerDiv('col col-md-6 p-0 form-group mb-1 flex-md-grow-1');
                quantityPowerContainer.appendChild(powerRatingContainer);

                let powerRatingLabel = createLabel('Power Rating');
                powerRatingContainer.appendChild(powerRatingLabel);

                let powerRatingInputField = createInputField('number', `power-rating-${counter}`, `power_rating[]`, false);
                powerRatingContainer.appendChild(powerRatingInputField);

                // Item Fee
                let feeContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                itemContent.appendChild(feeContainer);

                let feeLabel = createLabel('Fee');
                feeContainer.appendChild(feeLabel);

                let feeInputField = createInputField('number', `fee-${counter}`, `fee[]`);
                feeContainer.appendChild(feeInputField);

                // Create and append hidden input elements with unique identifiers
                itemContent.appendChild(createHiddenInput("item_id[]", `item-id-${counter}`, true));

                let billingIdHiddenInput = createHiddenInput("billing_id[]", `billing-id-${counter}`, true)
                itemContent.appendChild(billingIdHiddenInput);

                // Function to update the capacities based on the selected section
                function updateCapacities() {
                  let selectedSection = sectionSelect.value;
                  // Make an AJAX request to fetch capacities
                  let xhr = new XMLHttpRequest();
                  xhr.open("POST", "./json_response/capacities.php", true);
                  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                  xhr.onreadystatechange = function () {
                      if (xhr.readyState === 4 && xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                          
                        capacitySelect.innerHTML = "";

                        capacityContainer.classList.remove('d-none');
                        capacityContainer.classList.add('d-flex');
                        // Capacity Default Option
                        let capacityDefaultOption = document.createElement("option");
                        capacityDefaultOption.value = "";
                        capacityDefaultOption.text = "Select";
                        capacityDefaultOption.selected = true;
                        capacityDefaultOption.disabled = true;
                        capacityDefaultOption.hidden = true;
                        capacitySelect.appendChild(capacityDefaultOption);

                        response.capacities.forEach(capacity => {
                          let option = document.createElement("option");
                          option.value = capacity;
                          option.text = capacity;
                          capacitySelect.appendChild(option);
                        });

                      }
                  };
                  // Send selected section as parameter
                  xhr.send(`section=${selectedSection}`);
                }

                let originalFeeValue;

                function updateFee() {
                  let selectedCapacity = capacitySelect.value;

                  let xhr = new XMLHttpRequest();
                  xhr.open("POST", "./json_response/fee.php", true);
                  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                  xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                      let response = JSON.parse(xhr.responseText);

                        // Store the initial fee value
                        originalFeeValue = parseFloat(response.fee);

                        // Set the fee input field value
                        feeInputField.value = parseFloat(response.fee).toFixed(2);
                        billingIdHiddenInput.value = response.billing_id;
                      }
                    };
                    // Send selected section as parameter
                  xhr.send(`capacity=${selectedCapacity}`);
                }

                quantityInputField.addEventListener("input", function() {
                  calculateTotalFee();
                });

                // Function to calculate total fee
                function calculateTotalFee() {
                    let quantity = parseFloat(quantityInputField.value);
                    let fee = originalFeeValue.toFixed(2);
                    if (isNaN(quantity) || isNaN(fee) || quantity === 0) {
                        // If either quantity or fee is not a number, reset fee input field
                        feeInputField.value = originalFeeValue.toFixed(2);
                    } else {
                        // Calculate total fee and update fee input field
                        let totalFee = quantity * fee;
                        feeInputField.value = totalFee.toFixed(2); // assuming you want to keep it as a float with 2 decimal places
                    }
                }

                // Update input field values with unique identifiers
                document.getElementById(`item-id-${counter}`).value = itemDetails.item_id;

                // Update the displayed count of added items
                updateItemCount(counter);

                // Close the modal
                let modal = bootstrap.Modal.getInstance(wrapper);
                modal.hide();
            }
        };
        item.send();
    });
  }

  // If delete button is available, add event listener to it
  if (deleteItemButton) {
    deleteItemButton.addEventListener("click", function () {
        // Remove the last added item field
        let lastItemTitle = document.getElementById(`item-title-${counter}`);
        let lastItem = document.getElementById(`item-name-${counter}`);
        let lastCategory = document.getElementById(`category-name-${counter}`);
        let lastSection = document.getElementById(`section-${counter}`);
        let lastCapacity = document.getElementById(`capacity-${counter}`);
        let lastQuantity = document.getElementById(`quantity-${counter}`);
        let lastPowerRating = document.getElementById(`power-rating-${counter}`);
        let lastFee = document.getElementById(`fee-${counter}`);
        if (lastItem && lastCategory && lastSection && lastCapacity && lastQuantity && lastPowerRating && lastFee) {
          lastItemTitle.parentElement.remove();
          lastItem.parentElement.remove(); // Remove the container div
          lastCategory.parentElement.remove(); // Remove the container div
          lastSection.parentElement.remove(); // Remove the container div
          lastCapacity.parentElement.remove(); // Remove the container div
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

document.addEventListener("DOMContentLoaded", () => {
  let equipmentCategory = document.getElementById("category-id");
  let electricalSection = document.getElementById("electrical-section");
  let mechanicalSection = document.getElementById("mechanical-section");
  let electronicSection = document.getElementById("electronic-section");

  equipmentCategory.addEventListener("change", () => {
    let selectedOption = equipmentCategory.options[equipmentCategory.selectedIndex];
    let equipmentCategoryText = selectedOption.innerText.trim();


    if (equipmentCategoryText === 'Electrical') {
      electricalSection.classList.replace('d-none', 'd-flex');
      electricalSection.querySelector('select').removeAttribute("disabled");
      electricalSection.querySelector('select').setAttribute('required', 'required');

      mechanicalSection.classList.replace('d-flex', 'd-none');
      mechanicalSection.querySelector('select').removeAttribute("required");
      mechanicalSection.querySelector('select').setAttribute('disabled', 'disabled');

      electronicSection.classList.replace('d-flex', 'd-none');
      electronicSection.querySelector('select').removeAttribute("required");
      electronicSection.querySelector('select').setAttribute('disabled', 'disabled');
    } else if (equipmentCategoryText === 'Mechanical') {
      mechanicalSection.classList.replace('d-none', 'd-flex');
      mechanicalSection.querySelector('select').removeAttribute("disabled");
      mechanicalSection.querySelector('select').setAttribute('required', 'required');

      electricalSection.classList.replace('d-flex', 'd-none');
      electricalSection.querySelector('select').removeAttribute("required");
      electricalSection.querySelector('select').setAttribute('disabled', 'disabled');

      electronicSection.classList.replace('d-flex', 'd-none');
      electronicSection.querySelector('select').removeAttribute("required");
      electronicSection.querySelector('select').setAttribute('disabled', 'disabled');
    } else if (equipmentCategoryText === 'Electronic') {
      electronicSection.classList.replace('d-none', 'd-flex');
      electronicSection.querySelector('select').removeAttribute("disabled");
      electronicSection.querySelector('select').setAttribute('required', 'required');

      electricalSection.classList.replace('d-flex', 'd-none');
      electricalSection.querySelector('select').removeAttribute("required");
      electricalSection.querySelector('select').setAttribute('disabled', 'disabled');

      mechanicalSection.classList.replace('d-flex', 'd-none');
      mechanicalSection.querySelector('select').removeAttribute("required");
      mechanicalSection.querySelector('select').setAttribute('disabled', 'disabled');
    }
  });
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
  let wrapper = document.getElementById("inspector-list");
  let selectInspectorButtons = document.querySelectorAll(".select-inspector");
  let deleteInspectorButton = document.getElementById("delete-inspector");
  let totalInspector = document.getElementById("total-inspector");
  let counter = parseInt(totalInspector.innerText) || 0; // Initialize counter

  // Inside the loop where you're adding event listeners for select inspector buttons
  for (let i = 0; i < selectInspectorButtons.length; i++) {
    selectInspectorButtons[i].addEventListener("click", function (event) {
        event.preventDefault();

        let inspectorId = this.getAttribute("data-inspector-id");

        // Make an AJAX request to fetch the inspector details
        let inspector = new XMLHttpRequest();
        inspector.open("GET", `./json_response/inspector.php?inspector_id=${inspectorId}`, true);
        inspector.onreadystatechange = function () {
            if (inspector.readyState === 4 && inspector.status === 200) {
                let inspectorDetails = JSON.parse(inspector.responseText);

                // Increment counter for each click
                counter++;

                //Inspector Container
                let inspectorContainer = document.getElementById('inspector-container');

                //Inspector Content Container
                let inspectorContent = createContainerDiv('shadow-sm bg-white rounded p-3 mb-2', `inspector-content-${counter}`);
                inspectorContainer.appendChild(inspectorContent);

                let inspectorTitle = createTitle(`Inspector ${counter}`, `inspector-title-${counter}`);
                inspectorContent.appendChild(inspectorTitle);

                // Create and append inspector name container div
                let inspectorNameContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                inspectorContent.appendChild(inspectorNameContainer);

                // Create and append inspector name label
                let inspectorNameLabel = createLabel(`Inspector Name`);
                inspectorNameContainer.appendChild(inspectorNameLabel);

                let inspectorNameInputField = createInputField('text', `inspector-name-${counter}`, `inspector_name[]`);
                inspectorNameContainer.appendChild(inspectorNameInputField);
                inspectorNameInputField.value = inspectorDetails.inspector_name;

                
                // Update input field values with unique identifiers
                inspectorContent.appendChild(createHiddenInput("inspector_id[]", `inspector-id-${counter}`, true));
                document.getElementById(`inspector-id-${counter}`).value = inspectorDetails.inspector_id;

                // Update the displayed count of added inspectors
                updateInspectorCount(counter);

                // Close the modal
                let modal = bootstrap.Modal.getInstance(wrapper);
                modal.hide();
            }
        };
        inspector.send();
    });
  }

  // If delete button is available, add event listener to it
  if (deleteInspectorButton) {
    deleteInspectorButton.addEventListener("click", function () {
        // Remove the last added inspector field
        let lastInspectorTitle = document.getElementById(`inspector-title-${counter}`);
        let lastInspector = document.getElementById(`inspector-name-${counter}`);
        
        if (lastInspector) {
          lastInspectorTitle.parentElement.remove();
            counter--;

          // Update the displayed count of added inspector
          updateInspectorCount(counter);
      }
    });
  }

    // Function to update the count of added inspector
  function updateInspectorCount(count) {
    if (totalInspector) {
        totalInspector.innerHTML = count;
    }
  }
    
});

document.addEventListener("DOMContentLoaded", function () {
  let wrapper = document.getElementById("violation-list");
  let selectViolationButtons = document.querySelectorAll(".select-violation");
  let deleteViolationButton = document.getElementById("delete-violation");
  let totalViolation = document.getElementById("total-violation");
  let counter = parseInt(totalViolation.innerText) || 0; // Initialize counter

  // Inside the loop where you're adding event listeners for select violation buttons
  for (let i = 0; i < selectViolationButtons.length; i++) {
    selectViolationButtons[i].addEventListener("click", function (event) {
        event.preventDefault();

        let violationId = this.getAttribute("data-violation-id");

        // Make an AJAX request to fetch the violation details
        let violation = new XMLHttpRequest();
        violation.open("GET", `./json_response/violation.php?violation_id=${violationId}`, true);
        violation.onreadystatechange = function () {
            if (violation.readyState === 4 && violation.status === 200) {
                let violationDetails = JSON.parse(violation.responseText);

                // Increment counter for each click
                counter++;

                //Violation Container
                let violationContainer = document.getElementById('violation-container');

                //Violation Content Container
                let violationContent = createContainerDiv('shadow-sm bg-white rounded p-3 mb-2', `violation-content-${counter}`);
                violationContainer.appendChild(violationContent);

                let violationTitle = createTitle(`Violation ${counter}`, `violation-title-${counter}`);
                violationContent.appendChild(violationTitle);

                // Create and append violation name container div
                let descriptionContainer = createContainerDiv('col col-12 p-0 form-group mb-1');
                violationContent.appendChild(descriptionContainer);

                // Create and append violation name label
                let descriptionLabel = createLabel(`Description`);
                descriptionContainer.appendChild(descriptionLabel);

                let descriptionInputField = createInputField('text', `description-${counter}`, `description[]`);
                descriptionContainer.appendChild(descriptionInputField);
                descriptionInputField.value = violationDetails.description;

                
                // Update input field values with unique identifiers
                violationContent.appendChild(createHiddenInput("violation_id[]", `violation-id-${counter}`, true));
                document.getElementById(`violation-id-${counter}`).value = violationDetails.violation_id;

                // Update the displayed count of added violations
                updateViolationCount(counter);

                // Close the modal
                let modal = bootstrap.Modal.getInstance(wrapper);
                modal.hide();
            }
        };
        violation.send();
    });
  }

  // If delete button is available, add event listener to it
  if (deleteViolationButton) {
    deleteViolationButton.addEventListener("click", function () {
        // Remove the last added violation field
        let lastViolationTitle = document.getElementById(`violation-title-${counter}`);
        let lastViolation = document.getElementById(`description-${counter}`);
        
        if (lastViolation) {
          lastViolationTitle.parentElement.remove();
            counter--;

          // Update the displayed count of added violation
          updateViolationCount(counter);
      }
    });
  }

    // Function to update the count of added inspector
  function updateViolationCount(count) {
    if (totalViolation) {
        totalViolation.innerHTML = count;
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
