/**
 * Select Multiple Create Author
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
    placeholder: "აირჩიეთ ავტორი",
    allowClear: false,
    multiple: false,
    disabled: true,
    "language": {
        "noResults": function(){
            return "მსგავსი ავტორი არ მოიძებნა";
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
        "noResults": function(){
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

$("#room__select").on('change', function() {
    let room_id = $(this).val();


    $.ajax({
        url: 'room_info/' + room_id,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if(response.room) {

                $("#booking_room_calendar").datetimepicker("destroy");
                $("#time__list").empty();

                $('#calendar__container').removeClass('hide').addClass('show');

                let room_start_date = response.room.start_date;
                let room_end_date = response.room.end_date;

                let last_date = new Date;

                jQuery('#booking_room_calendar').datetimepicker({
                    format:	'Y/m/d H:i',
                    formatTime:	'H:i',
                    formatDate:	'Y/m/d',
                    inline: true,
                    sideBySide:true,
                    step:15,
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
                    timepicker:false,
                    disabledDates : [
                        '2023/07/19',
                        '2023/07/21',
                        '2023/07/25',
                    ],

                    onSelectDate:function (date) {

                        const [start_hour, start_minute] = room_start_date.split(':').map(Number);
                        const [end_hour, end_minute] = room_end_date.split(':').map(Number);
                        const start_total_minutes = start_hour * 60 + start_minute;
                        const end_total_minutes = end_hour * 60 + end_minute;

                        const times = {};

                        for (let i = start_total_minutes; i <= end_total_minutes; i += 15) {
                            const hour = Math.floor(i / 60);
                            const minute = i % 60;
                            const time = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                            times[time] = time;
                        }

                        const time__list = document.getElementById('time__list');
                        let time_html = '';
                        Object.values(times).forEach(time => {
                            time_html += `<div class="time__box" data-time="${time}">${time}</div>`;
                        });
                        time__list.innerHTML = time_html;

                        $('#time__container').removeClass('hide').addClass('show');

                        const click_date = new Date(date);
                        const selected_date = click_date.toISOString().split('T')[0];

                        /**
                         * Time Box Multi Selected
                         */
                        const time_boxes = document.querySelectorAll(".time__box");
                        const selected_times = [];

                        function handleTimeBoxClick(event) {
                            const time_boxes = event.target;
                            const time = time_boxes.getAttribute("data-time");

                            if (selected_times.includes(time)) {
                                const index = selected_times.indexOf(time);
                                selected_times.splice(index, 1);
                                time_boxes.classList.remove("time__selected");
                            } else {
                                selected_times.push(time);
                                time_boxes.classList.add("time__selected");
                            }
                            console.log(selected_times);
                        }

                        time_boxes.forEach(time_box => {
                            time_box.addEventListener("click", handleTimeBoxClick);
                        });

                        let store_data = [] ;
                        store_data.push(selected_date);
                        store_data.push(selected_times);
                        console.log(store_data)

                        $.ajax({
                            url: '/booking/create',
                            method: 'POST',
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function(response) {
                                if(response.success) {


                                }
                            },
                            error: function(response) {



                            }
                        });


                    },


                });

            }
        },
        error: function(response) {



        }
    });

});

