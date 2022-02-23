<template>
    <div>
        <!-- Button trigger modal -->
        <!-- <button
            type="button"
            class="btn btn-info"
            data-toggle="modal"
            data-target="#teamModel"
        >
            {{ trans.get("button.create_team") }}
        </button> -->
        <add-office-component />
        <!-- Modal -->
        <div
            class="modal fade"
            id="contributionModel"
            tabindex="-1"
            role="dialog"
            aria-labelledby="contributionLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contributionLabel">
                            {{ trans.get("button.create_contribution") }}
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
                            <label for="contribution_name"
                                >{{ trans.get("input.name") }}
                                <span class="text-danger">*</span></label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="contribution_name"
                                :placeholder="
                                    trans.get('input.name_placeholder')
                                "
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
                            <button
                                type="button"
                                class="btn btn-sm btn-info"
                                data-toggle="modal"
                                data-target="#officeModel"
                            >
                                +
                            </button>

                            <label for="office"
                                >{{ trans.get("input.select_receive_office") }}
                                <span class="text-danger">*</span></label
                            >
                            <select2
                                :url="fetchOffice"
                                placeholder="Select Receive Office"
                                :value="null"
                                @input="selectedReceiveOfficeBox($event)"
                                :selected-option="selectedReceiveOffice"
                                v-bind:class="{
                                    'is-invalid': validation.receive_office_id_hasError,
                                    'is-valid':
                                        submited &&
                                        !validation.receive_office_id_hasError
                                }"
                            ></select2>
                            <div
                                class="invalid-feedback"
                                v-if="validation.receive_office_id_hasError"
                            >
                                {{ validation.receive_office_id_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="
                                    !validation.receive_office_id_hasError && submited
                                "
                            >
                                {{ validation.receive_office_id_successMessage }}
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
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            id="contributionModelClose"
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
import AddCenterComponent from "./AddCenterComponent.vue";
import AddOfficeComponent from "./AddOfficeComponent.vue";
import select2 from "./select2";
export default {
    components: {
        select2,
        AddCenterComponent,
        AddOfficeComponent
    },
    data: function() {
        return {
            data: {
                name: "",
                receive_office_id: ""
            },
            submited: false,
            fetchOffice: route("offices.fetch"),
            selectedReceiveOffice: {},
            validation: {
                name_hasError: false,
                name_errorMessage: "",
                name_successMessage: "",

                receive_office_id_hasError: false,
                receive_office_id_errorMessage: "",
                receive_office_id_successMessage: ""
            }
        };
    },
    mounted() {
        let url = route("auth.admin.information");
        $.get(url)
            .then(response => {
                // this.data.center_id = response.center.id;
            })
            .catch(error => {
                console.log(error);
            });
    },
    created() {
        this.$root.$on("officeSuccess", data => {
            this.data.receive_office_id = data.id;
            this.selectedReceiveOffice = data;
        });
    },
    methods: {
        create() {
            this.submited = true;
            let self = this;
            let url = route("contributions.store");

            window.dashboard_app.$emit("startLoading");

            axios
                .post(url, this.data)
                .then(response => {
                    this.clearValidation();
                    this.clearData();

                    window.dashboard_app.$emit("contributionCreateSuccess", response.data);
                    window.dashboard_app.$toasted.show("Saving Success.", {
                        icon: "save"
                    });
                    window.dashboard_app.$emit("endLoading");
                    document.getElementById('contributionModelClose').click();
                })
                .catch(function(error) {
                    // window.dashboard_app.$emit('failed')
                    console.log(error.response);
                    self.clearValidation();
                    self.constructValidation(error.response.data.errors);

                    window.dashboard_app.$toasted.show("Saving Failed.", {
                        icon: "save"
                    });
                    window.dashboard_app.$emit("endLoading");
                });
        },
        selectedReceiveOfficeBox(event) {
            this.selectedReceiveOffice = event;
            this.data.receive_office_id = event != null ? event.id : "";
        },
        clearValidation() {
            this.validation.name_hasError = false;
            this.validation.name_errorMessage = "";
            this.validation.name_successMessage = "";

            this.validation.receive_office_id_hasError = false;
            this.validation.receive_office_id_errorMessage = "";
            this.validation.receive_office_id_successMessage = "";
        },
        constructValidation(validation) {
            if (validation.name) {
                this.validation.name_hasError = true;
                this.validation.name_errorMessage = validation.name[0];
            } else {
                this.validation.name_successMessage = "Good Job";
            }
            
            if (validation.receive_office_id) {
                this.validation.receive_office_id_hasError = true;
                this.validation.receive_office_id_errorMessage =
                    validation.receive_office_id[0];
            } else {
                this.validation.receive_office_id_successMessage = "Good Job";
            }
        },
        clearData() {
            this.data.name = "";
            this.data.receive_office_id = "";
            this.selectedReceiveOffice = {};
            this.submited = false;
        }
    }
};
</script>
