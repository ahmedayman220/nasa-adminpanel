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

// Select Elements
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
    const rows = table.rows({ search: 'applied' }); // Get only visible rows after filtering
    const size = rows.count(); // Get total number of rows
    const rowIndexes = rows.indexes().toArray(); // Convert row indexes to an array

    const start = parseInt(fromInput.value, 10);
    const end = parseInt(toInput.value, 10);

    const isValid = start <= end && start > 0 && end <= size;
    if (isValid) {
        for (let i = start - 1; i < end; i++) {
            const rowIndex = rowIndexes[i]; // Get the row index
            const row = table.row(rowIndex); // Get row instance by index

            if (action === 'select') {
                row.select(); // Select the row
                console.log(`SELECTED row ${i + 1}`);
            } else {
                row.deselect(); // Deselect the row
                console.log(`DESELECTED row ${i + 1}`);
            }
        }
    } else {
        alert("Enter A Valid Range");
    }
}
