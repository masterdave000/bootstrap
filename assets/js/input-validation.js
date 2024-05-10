function fnameValidation (fname) {
    if (document.getElementById(fname)) {
        let fnameInput = document.getElementById(fname);

        fnameInput.addEventListener('input', () => {
            const fnameValue = fnameInput.value.trim();
            if (fnameValue === '') {
              fnameInput.setCustomValidity('Please enter a value. Avoid inputting whitespaces');
            } else if (/^[0-9]+$/.test(fnameValue)) {
              fnameInput.setCustomValidity('Numbers are not allowed.');
            } else if (/^[~`!@#$%^&*()_=+[\]{}|;:'",<>/?]+$/.test(fnameValue)) {
              fnameInput.setCustomValidity('Special Characters are not allowed.');
            } else if (!/^[a-zA-Z\s-.ñÑ]+$/.test(fnameValue)) {
              fnameInput.setCustomValidity('Numbers and Special Characters are not allowed.');
            } else {
              fnameInput.setCustomValidity('');
            }
          });
    }
}

fnameValidation('inspector-firstname');
fnameValidation('owner-firstname');

function lnameValidation (lname) {
    if (document.getElementById(lname)) {
        let lnameInput = document.getElementById(lname);

        lnameInput.addEventListener('input', () => {
            const lnameValue = lnameInput.value.trim(); 
            if (lnameValue === '') {
              lnameInput.setCustomValidity('Please enter a value. Avoid inputting whitespaces');
            } else if (/^[0-9]+$/.test(lnameValue)) {
              lnameInput.setCustomValidity('Numbers are not allowed.');
            } else if (/^[~`!@#$%^&*()_=+[\]{}|;:'",<>/?]+$/.test(lnameValue)) {
              lnameInput.setCustomValidity('Special Characters are not allowed.');
            } else if (!/^[a-zA-Z\s-.ñÑ]+$/.test(lnameValue)) {
              lnameInput.setCustomValidity('Numbers and Special Characters are not allowed.');
            } else {
              lnameInput.setCustomValidity('');
            }
          });
    }
}

lnameValidation('inspector-lastname');
lnameValidation('owner-lastname');

