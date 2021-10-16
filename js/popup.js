var this_cell;
var modal = document.getElementById('id01');
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

const openModal = function (cell) {
    // let form = $('form[name= "edit-element"]');
    // console.log(cell);
    this_cell = cell;
    $('input[name="name"]').val(cell.model.attributes.label);
    $('input:radio[name="status"]').val([cell.model.attributes.status]);
    $('input[name="url"]').val(cell.model.attributes.url);
    $('input[name="description"]').val(cell.model.attributes.description);
    $('textarea[name="notes"]').val(cell.model.attributes.notes);
    $('#last-changed').text(cell.model.attributes.last_changed);
    $('.modal').css('display', 'block');
}

$(function () {
    $('#save-edited-element').click((evt) => {
        evt.preventDefault();
        let label = $('input[name="name"]').val();
        let status = $('input:radio[name="status"]:checked').val();
        let url = $('input[name="url"]').val();
        let description = $('input[name="description"]').val();
        let notes = $('textarea[name="notes"]').val();

        this_cell.model.attributes.label = label;
        this_cell.model.attributes.status = status;
        this_cell.model.attributes.description = description;
        this_cell.model.attributes.url = url;
        this_cell.model.attributes.notes = notes;
        this_cell.model.attributes.last_changed = new Date().toUTCString();
        this_cell.updateBox();

        $('.modal').css('display', 'none');
    })
})