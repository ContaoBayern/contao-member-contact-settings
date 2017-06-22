(function($) {
    $(document).ready(function() {
        var $registrationForm = $('form#tl_registration');
        if ($registrationForm.length>0) {
            var initialState = {
                'street': $('input[name="street"]').prop('required'),
                'postal': $('input[name="postal"]').prop('required'),
                'city':   $('input[name="city"]').prop('required'),
                'fax':    $('input[name="fax"]').prop('required'),
                'email':  $('input[name="email"]').prop('required')
            };
            $registrationForm.removeAttr('novalidate');
            $('input[name="contactLetter"]').click(function() {
                if ($(this).is(':checked'))	{
                    $('input[name="street"]').prop('required',true);
                    $('input[name="postal"]').prop('required',true);
                    $('input[name="city"]').prop('required',true);
                } else {
                    $('input[name="street"]').prop('required',initialState.street);
                    $('input[name="postal"]').prop('required',initialState.postal);
                    $('input[name="city"]').prop('required',initialState.city);
                }
            });
            $('input[name="contactFax"]').click(function() {
                if ($(this).is(':checked'))	{
                    $('input[name="fax"]').prop('required',true);
                } else {
                    $('input[name="fax"]').prop('required',initialState.fax);
                }
            });
            $('input[name="contactEmail"]').click(function() {
                if ($(this).is(':checked'))	{
                    $('input[name="email"]').prop('required',true);
                } else {
                    $('input[name="email"]').prop('required',initialState.email);
                }
            });
        }
    });
})(jQuery);
