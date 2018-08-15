//jQuery.validator.extend
jQuery.extend( jQuery.validator.methods, {

    requiredTo: function( value, element, param ) {

        // Bind to the blur event of the target in order to revalidate whenever the target field is updated
        var target = $( param );
        if ( this.settings.onfocusout && target.not( ".validate-requiredTo-blur" ).length ) {
            target.addClass( "validate-requiredTo-blur" ).on( "blur.validate-requiredTo", function() {
                $( element ).valid();
            } );
        }
        return target.val().length > 0;
    },

    decimals: function( value, element ) {
        return this.optional(element) || /^\d+(\.\d{1,2})?$/.test(value);
    },

    username:function(value, element){
        return this.optional(element) || /(^.*?[a-zA-Z]+.*?\d+.*?$)|(^.*?\d+.*?[a-zA-Z]+.*?$)/.test(value);
    },

    mobile: function( value, element ) {
        return this.optional(element) || /^1[3|4|5|7|8][0-9]\d{8}$/.test(value);
    },

    phone: function( value, element ) {
        return this.optional(element) || /^0\d{2,4}-?\d{7,8}$/.test(value);
    },

    smscode: function( value, element ) {
        return this.optional(element) || /^[0-9]{6}$/.test(value);
    },

    realname: function(value, element){
        return this.optional(element) || /^[\u4e00-\u9fa5]+$/.test(value);
    },

    remote: function( value, element, param, method ) {
        if ( this.optional( element ) ) {
            return "dependency-mismatch";
        }

        method = typeof method === "string" && method || "remote";

        var previous = this.previousValue( element, method ),
            validator, data, optionDataString;

        if ( !this.settings.messages[ element.name ] ) {
            this.settings.messages[ element.name ] = {};
        }
        previous.originalMessage = previous.originalMessage || this.settings.messages[ element.name ][ method ];
        this.settings.messages[ element.name ][ method ] = previous.message;

        param = typeof param === "string" && { url: param } || param;
        optionDataString = $.param( $.extend( { data: value }, param.data ) );
        if ( previous.old === optionDataString ) {
            return previous.valid;
        }

        previous.old = optionDataString;
        validator = this;
        this.startRequest( element );
        data = {};
        data[ element.name ] = value;
        $.ajax( $.extend( true, {
            mode: "abort",
            port: "validate" + element.name,
            dataType: "json",
            data: data,
            context: validator.currentForm,
            success: function( response ) {
                var valid = response === true || response === "true",
                    errors, message, submitted;

                validator.settings.messages[ element.name ][ method ] = previous.originalMessage;
                if ( valid ) {
                    submitted = validator.formSubmitted;
                    validator.resetInternals();
                    validator.toHide = validator.errorsFor( element );
                    validator.formSubmitted = submitted;
                    validator.successList.push( element );
                    validator.invalid[ element.name ] = false;
                    validator.showErrors();
                } else {
                    errors = {};
                    message = response.info || validator.defaultMessage( element, { method: method, parameters: value } );
                    errors[ element.name ] = previous.message = message;
                    validator.invalid[ element.name ] = true;
                    validator.showErrors( errors );
                }
                previous.valid = valid;
                validator.stopRequest( element, valid );
            },
            error: function( response ) {
                var valid = false, errors = {}, message;
                validator.settings.messages[ element.name ][ method ] = previous.originalMessage;
                if (!response) {
                    message = response || validator.defaultMessage( element, { method: method, parameters: value } );
                    errors[ element.name ] = previous.message = message;
                    validator.invalid[ element.name ] = true;
                    validator.showErrors( errors );
                    previous.valid = valid;
                    validator.stopRequest( element, valid );
                } else {
                    response = $.parseJSON(response.responseText);
                    if (response.errors) {
                        $.each(response.errors, function (key, value) {
                            message = value || validator.defaultMessage( element, { method: method, parameters: value } );
                            errors[ element.name ] = previous.message = message;
                            validator.invalid[ element.name ] = true;
                            validator.showErrors( errors );
                            previous.valid = valid;
                            validator.stopRequest( element, valid );
                            return false;
                        });
                    }
                }
            }
        }, param ) );
        return "pending";
    }
});