// Select Elements
const buttonsConatiner = document.querySelector(".dt-buttons");

const html = `
      <a class="btn select-range-button btn-primary">
        <span>Select</span>
      </a>
      <a class="btn  deselect-range-button btn-primary disabled">
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
function rangeValidation(start, end, size) {
    return start <= end && start > 0 && end <= size;
}
function handleRangeSelction(action) {
    const rows = document.querySelectorAll(".row");
    const size = rows.length;
    const start = fromInput.value || 0;
    const end = toInput.value || 0;

    const isValid = rangeValidation(start, end, size);
    if (isValid) {
        for (let i = start - 1; i < end; i++) {
            const el = rows[i];
            if (action == 'select') {
                el.classList.add('selected');
            } else {
                el.classList.remove('selected');
            }
        }
    }
    else {
        alert("Enter A Valid Range");
    }
}
