function confirm_delete(event) {
    event.preventDefault();
    const form = event.currentTarget.closest('.delete__form');
    const url = form.getAttribute('action');
    Swal.fire({
        title: 'ნამდვილად გსურთ წაშლა',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'დიახ',
        cancelButtonText: 'არა'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

/**
 * Select Multiple Selector
 * Set Dropdown with SearchBox via dropdownAdapter option
 */
const Utils = $.fn.select2.amd.require('select2/utils');
const Dropdown = $.fn.select2.amd.require('select2/dropdown');
const DropdownSearch = $.fn.select2.amd.require('select2/dropdown/search');
const CloseOnSelect = $.fn.select2.amd.require('select2/dropdown/closeOnSelect');
const AttachBody = $.fn.select2.amd.require('select2/dropdown/attachBody');

const dropdownAdapter = Utils.Decorate(Utils.Decorate(Utils.Decorate(Dropdown, DropdownSearch), CloseOnSelect), AttachBody);

$("#user__select").select2({
    dropdownAdapter: dropdownAdapter,
    minimumResultsForSearch: 0,
    placeholder: "აირჩიეთ მომხმარებელი",
    allowClear: false,
    multiple: false,
    disabled: false,
    "language": {
        "noResults": function () {
            return "მსგავსი მომხმარებელი არ მოიძებნა";
        }
    },
}).on('select2:opening select2:closing', function (event) {
    const searchfield = $(this).parent().find('.select2-search__field');
    searchfield.prop('disabled', true);
});

$("#room__select").select2({
    dropdownAdapter: dropdownAdapter,
    minimumResultsForSearch: 0,
    placeholder: "აირჩიეთ ოთახი",
    allowClear: false,
    multiple: false,
    "language": {
        "noResults": function () {
            return "მსგავსი ოთახი არ მოიძებნა";
        }
    },
}).on('select2:opening select2:closing', function (event) {
    const searchfield = $(this).parent().find('.select2-search__field');
    searchfield.prop('disabled', true);
});