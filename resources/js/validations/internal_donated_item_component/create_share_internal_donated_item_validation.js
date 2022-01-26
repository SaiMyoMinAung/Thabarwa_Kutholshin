export default class CreateShareInternalDonatedItemValidation {
    constructor(
        validation = null
    ) {
        if (validation != null) {

            if (validation.item_type_id) {
                this.item_type_id_hasError = true;
                this.item_type_id_errorMessage = validation.item_type_id[0];
                this.item_type_id_successMessage = null;
            } else {
                this.item_type_id_hasError = false;
                this.item_type_id_successMessage = 'Good Job.';
            }

            if (validation.item_sub_type_id) {
                this.item_sub_type_id_hasError = true;
                this.item_sub_type_id_errorMessage = validation.item_sub_type_id[0];
                this.item_sub_type_id_successMessage = null;
            } else {
                this.item_sub_type_id_hasError = false;
                this.item_sub_type_id_successMessage = 'Good Job.';
            }

            if (validation.package_qty) {
                this.package_qty_hasError = true;
                this.package_qty_errorMessage = validation.package_qty[0];
                this.package_qty_successMessage = null;
            } else {
                this.package_qty_hasError = false;
                this.package_qty_successMessage = 'Good Job.';
            }

            if (validation.sacket_qty) {
                this.sacket_qty_hasError = true;
                this.sacket_qty_errorMessage = validation.sacket_qty[0];
                this.sacket_qty_successMessage = null;
            } else {
                this.sacket_qty_hasError = false;
                this.sacket_qty_successMessage = 'Good Job.';
            }

            // For Internal Requested Item
            if (validation.requestable_type) {
                this.requestable_type_hasError = true;
                this.requestable_type_errorMessage = validation.requestable_type[0];
                this.requestable_type_successMessage = null;
            } else {
                this.requestable_type_hasError = false;
                this.requestable_type_successMessage = 'Good Job.';
            }

            if (validation.requestable_id) {
                this.requestable_id_hasError = true;
                this.requestable_id_errorMessage = validation.requestable_id[0];
                this.requestable_id_successMessage = null;
            } else {
                this.requestable_id_hasError = false;
                this.requestable_id_successMessage = 'Good Job.';
            }

        } else {
            this.clearValidation()
        }

        this.maxlength = 20;
    }

    clearValidation() {
        this.package_qty_hasError = false;
        this.package_qty_errorMessage = '';
        this.package_qty_successMessage = '';

        this.sacket_qty_hasError = false;
        this.sacket_qty_errorMessage = '';
        this.sacket_qty_successMessage = '';

        this.item_sub_type_id_hasError = false;
        this.item_sub_type_id_errorMessage = '';
        this.item_sub_type_id_successMessage = '';

        this.item_type_id_hasError = false;
        this.item_type_id_errorMessage = '';
        this.item_type_id_successMessage = '';

        this.requestable_type_hasError = false;
        this.requestable_type_errorMessage = '';
        this.requestable_type_successMessage = '';

        this.requestable_id_hasError = false;
        this.requestable_id_errorMessage = '';
        this.requestable_id_successMessage = '';

    }

}