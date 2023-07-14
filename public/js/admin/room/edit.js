/**
 * Show Appropriate Container [ Lang Tab ]
 */
const lang_tabs = document.querySelectorAll('.lang__tab');
const lang_containers = document.querySelectorAll('.translatable');
let active_lang = document.querySelector('.active__lang').getAttribute('data-lang');

/** Show the initially active language container and its corresponding tab */
let initial_container = document.querySelector(`[data-lang-container="${active_lang}"]`);
initial_container.classList.remove('hide');

lang_tabs.forEach(active_tab => {
    active_tab.addEventListener('click', () => {
        const selected_lang = active_tab.getAttribute('data-lang');

        lang_containers.forEach(container => {
            container.classList.remove('show');
            container.classList.add('hide');
        });

        const active_container = document.querySelector(`[data-lang-container="${selected_lang}"]`);
        active_container.classList.remove('hide');
        active_container.classList.add('show');

        lang_tabs.forEach(tab => {
            tab.classList.remove('active__lang');
        });
        active_tab.classList.add('active__lang');

        active_lang = selected_lang;

    });
});

/**
 * Date Time Picker
 */
$('#start_date').datetimepicker({
    datepicker:false,
    format:'H:i',
    step:15,
    minTime: '9:00',
    maxTime: '17:15',
});

$('#end_date').datetimepicker({
    datepicker:false,
    format:'H:i',
    step:15,
    minTime: '9:00',
    maxTime: '17:15',
});