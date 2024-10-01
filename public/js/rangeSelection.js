'use strict'
const buttonsConatiner = document.querySelector(".dt-buttons");

const html = `
          <a class="btn select-range-button btn-primary text-white">
            <span>Select</span>
          </a>
          <a class="btn deselect-range-button btn-primary text-white">
            <span>Deselect</span>
          </a>
          <input
            type="number"
            name="from"
            id="fromField"
            placeholder="From"
            min="1"
          />
          <input type="number" name="To" id="toField" placeholder="To" min="1" />
    `
buttonsConatiner.insertAdjacentHTML("beforeend", html);

//Select Elemtns
const fromInput = document.querySelector("#fromField");
const toInput = document.querySelector("#toField");
const selectBtn = document.querySelector(".select-range-button");
const deselectBtn = document.querySelector(".deselect-range-button");

selectBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleRangeSelction('select');
});
deselectBtn.addEventListener('click', function (e) {
    e.preventDefault();
    handleRangeSelction('deselect');
});

function handleRangeSelction(action) {
    const table = $('.datatable-Team').DataTable();
    const rows = table.rows({ 'search': 'applied' }).nodes(); // Get the filtered rows
    // const rows = document.querySelectorAll('tbody .select-checkbox');
    const size = rows.length;
    const start = parseInt(fromInput.value, 10);
    const end = parseInt(toInput.value, 10);


    const isValid = start <= end && start > 0 && end <= size;
    if (isValid) {

        for (let i = start - 1; i < end; i++) {
            const row = rows[i];
            const checkbox = row.querySelector('.select-checkbox');
            console.log(checkbox);
            if (checkbox) {
                const event = new Event('click');
                checkbox.dispatchEvent(event);
            } else {
                console.error('There No Checkbox');
            }
        }
    }
    else {
        alert("Enter A Valid Range");
    }
}
function rangeValidation(start, end, size) {
    return start <= end && start > 0 && end <= size;
}
