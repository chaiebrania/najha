/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import 'icheck-bootstrap/icheck-bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css';
import '../css/adminlte.min.css';
import '../css/app.css';

import 'ionicons/dist';
import $ from 'jquery';
import moment from 'moment';
import 'bootstrap';
import 'datatables.net/js/jquery.dataTables.min';
import 'datatables.net-bs4/js/dataTables.bootstrap4.min';
import 'datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
import IMask from 'imask';
import '../js/adminlte.min';


var momentFormat = 'HH:mm';
$.each($('[data-mask="time"]'), function(index, element) {
    var momentMask = IMask(element, {
        mask: Date,
        pattern: momentFormat,
        lazy: false,
        format: function (date) {
            return moment(date).format(momentFormat);
        },
        parse: function (str) {
            return moment(str, momentFormat);
        },
        blocks: {
            HH: {
                mask: IMask.MaskedRange,
                from: 0,
                to: 23
            },
            mm: {
                mask: IMask.MaskedRange,
                from: 0,
                to: 59
            }
        }
    });
})


$("#dataTable").DataTable({
    "responsive": true,
    "autoWidth": false,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/French.json'
    },
    "order": [[ 2, "asc" ]]
});

$('#generate-pwd').on('click', function () {
    let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%@!?+=%',
        password = '';

    for (let i = 0; i < 16; i++) {
        password += chars[Math.floor(Math.random() * Math.floor(chars.length - 1))];
    }

    $('#user_password').val(password);
});

$('#toggle-pwd').on('click', function () {

    $('#toggle-pwd').children('i').toggleClass('fa-eye').toggleClass('fa-eye-slash')

    if($('#user_password').attr('type') === 'password') {
        $('#user_password').attr('type', 'text');
    }
    else {
        $('#user_password').attr('type', 'password');
    }
});