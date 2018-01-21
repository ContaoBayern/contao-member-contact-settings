(function ($) {
    jQuery.fn.fieldDependencies = function (options) {
        var defaults = {
            dependencies: [],
            mandatoryClass: 'mandatory',
            mandatoryLabelAddition: '<span class="mandatory">*</span>',
            mandatoryLabelHint: '<span class="invisible">Mandatory </span>',
            trimLabelText: true,
            toggleVisibility: true
        };
        var config = $.extend(defaults, options);

        /**
         * Represents a field which can be set to be mandatory and shown or hidden.
         *
         * @constructor
         *
         * @param input object The input field (jQuery object)
         */
        function Field(input) {
            var self = this;

            self.input = input;

            self.label = self.input.siblings('label');

            // Trim label text so we can add the label addition (asterisk) without a space before it
            if (config.trimLabelText) {
                self.label.html($.trim(self.label.html()));
            }

            self.widget = self.input.parents('.widget');
        }

        /**
         * Sets the field to be mandatory.
         */
        Field.prototype.setMandatory = function () {
            this.input.prop('required', true);

            this.label.prepend($(config.mandatoryLabelHint));
            this.label.append($(config.mandatoryLabelAddition));

            this.widget.addClass(config.mandatoryClass);
            this.input.addClass(config.mandatoryClass);
            this.label.addClass(config.mandatoryClass);
        };

        /**
         * Removes the fields mandatory status.
         */
        Field.prototype.removeMandatoryStatus = function () {
            this.input.prop('required', false);

            var html = this.label.html();
            html = html.replace(config.mandatoryLabelAddition, '');
            html = html.replace(config.mandatoryLabelHint, '');
            this.label.html(html);

            this.widget.removeClass(config.mandatoryClass);
            this.input.removeClass(config.mandatoryClass);
            this.label.removeClass(config.mandatoryClass);
        };

        /**
         * Shows the field.
         */
        Field.prototype.show = function () {
            this.input.prop('disabled', false);
            this.widget.show();
        };

        /**
         * Hides the field.
         */
        Field.prototype.hide = function () {
            this.input.prop('disabled', true);
            this.widget.hide();
        };

        /**
         * Represents a field with dependencies.
         *
         * @constructor
         *
         * @param form         object The form to which the field belongs
         * @param name         string The name of the input field
         * @param dependencies array  The dependent fields (mandatory and visibility)
         */
        function FieldWithDependencies(form, name, dependencies) {
            var self = this;

            self.input = form.find('input[name="' + name + '"]');

            self.fieldsToSetMandatory = [];
            $.each(dependencies.mandatory, function (index, fieldName) {
                var input = form.find('[name="' + fieldName + '"]');
                    self.fieldsToSetMandatory.push(new Field(input));
            });

            if (config.toggleVisibility) {
                self.fieldsToToggleVisibility = [];
                $.each(dependencies.visibility, function (index, fieldName) {
                    var input = form.find('[name="' + fieldName + '"]');
                        self.fieldsToToggleVisibility.push(new Field(input));
                });

                self.hideDependentFields();
            }

            self.input.on('change', function () {
                if ($(this).is(':checked')) {
                    self.setDependentFieldsMandatory();
                    if (config.toggleVisibility) {
                        self.showDependentFields();
                    }
                } else {
                    self.removeDependentFieldsMandatoryStatus();
                    if (config.toggleVisibility) {
                        self.hideDependentFields();
                    }
                }
            });
        }

        /**
         * Sets all dependent fields to be mandatory.
         */
        FieldWithDependencies.prototype.setDependentFieldsMandatory = function () {
            $.each(this.fieldsToSetMandatory, function (index, field) {
                field.setMandatory();
            });
        };

        /**
         * Removes the mandatory status of all dependent fields.
         */
        FieldWithDependencies.prototype.removeDependentFieldsMandatoryStatus = function () {
            $.each(this.fieldsToSetMandatory, function (index, field) {
                field.removeMandatoryStatus();
            });
        };

        /**
         * Shows all dependent fields.
         */
        FieldWithDependencies.prototype.showDependentFields = function () {
            $.each(this.fieldsToToggleVisibility, function (index, field) {
                field.show();
            });
        };

        /**
         * Hides all dependent fields.
         */
        FieldWithDependencies.prototype.hideDependentFields = function () {
            $.each(this.fieldsToToggleVisibility, function (index, field) {
                field.hide();
            });
        };

        return this.each(function () {
            var form = $(this);
            var FieldsWithDependencies = [];

            form.removeAttr('novalidate');

            $.each(config.dependencies, function (name, dependencies) {
                FieldsWithDependencies.push(new FieldWithDependencies(form, name, dependencies));
            });
        });
    };
})(jQuery);
