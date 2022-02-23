<template>
    <div>
        <!-- Button trigger modal -->
        <!-- <button
            type="button"
            class="btn btn-sm btn-info"
            data-toggle="modal"
            data-target="#centerModel"
        >
            +
        </button> -->

        <!-- Modal -->
        <div
            class="modal fade"
            id="officeModel"
            tabindex="-1"
            role="dialog"
            aria-labelledby="officeLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="officeLabel">
                            {{ trans.get("title.create_office") }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"
                                >{{ trans.get("input.name") }}
                                <span class="text-danger">*</span></label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                :placeholder="trans.get('input.name')"
                                v-model="data.name"
                                v-bind:class="{
                                    'is-invalid': validation.name_hasError,
                                    'is-valid':
                                        submited && !validation.name_hasError
                                }"
                            />

                            <div
                                class="invalid-feedback"
                                v-if="validation.name_hasError"
                            >
                                {{ validation.name_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.name_hasError && submited"
                            >
                                {{ validation.name_successMessage }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address"
                                >{{ trans.get("input.address") }}
                                <span class="text-danger">*</span></label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="address"
                                :placeholder="trans.get('input.address')"
                                v-model="data.address"
                                v-bind:class="{
                                    'is-invalid': validation.address_hasError,
                                    'is-valid':
                                        submited && !validation.address_hasError
                                }"
                            />

                            <div
                                class="invalid-feedback"
                                v-if="validation.address_hasError"
                            >
                                {{ validation.address_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.address_hasError && submited"
                            >
                                {{ validation.address_successMessage }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="center"
                                >{{ trans.get("input.select_center") }}
                                <span class="text-danger">*</span></label
                            >
                            <select2
                                :url="fetchCenter"
                                placeholder="Select Center"
                                :value="null"
                                @input="selectedCenterBox($event)"
                                :selected-option="selectedCenter"
                                v-bind:class="{
                                    'is-invalid': validation.center_id_hasError,
                                    'is-valid':
                                        submited && !validation.center_id_hasError
                                }"
                            ></select2>
                            <div
                                class="invalid-feedback"
                                v-if="validation.center_id_hasError"
                            >
                                {{ validation.center_id_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.center_id_hasError && submited"
                            >
                                {{ validation.center_id_successMessage }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="create()"
                        >
                            {{ trans.get("button.create") }}
                        </button>
                        <button
                            type="button"
                            id="officeClose"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            {{ trans.get("button.close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import select2 from "./select2";

export default {
    components: {
        select2
    },
    data: function() {
        return {
            data: {
                name: "",
                center_id: "",
                addresss: "",
                is_open: 1
            },
            fetchCenter: route("centers.fetch"),
            selectedCenter: {},
            submited: false,
            validation: {
                name_hasError: false,
                name_errorMessage: "",
                name_successMessage: "",

                center_hasError: false,
                center_errorMessage: "",
                center_successMessage: "",

                address_hasError: false,
                address_errorMessage: "",
                address_successMessage: ""
            }
        };
    },
    // mounted() {
    //   let url = route("auth.admin.information");
    //   $.get(url)
    //     .then((response) => {
    //       this.data.city_id = response.office.center.city.id;
    //     })
    //     .catch((error) => {
    //       console.log(error);
    //     });
    // },
    methods: {
        selectedCenterBox(event) {
            this.selectedCenter = event;
            this.data.center_id = event != null ? event.id : "";
        },
        create() {
            this.submited = true;
            let self = this;
            let url = route("offices.store");

            window.dashboard_app.$emit("startLoading");

            axios
                .post(url, this.data)
                .then(response => {
                    this.clearValidation();
                    this.clearData();

                    window.dashboard_app.$emit("officeSuccess", response.data);
                    window.dashboard_app.$toasted.show("Saving Success.", {
                        icon: "save"
                    });
                    window.dashboard_app.$emit("endLoading");
                    document.getElementById("officeClose").click();
                })
                .catch(function(error) {
                    // window.dashboard_app.$emit('failed')
                    console.log(error.response);
                    self.clearValidation();
                    if (error.response.data) {
                        self.constructValidation(error.response.data.errors);
                    }

                    window.dashboard_app.$toasted.show("Saving Failed.", {
                        icon: "save"
                    });
                    window.dashboard_app.$emit("endLoading");
                });
        },
        clearValidation() {
            this.validation.name_hasError = false;
            this.validation.name_errorMessage = "";
            this.validation.name_successMessage = "";

            this.validation.center_id_hasError = false;
            this.validation.center_id_errorMessage = "";
            this.validation.center_id_successMessage = "";

            this.validation.address_hasError = false;
            this.validation.address_errorMessage = "";
            this.validation.address_successMessage = "";
        },
        constructValidation(validation) {
            if (validation.name) {
                this.validation.name_hasError = true;
                this.validation.name_errorMessage = validation.name[0];
            } else {
                this.validation.name_successMessage = "Good Job";
            }

            if (validation.address) {
                this.validation.address_hasError = true;
                this.validation.address_errorMessage = validation.address[0];
            } else {
                this.validation.address_successMessage = "Good Job";
            }

            if (validation.center_id) {
                this.validation.center_id_hasError = true;
                this.validation.center_id_errorMessage = validation.center_id[0];
            } else {
                this.validation.center_id_successMessage = "Good Job";
            }
        },
        clearData() {
            this.data.name = "";
            this.data.address = "";
            this.data.center_id = "";
            this.selectedCenter = {};
            this.submited = false;
        }
    }
};
</script>
