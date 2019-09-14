$(document).ready(function() {
   $('#loginForm').on('submit', function(e) {
        
        if ( $('#username').val() == ''){
            alert('Masukkan Username');
            $('#username').focus();
            return false;
        } else if ($('#password').val() == '') {
            alert('Masukkan password');
            $('#password').focus();
            return false;
        } else {
            $('#loginForm').submit();
        }
        e.preventDefault();
   });
});