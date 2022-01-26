<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-sm btn-info"
            data-toggle="modal"
            data-target="#itemSubType"
        >
            +
        </button>

        <add-item-type-component />

        <!-- Modal -->
        <div
            class="modal fade"
            id="itemSubType"
            tabindex="-1"
            role="dialog"
            aria-labelledby="itemSubTypeLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemSubTypeLabel">
                            {{ trans.get("title.create_item_sub_type") }}
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
                                >{{ trans.get("input.item_sub_type") }}
                                <span class="text-danger">*</span></label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                placeholder="Enter Name"
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
                                data-target="#itemType"
                            >
                                +
                            </button>
                            <label for="itemType"
                                >{{ trans.get("input.item_type")
                                }}<span class="text-danger">*</span></label
                            >
                            <select2
                                :tabindex="3"
                                :url="fetchItemType"
                                placeholder="Select Item Type"
                                :value="data.item_type_id"
                                @input="selectedItemTypeBox($event)"
                                :selected-option="selectedItemType"
                                :fetch="fetchItemType"
                                v-bind:class="{
                                    'is-invalid':
                                        validation.item_type_id_hasError,
                                    'is-valid': submited && !validation.item_type_id_hasError
                                }"
                            ></select2>
                            <div
                                class="invalid-feedback"
                                v-if="validation.item_type_id_hasError"
                            >
                                {{ validation.item_type_id_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.item_type_id_hasError && submited"
                            >
                                {{ validation.item_type_id_successMessage }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unit"
                                >{{ trans.get("input.unit") }}
                                <span class="text-danger">*</span></label
                            >
                            <select2
                                :url="fetchUnit"
                                placeholder="Select Unit"
                                :value="data.unit_id"
                                @input="selectedUnitBox($event)"
                                :selected-option="selectedUnit"
                                v-bind:class="{
                                    'is-invalid': validation.unit_id_hasError,
                                    'is-valid': submited && !validation.unit_id_hasError
                                }"
                            ></select2>
                            <div
                                class="invalid-feedback"
                                v-if="validation.unit_id_hasError"
                            >
                                {{ validation.unit_id_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.unit_id_hasError && submited"
                            >
                                {{ validation.unit_id_successMessage }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="socket_per_package"
                                >{{ trans.get("input.sacket_per_package") }}
                                <span class="text-danger">*</span></label
                            >
                            <input
                                name="sacket_per_package"
                                id="sacket_per_package"
                                type="text"
                                class="form-control only-number"
                                :placeholder="
                                    trans.get(
                                        'input.sacket_per_package_placeholder'
                                    )
                                "
                                v-model="data.sacket_per_package"
                                v-bind:class="{
                                    'is-invalid':
                                        validation.sacket_per_package_hasError,
                                    'is-valid':
                                        validation.sacket_per_package_hasError
                                }"
                            />
                            <div
                                class="invalid-feedback"
                                v-if="validation.sacket_per_package_hasError"
                            >
                                {{ validation.sacket_per_package_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="validation.sacket_per_package_hasError"
                            >
                                {{
                                    validation.sacket_per_package_successMessage
                                }}
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
                            id="itemSubTypeClose"
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
import AddItemTypeComponent from "./AddItemTypeComponent.vue";
import select2 from "./select2";

export default {
    components: {
        select2,
        AddItemTypeComponent
    },
    created() {
        this.$root.$on("itemTypeSuccess", data => {
            this.data.item_type_id = data.id;
            this.selectedItemType = data;
        });
    },
    data: function() {
        return {
            data: {
                name: "",
                item_type_id: "",
                unit_id: "",
                sacket_per_package: ""
            },
            submited: false,
            validation: {
                name_hasError: false,
                name_errorMessage: "",
                name_successMessage: "",
                unit_id_hasError: false,
                unit_id_errorMessage: "",
                unit_id_successMessage: "",
                item_type_id_hasError: false,
                item_type_id_errorMessage: "",
                item_type_id_successMessage: "",
                sacke_per_package_hasError: false,
                sacke_per_package_errorMessage: "",
                sacke_per_package_successMessage: ""
            },
            fetchUnit: route("units.fetch"),
            fetchItemType: route("item_types.fetch"),
            selectedUnit: {},
            selectedItemType: {}
        };
    },
    methods: {
        selectedUnitBox(event) {
            this.selectedUnit = event;
            this.data.unit_id = event != null ? event.id : "";
        },
        selectedItemTypeBox(event) {
            this.selectedItemType = event;
            this.data.item_type_id = event != null ? event.id : "";
        },
        create() {
            this.submited = true;
            let self = this;
            let url = route("item_sub_types.store");
            window.dashboard_app.$emit("startLoading");

            axios
                .post(url, this.data)
                .then(response => {
                    this.clearValidation();
                    this.clearData();

                    window.dashboard_app.$emit(
                        "itemSubTypeSuccess",
                        response.data
                    );
                    window.dashboard_app.$toasted.show("Saving Success.", {
                        icon: "save"
                    });
                    window.dashboard_app.$emit("endLoading");
                    document.getElementById("itemSubTypeClose").click();
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

            this.validation.unit_id_hasError = false;
            this.validation.unit_id_errorMessage = "";
            this.validation.unit_id_successMessage = "";

            this.validation.item_type_id_hasError = false;
            this.validation.item_type_id_errorMessage = "";
            this.validation.item_type_id_successMessage = "";

            this.validation.sacket_per_package_hasError = false;
            this.validation.sacket_per_package_errorMessage = "";
            this.validation.sacket_per_package_successMessage = "";
        },
        constructValidation(validation) {
            if (validation.name) {
                this.validation.name_hasError = true;
                this.validation.name_errorMessage = validation.name[0];
            } else {
                this.validation.name_successMessage = "Good Job";
            }

            if (validation.unit_id) {
                this.validation.unit_id_hasError = true;
                this.validation.unit_id_errorMessage = validation.unit_id[0];
            } else {
                this.validation.unit_id_successMessage = "Good Job";
            }

            if (validation.item_type_id) {
                this.validation.item_type_id_hasError = true;
                this.validation.item_type_id_errorMessage =
                    validation.item_type_id[0];
            } else {
                this.validation.item_type_id_successMessage = "Good Job";
            }

            if (validation.sacket_per_package) {
                this.validation.sacket_per_package_hasError = true;
                this.validation.sacket_per_package_errorMessage =
                    validation.sacket_per_package[0];
            } else {
                this.validation.sacket_per_package_successMessage = "Good Job";
            }
        },
        clearData() {
            this.data.name = "";
            this.data.item_type_id = "";
            this.data.unit_id = "";
            this.data.sacket_per_package = "";
            //
            this.selectedUnit = {};
            this.selectedItemType = {};
            this.submited = false;
        }
    }
};
</script>
