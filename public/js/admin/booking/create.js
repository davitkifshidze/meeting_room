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
    disabled: true,
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


/**
 * Calendar
 */

$("#room__select").on('change', function () {
    let user_id = $('#user__select').val();
    let room_id = $(this).val();


    $.ajax({
        url: 'room_info/' + room_id,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.room) {

                $("#booking_room_calendar").datetimepicker("destroy");
                $("#time__list").empty();

                $('#calendar__container').removeClass('hide').addClass('show');

                let room_start_date = response.room.start_date;
                let room_end_date = response.room.end_date;

                let last_date = new Date;

                jQuery('#booking_room_calendar').datetimepicker({
                    format: 'Y/m/d H:i',
                    formatTime: 'H:i',
                    formatDate: 'Y/m/d',
                    inline: true,
                    sideBySide: true,
                    step: 15,
                    disabledWeekDays: [0, 6],
                    minDate: last_date,
                    i18n: {
                        ka: {
                            months: [
                                'იანვარი', 'თებერვალი', 'მარტი', 'აპრილი', 'მაისი', 'ივნისი', 'ივლისი', 'აგვისტო', 'სექტემბერი', 'ოქტომბერი', 'ნოემბერი', 'დეკემბერი'
                            ],
                            dayOfWeekShort: [
                                "კვ", "ორშ", "სამშ", "ოთხ", "ხუთ", "პარ", "შაბ"
                            ],
                            dayOfWeek: ["კვირა", "ორშაბათი", "სამშაბათი", "ოთხშაბათი", "ხუთშაბათი", "პარასკევი", "შაბათი"]
                        },
                    },
                    timepicker: false,
                    disabledDates: [
                        // დასვენების დღეების დამატება
                        // '2023/07/19',
                    ],

                    onSelectDate: function (date) {

                        const click_date = new Date(date);
                        const selected_date = click_date.toISOString().split('T')[0];


                        const [start_hour, start_minute] = room_start_date.split(':').map(Number);
                        const [end_hour, end_minute] = room_end_date.split(':').map(Number);
                        const start_total_minutes = start_hour * 60 + start_minute;
                        const end_total_minutes = end_hour * 60 + end_minute;

                        const times = {};

                        for (let i = start_total_minutes; i < end_total_minutes; i += 15) {
                            const hour = Math.floor(i / 60);
                            const minute = i % 60;
                            const time = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                            times[time] = time;
                        }

                        const time__list = document.getElementById('time__list');
                        let time_html = '';

                        let close_date_array;
                        $.ajax({

                            url: 'room_booking_info/' + room_id + '/' + selected_date,
                            method: 'GET',
                            dataType: 'json',
                            success: function (response) {

                                const reserved = [];

                                if (response) {
                                    close_date_array = response.booking.map(booking => booking.start_date);

                                    close_date_array.forEach((timestamp) => {
                                        const date = new Date(timestamp);
                                        const hour = date.getHours();
                                        const minute = (date.getMinutes()).toString().padStart(2, '0');
                                        const reserved_time = `${hour}:${minute}`;

                                        reserved.push(reserved_time);
                                    });
                                }

                                Object.values(times).forEach(time => {

                                    let now = new Date();

                                    let year = now.getFullYear();
                                    let month = (now.getMonth() + 1).toString().padStart(2, '0');
                                    let day = now.getDate();

                                    let current_date = [year, month, day].join('-');
                                    let current_time = now.getHours() + ':' + now.getMinutes();

                                    let current_date_time = new Date(current_date + ' ' + current_time);
                                    let appropriate_date_time = new Date(selected_date + ' ' + time);

                                    if (current_date_time.getTime() >= appropriate_date_time.getTime()) {
                                        time_html += `<div class="time__box close" data-time="${time}">${time}</div>`;

                                    } else if (reserved.includes(time)) {
                                        time_html += `<div class="time__box reserved" data-time="${time}">${time}</div>`;

                                    } else {
                                        time_html += `<div class="time__box" data-time="${time}">${time}</div>`;

                                    }

                                });
                                time__list.innerHTML = time_html;

                                $('#time__container').removeClass('hide').addClass('show');

                                /**
                                 * Time Box Multi Selected
                                 */
                                const time_boxes = document.querySelectorAll(".time__box");
                                const selected_times = [];
                                let booking_date = [];

                                function timeBoxClick(event) {

                                    const time_boxes = event;
                                    const time = time_boxes.getAttribute("data-time");

                                    if (selected_times.includes(time)) {
                                        const index = selected_times.indexOf(time);
                                        selected_times.splice(index, 1);
                                        time_boxes.classList.remove("time__selected");
                                    } else {
                                        selected_times.push(time);
                                        time_boxes.classList.add("time__selected");
                                    }

                                    booking_date.splice(0);
                                    selected_times.forEach((time) => {
                                        booking_date.push(selected_date + ' ' + time);
                                    });

                                }

                                time_boxes.forEach(time_box => {
                                    time_box.addEventListener("click", function () {

                                        if (time_box.classList.contains("close")) {
                                            showMessage('warning', 'მოცემული დროის დაჯავშნა შეუძლებელია', 1500, 'top-end');
                                        } else if (time_box.classList.contains("reserved")) {
                                            showMessage('warning', 'მოცემული დრო უკვე დაჯავშნილია', 1500, 'top-end');
                                        } else {
                                            timeBoxClick(this)
                                        }

                                    });
                                });


                                /**
                                 * Booking Room
                                 */
                                const create__booking = $('#create__booking');

                                create__booking.on('click', function () {

                                    if (booking_date.length > 0) {

                                        $.ajax({
                                            url: 'create',
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            data: {'user_id': user_id, 'room_id': room_id, 'dates': booking_date},
                                            dataType: 'json',
                                            success: function (response) {

                                                const selected_time = document.querySelectorAll('div.time__selected');
                                                selected_time.forEach(div => {
                                                    div.classList.remove('time__selected');
                                                    div.classList.add('reserved');
                                                });

                                                showMessage('success', 'ოთახი წარმატებით დაიჯავშნა', 1500, 'top-end');


                                            },
                                            error: function (error) {
                                                showMessage('error', 'დაჯავშნისას წარმოიქმნა პრობლემა', 1500, 'top-end');
                                            }
                                        });

                                    } else {
                                        showMessage('warning', 'გთხოვთ აირჩიოთ ჯავშნის დრო', 1500, 'top-end');
                                    }


                                });


                            },
                            error: function (error) {
                                showMessage('error', 'გთხოვთ სცადოთ მოგვიანებით', 1000, 'top-end');
                            }
                        });


                    },


                });

            }
        },
        error: function (response) {


        }
    });

});

