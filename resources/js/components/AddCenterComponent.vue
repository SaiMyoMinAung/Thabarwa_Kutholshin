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
            id="centerModel"
            tabindex="-1"
            role="dialog"
            aria-labelledby="centerLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="centerLabel">
                            {{ trans.get("title.create_center") }}
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
                            <label for="city"
                                >{{ trans.get("input.select_city") }}
                                <span class="text-danger">*</span></label
                            >
                            <select2
                                :url="fetchCity"
                                placeholder="Select City"
                                :value="null"
                                @input="selectedCityBox($event)"
                                :selected-option="selectedCity"
                                v-bind:class="{
                                    'is-invalid': validation.city_id_hasError,
                                    'is-valid':
                                        submited && !validation.city_id_hasError
                                }"
                            ></select2>
                            <div
                                class="invalid-feedback"
                                v-if="validation.city_id_hasError"
                            >
                                {{ validation.city_id_errorMessage }}
                            </div>

                            <div
                                class="valid-feedback"
                                v-if="!validation.city_id_hasError && submited"
                            >
                                {{ validation.city_id_successMessage }}
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
                            id="centerClose"
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
                city_id: "",
                is_available: 1
            },
            fetchCity: route("cities.index"),
            selectedCity: {},
            submited: false,
            validation: {
                name_hasError: false,
                name_errorMessage: "",
                name_successMessage: ""
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
        selectedCityBox(event) {
            this.selectedCity = event;
            this.data.city_id = event != null ? event.id : "";
        },
        create() {
            this.submited = true;
            let self = this;
            let url = route("centers.store");

            window.dashboard_app.$emit("startLoading");

            axios
                .post(url, this.data)
                .then(response => {
                    this.clearValidation();
                    this.clearData();

                    window.dashboard_app.$emit("centerSuccess", response.data);
                    window.dashboard_app.$toasted.show("Saving Success.", {
                        icon: "save"
                    });
                    window.dashboard_app.$emit("endLoading");
                    document.getElementById("centerClose").click();
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

            this.validation.city_id_hasError = false;
            this.validation.city_id_errorMessage = "";
            this.validation.city_id_successMessage = "";
        },
        constructValidation(validation) {
            if (validation.name) {
                this.validation.name_hasError = true;
                this.validation.name_errorMessage = validation.name[0];
            } else {
                this.validation.name_successMessage = "Good Job";
            }
            if (validation.city_id) {
                this.validation.city_id_hasError = true;
                this.validation.city_id_errorMessage = validation.city_id[0];
            } else {
                this.validation.city_id_successMessage = "Good Job";
            }
        },
        clearData() {
            this.data.name = "";
            this.data.city_id = "";
            this.selectedCity = {};
            this.submited = false;
        }
    }
};
</script>
