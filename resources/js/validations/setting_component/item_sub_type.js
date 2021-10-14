export default class ItemSubType {
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

            if (validation.item_type_id) {
                this.item_type_id_hasError = true;
                this.item_type_id_errorMessage = validation.item_type_id;
                this.item_type_id_successMessage = null;
            } else {
                this.item_type_id_hasError = false;
                this.item_type_id_successMessage = 'Good Item Sub Type.';
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

        this.item_type_id_hasError = false;
        this.item_type_id_errorMessage = '';
        this.item_type_id_successMessage = '';

    }

    validateName($event) {

    }

}