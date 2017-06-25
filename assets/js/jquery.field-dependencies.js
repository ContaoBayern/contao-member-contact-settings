(function ($) {
    jQuery.fn.fieldDependencies = function (options) {
        var defaults = {
            dependencies: [],
            mandatoryLabelAdditon: '<span class="mandatory">*</span>'
        };
        var config = $.extend(defaults, options);

        /**
         * Represents a field with dependencies.
         * @constructor
         */
        function FieldWithDependencies(form, fieldName, dependentFieldNames) {
            var self = this;

            self.field = form.find('input[name="' + fieldName + '"]');

            self.dependentFields = $();
            for (var i = 0; i < dependentFieldNames.length; i++) {
                self.dependentFields = self.dependentFields.add(form.find('[name="' + dependentFieldNames[i] + '"]'));
            }

            self.dependentFields.each(function () {
                $(this).parents('.widget').hide();
            });

            self.field.on('change', function () {
                if ($(this).is(':checked')) {
                    self.showDependentFields();
                } else {
                    self.hideDependentFields();
                }
            });
        }

        /**
         * Shows all dependent fields and sets them to be mandatory.
         */
        FieldWithDependencies.prototype.showDependentFields = function () {
            this.dependentFields.each(function () {
                $(this).prop('required', true);
                var labelHtml = $(this).siblings('label').html() + config.mandatoryLabelAdditon;
                $(this).siblings('label').html(labelHtml);
                $(this).parents('.widget').show();
            });
        };

        /**
         * Hides all dependent fields and removes the mandatory setting.
         */
        FieldWithDependencies.prototype.hideDependentFields = function () {
            this.dependentFields.each(function () {
                $(this).prop('required', false);
                var labelHtml = $(this).siblings('label').html().replace(config.mandatoryLabelAdditon, '');
                $(this).siblings('label').html(labelHtml);
                $(this).parents('.widget').hide();
            });
        };

        return this.each(function () {
            var form = $(this);
            var FieldsWithDependencies = [];

            form.removeAttr('novalidate');

            $.each(config.dependencies, function (fieldName, dependentFieldNames) {
                FieldsWithDependencies.push(new FieldWithDependencies(form, fieldName, dependentFieldNames));
            });
        });
    };
})(jQuery);
