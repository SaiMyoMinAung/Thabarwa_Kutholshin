export default class AlmsRound {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.package_unit) {
                this.package_unit_hasError = true;
                this.package_unit_errorMessage = validation.package_unit;
                this.package_unit_successMessage = null;
            } else {
                this.package_unit_hasError = false;
                this.package_unit_successMessage = 'Good Name.';
            }


            if (validation.package_symbol) {
                this.package_symbol_hasError = true;
                this.package_symbol_errorMessage = validation.package_symbol;
                this.package_symbol_successMessage = null;
            } else {
                this.package_symbol_hasError = false;
                this.package_symbol_successMessage = 'Good Name.';
            }

            if (validation.loose_symbol) {
                this.loose_symbol_hasError = true;
                this.loose_symbol_errorMessage = validation.loose_symbol;
                this.loose_symbol_successMessage = null;
            } else {
                this.loose_symbol_hasError = false;
                this.loose_symbol_successMessage = 'Good Name.';
            }

            if (validation.loose_unit) {
                this.loose_unit_hasError = true;
                this.loose_unit_errorMessage = validation.loose_unit;
                this.loose_unit_successMessage = null;
            } else {
                this.loose_unit_hasError = false;
                this.loose_unit_successMessage = 'Good Name.';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.package_unit_hasError = false;
        this.package_unit_errorMessage = '';
        this.package_unit_successMessage = '';

        this.package_symbol_hasError = false;
        this.package_symbol_errorMessage = '';
        this.package_symbol_successMessage = '';

        this.loose_unit_hasError = false;
        this.loose_unit_errorMessage = '';
        this.loose_unit_successMessage = '';

        this.loose_symbol_hasError = false;
        this.loose_symbol_errorMessage = '';
        this.loose_symbol_successMessage = '';
    }

    validateName($event) {

    }

}