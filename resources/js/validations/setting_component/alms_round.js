export default class AlmsRound {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.name) {
                this.name_hasError = true;
                this.name_errorMessage = validation.name;
                this.name_successMessage = null;
            } else {
                this.name_hasError = false;
                this.name_successMessage = 'Good Name.';
            }

            if (validation.center_id) {
                this.center_id_hasError = true;
                this.center_id_errorMessage = validation.center_id;
                this.center_id_successMessage = null;
            } else {
                this.center_id_hasError = false;
                this.center_id_successMessage = 'Good Center.';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.name_hasError = false;
        this.name_errorMessage = '';
        this.name_successMessage = '';

        this.center_id_hasError = false;
        this.center_id_errorMessage = '';
        this.center_id_successMessage = '';

    }

    validateName($event) {

    }

}