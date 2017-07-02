(function ($) {
    jQuery.fn.fieldDependencies = function (options) {
        var defaults = {
            dependencies: [],
            mandatoryLabelAdditon: '<span class="mandatory">*</span>'
        };
        var config = $.extend(defaults, options);

        /**
         * Represents a field which can be set to be mandatory and shown or hidden.
         *
         * @constructor
         *
         * @param element object The input field element (jQuery object)
         */
        function Field(element) {
            var self = this;

            self.element = element;

            self.label = self.element.siblings('label');
            self.originalLabelText = self.label.html();

            self.widget = self.element.parents('.widget');
        }

        /**
         * Sets the field to be mandatory.
         */
        Field.prototype.setMandatory = function () {
            this.element.prop('required', true);
            this.label.html(this.originalLabelText + config.mandatoryLabelAdditon);
        };

        /**
         * Removes the fields mandatory status.
         */
        Field.prototype.removeMandatoryStatus = function () {
            this.element.prop('required', false);
            this.label.html(this.originalLabelText);
        };

        /**
         * Shows the field.
         */
        Field.prototype.show = function () {
            this.element.prop('disabled', false);
            this.widget.show();
        };

        /**
         * Hides the field.
         */
        Field.prototype.hide = function () {
            this.element.prop('disabled', true);
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

            self.element = form.find('input[name="' + name + '"]');

            self.fieldsToSetMandatory = [];
            $.each(dependencies.mandatory, function (index, fieldName) {
                var element = form.find('[name="' + fieldName + '"]');
                // Only add fields which are not mandatory by default
                if (element.attr('required') === undefined) {
                    self.fieldsToSetMandatory.push(new Field(element));
                }
            });

            self.fieldsToShowOrHide = [];
            $.each(dependencies.visibility, function (index, fieldName) {
                var element = form.find('[name="' + fieldName + '"]');
                // Only add fields which are not mandatory by default
                if (element.attr('required') === undefined) {
                    self.fieldsToShowOrHide.push(new Field(element));
                }
            });

            self.hideDependentFields();

            self.element.on('change', function () {
                if ($(this).is(':checked')) {
                    self.setDependentFieldsMandatory();
                    self.showDependentFields();
                } else {
                    self.removeDependentFieldsMandatoryStatus();
                    self.hideDependentFields();
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
            $.each(this.fieldsToShowOrHide, function (index, field) {
                field.show();
            });
        };

        /**
         * Hides all dependent fields.
         */
        FieldWithDependencies.prototype.hideDependentFields = function () {
            $.each(this.fieldsToShowOrHide, function (index, field) {
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
